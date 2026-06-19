# AGENTS.md — Sistem Pakar Diagnosa Penyakit Sapi

Laravel 13 + Blade + Tailwind v3 (PostCSS) + Breeze (auth). Expert system using Certainty Factor method.

## Commands

| Action | Command |
|--------|---------|
| Full setup | `composer run setup` |
| Dev servers | `composer run dev` |
| Run tests | `composer run test` |
| Single test | `php artisan test tests/Feature/XTest.php` |
| Lint (Pint) | `./vendor/bin/pint` |
| Build assets | `npm run build` |

`composer run dev` runs 4 parallel processes: `php artisan serve`, `queue:listen`, `pail`, `vite`.

`composer run test` always runs `php artisan config:clear` first.

## Architecture

- **Domain**: Rule-based CF expert system. `Aturan` links `penyakit_id`, `gejala_id`, `solusi_id` (no `cf_pakar` on aturan — that column is unused). `cf_pakar` is per-gejala (double on `gejala` table). `DiagnosaController::proses()` computes `CF(H,E) = cf_pakar × cf_user` per matched gejala, combines with `CFcombine = CFlama + CFbaru × (1 - CFlama)` grouped by penyakit. User selects 0.0–1.0 confidence. Result sorted descending. Only the top result is stored in `hasil_diagnosa`: `penyakit` is a string (not FK), `user_id` uses `foreignId()` (no explicit constraint).
- **Auth**: Breeze Blade stack. `users.role` column: `admin` or `user` (default: `user`). AdminMiddleware aliased `'admin'` in `bootstrap/app.php:17`.
- **Routes**: `routes/web.php` (welcome, profile, admin CRUD for penyakit/gejala/solusi/aturan/users, diagnosa, riwayat, PDF download), `routes/auth.php` (Breeze). No API routes.
- **Models**: Non-plural table names. Models explicitly set `$table`. `User` model uses PHP 8.3 `#[Fillable]` / `#[Hidden]` attributes (not `protected $fillable`). `User` has `photo` column (optional, for profile avatar).
- **Views**: `@extends('layouts.app')`, `@section('content')/@endsection`, `@yield('title-section')`. Layout uses **all custom CSS** (no Tailwind utility classes): `.glass-card`, `.btn`, `.form-control`, `.badge`, etc.
- **DB**: SQLite by default. Uses database queue/cache/session (see `.env.example`). .env.example also includes PostgreSQL config for Vercel/Supabase.
- **Vercel**: Deployed via `vercel.json` (vercel-php@0.9.0 runtime, `api/index.php` entrypoint, routes all traffic to it). `bootstrap/app.php` redirects storage to `/tmp` when `VERCEL` env is set.

## Testing

- Test DB is SQLite `:memory:` (phpunit.xml). Feature tests **must** run migrations first.
- Only `UserFactory` exists. No factories for domain models.
- PHPUnit only (no Pest).

## Gotchas

- `DatabaseSeeder` uses `WithoutModelEvents` trait. Creates admin user: `admin@test.com` / `password`.
- `cf_pakar` was moved from `aturan` to `gejala` table. The old `cf_pakar` column on `aturan` persists but is dead code — the CF formula reads from `$item->gejala->cf_pakar`.
- `public/images/logo-kampus.png` referenced in layout footer.
- `dashboard/index.blade.php` does not exist — real dashboard is `dashboard.blade.php` in views root.
- Layout uses inline `<style>` (1280+ lines) inside `app.blade.php` — not a separate CSS file.
