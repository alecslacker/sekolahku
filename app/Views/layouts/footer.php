  <!-- ===== FOOTER ===== -->
  <footer class="footer" role="contentinfo">
    <div class="footer-shape" aria-hidden="true"></div>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="<?= base_url() ?>" class="logo" aria-label="Beranda <?= esc($site_name) ?>">
            <i class="<?= esc($site_logo_icon ?? 'fas fa-graduation-cap') ?>" aria-hidden="true"></i>
            <span><?= esc($site_logo_text ?? $site_name) ?></span>
          </a>
          <p><?= esc($footer_description ?? $site_description ?? $site_tagline) ?></p>
          <div class="footer-social">
            <?php foreach (['Facebook' => [$social_facebook ?? '', 'fab fa-facebook-f'], 'Instagram' => [$social_instagram ?? '', 'fab fa-instagram'], 'YouTube' => [$social_youtube ?? '', 'fab fa-youtube'], 'TikTok' => [$social_tiktok ?? '', 'fab fa-tiktok']] as $sm_name => [$sm_url, $sm_icon]): ?>
            <?php if ($sm_url && $sm_url !== '#'): ?>
            <a href="<?= esc($sm_url) ?>" aria-label="<?= $sm_name ?>"><i class="<?= $sm_icon ?>"></i></a>
            <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="footer-col footer-col-nav">
          <h4>Navigasi</h4>
          <a href="<?= base_url() ?>">Beranda</a>
          <a href="<?= base_url('#profile') ?>">Profil</a>
          <a href="<?= base_url('#programs') ?>">Program</a>
          <a href="<?= base_url('#extracurriculars') ?>">Ekstrakurikuler</a>
          <a href="<?= base_url('#teachers') ?>">Pengajar</a>
          <a href="<?= base_url('#achievements') ?>">Prestasi</a>
          <a href="<?= base_url('#testimonials') ?>">Testimoni</a>
          <a href="<?= base_url('news') ?>">Berita</a>
          <a href="<?= base_url('#events') ?>">Agenda</a>
          <a href="<?= base_url('#gallery') ?>">Galeri</a>
          <a href="<?= base_url('#faq') ?>">FAQ</a>
          <a href="<?= base_url('downloads') ?>">Download</a>
          <a href="<?= base_url('#contact') ?>">Kontak</a>
        </div>
        <?php
        $services = [];
        if(isset($footer_services) && $footer_services) {
          $services = is_string($footer_services) ? json_decode($footer_services, true) : $footer_services;
        }
        $services = array_filter($services, fn($s) => ($s['url'] ?? '#') !== '#' && !empty($s['url']));
        ?>
        <?php if ($services): ?>
        <div class="footer-col">
          <h4>Program</h4>
          <?php foreach($services as $svc): ?>
          <a href="<?= esc($svc['url']) ?>"><?= esc($svc['label'] ?? $svc['name'] ?? 'Link') ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php
        $links = [];
        if(isset($footer_links) && $footer_links) {
          $links = is_string($footer_links) ? json_decode($footer_links, true) : $footer_links;
        }
        $links = array_filter($links, fn($l) => ($l['url'] ?? '#') !== '#' && !empty($l['url']));
        ?>
        <?php if ($links): ?>
        <div class="footer-col">
          <h4>Layanan</h4>
          <?php foreach($links as $lnk): ?>
          <a href="<?= esc($lnk['url']) ?>"><?= esc($lnk['label'] ?? $lnk['name'] ?? 'Link') ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <p>&copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= esc($site_name) ?></a> · <?= esc($footer_copyright ?? 'All rights reserved.') ?><br>
          Design with <span role="img" aria-label="love">❤</span> by <a href="https://kirimpesanwa.my.id/jasapembuatanwebsite" target="_blank" rel="noopener">Duta Corpora Indonesia</a> · Powered by <a href="https://sekolahku.web.id" target="_blank" rel="noopener">CMS Sekolahku</a></p>
      </div>
    </div>
  </footer>

  <!-- ===== BACK TO TOP ===== -->
  <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas" title="Kembali ke atas">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
  </button>

  <!-- ===== LIGHTBOX ===== -->
  <div class="lightbox" id="lightboxModal" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <span class="lightbox-close" role="button" tabindex="0" aria-label="Tutup">&times;</span>
    <img class="lightbox-content" id="modalImage" alt="Pratinjau">
  </div>

  <script defer src="<?= base_url('js/script.min.js') ?>"></script>
<script>
// Refresh CSRF token on cached pages — reads token from cookie
(function(){
  var fields = document.querySelectorAll('[name="csrf_test_name"]');
  if (!fields.length) return;
  var match = document.cookie.match(/(?:^|;\s*)csrf_cookie_name=([^;]*)/);
  if (match) {
    var token = decodeURIComponent(match[1]);
    for (var i = 0; i < fields.length; i++) fields[i].value = token;
  }
})();
</script>
</body>
</html>
