<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder produksi: hanya data wajib (admin + pengaturan dasar).
 * Jalankan: php spark db:seed ProductionSeeder
 *
 * PENTING: password default administrator adalah "12345" (dari UserSeeder).
 * WAJIB diganti segera setelah login pertama di menu Profil.
 */
class ProductionSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\UserSeeder');
        $this->call('App\Database\Seeds\SettingSeeder');
        $this->call('App\Database\Seeds\MenuSeeder');
    }
}
