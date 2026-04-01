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

## Laravel resources

Official docs: [laravel.com/docs](https://laravel.com/docs).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
