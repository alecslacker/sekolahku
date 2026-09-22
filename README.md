# Website Madrasah — CMS Sekolahku (Kustomisasi Duta Corpora Indonesia)

CMS Sekolahku v3.1.2 yang dikustomisasi oleh **Duta Corpora Indonesia** untuk website madrasah: nuansa islami-pendidikan, mobile-first, aksesibilitas tinggi, dan tema warna per madrasah (9 tema). Konten dikelola sendiri oleh operator madrasah melalui panel admin.

> Daftar perubahan custom: [CHANGELOG-DCI.md](CHANGELOG-DCI.md)

## Fitur

### Halaman Publik
- **Beranda**: hero (badge, statistik, sambutan kepala sekolah), counter statistik, profil/visi-misi, program unggulan, ekstrakurikuler, tenaga pengajar (carousel), prestasi siswa, testimoni, berita terbaru, agenda, galeri (lightbox), FAQ (accordion), kontak + form
- **Berita & Artikel**: filter kategori, pencarian, arsip, tag, komentar, artikel terkait, share
- **Halaman dinamis** dengan menu builder, breadcrumb, dan share
- **Download Center** per kategori
- **Sitemap.xml**, meta SEO (OG/Twitter), JSON-LD `EducationalOrganization`
- **Dark mode** dan **9 tema warna**: blue, brown, gray, green, navy, pink, purple, red, teal

### Panel Admin
20+ modul: Dashboard, Pengaturan Situs (hero, statistik, kepala sekolah, tema), Berita, Halaman, Menu, Guru, Program, Ekstrakurikuler, Prestasi, Testimoni, Agenda, Galeri, FAQ, Downloads, Pesan, Komentar, Uploads, Pengguna (superadmin/admin/editor), Profil. Editor kaya (Quill), upload gambar auto-resize, visibilitas per-section beranda.

## Stack

| Komponen | Teknologi |
|---|---|
| Framework | CodeIgniter 4.7 |
| Database | MySQL / MariaDB (16 tabel) |
| CSS | Custom CSS + 9 file tema |
| JS | Vanilla JS, Simplebar, Font Awesome 6.5 |
| Admin UI | CoreUI 5 + Quill 2 |

## Instalasi

1. Persyaratan: PHP 8.1+, MySQL/MariaDB.
2. Clone repo, jalankan `composer install`.
3. Import `sekolahku_db.sql` ke database baru.
4. Salin `env` → `.env`, sesuaikan `app.baseURL` dan kredensial DB.
5. Arahkan DocumentRoot ke `public/`, atau `php spark serve` untuk server dev.
6. Login admin: `administrator` / `12345` → **ganti segera**.

> `composer.json` mensyaratkan PHP ^8.5 namun berjalan di PHP 8.3 (platform check dipatch). **Jangan `composer update`**.

## Struktur

```
app/
├── Config/Routes.php        # routing publik + admin
├── Controllers/             # Home, News, Pages, Downloads, Contact, Sitemap + Admin/
├── Models/                  # 16 model
├── Views/
│   ├── layouts/             # header + footer publik
│   ├── pages/               # home, news, single_post, page, contact, downloads
│   └── admin/               # layout + view per modul
├── Helpers/menu_helper.php
└── Database/Seeds/          # 14 seeder
public/
├── css/                     # style.css, 9 tema *-theme.css
├── js/                      # script.js
└── uploads/                 # konten via admin
```

## Keamanan

Output di-escape, CSRF pada semua form, honeypot form kontak, password bcrypt, upload tervalidasi + auto-resize, proteksi path-traversal & upload RCE.

## Lisensi & Kredit

- CMS inti: **Sekolahku** ([sekolahku.web.id](https://sekolahku.web.id)) — lihat `LICENSE`
- Kustomisasi & desain: © Duta Corpora Indonesia
