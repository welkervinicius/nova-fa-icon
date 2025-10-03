# Campo Seletor de Ícones (Font Awesome) para Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://packagist.org/packages/welkervinicius/nova-fa-icon)
[![Total Downloads](https://img.shields.io/packagist/dt/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://packagist.org/packages/welkervinicius/nova-fa-icon)
[![License](https://img.shields.io/packagist/l/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://github.com/welkervinicius/nova-fa-icon/blob/main/LICENSE.md)

Um campo avançado e performático para o Laravel Nova que permite buscar e selecionar ícones do Font Awesome. Construído com uma arquitetura moderna, garante uma experiência de usuário rápida e fluida, mesmo com milhares de ícones.

![Screenshot do Nova FA Icon Picker](https://raw.githubusercontent.com/welkervinicius/nova-fa-icon/main/docs/select-screenshot.png)

### Funcionalidades

-   **Busca no Servidor:** A busca é feita no backend, incluindo os termos de pesquisa de cada ícone (ex: buscar por "logout" encontra o ícone "right-from-bracket"), garantindo performance máxima.
-   **Scroll Infinito:** Os ícones são carregados sob demanda conforme o usuário rola a tela, tornando a abertura do seletor instantânea.
-   **Configurável:** Permite publicar um arquivo de configuração para usar seu próprio `icons.json` (ideal para versões Pro) e definir os estilos de ícones disponíveis globalmente.
-   **Flexível:** Permite filtrar os estilos de ícones (`solid`, `brands`, etc.) por campo diretamente no seu Resource.
-   **Traduzível:** O campo respeita o idioma selecionado no painel do Nova e inclui traduções para Inglês e Português do Brasil.

### Instalação

Você pode instalar o pacote via Composer:

```bash
composer require welkervinicius/nova-fa-icon
```

### Configuração Inicial

Para que os ícones sejam exibidos, você precisa carregar a folha de estilos do Font Awesome. A forma mais fácil é via CDN.

No seu `app/Providers/NovaServiceProvider.php`, dentro do método `boot()`, adicione a seguinte linha:

```php
public function boot()
{
    parent::boot();

    Nova::style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css');
}
```

### Configurações Opcionais

Você pode publicar o arquivo de configuração para personalizar o caminho do `icons.json` e os estilos padrão.

```bash
php artisan vendor:publish --tag="nova-fa-icon-config"
```

Você também pode publicar os arquivos de tradução para adicionar novos idiomas ou customizar os textos.

```bash
php artisan vendor:publish --tag="nova-fa-icon-lang"
```

### Uso

#### Uso Básico

No seu Nova Resource, simplesmente adicione o campo `NovaFaIcon`.

```php
use Welkervinicius\NovaFaIcon\NovaFaIcon;

public function fields(Request $request)
{
    return [
        // ...
        NovaFaIcon::make('Ícone'),
    ];
}
```

#### Filtrando por Estilos

Você pode restringir os estilos de ícones disponíveis para um campo específico usando o método `styles()`.

```php
NovaFaIcon::make('Ícone da Marca', 'brand_icon')
    ->styles(['brands']), // Irá mostrar apenas ícones do tipo "brands".

NovaFaIcon::make('Ícone de Ação', 'action_icon')
    ->styles(['solid', 'regular']), // Irá mostrar apenas ícones sólidos e regulares.
```

#### Usando um Alias

Para um código mais limpo, você pode usar um "alias" na importação.

```php
use Welkervinicius\NovaFaIcon\NovaFaIcon as FaIcon;

// ...
FaIcon::make('Ícone')->styles(['solid']),
```

## Changelog

Por favor, veja [CHANGELOG.md](CHANGELOG.md) para mais informações sobre o que mudou recentemente.

## Contribuições

Por favor, veja [CONTRIBUTING.md](CONTRIBUTING.md) para detalhes.

## Licença

The MIT License (MIT). Por favor, veja o [Arquivo de Licença](LICENSE.md) para mais informações.
