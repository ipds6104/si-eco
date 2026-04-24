<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan tabel users dengan truncate agar ID reset
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $filePath = database_path('seeders/data/users.json');

        if (!File::exists($filePath)) {
            $this->command->error("File users.json tidak ditemukan.");
            return;
        }

        $jsonData = File::get($filePath);
        $userList = json_decode($jsonData, true);

        if ($userList === null) {
            $this->command->error("Gagal decode JSON. Pastikan format JSON valid.");
            return;
        }

        foreach ($userList as $user) {
            $nip = trim($user['nip_lama']);
            
            // Cek apakah NIP ada di tabel pegawai, jika tidak buatkan dummy agar tidak error FK
            $exists = DB::table('pegawai')->where('nip_lama', $nip)->exists();
            if (!$exists) {
                DB::table('pegawai')->insert([
                    'nama' => $user['username'], // gunakan username sebagai nama sementara
                    'nip_lama' => $nip,
                    'nip_baru' => $nip,
                    'jabatan' => 'Lainnya',
                    'golongan_akhir' => '-',
                    'pendidikan' => '-',
                    'jenis_kelamin' => 'LK',
                    'email' => trim($user['email']),
                ]);
            }

            // Ambil bagian depan email sebagai password default
            $emailParts = explode('@', trim($user['email']));
            $defaultPassword = $emailParts[0] ?? 'password123';

            User::create([
                'id'        => $user['id'],
                'nip_lama'  => $nip,
                'username'  => trim($user['username']),
                'password'  => bcrypt($defaultPassword),
                'email'     => trim($user['email']),
                'id_role'   => $user['id_role'],
                'tim_id'    => $user['tim_id'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Data users berhasil diimpor dari JSON.");
    }
}
