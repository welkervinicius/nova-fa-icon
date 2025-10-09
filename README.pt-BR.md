# Seletor de ícones Font Awesome para Laravel Nova

[![Versão mais recente no Packagist](https://img.shields.io/packagist/v/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://packagist.org/packages/welkervinicius/nova-fa-icon)
[![Total de downloads](https://img.shields.io/packagist/dt/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://packagist.org/packages/welkervinicius/nova-fa-icon)
[![License](https://img.shields.io/packagist/l/welkervinicius/nova-fa-icon.svg?style=flat-square)](https://github.com/welkervinicius/nova-fa-icon/blob/main/LICENSE.md)

Um campo avançado e performático para o Laravel Nova que permite buscar e selecionar ícones do Font Awesome.  
Construído com arquitetura moderna, garante uma experiência rápida e fluida, mesmo com milhares de ícones.

![Nova FA Icon Picker Screenshot](https://raw.githubusercontent.com/welkervinicius/nova-fa-icon/main/docs/select-screenshot.png)

### Recursos

- **Busca no servidor:** A busca é realizada no backend, incluindo os termos de pesquisa de cada ícone (por exemplo, buscar por "logout" encontra o ícone "right-from-bracket"), garantindo máxima performance.
- **Scroll infinito:** Ícones são carregados sob demanda conforme o usuário rola, tornando a abertura do seletor instantânea.
- **Configurável:** Permite publicar o arquivo de configuração para usar seu próprio `icons.json` (ideal para versões Pro) e definir os estilos de ícones disponíveis globalmente.
- **Flexível:** Permite filtrar estilos de ícone (`solid`, `brands`, etc.) por campo diretamente no seu Resource.
- **Localizado:** O campo respeita o locale selecionado no painel Nova e inclui traduções em inglês e português do Brasil por padrão.

---

### Instalação

Instale via Composer:

```bash
composer require welkervinicius/nova-fa-icon
```

---

### Configuração Inicial

Para que os ícones sejam exibidos, você precisa carregar a folha de estilos do Font Awesome.  
A forma mais simples é via CDN.

No seu `app/Providers/NovaServiceProvider.php`, dentro do método `boot()`, adicione a linha do `Nova::style()` após a chamada `parent::boot();`:

```php
public function boot()
{
    parent::boot();

    Nova::style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css');
}
```

---

### Configuração Opcional

Você pode publicar o arquivo de configuração para personalizar o caminho do `icons.json` e os estilos padrão.

```bash
php artisan vendor:publish --tag="nova-fa-icon-config"
```

Também é possível publicar os arquivos de tradução para adicionar novos idiomas ou customizar textos.

```bash
php artisan vendor:publish --tag="nova-fa-icon-lang"
```

---

### ⚙️ Customizando a Fonte de Ícones (Font Awesome Pro ou Builds Customizados)

A partir da **v1.0.1**, o arquivo de configuração publicado utiliza `base_path()` em vez de `__DIR__`, garantindo que o caminho configurado aponte para a raiz da aplicação e não para o diretório do pacote.

Se você estiver usando a versão **Pro** do Font Awesome, ou um build/custom de ícones, faça o seguinte:

1. **Publique o arquivo de configuração** (caso ainda não tenha feito):
   ```bash
   php artisan vendor:publish --tag="nova-fa-icon-config"
   ```

2. **Edite o arquivo `config/nova-fa-icon.php`** e atualize o caminho para o seu `icons.json`.  
   Por exemplo, o Font Awesome Pro costuma ter esse arquivo em:
   ```php
   'icon_file' => base_path('node_modules/@fortawesome/fontawesome-pro/metadata/icons.json'),
   ```
   Ou, se você tiver um JSON customizado em outro local:
   ```php
   'icon_file' => base_path('resources/icons/custom-icons.json'),
   ```

3. O pacote carregará automaticamente os ícones a partir do JSON definido nessa configuração.

Esse procedimento garante compatibilidade com qualquer distribuição do Font Awesome (Free, Pro ou custom) e evita problemas de resolução de caminhos após publicar a configuração.

---

### Localização

A partir da versão **v1.1.0**, as traduções estão totalmente namespaced e carregadas pelo sistema de pacotes do Laravel.  
Idiomas suportados:

- Inglês `(en)`
- Português (Brasil) `(pt_BR)`
- Espanhol `(es)`
- Italiano `(it)`
- Russo `(ru)`

O Laravel Nova seleciona automaticamente a tradução correta com base no idioma configurado no painel.

---

### Uso

#### Uso Básico

No seu Resource Nova, adicione o campo `NovaFaIcon`:

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

#### Filtrando por Estilos

Você pode restringir os estilos de ícone disponíveis por campo usando o método `styles()`:

```php
NovaFaIcon::make('Brand Icon', 'brand_icon')
    ->styles(['brands']), // mostra apenas ícones do estilo "brands"

NovaFaIcon::make('Action Icon', 'action_icon')
    ->styles(['solid', 'regular']), // mostra apenas solid e regular
```

#### Usando um Alias

Para código mais limpo, você pode usar um alias na importação:

```php
use Welkervinicius\NovaFaIcon\NovaFaIcon as FaIcon;

// ...
FaIcon::make('Icon')->styles(['solid']),
```

---

## Changelog

Consulte [CHANGELOG.md](CHANGELOG.md) para mais informações sobre alterações recentes.

---

## Contribuindo

Consulte [CONTRIBUTING.md](CONTRIBUTING.md) para detalhes sobre como contribuir.

---

## Licença

MIT License (MIT). Consulte o arquivo [LICENSE.md](LICENSE.md) para mais informações.
