# Changelog

Todas as mudanças notáveis neste projeto serão documentadas neste arquivo.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), e este projeto adere ao [Versionamento Semântico](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-10-02

### Adicionado

-   **Lançamento inicial do `nova-fa-icon`**.
-   Componente Vue com seletor de ícones em um modal.
-   Busca de ícones no lado do servidor para máxima performance.
-   Busca inteligente por nome e termos de pesquisa do ícone.
-   Paginação de resultados com "scroll infinito" no seletor.
-   Sistema de configuração publicável (`config/nova-fa-icon.php`).
-   Capacidade de filtrar ícones por estilo (`solid`, `brands`, etc.) globalmente via config ou por campo via método `styles()`.
-   Suporte completo a localização (Inglês e Português do Brasil) que se adapta automaticamente ao idioma do Nova.
-   Arquivos de tradução publicáveis.
