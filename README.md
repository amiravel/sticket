# Project Installation Guide

## Requirements

Before starting, make sure you have installed:

- PHP 8.3+
- Composer
- MySQL / PostgreSQL
- Node.js 22+
- npm
- Git
- sqlite3 for test purpose

---
## Note

If you are willing to use Mysql/Postgresql or any database you want to run tests (which I don't recommend) 
you should update the .env.testig file database configurations. 

## Clone Repository

```bash
git clone <repository-url>
cd <project-folder>
```

---

## Install Backend Dependencies

```bash
composer install
```

---

## Environment Configuration

Copy the environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Update `.env` database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

## Run Database Migrations

```bash
php artisan migrate
```

Optional seed data:

```bash
php artisan db:seed
```

---

## Install Frontend Dependencies

```bash
npm install
```

If dependency issues happen:

```bash
rm -rf node_modules package-lock.json
npm install
```

---

## Build Frontend Assets

Development:

```bash
npm run dev
```

Production:

```bash
npm run build
```

---

## Configure Queue Worker

Set queue driver in `.env`:

```env
QUEUE_CONNECTION=database
```

Generate queue table:

```bash
php artisan queue:table
php artisan migrate
```

Run worker:

```bash
php artisan queue:work
```

---

## Start Laravel Server

```bash
php artisan serve
```

Project will run at:

```text
http://127.0.0.1:8000
```

---

## Run Tests

```bash
php artisan test
```

---

## Common Fixes

### Clear caches

```bash
php artisan optimize:clear
```

### Rebuild autoload

```bash
composer dump-autoload
```

### Fix frontend dependency conflicts

```bash
rm -rf node_modules package-lock.json
npm install
```

---

## Production Notes

Use:

- Supervisor for queue workers
- Nginx / Apache
- Redis for queues/cache
- `php artisan config:cache`
- `php artisan route:cache`

---

## Project Ready

If everything succeeds, the project is installed and ready for development.


## Default Admin Data:

### First Level Admin: 
    
```bash

email: john@doe.com
password: password

```
### Second Level Admin:

```bash

email: willem@defoe.com
password: password

```

# end points:

## Authentication:

```bash
login: /user/api/login POST
register: /user/api/register POST
logout: /user/api/logout DELETE
```
## Ticketing: 

### normal users level:

```bash
create new ticket : /ticket/api/tickets POST
```

### Admin (First Level)

```bash

list of tickets: /ticket/api/tickets GET
ticket item: /ticket/api/tickets/{id} GET
update tickets: /ticket/api/tickets/{id} PATCH
tickets bulk approve: /ticket/api/tickets/bulk-approve PATCH

```

### Admin (Second Level)

```bash

tickets bulk approve: /ticket/api/tickets/bulk-approve/second PATCH

```