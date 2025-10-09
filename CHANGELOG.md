# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2025-10-09

### Fixed
- **Translation Loading in Packages:** Fixed an issue where translation keys (e.g. `nova-fa-icon::messages.key`) were displayed as plain text in some Laravel versions (notably Laravel 10).  
  Translations are now correctly loaded across Laravel 10, 11, and 12, ensuring full compatibility with Nova 5.

### Changed
- Updated the translation system to use **PHP-based namespaced translations** (e.g. `__('nova-fa-icon::messages.key')`), the most stable approach for Laravel packages.

### Added
- **Multi-language Support:** Added new languages for broader internationalization:
  - Portuguese (Brazil) — `pt_BR`
  - Spanish — `es`
  - Italian — `it`
  - Russian — `ru`

## [1.0.1] - 2025-10-09

### Fixed

-   The `icon_file` path in the configuration now uses `base_path()` instead of `__DIR__`, fixing the loading error that occurred after publishing the configuration via `vendor:publish`.

## [1.0.0] - 2025-10-02

### Added

-   **Initial release of `nova-fa-icon`**.
-   Vue component featuring an icon selector modal.
-   Server-side icon searching for maximum performance.
-   Smart search by icon name and search terms.
-   Result pagination with "infinite scroll" in the selector.
-   Publishable configuration system (`config/nova-fa-icon.php`).
-   Ability to filter icons by style (`solid`, `brands`, etc.) globally via config or per-field via the `styles()` method.
-   Full localization support (English and Brazilian Portuguese) that automatically adapts to Nova's locale.
-   Publishable translation files.
