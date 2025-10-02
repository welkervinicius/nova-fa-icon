<?php

namespace Welkervinicius\NovaFaIcon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class IconController extends Controller
{
    public function __invoke(Request $request)
    {
        $path = config('nova-fa-icon.icon_file');

        if (!file_exists($path)) {
            return response()->json(['error' => 'Arquivo de ícones não encontrado.'], 404);
        }

        // Pega os estilos GLOBAIS permitidos pelo arquivo de configuração.
        $globallyAllowedStyles = config('nova-fa-icon.styles', [
            'brands',
            'duotone',
            'light',
            'regular',
            'solid',
            'thin',
        ]);

        // Pega os estilos ESPECÍFICOS pedidos por este campo (via frontend).
        $requestedStyles = $request->input('styles');

        // Decide quais estilos usar.
        if (is_array($requestedStyles) && !empty($requestedStyles)) {
            // Se o campo pediu estilos específicos, usamos a INTERSECÇÃO entre o que ele pediu e o que é permitido globalmente.
            $finalStyles = array_intersect($requestedStyles, $globallyAllowedStyles);
        } else {
            // Se o campo não pediu nada, usamos todos os estilos permitidos globalmente.
            $finalStyles = $globallyAllowedStyles;
        }

        $allIcons = collect(json_decode(file_get_contents($path), true));

        $collection = $allIcons->filter(function ($iconData) use ($finalStyles) {
            // Filtra os ícones para manter apenas aqueles que possuem pelo menos um dos estilos finais.
            return !empty(array_intersect($iconData['styles'], $finalStyles));
        });

        // O resto do código para busca e paginação continua o mesmo...
        if ($search = $request->input('search')) {
            $search = Str::lower($search);
            $collection = $collection->filter(function ($item, $key) use ($search) {
                $searchIn = $key . ' ' . implode(' ', data_get($item, 'search.terms', []));
                return Str::contains(Str::lower($searchIn), $search);
            });
        }

        $icons = $collection->mapWithKeys(function ($iconData, $key) use ($finalStyles) {
            $styles = array_intersect($iconData['styles'], $finalStyles);
            $formatted = [];
            foreach ($styles as $style) {
                $prefix = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'][$style] ?? 'fas';
                $formatted[trim($key . ' (' . $style . ')')] = $prefix . ' fa-' . $key;
            }
            return $formatted;
        });

        $page = (int) $request->input('page', 0);
        $perPage = 100;
        $chunk = $icons->slice($page * $perPage, $perPage);

        return response()->json([
            'icons' => $chunk,
            'has_more_pages' => $icons->count() > (($page + 1) * $perPage),
        ]);
    }
}
