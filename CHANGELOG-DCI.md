# CHANGELOG — Kustomisasi DCI

> Catatan perubahan custom oleh **Duta Corpora Indonesia** di atas CMS Sekolahku v3.1.2.
> File ini WAJIB di-update setiap sesi kustomisasi. Repo git upstream milik Sekolahku —
> semua perubahan di bawah adalah patch lokal DCI yang perlu di-reapply bila ambil versi resmi baru.

Format: [Keep a Changelog](https://keepachangelog.com/id/1.1.0/) · Versioning: [SemVer](https://semver.org/lang/id/)

## [Unreleased] — Kustomisasi DCI #4: Sinkronisasi UX Admin (P1b) (2026-09-23)

### Diperbaiki (Fixed)
- **Mismatch key principal**: seeder memakai `role_title`/`welcome_message` tapi frontend & form admin membaca `role`/`quote` — sambutan kepala madrasah tidak pernah tampil di frontend. Diseragamkan ke `role`/`quote` (seeder + DB demo).
- Fallback view `welcome_message` dipertahankan sementara agar aman untuk instalasi lama.

### Diubah (Changed)
- **Form section settings admin**: tambah field "Deskripsi Singkat" (key `desc`) di 14 section — operator kini bisa edit deskripsi yang tampil di bawah judul.
- Label admin "Kepala Sekolah" → "Kepala Madrasah".
- **Swatch tema admin** disesuaikan palet DCI: default kini solid hijau #1B5E43 (sebelumnya gradient jadul), green #065f46 → #1B5E43, urutan swatch dirotasi.

### Catatan Teknis
- Runtime Playwright: admin settings — 14 field desc, principal role/quote terisi benar, swatch default rgb(27,94,67); frontend — hero card "Kepala Madrasah" + sambutan Assalamu'alaikum tampil.
- `php -l` bersih. Settings::save() tidak perlu diubah (JSON section_settings & principal disimpan apa adanya dari POST).

## [Unreleased] — Kustomisasi DCI #3: Copy Bernyawa + Motif Arabesque + Rhythm (2026-09-23)

### Ditambahkan (Added)
- **Motif arabesque** bintang 8 titik (SVG data URI emas) sebagai pembatas `.section-title::after` — identitas islami halus tanpa gambar eksternal. Varian rata kiri `.section-title--left`.
- **Key `desc`** di section_settings (news, events, gallery, faq, teachers, achievements) — deskripsi section kini terpisah dari subtitle, bisa diedit operator.

### Diubah (Changed)
- **Copy bernyawa** (seeder + DB demo): hero subtitle, tombol hero, sambutan kepala madrasah ("Assalamu'alaikum..."), tagline "Madrasah untuk Buah Hati Anda", footer description, 13 subtitle section — semua bicara ke orang tua, bukan kalimat pemasaran generik.
- **Rhythm homepage**: section Berita rata kiri (`section-title--left`) memecah repetisi 10 judul centered.
- Icon program unggulan `fa-gem` → `fa-seedling`.
- `principal.role_title` → "Kepala Madrasah".

### Diperbaiki (Fixed)
- **Subtitle ganda**: 6 section (news, teachers, achievements, gallery, faq) menampilkan `subtitle` dua kali (di H2 dan paragraf) — paragraf kini membaca key `desc`.
- Spasi hilang di footer_description ("SekolahKu.Informasi").

### Catatan Teknis
- Runtime Playwright: 10 section-title motif aktif, 0 dead link, tagline baru di title, news rata kiri; events hidden (DB demo tanpa agenda — perilaku benar).
- style.min.css diregenerasi (49KB).

## [Unreleased] — Kustomisasi DCI #2: Identitas Visual P1 (2026-09-23)

Arah: DESIGN.md (islami hangat-ramah, ENERGY 1 / RHYTHM 2 / MOTION 1). Target kontras AAA.

### Ditambahkan (Added)
- **Font self-host** `public/fonts/`: Source Serif 4 (judul, serif editorial) + Public Sans (body), subset latin woff2 (~150KB total), `@font-face` di style.css. Google Fonts CDN dihapus dari header (hemat request eksternal, tahan internet lambat).
- **Cache-buster CSS**: `style.min.css?v={filemtime}` di header.php — mencegah cache basi setelah update tema.
- **DESIGN.md**: direction file resmi semua keputusan visual P1.

### Diubah (Changed)
- **Palet baru**: primary hijau madrasah `#1B5E43`, aksen emas `#B98A2F` (gelap `#8C6A22` untuk teks, 10.77:1), bg putih gading `#FAF9F5`, teks `#1F2937`/`#4B5563` (7.17-13.93:1, AAA). Dark mode: hijau mint `#6EE7B0` + emas terang `#E9C46A` (7.72:1 di atas `#14382A`).
- **9 tema madrasah** (`*-theme.css`) diregenerasi dengan kerangka DCI: warna inti bervariasi per tema (semua lolos 6.7-8.6:1), aksen emas tetap konsisten antar-tema.

### Dihapus (Removed)
- `text-gradient` pada H2 (kini warna solid aksen gelap).
- 4 blob dekoratif hero (`hero-shape`) + animasi float-nya.
- Radial orb background `.bg-alt` (kini flat putih gading).
- Gradient pada nav underline, tombol SPMB, st-badge, section divider, footer credit line (solid semua; gradient tersisa hanya nuansa hijau di hero/page-banner/tombol primary).

### Catatan Teknis
- Kontras diverifikasi contrast-check.py: 8 pasangan light + 4 dark, semua PASS (target ≥4.5, hasil 6.7-13.9).
- Runtime Playwright: palet + font aktif, dark mode benar (hijau mint/emas), hero-shape display:none, overflow-x mobile 0px, php -l bersih.
- File min.css diregenerasi (48.9KB).

## [Unreleased] — Kustomisasi DCI #1 (2026-09-22)

Sesi: Full audit AI slop + perbaikan P0 (Hard Gate) + rebranding footer.
Audit lengkap: `.trae/documents/audit-ai-slop.md` · Plan: `.trae/documents/plan-p0-audit-fix.md`

### Ditambahkan (Added)
- **Focus indicator global** (`public/css/style.css`): aturan `:focus-visible` untuk semua elemen interaktif (outline 3px + offset 2px), dengan varian kontras untuk bg gelap (footer/hero) dan dark mode. Sebelumnya 80 elemen tanpa indikator fokus keyboard.
- **`prefers-reduced-motion`**: matikan semua animasi/transisi untuk user yang mengaturnya di OS.
- **Tap target mobile 44x44px** (media query ≤768px): ikon sosmed, link "Baca Selengkapnya", filter kategori berita, link footer, tombol pagination.

### Diubah (Changed)
- **Rebranding footer**: kredit "CMS by sekolahku.web.id" → "Design with ❤ by Duta Corpora Indonesia · Powered by CMS Sekolahku" (link DCI: https://kirimpesanwa.my.id/jasapembuatanwebsite). Warna inline `#6366f1` dihapus, memakai warna aksen tema.
- **Judul halaman (title tag)**: pola "X — Y" duplikat ("SekolahKu — SekolahKu") dinormalisasi menjadi "NamaHalaman | NamaSitus"; home kini "NamaSitus | Tagline". Separator `-` di controller diganti `|`. File: `layouts/header.php`, `Controllers/{Home,News,Contact,Downloads}.php`.
- **Default seeder jujur** (`app/Database/Seeds/SettingSeeder.php`): `hero_badge` kosong (tidak lagi mengklaim "Terakreditasi A"), `spmb_url` kosong, `hero_stats` & `counter_stats` kosong (tidak lagi mengarang "1200+ Siswa"), `about.accreditation` kosong, `footer_copyright` = "All rights reserved." (tanpa © dobel). DB lokal demo sudah disinkronkan via SQL UPDATE.

### Dihapus (Removed)
- **Fallback angka fabrikasi** di `pages/home.php` (40+ Rombongan Belajar / 25 Tahun / 24 Prodi / 3000+ Alumni): section counter kini auto-hide bila data kosong.
- **Dead link `#` massal** (hasil verifikasi runtime: 0 sisa):
  - Ikon sosmed header-top, footer, dan sidebar berita/halaman: hanya dirender bila URL terisi dan bukan `#`.
  - Tombol "SPMB Online" di navigasi: auto-hide selama `spmb_url` kosong.
  - Kolom footer "Program" (Sains & Teknologi, Seni & Budaya, Olahraga, Bahasa Asing, Digital Literacy) dan "Layanan" (SPMB Online, E-Learning, Perpustakaan, Pengaduan): link `#` di-skip; seluruh kolom auto-hide bila kosong.
  - Fallback hardcoded link footer dihapus dari `layouts/footer.php`.
- **Em dash (—)** pada copyright footer dan pola title.

### Catatan Teknis
- `public/css/style.min.css` diregenerasi dari `style.css` (skrip minify sementara dihapus setelah pakai).
- Verifikasi: Playwright (focus outline solid 3px, 0 dead link, counter hilang, tap target 44px, overflow-x mobile 0px) + `php -l` bersih untuk 10 file PHP yang diubah.
- Konsol error CORS debugbar hanya muncul di dev (127.0.0.1 vs sekolahku.test), tidak ada di produksi.
- Konten dummy lain (testimoni "Alya Putri" dll., "Dr. Sari Wijaya", alamat fiktif) masih ada di DB demo — akan diganti operator via admin; default seeder produksi menyusul.

## TODO Kustomisasi Berikutnya
- P1: identitas visual islami-pendidikan (DESIGN.md → palet, font self-host, rhythm section, copy, kontras AAA, 9 tema warna).
- P1b: UX Admin Pengaturan (tab pengelompokan, label operator, checklist onboarding).
- Split seeder demo vs produksi (DatabaseSeeder minimal tanpa konten dummy).
- P2: empty state informatif, verifikasi kontras dark mode, toast pengganti alert(), tanggal Indonesia.
