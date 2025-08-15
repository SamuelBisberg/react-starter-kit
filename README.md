# Laravel + React Starter Kit

## Introduction

This is a fork of the [Laravel + React Starter Kit](https://github.com/laravel/react-starter-kit) with my additional features and improvements. Such as:

- **Laravel Debugbar**: Integrated for debugging and profiling.
- **Laravel Data & Typescript**: Utilizes [spatie/laravel-data](https://spatie.be/docs/laravel-data) for data handling and [spatie/typescript-transformer](https://spatie.be/docs/typescript-transformer/v2/laravel) for TypeScript support.
- **Laravel Translatable & Translations**: Fully translated into Hebrew & supports translatable columns with [spatie/laravel-translatable](https://spatie.be/docs/laravel-translatable)
- **MinIO & Media Library**: For file uploads and media management.
- **Sail Included**: Docker support with Laravel Sail for easy local development.
- **Blueprint**: Uses [laravel-shift/blueprint](https://blueprint.laravelshift.com/) for rapid application development.
- **Workos**: Integrated for SSO and OAuth flows with [workos.com](https://workos.com).
- **Admin Panel**: Built with [Filament](https://filamentadmin.com/) for a beautiful and responsive admin interface.
- **Backup**: Integrated with [spatie/laravel-backup](https://spatie.be/docs/laravel-backup) for easy backup management.
- **Monitoring**: Integrated with [laravel-pulse](https://laravel.com/docs/pulse) for application monitoring.

And much more!

## Requirements

From a Linux distro of your choice, you will need:

- [Docker](https://docs.docker.com/get-docker/) - Containerization platform.
- [Docker Compose](https://docs.docker.com/compose/install/) - Tool for defining and running multi-container Docker applications.
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) - Version control system.
- [Bun](https://bun.sh/docs/install) - JavaScript runtime.
- [Node.js](https://nodejs.org/en/download/) - JavaScript runtime environment.
- [PHP 8.4 or higher and Composer](https://laravel.com/docs/#installing-php)

## Getting Started

After the installation you can edit `blueprint.yaml` to define your application structure and features. You can use the [Blueprint documentation](https://blueprint.laravelshift.com/) to learn how to define your models, controllers, and other components.

Finally Create your models, controllers, and other components using Blueprint:

```bash
sail artisan blueprint:build
```

## Installation

1. Fork the repository and clone it to your local machine:

   This will help you get changes merged back into the main repository.

   ```bash
   git clone <your-fork-url>
   cd <your-repo-name>
   ```

2. Install dependencies:

   ```bash
   sail composer install
   sail npm install # or `sail bun install`
   ```

3. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

4. Run app with Sail:

   ```bash
   # Don't forget to add the alias to your shell config file (e.g., .bashrc, .zshrc)
   # alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
   sail up -d
   ```

5. Generate application key:

   ```bash
    sail artisan key:generate
    ```

6. Run migrations and seed the database:
  
    ```bash
    sail artisan migrate --seed
    ```

7. Run the development server:

   ```bash
   sail composer run dev
   ```

## Debugger & Playground

The application includes the [Laravel Debugbar](https://laraveldebugbar.com/) for debugging and profiling.

You can use the `Playground` at [http://localhost/playground](http://localhost/playground) and play with:

- [The Controller](/app/Http/Controllers/PlaygroundController.php) - You can modify the controller to test different scenarios.
- [The View](/resources/js/pages/playground/index.tsx) - You can modify the view to test different scenarios.
- [Playground Command](/app/Console/Commands/PlaygroundCommand.php) - Run `php artisan app:playground`.

## File Uploads w/ MinIO & Media Library

MinIO is used for file uploads. You can access the MinIO dashboard at [localhost:9000](http://localhost:9000) with the credentials:

- **Access Key**: sail
- **Secret Key**: password

In the laravel app you can use the package for managing files: [spatie/laravel-medialibrary](https://spatie.be/docs/laravel-medialibrary)

### Temporary Files

<!-- TODO: Implement -->
...

Note: `laravel-medialibrary` uses optimization packages. Install them with:

```bash
sudo apt install jpegoptim optipng pngquant gifsicle libavif-bin
npm install -g svgo # or `sudo snap install svgo`
```

## Translations & Translatable Columns

The application is fully translated into Hebrew. The translation files are located in the `lang/he` directory and `lang/he.json` for JSON translations.

Use the package [bottelet/translation-checker](https://bottelet.github.io/translation-checker) to check for missing translations, automatically generate translation with `Google Translate` using the command:

```bash
sail translations:check en --sort --translate-missing
#                       └─target: `en`, `he` or any other language
```

In addition, the `spatie/laravel-translatable` package is used to handle translatable columns in the database. You can define translatable attributes in your models like this:

```php
use Spatie\Translatable\HasTranslations;  

class YourModel extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];
}
```

## Laravel Data & Typescript

The application uses [spatie/laravel-data](https://spatie.be/docs/laravel-data) for data handling and [spatie/typescript-transformer](https://spatie.be/docs/typescript-transformer/v2/laravel) for TypeScript support.

Use `Laravel Data` to create DTOs with single source of truth for validation rules, type safety, and serialization. This allows you to define your data structures in a clean and maintainable way.

Create a `Data` class with:

```bash
sail artisan make:data <DataClassName>
```

Then, generate the TypeScript types with:

```bash
sail artisan typescript:transform
```

This will generate TypeScript types in the `resources/js/types/generated.d.ts` file so you can use them in your the frontend.

You have Laravels's additional types such as `Paginator`, `EnumTtait` with usefull methods like `toCollection()` in `resources/js/types/index.d.ts`.

## Validation

In addition to the default validation rules, We have added the following custom validation rule:

- **Phone**: Validates that the input is a valid phone number using the package [propaganistas/laravel-phone](https://github.com/propaganistas/laravel-phone).

## Workos

The application integrates with [WorkOS](https://workos.com) for SSO and OAuth flows. You can enable it in the `.env` file:

| Environment Variable   | Description & How to get it                                                                         |
| ---------------------- | --------------------------------------------------------------------------------------------------- |
| `WORKOS_ENABLED`       | Enables or disables WorkOS SSO functionality. Set to `true` to enable, `false` to disable           |
| `WORKOS_CLIENT_ID`     | Your WorkOS application client ID. Get from your WorkOS dashboard under Applications → Your App     |
| `WORKOS_CLIENT_SECRET` | Your WorkOS application client secret. Get from your WorkOS dashboard under Applications → Your App |

*Note:* Make Sure to set redirect URIs in your WorkOS dashboard to match your application URLs.

- *Redirect URIs*: `http://localhost/authenticate`
- *App homepage URL*: `http://localhost`

## Backup

The application uses [spatie/laravel-backup](https://spatie.be/docs/laravel-backup) for backup management. You can configure the backup settings in the `.env` file:

| Environment Variable      | Description                                                  |
| ------------------------- | ------------------------------------------------------------ |
| `BACKUP_ENABLED`          | Enables or disables the backup functionality                 |
| `BACKUP_DISK`             | Specifies the storage disk for backups (e.g., `s3`, `local`) |
| `BACKUP_MAX_STORAGE`      | Maximum storage size in GB for backup retention              |
| `BACKUP_ARCHIVE_PASSWORD` | Optional password to encrypt backup archives                 |

You can also monitor the backup status using the `BackupHealthWidget` in the admin panel.
