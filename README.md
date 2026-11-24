# FlipPlay REST API

**Pengembangan Simulasi PHP OOP menjadi REST API menggunakan Laravel 12**

## 1. Deskripsi Project

FlipPlay merupakan aplikasi pengelolaan media digital yang dikembangkan dari simulasi berbasis terminal menggunakan PHP Object-Oriented Programming (OOP) pada Modul 3 menjadi REST API menggunakan Laravel 12 pada Modul 4.

Project ini mempertahankan dua entitas utama, yaitu Media dan User. Data disimpan dalam database MySQL dan dikelola menggunakan Eloquent ORM.

REST API memungkinkan client seperti Postman atau aplikasi frontend mengakses data media dan koleksi pengguna melalui HTTP endpoint.

## 2. Teknologi

- PHP
- Laravel 12
- MySQL
- Eloquent ORM
- REST API
- Postman
- Composer

## 3. Fitur Utama

### Media Management

- Menampilkan seluruh media.
- Menampilkan detail media.
- Menambahkan media.
- Memperbarui data media.
- Menghapus media.
- Mendukung Anime, Manga, dan Light Novel.

### User Collection

- Menampilkan koleksi media pengguna.
- Menambahkan media ke koleksi.
- Menghapus media dari koleksi.
- Mencegah duplikasi media dalam koleksi pengguna.

### Data Validation

- Validasi judul media.
- Pencegahan judul duplikat untuk jenis media yang sama.
- Validasi jenis media.
- Validasi informasi khusus berdasarkan jenis media.

## 4. Struktur Database

Project menggunakan tiga tabel utama:

| Tabel | Fungsi |
|---|---|
| users | Menyimpan data pengguna |
| media | Menyimpan data media |
| media_user | Menyimpan relasi koleksi pengguna |

Relasi User dan Media menggunakan many-to-many melalui tabel pivot `media_user`, yang diimplementasikan menggunakan relasi `belongsToMany()` pada Eloquent.

## 5. Struktur Project

```text
flipplay/
|
+-- app/
|   +-- Http/
|   |   +-- Controllers/
|   |   |   +-- MediaController.php
|   |   |   +-- UserCollectionController.php
|   |   |
|   |   +-- Requests/
|   |   |   +-- StoreMediaRequest.php
|   |   |   +-- UpdateMediaRequest.php
|   |   |
|   |   +-- Resources/
|   |       +-- MediaResource.php
|   |       +-- UserResource.php
|   |
|   +-- Models/
|       +-- Media.php
|       +-- User.php
|
+-- database/
|   +-- migrations/
|   +-- seeders/
|       +-- FlipPlaySeeder.php
|
+-- routes/
|   +-- api.php
|
+-- .env.example
+-- composer.json
+-- README.md
```

## 6. Instalasi dan Konfigurasi

### Persyaratan

- PHP sesuai persyaratan Laravel 12.
- Composer.
- MySQL.
- Git.

### Langkah Instalasi

1. Clone repository:

```bash
git clone URL_REPOSITORY
```

2. Masuk ke direktori project:

```bash
cd flipplay
```

3. Instal dependensi:

```bash
composer install
```

4. Salin konfigurasi environment:

```bash
copy .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Buat database MySQL dengan nama `flipplay`.

7. Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=flipplay
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan port, username, dan password dengan konfigurasi MySQL lokal.

8. Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

9. Jalankan server Laravel:

```bash
php artisan serve
```

Server dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## 7. API Endpoints

Base URL:

```text
http://127.0.0.1:8000/api
```

### Media CRUD

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | /media | Menampilkan seluruh media |
| GET | /media/{media} | Menampilkan detail media |
| POST | /media | Menambahkan media |
| PUT/PATCH | /media/{media} | Memperbarui media |
| DELETE | /media/{media} | Menghapus media |

### User Collection

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | /users/{user}/collection | Menampilkan koleksi pengguna |
| POST | /users/{user}/collection/{media} | Menambahkan media ke koleksi |
| DELETE | /users/{user}/collection/{media} | Menghapus media dari koleksi |

## 8. Validasi dan Format Response

Project menggunakan Form Request Validation untuk memvalidasi input pada endpoint POST dan PATCH.

API Resource digunakan untuk menghasilkan format response JSON yang konsisten.

Relasi antarmodel ditampilkan menggunakan mekanisme `whenLoaded()`.

Validasi yang gagal menghasilkan HTTP 422 Unprocessable Content.

## 9. Pengujian

Pengujian API dilakukan menggunakan Postman melalui tiga kelompok:

1. Media CRUD.
2. Validation.
3. User Collection.

Pengujian mencakup skenario berhasil dan gagal, termasuk judul kosong, judul duplikat, serta penambahan media yang sama ke koleksi pengguna.

Pemeriksaan routing:

```bash
php artisan route:list --path=api
```

Pemeriksaan migration:

```bash
php artisan migrate:status
```

Pemeriksaan automated test:

```bash
php artisan test
```

## 10. Informasi Project

- Project: FlipPlay REST API
- Framework: Laravel 12
- Mata Kuliah: Pemrograman Web
- Modul: Modul 4 - REST API Development

Project ini merupakan pengembangan lanjutan dari simulasi PHP OOP FlipPlay pada Modul 3 dengan integrasi database MySQL dan REST API menggunakan Laravel 12.