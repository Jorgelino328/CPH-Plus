# CPH-Plus

A modern full-stack Pastebin clone built with Laravel (API) and Nuxt.js (Frontend). This project allows users to create, share, and manage text pastes with syntax highlighting and various expiration options.

## Features

- Create and share text pastes
- Syntax highlighting support
- Paste expiration settings
- User authentication and paste management
- Modern responsive UI built with Vuetify
- RESTful API with Laravel Sanctum authentication

## Requirements

### System Requirements

- **PHP**: >= 8.1
- **Node.js**: >= 18.x
- **npm**: >= 9.x (or yarn/pnpm)
- **Database**: MySQL 8.0+ or MariaDB 10.3+ (or SQLite for development)
- **Composer**: Latest version

### Optional Requirements

- **Redis**: For caching and session storage (recommended for production)
- **Git**: For version control

## Local Development Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Jorgelino328/CPH-Plus.git
cd CPH-Plus
```

### 2. Backend Setup (Laravel API)

Navigate to the API directory:

```bash
cd api
```

#### Install PHP Dependencies

```bash
composer install
```

#### Environment Configuration

Copy the environment file and configure it:

```bash
cp .env.example .env
```

Edit `.env` file and configure your database settings:

```env
APP_NAME="CPH-Plus"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cph_plus
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

> **Note**: For quick setup, you can use SQLite by changing `DB_CONNECTION=sqlite` and creating an empty database file: `touch database/database.sqlite`

#### Generate Application Key

```bash
php artisan key:generate
```

#### Database Setup

Create the database and run migrations:

```bash
# Create database (MySQL/MariaDB)
mysql -u root -p -e "CREATE DATABASE cph_plus;"

# Run migrations
php artisan migrate

# Optional: Seed with sample data
php artisan db:seed
```

#### Start the Laravel Development Server

```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

### 3. Frontend Setup (Nuxt.js)

Open a new terminal and navigate to the frontend directory:

```bash
cd front
```

#### Install Node.js Dependencies

```bash
npm install
```

#### Configure API Endpoint

If your Laravel API is running on a different port or domain, update the API configuration in `composables/useApi.ts` or create a `.env` file:

```env
NUXT_PUBLIC_API_BASE=http://localhost:8000/api
```

#### Start the Nuxt Development Server

```bash
npm run dev
```

The frontend will be available at `http://localhost:3000`
