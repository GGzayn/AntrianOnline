<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Opd;
use App\Models\Role;
use App\Models\Layanan;
use App\Models\Loket;
use App\Models\Antrian;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $opd = new Opd;

        $opd->id_opd = '0111';
        $opd->nama_opd = 'Contoh Dinas';
        $opd->nama_kordinator = 'kordinator Dinas';
        $opd->nip_kordinator = '0101010101';
        $opd->jabatan = 'Contoh Jabatan';
        $opd->save();

        $roleAdmin = new Role;
        $roleAdmin->role = 'Super Admin';

        $roleAdmin->save();

        $roleAdminDinas = new Role;
        $roleAdminDinas->role = 'Admin Dinas';

        $roleAdminDinas->save();

        $roleLoket = new Role;
        $roleLoket->role = 'Staff Loket';

        $roleLoket->save();



        $user = new User;
        $user->name = 'Fuad Harmuzain';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('12345qwerty');
        $user->role_id = $roleAdmin->id;
        $user->child_id = 1;

        $user->save();

        $userDinas = new User;
        $userDinas->name = 'Dora';
        $userDinas->email = 'admin_2@gmail.com';
        $userDinas->password = bcrypt('12345qwerty');
        $userDinas->role_id = $roleAdminDinas->id;
        $userDinas->child_id = $opd->id;

        $userDinas->save();


        $layanan = new Layanan;

        $layanan->nama_layanan = 'Layanan 1';
        $layanan->kode_layanan = 'AI';
        $layanan->opd_id = $opd->id;
        $layanan->alamat = 'Alamat Layanan 1';
        $layanan->no_telepon = '02154455444';

        $layanan->save();

        $loket = new Loket;

        $loket->nama_loket = 'Loket 1';
        $loket->layanan_id = $layanan->id;
        $loket->child_id = $roleAdminDinas->id;
        $loket->nama_petugas = 'Petugas 1';
        $loket->interval_waktu = 10;
        $loket->interval_booking = 30;
        $loket->waktu_buka = '08:00:00';
        $loket->waktu_tutup = '15:00:00';
        $loket->status_loket = 0;
        $loket->loket_antrian = 'online';
        $loket->save();


        $antrian = new Antrian;

        $antrian->tanggal_booking = now();
        $antrian->loket_id = $loket->id;
        $antrian->nama = 'Fulanah binti Fulan';
        $antrian->nik = '3173011007860001';
        $antrian->tanggal_antrian = '2021-04-28';
        $antrian->waktu_antrian = '09:00:00';
        $antrian->jenis_antrian = 1;
        $antrian->status_antrian = 1;
        $antrian->no_antrian = '1';

        $antrian->save();
    }
}
