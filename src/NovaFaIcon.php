<?php

namespace Welkervinicius\NovaFaIcon;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Nova;

class NovaFaIcon extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-fa-icon';

    /**
     * Cria uma nova instância do campo.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  callable|null  $resolveCallback
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        // Traduz as strings no backend e as envia para o frontend via 'meta'.
        $this->withMeta([
            'translations' => [
                'choose' => Nova::__('nova-fa-icon::messages.nfai.choose'),
                'choose_icon' => Nova::__('nova-fa-icon::messages.nfai.choose_icon'),
                'icon_list' => Nova::__('nova-fa-icon::messages.nfai.icon_list'),
                'search' => Nova::__('nova-fa-icon::messages.nfai.search'),
                'loading' => Nova::__('nova-fa-icon::messages.nfai.loading'),
                'no_results' => Nova::__('nova-fa-icon::messages.nfai.no_results'),
                'clear_selection' => Nova::__('nova-fa-icon::messages.nfai.clear_selection'),
            ],
        ]);
    }

    /**
     * Define quais estilos de ícones devem ser exibidos no seletor.
     *
     * @param  array  $styles ['solid', 'regular', 'brands']
     * @return $this
     */
    public function styles(array $styles)
    {
        return $this->withMeta(['fa_styles' => $styles]);
    }
}
