# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
