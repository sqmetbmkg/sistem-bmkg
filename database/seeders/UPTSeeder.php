<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UPTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "wmo_id" => 96043,
                "nama_stasiun" => "Stasiun Meteorologi Silangit",
                "nama_balai" => "BBMKG Wilayah I",
                "provinsi" => "Sumatera Utara",
                "longitude" => 98.99357,
                "latitude" => 2.26136,
                "elevation_mdpl" => 1420
            ],
            [
                "wmo_id" => 96087,
                "nama_stasiun" => "Stasiun Meteorologi Hang Nadim",
                "nama_balai" => "BBMKG Wilayah I",
                "provinsi" => "Kepulauan Riau",
                "longitude" => 104.11667,
                "latitude" => 1.11667,
                "elevation_mdpl" => 26
            ],
            [
                "wmo_id" => 96161,
                "nama_stasiun" => "Stasiun Meteorologi Maritim Teluk Bayur",
                "nama_balai" => "BBMKG Wilayah I",
                "provinsi" => "Sumatera Barat",
                "longitude" => 100.37222,
                "latitude" => -0.99639,
                "elevation_mdpl" => 2
            ],
            [
                "wmo_id" => 96253,
                "nama_stasiun" => "Stasiun Meteorologi Fatmawati Soekarno",
                "nama_balai" => "BBMKG Wilayah II",
                "provinsi" => "Bengkulu",
                "longitude" => 102.3367,
                "latitude" => -3.8582,
                "elevation_mdpl" => 920
            ],
            [
                "wmo_id" => 96751,
                "nama_stasiun" => "Stasiun Meteorologi Citeko",
                "nama_balai" => "BBMKG Wilayah II",
                "provinsi" => "Jawa Barat",
                "longitude" => 106.85,
                "latitude" => -6.7,
                "elevation_mdpl" => 24
            ],
            [
                "wmo_id" => 96741,
                "nama_stasiun" => "Stasiun Meteorologi Maritim Tanjung Priok",
                "nama_balai" => "BBMKG Wilayah II",
                "provinsi" => "DKI Jakarta",
                "longitude" => 106.8805694,
                "latitude" => -6.1077608,
                "elevation_mdpl" => 3
            ],
            [
                "wmo_id" => 97284,
                "nama_stasiun" => "Stasiun Meteorologi Frans Sales Lega",
                "nama_balai" => "BBMKG Wilayah III",
                "provinsi" => "Nusa Tenggara Timur",
                "longitude" => 120.45,
                "latitude" => -8.63,
                "elevation_mdpl" => 1070
            ],
            [
                "wmo_id" => 96685,
                "nama_stasiun" => "Stasiun Meteorologi Syamsudin Noor",
                "nama_balai" => "BBMKG Wilayah III",
                "provinsi" => "Kalimantan Selatan",
                "longitude" => 114.754,
                "latitude" => -3.442,
                "elevation_mdpl" => 32
            ],
            [
                "wmo_id" => 96585,
                "nama_stasiun" => "Stasiun Meteorologi Maritim Tanjung Perak",
                "nama_balai" => "BBMKG Wilayah III",
                "provinsi" => "Jawa Timur",
                "longitude" => 112.7353,
                "latitude" => -7.0253,
                "elevation_mdpl" => 3
            ],
            [
                "wmo_id" => 97124,
                "nama_stasiun" => "Stasiun Meteorologi Pongtiku",
                "nama_balai" => "BBMKG Wilayah IV",
                "provinsi" => "Sulawesi Selatan",
                "longitude" => 119.81885,
                "latitude" => -3.04524,
                "elevation_mdpl" => 829
            ],
            [
                "wmo_id" => 97120,
                "nama_stasiun" => "Stasiun Meteorologi Majene",
                "nama_balai" => "BBMKG Wilayah IV",
                "provinsi" => "Sulawesi Barat",
                "longitude" => 118.98054,
                "latitude" => -3.55074,
                "elevation_mdpl" => 29
            ],
            [
                "wmo_id" => 97730,
                "nama_stasiun" => "Stasiun Meteorologi Ambon",
                "nama_balai" => "BBMKG Wilayah IV",
                "provinsi" => "Maluku",
                "longitude" => 128.10075,
                "latitude" => -3.79053,
                "elevation_mdpl" => 3
            ],
            [
                "wmo_id" => 97686,
                "nama_stasiun" => "Stasiun Meteorologi Wamena Jaya Wijaya",
                "nama_balai" => "BBMKG Wilayah V",
                "provinsi" => "Papua",
                "longitude" => 138.95,
                "latitude" => -4.07,
                "elevation_mdpl" => 1653
            ],
            [
                "wmo_id" => 97796,
                "nama_stasiun" => "Stasiun Meteorologi Mozez Kilangin",
                "nama_balai" => "BBMKG Wilayah V",
                "provinsi" => "Papua",
                "longitude" => 136.89348,
                "latitude" => -4.53006,
                "elevation_mdpl" => 30
            ],
            [
                "wmo_id" => 97560,
                "nama_stasiun" => "Stasiun Meteorologi Frans Kaisiepo",
                "nama_balai" => "BBMKG Wilayah V",
                "provinsi" => "Papua",
                "longitude" => 136.10361,
                "latitude" => -1.19069,
                "elevation_mdpl" => 3
            ]
        ];

        DB::table('stasiun')->insert($data);
    }
}