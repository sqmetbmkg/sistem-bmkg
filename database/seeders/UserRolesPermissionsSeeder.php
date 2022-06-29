<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserRolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Role Admin
        $adminRole = Role::create(['name' => 'admin']);

        // Buat Permission Input Threshold
        Permission::create(['name' => 'input threshold']);

        // Buat Permission Input Semua UPT
        Permission::create(['name' => 'input semua UPT']);

        // Buat Permission Tambah Pengguna
        Permission::create(['name' => 'tambah pengguna']);

        // Berikan akses untuk input threshold
        $adminRole->givePermissionTo('input threshold');

        // Berikan akses untuk input semua UPT
        $adminRole->givePermissionTo('input semua UPT');

        // Berikan akses untuk tambah pengguna
        $adminRole->givePermissionTo('tambah pengguna');

        // Buat Admin
        $adminUser = User::factory()->create([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('admin123')
        ]);

        $adminUser->assignRole($adminRole);

        // Buat User
        $file = base_path('database/seeders/akun.csv');
        $csv = $this->csvToArray($file);

        foreach($csv as $data) {
            $user = User::factory()->create([
                'username' => $data[0],
                'name' => $data[1],
                'password' => Hash::make($data[2])
            ]);
        }
    }

    private function csvToArray($csvFile)
    {
        $fileToRead = fopen($csvFile, 'r');
        while (!feof($fileToRead)) {
            $row[] = fgetcsv($fileToRead, 1000, ';');
        }
        fclose($fileToRead);
        return $row;
    }
}
