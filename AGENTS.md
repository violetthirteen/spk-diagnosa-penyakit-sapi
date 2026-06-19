# AGENTS.md — Sistem Pakar Diagnosa Penyakit Sapi

Laravel 13 + Blade + Tailwind v3 (PostCSS) + Breeze (auth). Expert system using Certainty Factor method.

## Commands

| Action | Command |
|--------|---------|
| Full setup | `composer run setup` |
| Dev servers | `composer run dev` |
| Run tests | `composer run test` |
| Run PHPUnit directly | `php artisan test` |
| Single test | `php artisan test tests/Feature/XTest.php` |
| Build assets | `npm run build` |
| Lint (Pint) | `./vendor/bin/pint` |

## Architecture

- **Domain**: Rule-based CF expert system. `Aturan` links `penyakit_id`, `gejala_id`, `solusi_id` (no `cf_pakar` on aturan). `cf_pakar` is per-gejala (double, stored on `gejala` table). `DiagnosaController::proses()` computes `CF(H,E) = cf_pakar × cf_user` per matched gejala, then combines with `CFcombine = CFlama + CFbaru × (1 - CFlama)` grouped by penyakit. User selects confidence level (0.0–1.0). Result sorted descending, stored as `penyakit` string (not FK) in `hasil_diagnosa`.
- **Auth**: Breeze Blade stack. `users.role` column: `admin` or `user` (default: `user`). AdminMiddleware aliased as `'admin'` in `bootstrap/app.php:16`.
- **Routes**: `routes/web.php` (welcome, profile, admin CRUD, diagnosa, riwayat, PDF download), `routes/auth.php` (Breeze). No API routes.
- **Models**: Non-plural table names (`penyakit`, `gejala`, `solusi`, `aturan`, `hasil_diagnosa`). Models explicitly set `$table`.
- **Views**: `@extends('layouts.app')`, `@section('content')/@endsection`, `@yield('title-section')`. Layout uses **all custom CSS** (no Tailwind utility classes) — custom classes: `.glass-card`, `.btn`, `.form-control`, `.badge`, etc.
- **DB**: SQLite by default. Uses database queue/cache/session (see `.env.example`).

## Testing quirks

- Test DB is SQLite `:memory:`. Feature tests **must** run migrations first.
- Only `UserFactory` exists. No factories for domain models.
- `composer run test` always runs `php artisan config:clear` first.

## Gotchas

- `DatabaseSeeder` uses `WithoutModelEvents` trait.
- `users.role` was defined in **both** `create_users_table` and `add_role_to_users_table` — the redundant migration has been deleted.
- `cf_pakar` was moved from `aturan` to `gejala` table. Each gejala has its own CF value. The old `cf_pakar` column on `aturan` still exists but is unused.
- `public/images/logo-kampus.png` is referenced in layout footer.
- `@tailwindcss/vite` in devDependencies is unused (config uses PostCSS plugin).
- `dashboard/index.blade.php` is unused — real dashboard is `dashboard.blade.php`.
