# Website Madrasah — CMS Sekolahku (Kustomisasi Duta Corpora Indonesia)

Repo ini berisi **CMS Sekolahku v3.1.2** (by [sekolahku.web.id](https://sekolahku.web.id), gratis 100%) yang dikustomisasi oleh **Duta Corpora Indonesia** untuk membangun website madrasah (MI/MTs/MA) dengan nuansa islami-pendidikan, mobile-first, dan aksesibilitas tinggi.

Dikembangkan sebagai bagian dari **bundle retensi klien CBT Duta Corpora Indonesia**: perpanjangan layanan CBT Rp 2.000.000/tahun, termasuk website + jurnal mengajar gratis, untuk 8 MI se-satu kecamatan. Setiap madrasah mendapat website dengan **tema warna sendiri** (9 tema tersedia) dan konten yang diisi sendiri oleh operator melalui panel admin.

> Dokumen perubahan custom DCI: [CHANGELOG-DCI.md](CHANGELOG-DCI.md)

---

## Fitur

### Halaman Publik
- **Beranda** komposit: hero (badge, statistik, sambutan kepala sekolah), counter statistik, profil/visi-misi, program unggulan, ekstrakurikuler, tenaga pengajar (carousel), prestasi siswa, testimoni, berita terbaru, agenda kegiatan, galeri (lightbox), FAQ (accordion), kontak + form (honeypot + CSRF)
- **Berita & Artikel**: filter kategori, pencarian, arsip bulanan, tag, komentar, artikel terkait, share (WA/Telegram/FB/X)
- **Halaman dinamis** (Pages) dengan menu builder, breadcrumb, dan share
- **Download Center**: pengelompokan per kategori, ukuran file
- **Kontak**: form pesan masuk ke admin
- **Sitemap.xml** otomatis, meta SEO (OG/Twitter card), JSON-LD `EducationalOrganization`
- **Dark mode** toggle, **9 tema warna** per madrasah: blue, brown, gray, green, navy, pink, purple, red, teal

### Panel Admin (`/login`)
Manajemen penuh via 20+ modul CRUD: Dashboard, Pengaturan Situs (36 pengaturan termasuk hero, statistik, kepala sekolah, tema warna), Berita, Halaman, Menu (drag order, nested), Guru, Program, Ekstrakurikuler, Prestasi, Testimoni, Agenda, Galeri, FAQ, Downloads, Pesan Kontak, Komentar, Uploads (RCE-safe), Pengguna (role: superadmin/admin/editor), Profil.

Editor teks kaya (Quill), upload gambar dengan auto-resize (GD), pengaturan visibilitas per-section beranda.

## Stack Teknologi

| Komponen | Teknologi |
|---|---|
| Framework | CodeIgniter 4.7 (PHP native views, tanpa template engine) |
| Database | MySQL / MariaDB (16 tabel) |
| CSS | Custom CSS murni (±55KB) + 9 file tema, minify via `matthiasmullie/minify` |
| JS | Vanilla (script.min.js), Simplebar, Font Awesome 6.5 |
| Admin UI | CoreUI 5 + Quill 2 |
| Font | Parkinsans + Inter (Google Fonts) |

## Instalasi Lokal (Laragon/Windows)

1. **Persyaratan**: PHP 8.1+ (dites di 8.3.16), MySQL/MariaDB, Apache (vhost) atau `php spark serve`.
2. Clone repo, `composer install` **tidak diperlukan** bila memakai distribusi ber-vendor (repo ini tidak menyertakan `vendor/`; jalankan `composer install` bila vendor belum ada, lalu bila composer menolak versi PHP: patch `vendor/check_platform_reqs`/platform check sesuai PHP yang dipakai).
3. Buat database, import `sekolahku_db.sql` (berisi struktur + data demo + akun admin default).
4. Salin `env` → `.env`, sesuaikan `app.baseURL` dan kredensial DB.
5. Arahkan DocumentRoot ke folder `public/`.
6. Login admin: `administrator` / `12345` → **ganti segera**.

```bash
# Alternatif server dev
php spark serve        # http://localhost:8080
```

> Catatan penting: `composer.json` mensyaratkan PHP ^8.5 namun vendor berjalan di PHP 8.3 (platform check dipatch). **Jangan `composer update`** karena akan menimpa patch.

## Struktur Proyek

```
app/
├── Config/Routes.php          # Routing publik + 20+ route group admin (presenter)
├── Controllers/
│   ├── Home, News, Pages, Downloads, Contact, Sitemap   # Publik
│   └── Admin/                # Dashboard, Settings, Auth, News, Pages, Menus,
│                             # Teachers, Programs, Extracurriculars, Achievements,
│                             # Testimonials, Events, Gallery, Faq, Messages,
│                             # Comments, Uploads, Users, Profile, Downloads
├── Models/                    # 16 model (1 per tabel) + query builder
├── Views/
│   ├── layouts/               # header.php + footer.php (layout publik)
│   ├── pages/                 # home, news, single_post, page, contact, downloads
│   └── admin/                 # layout.php + view per modul CRUD
├── Helpers/menu_helper.php    # render menu nested dari DB
└── Database/Seeds/            # 14 seeder (users, settings, konten demo)
public/
├── css/                       # style.css (+ .min.css), 9 tema *-theme.css
├── js/script.js               # interaksi publik (menu, carousel, lightbox, dark mode)
└── uploads/                   # konten yang diunggah via admin
```

## Perbedaan dari CMS Sekolahku Resmi (Kustomisasi DCI)

Ringkasan; detail lengkap di [CHANGELOG-DCI.md](CHANGELOG-DCI.md):

- Rebranding footer: "Design with ❤ by Duta Corpora Indonesia · Powered by CMS Sekolahku"
- Aksesibilitas: focus-visible global, `prefers-reduced-motion`, tap target 44px mobile
- Judul halaman dinormalisasi (tanpa duplikasi "SekolahKu — SekolahKu")
- Dead link `#` otomatis disembunyikan (sosmed, SPMB, footer) hingga operator mengisi
- Default seeder jujur: tanpa klaim akreditasi/statistik fabrikasi
- Dokumen internal kerja DCI di `.trae/` (tidak di-commit)

## Keamanan

- Output di-escape `esc()` konsisten; CSRF token pada semua form + refresh token via cookie
- Upload gambar divalidasi tipe (JPEG/PNG/WebP) + auto-resize; proteksi path-traversal & upload RCE (fix bawaan v3.1.2)
- Honeypot pada form kontak; password bcrypt (cost 12); role-based access admin

## Lisensi & Kredit

- CMS inti: **Sekolahku** ([sekolahku.web.id](https://sekolahku.web.id)), gratis — lihat `LICENSE`
- Kustomisasi & desain: © Duta Corpora Indonesia

---

*Dibangun dengan TRAE (Slackercoder workflow) · Audit AI-slop & design system islami-pendidikan berjalan menuju pilot Oktober 2026.*
