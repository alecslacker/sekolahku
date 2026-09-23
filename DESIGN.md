# DESIGN.md — Website Sekolah (Kustomisasi DCI atas CMS Sekolahku)

> Direction file antislop (R-37). Sumber arah: keputusan Mas Wondho, 2026-09-22.
> File ini adalah KEBENARAN untuk semua keputusan visual P1. Konflik dengan selera default agent = agent kalah.

## Identitas

Sekolah yang hangat dan dipercaya: website yang terasa seperti sekolahnya sendiri, bukan template sekolah generik. Orang tua (mayoritas pengakses via HP) datang mencari informasi: jadwal, berita, kontak, pendaftaran. Desain melayani itu, tidak berpamer.

Karakter: **islami hangat-ramah** — hijau lembut, putih bersih, aksen islami SATU motif saja (geometri arabesque halus), bukan ornamen di mana-mana. Terasa religius tanpa berat, bersahabat tanpa kekanakan.

## Palet

| Peran | Warna | Catatan |
|---|---|---|
| Inti 1 (identitas) | Hijau sekolah `#1B5E43` (dark green lembut) | Header, heading, link aktif |
| Inti 2 (dasar) | Putih gading `#FAF9F5` + putih `#FFFFFF` | Background section selang-seling |
| Aksen | Emas `#B98A2F` | Dosis rendah: 1-2 titik per layar (CTA utama, garis pembatas motif) |
| Netral teks | `#1F2937` (teks), `#4B5563` (sekunder) | Kontras AAA di atas putih gading |

Aturan:
- Gradient dihapus dari identity; hanya boleh 1 tempat (hero) bila diperlukan kedalaman, alasan ditulis.
- `text-gradient` pada H2 dihapus semua.
- Radial orb background body dihapus.
- Neutral (putih/hitam/abu) tidak dihitung palet.
- 9 tema sekolah = variasi "Inti 1" saja (hijau→biru/navy/dll sesuai tema), emas aksen tetap.

## Tipografi

- **Heading: serif editorial** — berkarakter buku pelajaran/lontar, modern. Kandidat: *Source Serif 4* atau *Lora* (self-host, subset latin, woff2). Alasan: terasa kitab-akademik hangat, tetap terbaca besar di HP.
- **Body: sans bersih** — *Public Sans* atau *Inter* DILARANG default-tanpa-alasan; pilih *Public Sans* (self-host) karena karakter netral-pemerintahan yang tepercaya dan bukan default AI paling khas.
- Skala: fluid (`clamp()`), body 16-17px mobile-first, heading H1 `clamp(1.75rem, 4vw, 2.5rem)`.
- Uppercase letter-spacing hanya untuk label kecil (overline section), maksimal 1 per section.

## Motif Identitas (identity motif)

Satu motif: **garis geometric-arabesque sederhana** (pola 8-titik / bintang dua persegi diputar) sebagai SVG tipis (opacity rendah) di:
1. Pembatas antar-section (garis horizontal dengan motif di tengah), dan
2. Sudut kartu kepala sekolah / hero.
Tidak di background body, tidak di setiap kartu. Alasan: identitas islami tanpa ornamen berlebih.

## Dials (antislop)

- **ENERGY 1** (kalem): GOV.UK-like, konten dominan, tidak ada dekorasi berteriak.
- **RHYTHM 2** (konsisten dengan beberapa variasi): section selang putih-gading, komposisi bervariasi 3 pola (2 kolom gambar-kiri/kanan, daftar, grid) — bukan 13x kartu seragam.
- **MOTION 1** (hover/fokus saja): transisi warna halus 150-200ms; tanpa scroll-reveal, tanpa floating, counter tetap tapi hormati reduced-motion (sudah ada).

## Komponen Kunci

- **Hero**: teks kiri (H1 serif + sub + 1 CTA hijau solid + 1 link sekunder), kartu sambutan kepala sekolah kanan dengan motif sudut. Tanpa blob/shape dekoratif 4 buah (hapus hero-shape).
- **Kartu**: radius 8-12px konsisten (bukan pill), shadow 1 level saja (elevasi hover), tanpa glow.
- **CTA**: teks spesifik ("Lihat Jadwal KBM", "Daftar PPDB" — bukan "Jelajahi"), tombol solid hijau, hover gelap 10%.
- **Ikon**: Font Awesome dipertahankan (sudah ada) tapi hanya ikon kontekstual (telepon, lokasi, kalender) — hapus ikon dekoratif (star di badge, gem).
- **Focus**: tetap outline 3px (P0), warna aksen emas di bg hijau.

## Aksesibilitas (target AAA)

- Semua pasangan teks/bg dihitung dengan contrast-check.py: teks normal ≥ 7:1, besar ≥ 4.5:1 (di atas target AA).
- Emas `#B98A2F` DILARANG untuk teks di putih (kontras ~3:1); hanya untuk elemen non-teks / teks besar di bg gelap.
- Dark mode diverifikasi 2-arah dengan formula yang sama.

## Larangan Eksplisit

- Tidak emoji di UI. Tidak purple/indigo. Tidak glassmorphism. Tidak bento. Tidak gradient text.
- Tidak menambah konten fabrikasi (R-17/R-38) — empty state jujur.
- Tidak em dash (R-02).
