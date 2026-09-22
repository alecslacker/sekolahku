# AUDIT AI SLOP — CMS Sekolahku v3.1.2

Tanggal: 2026-09-22 · Auditor: Slackercoder (skills: antislop core + ui + copywriting + human + layoutmobile, frontend-design) · Mode: Mode 2 audit-only, TANPA edit kode.

## Metode

- Source review: `app/Views/{layouts,pages,admin}`, `public/css/style.css`, `public/js/script.js`, tabel `settings` (DB).
- Browser: Playwright, desktop (default viewport) + mobile 375x812. Halaman: home, /news, /news/[slug], /contact, /downloads, /login, /admin/dashboard (login sukses: administrator).
- Tekanan runtime: overflow-x mobile = 0px (bagus), 80 elemen interaktif TANPA outline focus, tap target <36px di berbagai link, console error CORS debugbar (dev-only, non-issue produksi).
- Screenshot: `audit-{desktop,mobile}-*.png` (10 file, root project — pindahkan bila perlu).

Severity: HIGH (Hard Gate R-xx, wajib) · MEDIUM (Purpose-Gate, butuh alasan) · LOW (quality lock).

---

## A. TEMUAN GLOBAL (semua halaman publik)

### A1. [HIGH | R-32] Focus state hilang total — 80 elemen interaktif tanpa outline
- Lokasi: `public/css/style.css` — tidak ada aturan `:focus-visible` global sama sekali; grep `:focus` hanya mengenai `input/textarea` (glow border).
- Bukti runtime: 80/80 link & button di homepage tidak punya indikator focus.
- Dampak: keyboard user (dan screen reader) tidak bisa lihat posisi tab. Fatal untuk klaim WCAG AAA.
- Rekomendasi: tambah `:focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }` global + audit dark mode.

### A2. [HIGH | R-24/R-26] Dead links massal — semua URL sosial media & footer "#" 
- Lokasi: DB `settings` (social_facebook/instagram/youtube/tiktok = `#`), `footer_links` (SPMB Online, E-Learning, Perpustakaan, Pengaduan = `#`), `spmb_url` = `#` (dipakai tombol "SPMB Online" di header), fallback `<a href="#">` di `layouts/footer.php` baris 58-62, 80-84.
- Dampak: link mati yang tampak nyata = broken promise. Untuk orang tua mencari SPMB, ini merusak trust langsung.
- Rekomendasi: sembunyikan link bernilai `#` (guard `&& $url !== '#'`), atau isi tujuan nyata per madrasah saat onboarding.

### A3. [HIGH | R-17/R-38] Statistik fabrikasi dari seeder — "1200+ Siswa, 85+ Guru, 150+ Prestasi, Lulusan 100% Terserap"
- Lokasi: DB `settings` (hero_stats, counter_stats, about.highlights), dirender `pages/home.php` baris 33-42 (hero-meta), 91-105 (counter), 156-162 (about-list).
- Dampak: angka palsu tampil di hero madrasah nyata (MI kecil dengan ~100-300 siswa) = klaim menyesatkan, pelanggaran R-17.
- Rekomendasi: default seeder → kosong/0, wajib diisi admin per sekolah; atau tarik angka riil dari DB (jumlah guru = tabel teachers, dsb).

### A4. [HIGH | R-18/R-38] Testimoni fabrikasi — "Alya Putri", "Andi Pratama", "Raka Firmansyah"
- Lokasi: tabel `testimonials` (seeder), dirender `pages/home.php` baris 314-340.
- Rekomendasi: hapus seeder testimoni; section auto-hide saat kosong (view sudah punya guard `!empty` — cukup kosongkan datanya).

### A5. [HIGH | R-23/R-38] Identitas dummy fabrikasi — "Dr. Sari Wijaya, M.Pd." + foto placehold.co + hero "Terakreditasi A"
- Lokasi: DB `settings` principal (nama & foto kepala sekolah fiktif), about.image = placehold.co, hero_badge "Terakreditasi A" (klaim akreditasi tanpa bukti), alamat "Jl. Pendidikan No. 123, Kelurahan Cerdas".
- Dampak: klaim akreditasi A adalah klaim resmi. Tidak boleh tampil default.
- Rekomendasi: default kosong + placeholder jujur " Belum ada foto kepala sekolah"; akreditasi hanya tampil bila diisi.

### A6. [MEDIUM | R-06] Tipografi generik AI — Parkinsans + Inter dari Google Fonts
- Lokasi: `layouts/header.php` baris 22 (Parkinsans 400-800 + Inter 300-600).
- Dampak: Inter adalah default AI paling khas (R-06); Parkinsans juga font "trendy 2025". Tidak ada koneksi ke karakter islami-pendidikan. Bonus: dependensi eksternal Google Fonts (offline lambat di server lokal madrasah).
- Rekomendasi: pilih font bercirikan naskah-akademik Indonesia (mis. display serif/kufi-geometris) + self-host subset, dengan alasan tertulis di DESIGN.md.

### A7. [MEDIUM | R-01/R-29] Gradient & aksen di mana-mana
- Lokasi: `style.css` — `text-gradient` (accent→primary-light) dipakai ±15x per halaman; linear-gradient pada tombol, badge st-badge, hero, counter icon, nav underline, footer. Radial orb background body. Variabel `--accent-glow`.
- Dampak: aksen teal (#14b8a6) muncul di tombol, ikon, badge, link, border, hover — bukan aksen lagi, tapi warna kedua yang menyala di mana-mana. `text-gradient` pada tiap H2 = template rhythm seragam.
- Rekomendasi: palet 2 inti + 1 aksen; gradient hanya 1-2 tempat dengan alasan tertulis; hapus text-gradient dari semua H2.

### A8. [MEDIUM | R-05] Rhythm section seragam total — 12 section homepage, semuanya "badge kecil + H2 gradient + subtitle + grid kartu identik"
- Lokasi: `pages/home.php` — hero, counter, profil, program, ekskul, guru, prestasi, testimoni, berita, agenda, galeri, FAQ, kontak. Setiap section-title punya struktur byte-identik; grid kartu seragam (R-14).
- Dampak: halaman terasa "generated" — template yang sama diulang 12x, tidak ada fokus/hierarki antar-section.
- Rekomendasi: variasikan komposisi 2-3 pola (daftar untuk ekskul, feature lebar untuk program unggulan, dsb.), kurangi section yang kosong datanya.

### A9. [MEDIUM | R-02] Em dash di copy — "© 2026 SekolahKu — All rights reserved."
- Lokasi: DB `footer_copyright`, dirender `layouts/footer.php` baris 91. Juga pattern title `X — Y` di `<title>` (`layouts/header.php` baris 6).
- Rekomendasi: ganti em dash dengan "·" atau "|"; title separator pakai "|" atau " -" (hyphen).

### A10. [HIGH | duplikasi title] "SekolahKu — SekolahKu" + pola title rusak
- Lokasi: `layouts/header.php` baris 6: `$page_title ?? $site_name` — di Home controller tidak mengirim `$page_title`, jadi site_name dobel. Halaman lain: "Berita - SekolahKu — SekolahKu" (dua separator berbeda: "-" dari controller + "—" dari layout).
- Bukti runtime: title home = "SekolahKu — SekolahKu", news = "Berita - SekolahKu — SekolahKu", single post = "… - SekolahKu — SekolahKu".
- Rekomendasi: normalisasi: title = `$page_title | $site_name`, fallback `$site_name - $site_tagline`.

### A11. [MEDIUM | R-03] Tap target <44px di mobile
- Bukti runtime: link nav footer/anchor "active:10px", `.bc-link` (Baca Selengkapnya) = 22px tinggi, sosial icon 33px.
- Rekomendasi: min-height 44px + padding untuk semua link interaktif mobile (sosial header-top, bc-link, nav-spmb).

### A12. [LOW | R-27] Empty state minim — "Tidak ada berita saat ini." / "Belum ada berkas download tersedia."
- Lokasi: `pages/news.php` baris 50, `pages/downloads.php` baris 50-53.
- Dampak: tidak menyebut penyebab & aksi berikutnya (R-27: empty state harus informatif).
- Rekomendasi: "Belum ada berita yang dipublikasikan. Pengumuman sekolah akan tampil di sini."

### A13. [MEDIUM | R-16] Headline templatis generik
- Lokasi: DB `section_settings` + fallback views — "Membangun Generasi Cerdas, Berkarakter, dan Berprestasi menuju Masa Depan Gemilang" (rule-of-three + journey), "Generasi Berdaya Saing Global", "Digital Literacy" (EN di footer ID), "Selamat Datang di SekolahKu" (hero tidak bicara apa pun).
- Rekomendasi: copy yang bicara ke orang tua MI: "Madrasah al-Qur'an dan sains untuk buah hati Anda" — arah islami-pendidikan sesuai desain target.

### A14. [LOW | R-19] Counter animation tanpa prefers-reduced-motion
- Lokasi: `public/js/script.js` (animasi angka naik), CSS tidak ada `@media (prefers-reduced-motion)`.
- Dampak: user vestibular disorder tidak bisa matikan motion; juga angka yang di-animate adalah angka fabrikasi (lihat A3).

### A15. [MEDIUM] Dark mode toggle ada — tapi tanpa persist & kontras belum diverifikasi
- Lokasi: `layouts/header.php` baris 92 (#darkToggle), `style.css` baris 35-40 (variabel dark).
- Dampak: R-21/R-34: kedua mode harus diverifikasi kontrasnya. Perlu cek `--primary: #38bdf8` (biru terang) di dark mode terhadap teks putih.
- Catatan positif: toggle-nya ada dan berfungsi (basis bagus).

---

## B. PER HALAMAN

### Home (`app/Views/pages/home.php`)
| # | Kategori | Temuan | Severity | Lokasi |
|---|---|---|---|---|
| H1 | Dummy slop | Seluruh konten dari seeder fiktif (A3-A5) | HIGH | baris 14-105, 314-340 |
| H2 | Layout generik | Hero 2-kolom + badge bintang ⭐-style + 2 CTA + kartu kepsek — template landing klasik | MEDIUM | baris 6-74 |
| H3 | Ikon | `fa-star` di hero-badge, `fa-gem` (programs), `fa-trophy` — ikon generik tanpa relevansi | LOW (R-04) | baris 15; DB section_settings |
| H4 | CTA generik | "Jelajahi Sekolah" → `#profile` (scroll), oke fungsi tapi copy templatis | LOW (R-15) | baris 21 |
| H5 | Duplikasi | Section KONTAK home (baris 466-529) identik dengan halaman /contact — konten dobel | LOW | baris 466-529 |
| H6 | Fallback slop | Fallback counter hardcoded "40+ Rombel / 25 Thn / 24 Prodi / 3000+ Alumni" bila setting kosong — tetap angka palsu | HIGH (R-17) | baris 82-89 |

### News (`app/Views/pages/news.php`)
| # | Temuan | Severity |
|---|---|---|
| N1 | Placeholder placehold.co untuk semua thumbnail berita (600x400 teal) — terlihat "belum jadi" | MEDIUM (R-23) |
| N2 | Empty state satu kalimat tanpa aksi | LOW (R-27) |
| N3 | Sidebar widget "Ikuti Kami" link "#" | HIGH (R-26, lihat A2) |
| N4 | Title "Berita - SekolahKu — SekolahKu" double-separator | MEDIUM (A10) |

### Single Post (`app/Views/pages/single_post.php`)
| # | Temuan | Severity |
|---|---|---|
| S1 | H1 banner generik "Baca Berita SekolahKu" — judul artikel asli ada tapi banner di atasnya templatis & redundan | LOW |
| S2 | Share link `alert('Link disalin!')` — blocking alert() bukan feedback baik; tanpa fallback clipboard API | LOW |
| S3 | Tanggal format `j F Y` Inggris ("22 September" oke tapi nama bulan bisa "March") — pakai format Indonesia | LOW |

### Contact (`app/Views/pages/contact.php`)
| # | Temuan | Severity |
|---|---|---|
| C1 | Banner h1 "Hubungi Kami" + span gradient "Kami" — kata dipecah demi styling, aneh dibaca | LOW |
| C2 | Form: placeholder-as-label (tanpa label terlihat) — aksesibilitas input buruk bagi screen reader low-vision; ada aria-label tapi tanpa visible label WCAG AAA lebih baik label eksplisit | MEDIUM (R-25/R-32 area) |
| C3 | Feedback submit via `alert()` errText (`script.js` baris 184) — bukan inline error human-readable | MEDIUM |
| C4 | Alamat/telepon dummy "(021) 1234-5678" tampil nyata | HIGH (R-38, lihat A5) |

### Downloads (`app/Views/pages/downloads.php`)
| # | Temuan | Severity |
|---|---|---|
| D1 | Empty state "Belum ada berkas download tersedia." — informatif kurang, icon `fa-4x` dekoratif | LOW (R-27) |
| D2 | `fa-weight` untuk ukuran file — ikon tidak relevan (weight = timbangan) | LOW (R-04) |

### Page dinamis (`app/Views/pages/page.php`)
| # | Temuan | Severity |
|---|---|---|
| P1 | Banner "Baca Halaman SekolahKu / Informasi lengkap seputar halaman ini" — placeholder yang tidak bicara apa pun | LOW |
| P2 | Sidebar search "Cari berita..." di halaman statis — konteks salah | LOW |
| P3 | Catatan: tabel `pages` kosong (0 baris) — tidak bisa diaudit ter-render; temuan P1-P2 dari kode | info |

### Layout global (`layouts/header.php`, `footer.php`)
| # | Temuan | Severity |
|---|---|---|
| L1 | Skip-link ada (positif!) tapi inline style + hardcode warna | LOW |
| L2 | Keyword meta hardcode di header baris 8 ("sekolah, pendidikan, kurikulum merdeka…") mengabaikan setting meta_keywords | LOW |
| L3 | Footer 4-kolom template (Brand/Navigasi/Program/Layanan) — kolom "Program" berisi 5 link ke anchor sama `#programs`, sia-sia | MEDIUM (R-05) |
| L4 | Footer nav 13 link anchor ke section home — di halaman news/contact anchor mati (tidak ada #profile di halaman itu) | MEDIUM (R-24) |
| L5 | Em dash copyright + warna inline `#6366f1` (indigo, di luar palet) di kredit CMS | LOW (R-29) |

### Admin (`app/Views/admin/*` — CoreUI 5)
| # | Temuan | Severity |
|---|---|---|
| AD1 | Title login "Login Admin – SekolahKu" pakai en dash; admin layout `lang="en"` padahal UI Bahasa Indonesia | LOW |
| AD2 | Sidebar active = left stripe biru `#60a5fa` + gradient fade — colored left stripe dekoratif (R-05 ui) tapi di sini fungsional sebagai indikator aktif — bisa dipertahankan dengan alasan | LOW (passed purpose test, dokumentasikan) |
| AD3 | Menggunakan CoreUI default tanpa kustomisasi brand — generik tapi fungsional; prioritas rendah untuk pilot | LOW |
| AD4 | np-btn pagination 36px tinggi < 44px | LOW (R-03) |

---

## C. YANG SUDAH BAGUS (dipertahankan)

1. Overflow-x mobile = 0px di home/news/contact — layout mobile tidak bocor.
2. Skip-link keyboard ada.
3. `aria-label` & `aria-hidden` pada ikon dekoratif konsisten.
4. Toggle dark mode ada dan fungsional.
5. `prefers-reduced-motion` belum ada tapi motion umumnya halus (kecuali counter).
6. Honeypot CSRF di form kontak + refresh token via cookie — security basic oke.
7. Escape `esc()` konsisten di semua output — XSS hygiene baik.

## D. KONTRAS (butuh verifikasi numerik saat perbaikan)

Pasangan mencurigakan yang WAJIB dihitung dengan contrast-check.py saat eksekusi perbaikan:
- `--primary-light #0ea5e9` pada teks/link di bg putih (dipakai text-gradient → kemungkinan < 4.5:1).
- Teks putih di `linear-gradient(135deg, var(--accent) #14b8a6, var(--accent-dark))` tombol (bagian #14b8a6 ~2.8:1 → FAIL AA untuk teks putih).
- Dark mode `--primary #38bdf8` vs bg dark.
- `.header-top` teks kecil di bg gelap.

---

## E. RINGKASAN PRIORITAS PERBAIKAN (usulan urutan)

1. **P0 — Hard Gate (HIGH, 9 temuan):** focus-visible global (A1), dead link "#" (A2), statistik fabrikasi (A3, H6), testimoni fabrikasi (A4), dummy identitas/akreditasi (A5, C4), duplikasi title (A10).
2. **P1 — Identitas & slop visual (MEDIUM):** gradient overdose (A7), rhythm seragam (A8, L3/L4), font generik (A6), em dash (A9), tap target (A11), copy templatis (A13, C1, P1), form label & feedback (C2, C3).
3. **P2 — Polish (LOW):** empty state (A12), reduced-motion (A14), dark mode kontras (A15), minor admin (AD1-AD4).

Estimasi file yang akan disentuh saat eksekusi: `layouts/header.php`, `layouts/footer.php`, `pages/*.php` (6 file), `public/css/style.css`, `public/js/script.js`, seeder/DB default settings. Tidak menyentuh controller/model (kecuali title di controller untuk A10).

— Audit selesai. Tidak ada kode yang diubah. Menunggu persetujuan item mana yang dieksekusi.
