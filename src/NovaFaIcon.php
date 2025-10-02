<?php

namespace Welkervinicius\NovaFaIcon;

use Laravel\Nova\Fields\Field;

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
                'choose' => __('nova-fa-icon::nova-fa-icon.choose'),
                'choose_an_icon' => __('nova-fa-icon::nova-fa-icon.choose_an_icon'),
                'select_icon' => __('nova-fa-icon::nova-fa-icon.select_icon'),
                'search' => __('nova-fa-icon::nova-fa-icon.search'),
                'loading' => __('nova-fa-icon::nova-fa-icon.loading'),
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
