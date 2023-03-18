<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Universidad',
            'lastname' => 'VIU',
            'DNI' => '11111112L',
            'email' => 'seguridadweb@campusviu.es',
            'password' => '$2y$10$Eth.78ieIFUxhPGkgoGp2u.DLSy8MgDvOpCHdyNXt/6Mu1qT3o.ui',
            'IBAN' => '00000000'
        ]);
    }
}
