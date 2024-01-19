# Certify Pro

This is a platform that allow any education authority to generate certificates for participants in a program with custom design for each certificate.

# Development Environment

Clone the repo to your local computer:

```shell
git clone https://github.com/Ali-Bin-Shoaib/certify-pro.git
```

Navigate to the cloned project folder:

```shell
cd certify-pro
```

Install the dependencies:

```shell
composer install
```

copy `.env.example` file and rename the copy to `.env`. This file is not in the repo because it is sensitive:

```shell
cp .env.expample .env
```

Configure the database information in the `.env` file (`DB_*`).

```js
DB_DATABASE = yourdatabase_name;
DB_USERNAME = your_username;
DB_PASSWORD = your_password;
```

Sets the `APP_KEY` value in your `.env` file:

```shell
php artisan key:generate
```

Create the `database/migrations` schema:

```shell
php artisan migrate
//OR to drop all existing tables
php artisan migrate:fresh
```

Seed the database with fake data.

Note: there will be three default users:

- admin with username & password: `admin` , and email: `admin@admin.com`.
- org with username & password: `org` , and email: `org@org.com`.
- member with username & password: `member` , and email: `member@member.com`.

```bash
php artisan db:seed
```

Generate a link folder (shortcut) on the public directory to serve the client with files that located on a private directory.

```bash
php artisan storage:link
```

Run the server

```bash
php artisan serve
```

# Powered by

- **Laravel** as a backend.
- **MPDF** to generate pdf from html.
- **Laravel-Excel** to import data from excel file to database.
- **simple-qrcode** to generate QR code for each certificate.
- **Bootstrap** for styling html.
- **Fontawesome** to use icons.
