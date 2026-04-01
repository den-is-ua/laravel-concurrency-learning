# Laravel concurrency (learning)

This repository is a **personal learning sandbox** for exploring **concurrency** in a Laravel application: how requests, queues, cache, sessions, and the database interact under load, and how to reason about race conditions, idempotency, and safe patterns in PHP and Laravel.

It is not a production product—expect experiments, notes in code, and rough edges as topics are tried out.

## Stack

- **Laravel** (current skeleton from [laravel/laravel](https://github.com/laravel/laravel))
- **Docker**: PHP-FPM (`app`) + **Nginx** (`nginx`), **no database service** in Compose. Session, cache, and queue defaults are overridden in Compose to file/sync and an in-memory-style DB driver so the stack runs without standing up MySQL or Postgres. You can add a database later when exercises need it.

## Quick start

```bash
docker compose up -d
```

Application URL: **http://localhost:8080**

Shell inside the PHP container (from the project root):

```bash
./go-into-app
```

Requires containers to be running.

## HTTP routes

Defined in `routes/web.php` and handled by `HomeController`:

| Method | Path | Description |
|--------|------|-------------|
| `GET` | `/` | Runs three closures in parallel via `Concurrency::run()` (each sleeps 2s), then returns JSON with the collected results and `elapsed_seconds`. |
| `GET` | `/defer` | Schedules three deferred closures via `Concurrency::defer()` (each sleeps 2s and logs); the HTTP response returns immediately with a message and `elapsed_seconds` while work continues in the background. |

Examples (with Docker as in [Quick start](#quick-start)):

- http://localhost:8080/
- http://localhost:8080/defer

## Console commands

Custom Artisan commands for trying Laravel’s **Concurrency** facade:

| Command | What it does |
|--------|----------------|
| `php artisan concurrency` | Runs three closures in parallel via `Concurrency::run()` (each sleeps 2s), then prints the collected results and a rough elapsed time. |
| `php artisan concurrency:defer` | Schedules three deferred closures via `Concurrency::defer()` (each sleeps 2s and writes to the log); returns quickly while work continues in the background. |

From the host with Docker:

```bash
docker compose exec app php artisan concurrency
docker compose exec app php artisan concurrency:defer
```

Or from a shell opened with `./go-into-app`, run the same `php artisan …` lines.

## Laravel resources

Official docs: [laravel.com/docs](https://laravel.com/docs).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
