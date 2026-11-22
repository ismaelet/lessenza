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

The storefront supports Italian (default) and English. The flag dropdown in the desktop and mobile
headers stores the selected language in the Laravel session and keeps the current page and filters.
Translations are maintained in `app/lang/it.json` and `app/lang/en.json`, with framework messages in
the corresponding locale directories. Wrap new interface text in Laravel's `__()` or `trans_choice()`.
Existing authored product, blog, and review content is translated at display time using
`localized_text()` / `localized_html()`; the Italian database values, product identifiers, and URLs
remain unchanged. Add translations for new authored content to the language catalogues. Original
product label images and downloadable safety documents remain in their supplied language.

The application includes functionality for:

- Product browsing and product information
- Shopping cart and checkout
- Customer accounts and order management
- Administrative management interfaces
- Online payment integration
- Transactional email configuration
- Content and informational pages
- Responsive storefront layouts

The Aufguss essential oil catalogue is available at `/oli-essenziali`, with searchable fragrances,
individual product pages, 30 ml and 100 ml formats, safety sheet downloads, and quote enquiries
through the contact form. Catalogue content is maintained in `app/resources/data/oli-essenziali.json`;
the supplied images, labels, and PDFs are in `app/public/oli-essenziali/`. The dedicated catalogue
uses the enquiry flow. The `2026_11_22_170000_add_aufguss_essential_oil_products` data migration also
adds 32 shop products (16 oils in two sizes) with fixed prices excluding VAT. It contains an
immutable snapshot of the client data, including product codes and safety sheet links. Rollback
removes the imported products and retains the product type, which may be shared with other products.

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
