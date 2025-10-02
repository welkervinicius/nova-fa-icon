<?php

namespace Welkervinicius\NovaFaIcon;

use Illuminate\Support\Facades\Route; // <-- Adicionar Import
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Welkervinicius\NovaFaIcon\Http\Controllers\IconController; // <-- Adicionar Import

class FieldServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Torna o arquivo de configuração publicável
        $this->publishes([
            __DIR__.'/../config/nova-fa-icon.php' => config_path('nova-fa-icon.php'),
        ], 'nova-fa-icon-config'); // Usamos uma tag específica

        // Mescla a configuração padrão do pacote com a do usuário (se publicada)
        $this->mergeConfigFrom(
            __DIR__.'/../config/nova-fa-icon.php',
            'nova-fa-icon' // Esta é a chave que usaremos: config('nova-fa-icon.key')
        );

        // Carrega os arquivos de tradução do pacote
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'nova-fa-icon');

        // Torna os arquivos de tradução publicáveis
        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/nova-fa-icon'),
        ], 'nova-fa-icon-lang');

        // Registra o evento que é disparado quando o Nova está sendo servido
        Nova::serving(function (ServingNova $event) {
            // Mantemos o seu método moderno de registrar assets
            Nova::mix('nova-fa-icon', __DIR__.'/../dist/mix-manifest.json');
        });

        // Adicionamos a chamada para registrar as rotas do nosso pacote
        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * Registra as rotas da API do nosso pacote.
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        // Define um grupo de rotas com o middleware e prefixo padrão do Nova
        Route::middleware(['nova'])
            ->prefix('nova-vendor/nova-fa-icon') // <-- Prefixo com o nome do nosso pacote
            ->group(function () {
                // Nossa rota que busca os ícones e chama o controller
                Route::get('/icons', IconController::class);
            });
    }

    public function register(): void
    {
        //
    }
}
