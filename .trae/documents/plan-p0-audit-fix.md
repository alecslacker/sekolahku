# IMPLEMENTATION PLAN: P0 Audit Fix — Hard Gate Sekolahku

Overview: Perbaikan 6 kelompok temuan HIGH dari audit-ai-slop.md: focus-visible, title duplikat, fallback angka fabrikasi, dead link "#", tap target mobile, default seeder jujur. Rebrand footer sudah selesai (commit terpisah nanti).
Context7 Pre-Check: tidak ada library eksternal baru (CSS murni + PHP native views) — tidak perlu.
Skill yang digunakan: writing-plans (plan ini), antislop* (sudah termuat — acuran R-17/R-24/R-26/R-32/R-03), verification via Playwright MCP.

Tasks:
1. Focus-visible global — Files: public/css/style.css — Complexity: Low
2. Title duplikat & separator — Files: layouts/header.php, Controllers/{Home,News,Contact,Downloads}.php — Complexity: Low
3. Fallback angka hardcoded + empty state — Files: pages/home.php, public/css/style.css — Complexity: Medium
4. Guard dead link "#" — Files: layouts/header.php, layouts/footer.php, app/Helpers/menu_helper.php (cek) — Complexity: Medium
5. Tap target 44px — Files: public/css/style.css (blok @media mobile) — Complexity: Low
6. Default seeder jujur — Files: app/Database/Seeds/SettingSeeder.php + UPDATE DB lokal — Complexity: Low
Risiko: style.min.css harus di-regenerate (php minify.php atau salin manual) — cek skrip minify. GetDiagnostics tiap selesai file PHP. Verifikasi akhir: Playwright (focus test, title, screenshot diff).

RULE penting: file CSS publik yang dipakai = style.min.css (lihat header.php baris 27). Semua edit CSS harus di style.css LALU di-minify ulang, atau edit juga dipatch ke .min.
