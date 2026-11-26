# Byte Bucket

A cloud file-storage service in the style of S3, built with Laravel 12 and Livewire 3. Users sign up, verify their email, create named storage buckets, and see how much space they're using and what kind of files are taking it up.

> **Status:** work in progress. Accounts, email verification, bucket creation and the storage dashboard work. File upload and browsing inside buckets are next, and the data model for them already exists.

## Features

- **Accounts:** sign-up and login, with email verification by tokenised link and resend.
- **Buckets:** create buckets with unique names per user, in three storage classes: `standard`, `archival` and `deep_archive`. Each one maps to a physical bucket name on the storage backend.
- **Dashboard:**
  - Total storage used against the plan limit, with a status indicator.
  - Breakdown of storage by file type (images, video, documents and so on).
  - Searchable bucket list.
- **Plans:** subscription tiers (`free`, `basic`, `pro`, `enterprise`) modelled for Paystack billing.
- **Files and folders:** items have a size, MIME type and storage key, plus a `parent_id`, so buckets can hold nested folders.

## Data model

```
User ──< Subscription        (plan tier, Paystack codes, billing dates)
User ──< Bucket              (name, storage class, physical bucket)
Bucket ──< Item              (file or folder, size, mime type, storage key)
Item ──< Item                (folders contain items via parent_id)
```

## Tech stack

Laravel 12 · Livewire 3 · PostgreSQL · Tailwind CSS · Vite · S3-compatible storage (planned via Laravel's filesystem)

## Getting started

You need PHP 8.2+, Composer, Node.js and PostgreSQL.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Set your `DB_*` values in `.env`, plus `MAIL_*` so verification emails can be sent. Then run:

```bash
php artisan migrate
npm run dev
php artisan serve
```

Open http://localhost:8000 and create an account.

## Roadmap

- [ ] Upload, download and delete files in a bucket (S3 driver)
- [ ] Folder navigation
- [ ] Enforce storage limits per plan
- [ ] Paystack checkout and webhooks
