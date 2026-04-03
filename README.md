# ✅ Todo API — Laravel 11 REST API

A fully tested REST API for managing a To-Do list built with Laravel 11 and SQLite.

## Stack
- PHP 8.2+, Laravel 11, SQLite, PHPUnit 11

## Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | /api/tasks | List all tasks |
| POST | /api/tasks | Create a task |
| GET | /api/tasks/{id} | Get one task |
| PUT | /api/tasks/{id} | Update a task |
| DELETE | /api/tasks/{id} | Delete a task |

## Task fields
- `title` (string, required)
- `description` (string, optional)
- `status` (pending / in_progress / done)

## Deploy on Railway
1. Push this repo to GitHub
2. Connect repo to Railway
3. Add environment variables:
   - `APP_KEY` = generate at https://generate-random.org/laravel-key-generator
   - `APP_ENV` = production
   - `APP_DEBUG` = false
   - `APP_URL` = your Railway URL
   - `DB_CONNECTION` = sqlite
   - `DB_DATABASE` = /app/database/database.sqlite
4. Deploy — Railway runs `composer install` and migrations automatically

## Test the API
```
GET https://your-railway-url.up.railway.app/api/tasks
```
