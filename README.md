# L'Essenza

An e-commerce application developed with Laravel, featuring a custom storefront, product management, online ordering, and an administrative interface.

The project combines a modern Laravel architecture with an earlier custom PHP implementation, reflecting the evolution of the application over time.

## About the Project

L'Essenza is an e-commerce website developed to support the online presentation and sale of products.

The platform includes a customer-facing storefront and administrative functionality for managing the application's content and commercial operations.

Originally developed using a custom PHP architecture, the project was subsequently migrated toward a modern Laravel-based application.

## Technology Stack

- **PHP and Laravel** — Application architecture, backend logic, and server-side functionality
- **Livewire** — Interactive application components
- **Filament** — Administration interface
- **MySQL** — Relational database
- **JavaScript** — Client-side functionality
- **Tailwind CSS** — Interface styling
- **Vite** — Frontend asset compilation
- **Docker Compose** — Containerized development environment
- **FrankenPHP and Caddy** — PHP application serving and HTTP configuration
- **Composer** — PHP dependency management

## Features

The application includes functionality for:

- Product browsing and product information
- Shopping cart and checkout
- Customer accounts and order management
- Administrative management interfaces
- Online payment integration
- Transactional email configuration
- Content and informational pages
- Responsive storefront layouts

The exact availability of individual features depends on the current application configuration and enabled integrations.

## Project Structure

The main application is located in `app/`.

| Path | Description |
|---|---|
| `app/app/` | Laravel application logic, models, and components |
| `app/config/` | Application and service configuration |
| `app/database/` | Database migrations and related resources |
| `app/resources/` | Views, frontend assets, and application resources |
| `app/routes/` | Application routes |
| `app/public/` | Publicly accessible assets and entry point |
| `app/storage/` | Application-generated files, logs, and runtime data |
| `app/legacy/` | Historical implementation retained for reference |
| `compose.yml` | Containerized development configuration |

## Local Development

The project provides a Docker Compose configuration for running the application locally.

### Requirements

- Docker Engine or Docker Desktop
- Docker Compose

### Environment Configuration

Create a local `.env` file in the repository root and provide the environment variables required by `compose.yml`, including:

- `APP_KEY`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `DB_ROOT_PASSWORD`

Additional credentials may be necessary for third-party services.

Environment files containing credentials must not be committed to version control.

### Start the Application

From the repository root:

```bash
docker compose up -d --build
```

The application is configured to use `http://localhost:8000` for local development, while Vite's development server uses port `5173`.

Depending on the state of the local environment, additional Laravel setup steps, such as dependency installation and database migrations, may be required.

## Integrations

The application contains configuration for third-party services, including PayPal and transactional email providers.

Sensitive credentials are loaded through environment variables rather than