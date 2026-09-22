# CHANGELOG — Kustomisasi DCI

> Catatan perubahan custom oleh **Duta Corpora Indonesia** di atas CMS Sekolahku v3.1.2.
> File ini WAJIB di-update setiap sesi kustomisasi. Repo git upstream milik Sekolahku —
> semua perubahan di bawah adalah patch lokal DCI yang perlu di-reapply bila ambil versi resmi baru.

Format: [Keep a Changelog](https://keepachangelog.com/id/1.1.0/) · Versioning: [SemVer](https://semver.org/lang/id/)

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
