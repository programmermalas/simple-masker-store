## About Simple Masker Store

Simple masker store adalah e-commerce simple saya buat karena tuntutan pekerjaan saya. Di buat cuman 4 hari maklum boss nya ngebet cepet jadi bikin simple aja ya.

## Install

Untuk install cukup mudah:

### Tahap 1
Pertama install dulu nih paket composer nya dengan cara ketikan di console seperti berikut:
```
  composer install
```

### Tahap 2:
Kedua copy/duplikat .env ketikan di console, karena saya menggunakan linux maka caranya seperti berikut:
```
  cp .env.example .env
```

### Tahap 3:
Ketiga isikan konfigurasi mysql sesuai dengan server yang anda miliki, seperti berikut:
```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=NAMA_DATABASE
  DB_USERNAME=NAMA_USER
  DB_PASSWORD=PASSWORD
```
Nah jangan lupa key api, yang terdapat pada raja ongkir, kalau belum dapat silahkan daftar terlebih dahulu untuk mendapatkan key api, seperti berikut:
```
  API_KEY_RAJAONGKIR=ISIKAN_DISINI_JANGAN_DIHATIKU_NANTI_BAPER
```

### Tahap 3
Keempat dapatkan key untuk .env nya ketikan di console, caranya seperti berikut:
```
  php artisan key:generate
```

### Tahap 4
Cara jalanin nya cuman ketikan di console, seperti berikut:
```
  php artisan serve
```

udah selesai tinggal ngopi dah...