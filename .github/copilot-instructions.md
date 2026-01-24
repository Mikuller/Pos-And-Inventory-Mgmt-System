# Copilot instructions for this repository

This file gives an AI coding agent focused, actionable guidance to be immediately productive in this Laravel 10 + Livewire project.

- **Project type:** Laravel 10 app using Livewire v3 for reactive UI, Vite for assets, PHP ^8.1. Key dependencies include `livewire/livewire`, `spatie/laravel-backup`, `barryvdh/laravel-dompdf` and `realrashid/sweet-alert` (see `composer.json`).

- **Entry points & architecture:**
    - Routes are defined in `routes/web.php` and grouped by resource/prefix (e.g., `products`, `purchases`, `sales`). Update routes here when adding controllers or pages.
    - UI state is handled primarily by Livewire components in `app/Livewire/`. Examples: `POS` (cart/session flow), `Products` (search + category filter), `Purchases` (purchase creation + inventory updates).
    - Controllers in `app/Http/Controllers` implement server endpoints and return views or handle resource logic. Follow existing route -> controller -> view patterns.
    - Models live in `app/Models` and use Eloquent relations (products ⇄ purchases via pivot; many controllers and Livewire components call Eloquent directly).

- **Typical data flows and examples to follow:**
    - Cart/invoice: `app/Livewire/POS.php` stores cart and customer data into session (`session()->put('cart', $this->cart)`), then redirects to the sales route (`/sales/pos`). When editing or extending cart behavior, mirror this session usage.
    - Purchases: `app/Livewire/Purchases.php` creates a `Purchase` and attaches products via `$purchase->products()->attach(...)` and updates `Product::quantity`. New code interacting with purchases should keep the attach/update pattern to remain consistent.
    - Filtering/search: Livewire components use Eloquent `when()` chains and `whereHas()` for category filtering (see `Products::render()` and `POS::getProducts()`). Use these patterns for new list screens.

- **Auth & authorization conventions:**
    - Many routes are protected by `auth` and gate checks `can:admin` and `can:status` in `routes/web.php`. Use these middleware and gate names when adding routes or controllers.

- **Build / run / test commands (project-specific):**
    - Install PHP deps: `composer install`
    - Install JS deps: `npm install` (project uses Vite) and run `npm run dev` for local assets or `npm run build` for production.
    - Environment: copy `.env.example` to `.env` and run `php artisan key:generate`.
    - Serve locally: `php artisan serve` or use your webserver configured to the project public directory.
    - Run migrations/tests: `php artisan migrate` (ensure DB vars set), `./vendor/bin/phpunit`.
    - Useful dev tools present: `barryvdh/laravel-debugbar` (dev), `spatie/laravel-ignition`.

- **Database & backups:**
    - There's a route `/backUpDB` in `routes/web.php` that uses Spatie's DB dumper to write `dataBaseBackUp.sql`. This route is behind `auth`; do not expose unguarded.

- **View & Livewire locations:**
    - Livewire views are under `resources/views/livewire/` (examples: `livewire.products`, `livewire.p-o-s`, `livewire.purchases`). When adding a Livewire component, create a pair: `app/Livewire/MyComponent.php` + `resources/views/livewire/my-component.blade.php`.

- **Patterns & conventions to preserve:**
    - Use Livewire component properties for UI state and `render()` returning the view with compacted data.
    - For paginated lists, components use `WithPagination` trait.
    - Query building commonly uses `when()` closures and `whereHas()` for related filters — preserve that style for consistency.
    - The codebase often fetches models with `Product::all()->find($id)` — this is an existing pattern you may see repeated; prefer to follow existing style when making small or incremental changes unless refactoring explicitly.

- **External integrations:**
    - PDF generation: `barryvdh/laravel-dompdf`. Look for controller methods that call `generatePDF` / `generateInvoice`.
    - DB dumping: `spatie/db-dumper` (used in `/backUpDB` route).

- **Where to implement common tasks:**
    - Add new web endpoints: edit `routes/web.php` and point to a controller or Livewire component. Follow grouping/prefix patterns used for `products`, `purchases`, `sales`.
    - Add or modify Livewire UI: add class in `app/Livewire/` and matching view in `resources/views/livewire/`.
    - Model changes: update `app/Models/*` and migrations in `database/migrations/`.

- **Files to inspect for examples:**
    - `routes/web.php` — route structure and middleware usage.
    - `app/Livewire/POS.php` — session/cart example and search/filter patterns.
    - `app/Livewire/Products.php` and `app/Livewire/Purchases.php` — list, search, attach, and inventory update examples.
    - `composer.json` and `package.json` — dependency and build info.

- **Avoid making stylistic-only changes:**
    - Preserve existing query patterns and Livewire conventions. If a deeper refactor is required, describe it in a PR and get approval from maintainers.

If any section above is unclear or you need examples expanded (e.g., how invoices are generated or exact middleware semantics), tell me which area to expand and I'll update this file.
