<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Path to the Icon JSON File
    |--------------------------------------------------------------------------
    |
    | By default, we use the icon file included with this package. You can
    | publish this configuration and point to your own JSON file, for instance,
    | if you are using a Pro version of Font Awesome.
    |
    | If you publish this configuration and encounter an error loading the JSON file,
    | ensure the path is correct. For Pro versions, the icon data is typically located
    | inside your `fontawesome` package under `metadata` path like:
    | `asset('assets/fontawesome-pro/metadata/icons.json')`.
    |
    */

    'icon_file' => base_path('vendor/welkervinicius/nova-fa-icon/data/icons.json'),

    /*
    |--------------------------------------------------------------------------
    | Icon Styles to be Loaded
    |--------------------------------------------------------------------------
    |
    | Define which Font Awesome styles should be loaded and displayed in the
    | icon picker. By default, we load the styles for the free version
    | of Font Awesome 6.
    |
    */

    'styles' => [
        'brands',
        'regular',
        'solid',
    ],

];
