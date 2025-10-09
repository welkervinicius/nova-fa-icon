# Font Awesome Icon Picker Field for Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://packagist.org/packages/welkervinicius/nova-fa-icon)
[![Total Downloads](https://img.shields.io/packagist/dt/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://packagist.org/packages/welkervinicius/nova-fa-icon)
[![License](https://img.shields.io/packagist/l/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://github.com/welkervinicius/nova-fa-icon/blob/main/LICENSE.md)

An advanced and performant field for Laravel Nova that allows you to search and select Font Awesome icons.  
Built with a modern architecture, it ensures a fast and fluid user experience, even with thousands of icons.

![Nova FA Icon Picker Screenshot](https://raw.githubusercontent.com/welkervinicius/nova-fa-icon/main/docs/select-screenshot.png)

### Features

- **Server-Side Search:** The search is performed on the backend, including each icon's search terms (e.g., searching for "logout" finds the "right-from-bracket" icon), ensuring maximum performance.
- **Infinite Scroll:** Icons are loaded on-demand as the user scrolls, making the picker's opening instantaneous.
- **Configurable:** Allows publishing a configuration file to use your own `icons.json` (ideal for Pro versions) and to define the globally available icon styles.
- **Flexible:** Allows filtering icon styles (`solid`, `brands`, etc.) on a per-field basis directly in your Resource.
- **Localized:** The field respects the locale selected in the Nova panel and includes translations for English and Brazilian Portuguese out of the box.

---

### Installation

You can install the package via Composer:

```bash
composer require welkervinicius/nova-fa-icon
```

---

### Initial Setup

For the icons to be displayed, you need to load the Font Awesome stylesheet.  
The easiest way is via CDN.

In your `app/Providers/NovaServiceProvider.php`, inside the `boot()` method, add the following `Nova::style()` line after the `parent::boot();` call:

```php
public function boot()
{
    parent::boot();
    
    Nova::style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css');
}
```

---

### Optional Configuration

You can publish the configuration file to customize the `icons.json` path and the default styles.

```bash
php artisan vendor:publish --tag="nova-fa-icon-config"
```

You can also publish the translation files to add new languages or customize the text.

```bash
php artisan vendor:publish --tag="nova-fa-icon-lang"
```

---

### ⚙️ Customizing the Icons Source (for Font Awesome Pro or Custom Builds)

Starting from **v1.0.1**, the configuration file now uses `base_path()` instead of `__DIR__`, ensuring that the published config file points to your application's root instead of the package directory.

If you’re using a **Pro** version of Font Awesome, or your own icon build, you should:

1. **Publish the configuration file** (if not already done):
   ```bash
   php artisan vendor:publish --tag="nova-fa-icon-config"
   ```

2. **Edit the `config/nova-fa-icon.php` file**, and update the path to your own `icons.json`.  
   For example, Font Awesome Pro typically stores this file at:
   ```php
   'icon_file' => base_path('node_modules/@fortawesome/fontawesome-pro/metadata/icons.json'),
   ```
   Or, if you have a custom JSON file elsewhere:
   ```php
   'icon_file' => base_path('resources/icons/custom-icons.json'),
   ```

3. The package will automatically load icons from the JSON path defined here.

This approach ensures full compatibility with any Font Awesome package (Free, Pro, or custom) while avoiding path resolution issues after publishing the configuration.

---

### Localization

From v1.1.0, translations are fully namespaced and loaded via the Laravel package system.
Supported languages:

- English `(en)`
- Portuguese (Brazil) `(pt_BR)`
- Spanish `(es)`
- Italian `(it)`
- Russian `(ru)`

Laravel Nova automatically selects the correct translation based on your panel locale.

---

### Usage

#### Basic Usage

In your Nova Resource, simply add the `NovaFaIcon` field.

```php
use Welkervinicius\NovaFaIcon\NovaFaIcon;

public function fields(Request $request)
{
    return [
        // ...
        NovaFaIcon::make('Icon'),
    ];
}
```

#### Filtering by Styles

You can restrict the available icon styles for a specific field using the `styles()` method.

```php
NovaFaIcon::make('Brand Icon', 'brand_icon')
    ->styles(['brands']), // This will only show icons of the "brands" style.

NovaFaIcon::make('Action Icon', 'action_icon')
    ->styles(['solid', 'regular']), // This will only show solid and regular icons.
```

#### Using an Alias

For cleaner code, you can use an alias in your import statement.

```php
use Welkervinicius\NovaFaIcon\NovaFaIcon as FaIcon;

// ...
FaIcon::make('Icon')->styles(['solid']),
```

---

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for more information on what has changed recently.

---

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

---

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.
