# TRANSISI PROJECT - Dari Build Sendiri ke CMS Sekolahku

Tanggal: 2026-09-22 | Keputusan: Mas Wondho

## [2026-09-22] Keputusan Pivot: Pakai CMS Sekolahku

- Alasan: Deadline perpanjangan CBT 10 Oktober 2026. Build sendiri (vibe coding) terlalu lambat untuk perbaikan tampilan & fitur yang banyak. CMS Sekolahku (https://sekolahku.web.id/) dipilih sebagai basis website MI.
- Project baru: F:\laragon\www\sekolahku (Laragon). Dokumentasi latar belakang dipindah ke .trae/documents/ di sana.
- Masalah yang akan diatasi: demo CMS Sekolahku masih banyak AI slop pada tampilan - akan diperbaiki (skill antislop* + frontend-design).
- Status project lama (website-mi/ Astro): DIHENTIKAN sementara, bukan dibatalkan. Fase A selesai (3/17 task: tokens, font, ikon). Bisa dijadikan referensi design system (PRD Section 8 masih relevan: token semantik, dua komposisi mobile/desktop, tema per madrasah).
- Konteks bisnis tetap: bundle retensi CBT Rp 2.000.000/tahun = website + jurnal mengajar gratis; 8 MI sekecamatan; pilot live sebelum deadline 10 Oktober.
- Artefak pendukung di project baru: downloads/ berisi zip CMS Sekolahku v2.1.3-v3.0.1 (terbaru v3.0.1). Surat penawaran + script surat tetap di project lama.

## Langkah sesi baru (di F:\laragon\www\sekolahku)

1. Ekstrak/instal CMS Sekolahku v3.0.1 via Laragon.
2. Pelajari struktur & theming CMS Sekolahku (cek dokumentasi resmi).
3. Audit tampilan demo -> daftar semua AI slop yang harus diperbaiki.
4. Kerjakan perbaikan tampilan sesuai design contract PRD Section 8 (dipindahkan dari project Astro bila relevan).
