<h1>Σ sigma</h1>

## Sobre o SIGMA

SIGMA-Ultrimagem é um sistema criado pelo setor de T.I da Ultrimagem LTDA para gestão de processos internos da empresa como solicitações de autorização de exames, triagem de pacientes, monitoramento de filas de trabalho, entre outros.

Atualmente o sistema conta com 4 módulos ativos e um módulo principal para controle de usuários, acessos e permissões.

- Autorização: Sistema de envio e controle de solicitações de autorização de exames para convênios com integração ao RIS da clínica.
- Triagem: Triagem de pacientes e monitoramento de filas com integração ao RIS da clínica.
- HelpDesk: Sistema para solicitação de chamados internos ao setor de TI.
- Não Conformidades: Sistema para registro e controle de não conformidades.
- Financeiro: Controle de pagamento de repasses em exames laudados.
- Serviços Extras: Solicitação de serviços extras ao setor administrativo. Com integração ao módulo de HelpDesk.

O sistema integrado foi desenvolvido utilizando TALL Stack :

- [Tailwindcss](https://tailwindcss.com/);
- [AlpineJS](https://alpinejs.dev/);
- [Laravel](https://laravel.com/);
- [Livewire](https://laravel-livewire.com/);

Outros pacotes e bibliotecas utilizados:

- [Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission/v5/introduction);
- [Laravel Modules](https://nwidart.com/laravel-modules/v6/introduction);
- [Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf);
- [Apex Charts](https://apexcharts.com/);

## Executando com Docker

É necessário ter Docker Desktop com o plugin Docker Compose instalado. A configuração sobe a aplicação em `http://localhost:8000` e um MySQL 8 com volume persistente.

1. Se ainda não existir, crie o arquivo de ambiente a partir do exemplo:

   ```powershell
   Copy-Item .env.example .env
   ```

2. No `.env`, defina um valor para `APP_KEY`. Para gerar uma chave, construa a imagem e execute:

   ```powershell
   docker compose build
   docker compose run --rm --no-deps app php artisan key:generate --show
   ```

   Copie a chave exibida para `APP_KEY` no `.env`.

3. Inicie os containers e aplique as migrations:

   ```powershell
   docker compose up -d
   docker compose exec app php artisan migrate
   ```

O Compose configura `DB_HOST=mysql` e um banco local separado dos valores `DB_*` do `.env`. Os valores locais podem ser personalizados com `DOCKER_DB_DATABASE`, `DOCKER_DB_USERNAME`, `DOCKER_DB_PASSWORD` e `DOCKER_DB_ROOT_PASSWORD`; por padrão, são usados `laravel`/`localdev`/`localroot`, apenas para desenvolvimento e nunca para produção. Para alterar a URL local, use `DOCKER_APP_URL`. Para parar os containers, execute `docker compose down`; para também apagar os dados persistidos do banco, use `docker compose down -v`.

A integração com SQL Server/RIS continua dependendo de uma instância externa acessível pela rede do container, de suas credenciais/configuração próprias e dos drivers SQL Server do PHP; o serviço MySQL do Compose é destinado ao banco principal local.
