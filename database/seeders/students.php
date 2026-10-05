<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class students extends Seeder
{
    public function run(): void
    {
        $students = [
            ['absen' => 1, 'nis' => '18332', 'full_name' => 'Alief Saktiawan Prananda'],
            ['absen' => 2, 'nis' => '18333', 'full_name' => 'Arya Saputra Nugraha'],
            ['absen' => 3, 'nis' => '18334', 'full_name' => 'Azka Chirza Saifani Chasan'],
            ['absen' => 4, 'nis' => '18335', 'full_name' => 'Dafa Fadhila Dzikri'],
            ['absen' => 5, 'nis' => '18336', 'full_name' => 'Dafa Muhammad Sulistyo'],
            ['absen' => 6, 'nis' => '18338', 'full_name' => 'Dini Nur Meilia'],
            ['absen' => 7, 'nis' => '18339', 'full_name' => 'Fahrezy Ramadinansya'],
            ['absen' => 8, 'nis' => '18340', 'full_name' => 'Fairuz Adam Rizqulah'],
            ['absen' => 9, 'nis' => '18341', 'full_name' => 'Faiz Ibnu Majid'],
            ['absen' => 10, 'nis' => '18342', 'full_name' => 'Fandy Miftakhul Zanuar'],
            ['absen' => 11, 'nis' => '18343', 'full_name' => 'Fassa Hutama Nurrofiqi'],
            ['absen' => 12, 'nis' => '18344', 'full_name' => 'Hasan Nur Adhi Wibowo'],
            ['absen' => 13, 'nis' => '18345', 'full_name' => 'Hilal Nabiil Mukhtar Prasetya'],
            ['absen' => 14, 'nis' => '18346', 'full_name' => 'Kalus Lintang Pradipta'],
            ['absen' => 15, 'nis' => '18347', 'full_name' => 'Khansa Maysun Zuhayr'],
            ['absen' => 16, 'nis' => '18348', 'full_name' => 'Kusumastuti Endah Retnadi'],
            ['absen' => 17, 'nis' => '18349', 'full_name' => 'Labib Arafat'],
            ['absen' => 18, 'nis' => '18350', 'full_name' => 'Laili Nur Azizah'],
            ['absen' => 19, 'nis' => '18351', 'full_name' => 'Maden Haryo Wicaksono'],
            ['absen' => 20, 'nis' => '18352', 'full_name' => 'Muhammad Aziz Nugroho'],
            ['absen' => 21, 'nis' => '18353', 'full_name' => 'Muhammad Fahmi Muqorrobin'],
            ['absen' => 22, 'nis' => '18354', 'full_name' => 'Muhammad Raditya Aqso Hikmawan'],
            ['absen' => 23, 'nis' => '18355', 'full_name' => 'Muhammad Tsaqif Abdulloh'],
            ['absen' => 24, 'nis' => '18356', 'full_name' => 'Nafiza Bilqis Syarifah'],
            ['absen' => 25, 'nis' => '18357', 'full_name' => 'Paty Helmy Tamami Lamadira'],
            ['absen' => 26, 'nis' => '18358', 'full_name' => 'Resty Budi Lestari'],
            ['absen' => 27, 'nis' => '18359', 'full_name' => 'Rifky Dhafa Putra Triwardhana'],
            ['absen' => 28, 'nis' => '18360', 'full_name' => 'Rifqi Nata Kalbu Shafwan'],
            ['absen' => 29, 'nis' => '18361', 'full_name' => 'Rindra Putra Agustin'],
            ['absen' => 30, 'nis' => '18362', 'full_name' => 'Rishafy Askha Septama'],
            ['absen' => 31, 'nis' => '18363', 'full_name' => 'Sabhinaya Aisha Saraswati'],
            ['absen' => 32, 'nis' => '18364', 'full_name' => 'Syakira Nawa Ayyasy'],
            ['absen' => 33, 'nis' => '18365', 'full_name' => 'Syandana Rezka Josawa'],
            ['absen' => 34, 'nis' => '18366', 'full_name' => 'Winasis Prasojo'],
            ['absen' => 35, 'nis' => '18367', 'full_name' => 'Zakian Akbar Maulana'],
        ];

        foreach ($students as $student) {
            Student::firstOrCreate(['absen' => $student['absen']], $student);
        }
    }
}
