<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('settings')->truncate();
        $settings = [
            // Site identity
            ['site_name', 'SekolahKu'],
            ['site_tagline', 'Madrasah untuk Buah Hati Anda'],
            ['site_description', 'Situs resmi SekolahKu: informasi program, guru, kegiatan, dan pendaftaran untuk Bapak/Ibu orang tua.'],
            ['site_logo_text', 'SekolahKu'],
            ['site_logo_icon', 'graduation-cap'],
            ['site_url', 'https://sekolahku.sch.id'],

            // Contact info
            ['contact_phone', '(021) 1234-5678'],
            ['contact_email', 'info@sekolahku.sch.id'],
            ['contact_address', 'Jl. Pendidikan No. 123, Kelurahan Cerdas, Kecamatan Unggul, Kota Pelajar 12345'],
            ['contact_hours', 'Senin - Jumat: 07.00 - 16.00 WIB'],

            // Social media
            ['social_facebook', '#'],
            ['social_instagram', '#'],
            ['social_youtube', '#'],
            ['social_tiktok', '#'],

            // SEO / Meta
            ['meta_author', 'SekolahKu'],
            ['meta_keywords', 'sekolah, pendidikan, kurikulum merdeka, sekolah unggulan, SPMB'],
            ['meta_description', 'SekolahKu adalah institusi pendidikan unggulan yang berkomitmen mencetak generasi cerdas, berkarakter, dan berprestasi dengan kurikulum Merdeka.'],

            // Hero section
            ['hero_badge', ''],
            ['hero_title', 'Selamat Datang di SekolahKu'],
            ['hero_subtitle', 'Madrasah untuk buah hati Anda: belajar dengan hati, tumbuh dengan iman, siap menghadapi masa depan.'],
            ['hero_btn_primary_text', 'Kenali Madrasah Kami'],
            ['hero_btn_primary_url', '#profile'],
            ['hero_btn_secondary_text', 'Sampaikan Pertanyaan'],
            ['hero_btn_secondary_url', '#contact'],
            ['spmb_url', ''],

            // Hero stats (JSON) — kosong, diisi operator dengan data riil
            ['hero_stats', json_encode([])],

            // Principal (JSON)
            ['principal', json_encode([
                'name' => 'Dr. Sari Wijaya, M.Pd.',
                'photo' => '/images/default-principal.jpg',
                'role_title' => 'Kepala Sekolah',
                'welcome_message' => 'Assalamu\'alaikum. Selamat datang di SekolahKu. Kami berharap situs ini membantu Bapak/Ibu mengenal madrasah kami lebih dekat: programnya, gurunya, dan kegiatannya. Mari bersama menemani tumbuh kembang putra-putri kita.',
                'education' => 'S3 Pendidikan',
                'years_of_service' => '10 Thn Mengabdi',
            ])],

            // About (JSON)
            ['about', json_encode([
                'image' => 'https://placehold.co/600x400/0c4a6e/ffffff?text=SekolahKu',
                'content_title' => 'Belajar dengan Hati, Tumbuh dengan Iman',
                'content_1' => 'SekolahKu adalah madrasah yang menempatkan akhlak dan ilmu berjalan bersama. Anak-anak belajar dalam suasana hangat, dekat dengan guru, dan dekat dengan nilai-nilai agama.',
                'content_2' => 'Kami percaya setiap anak membawa potensinya sendiri. Tugas kami merawatnya: menguatkan landasan iman, membuka wawasan ilmu, dan menemani langkahnya satu per satu.',
                'accreditation' => '',
                'accreditation_label' => 'Standar Nasional',
                'highlights' => ['Kurikulum Merdeka', 'Lab & Perpustakaan Digital'],
            ])],

            // Section settings (JSON)
            ['section_settings', json_encode([
                'hero' => ['title' => 'Selamat Datang di SekolahKu', 'subtitle' => 'Madrasah untuk buah hati Anda', 'icon' => 'fa-school', 'show' => true],
                'profile' => ['title' => 'Profil Sekolah', 'subtitle' => 'Visi, misi, dan cara kami mendidik', 'icon' => 'fa-building-columns', 'show' => true],
                'programs' => ['title' => 'Program Unggulan', 'subtitle' => 'Apa yang anak Anda dapatkan di sini', 'icon' => 'fa-seedling', 'show' => true],
                'extracurriculars' => ['title' => 'Ekstrakurikuler', 'subtitle' => 'Minat dan bakat anak dirawat di luar jam pelajaran', 'icon' => 'fa-futbol', 'show' => true],
                'teachers' => ['title' => 'Tenaga Pengajar', 'subtitle' => 'Guru-guru yang menemani anak Anda setiap hari', 'desc' => 'Dibimbing guru profesional yang mengajar dengan hati', 'icon' => 'fa-chalkboard-user', 'show' => true],
                'achievements' => ['title' => 'Prestasi Siswa', 'subtitle' => 'Kebanggaan yang diraih bersama', 'desc' => 'Prestasi anak-anak di berbagai bidang dan tingkatan', 'icon' => 'fa-trophy', 'show' => true],
                'testimonials' => ['title' => 'Testimoni', 'subtitle' => 'Apa kata orang tua dan alumni', 'icon' => 'fa-comment', 'show' => true],
                'news' => ['title' => 'Berita & Artikel', 'subtitle' => 'Kabar terbaru dari madrasah', 'desc' => 'Dokumentasi kegiatan dan kabar terkini dari madrasah', 'icon' => 'fa-newspaper', 'show' => true],
                'events' => ['title' => 'Agenda & Kegiatan', 'subtitle' => 'Catat tanggalnya, Bapak/Ibu', 'desc' => 'Jadwal kegiatan dan acara mendatang di madrasah', 'icon' => 'fa-calendar-days', 'show' => true],
                'gallery' => ['title' => 'Galeri', 'subtitle' => 'Lihat suasana kegiatan anak-anak', 'desc' => 'Momen belajar anak-anak terekam di sini', 'icon' => 'fa-images', 'show' => true],
                'faq' => ['title' => 'FAQ', 'subtitle' => 'Pertanyaan yang sering diajukan orang tua', 'desc' => 'Jawaban atas pertanyaan yang paling sering ditanyakan', 'icon' => 'fa-circle-question', 'show' => true],
                'downloads' => ['title' => 'Download Center', 'subtitle' => 'Unduh berkas penting: akademik, kurikulum, administrasi', 'icon' => 'fa-download', 'show' => true],
                'contact' => ['title' => 'Kontak Kami', 'subtitle' => 'Ada pertanyaan? Kami siap membantu', 'icon' => 'fa-address-card', 'show' => true],
            ])],

            // Page banners (JSON)
            ['page_banners', json_encode([
                'news' => ['badge' => 'Berita & Artikel', 'title' => 'Baca Berita Terbaru', 'subtitle' => 'Informasi terkini seputar kegiatan dan prestasi di lingkungan SekolahKu'],
                'single_post' => ['badge' => 'Detail Berita', 'title' => 'Baca Berita', 'subtitle' => 'Informasi lengkap seputar kegiatan dan prestasi di lingkungan SekolahKu'],
                'pages' => ['badge' => 'Halaman', 'title' => 'Baca Halaman', 'subtitle' => 'Informasi lengkap seputar halaman ini'],
                'downloads' => ['badge' => 'Download Center', 'title' => 'Pusat Unduhan', 'subtitle' => 'Unduh berkas-berkas penting seputar akademik, kurikulum, dan administrasi sekolah'],
            ])],

            // Footer
            ['footer_description', 'Situs resmi SekolahKu. Informasi program, guru, kegiatan, dan pendaftaran untuk Bapak/Ibu orang tua.'],
            ['footer_copyright', 'All rights reserved.'],
            ['footer_services', json_encode([
                ['label' => 'Sains & Teknologi', 'url' => '#programs'],
                ['label' => 'Seni & Budaya', 'url' => '#programs'],
                ['label' => 'Olahraga', 'url' => '#programs'],
                ['label' => 'Bahasa Asing', 'url' => '#programs'],
                ['label' => 'Digital Literacy', 'url' => '#programs'],
            ])],
            ['footer_links', json_encode([
                ['label' => 'SPMB Online', 'url' => '#'],
                ['label' => 'E-Learning', 'url' => '#'],
                ['label' => 'Perpustakaan', 'url' => '#'],
                ['label' => 'FAQ', 'url' => '#faq'],
                ['label' => 'Pengaduan', 'url' => '#'],
            ])],

            // Theme
            ['theme_color', 'default'],

            // Counter stats (JSON) — kosong, diisi operator dengan data riil
            ['counter_stats', json_encode([])],
        ];

        $this->db->table('settings')->insertBatch(
            array_map(fn($s) => ['key' => $s[0], 'value' => $s[1]], $settings)
        );
    }
}
