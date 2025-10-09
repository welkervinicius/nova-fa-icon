<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Caminho para o arquivo JSON de ícones
    |--------------------------------------------------------------------------
    |
    | Por padrão, usamos o arquivo que vem com este pacote. Você pode
    | publicar esta configuração e apontar para seu próprio arquivo
    | JSON, caso utilize uma versão Pro do Font Awesome, por exemplo.
    |
    */

    'icon_file' => base_path('vendor/welkervinicius/nova-fa-icon/data/icons.json'),

    /*
    |--------------------------------------------------------------------------
    | Estilos de Ícones a Serem Carregados
    |--------------------------------------------------------------------------
    |
    | Defina quais estilos do Font Awesome devem ser carregados e exibidos
    | no seletor de ícones. Por padrão, carregamos os estilos da
    | versão gratuita do Font Awesome 6.
    |
    */

    'styles' => [
        'brands',
        'regular',
        'solid',
    ],

];
