<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Drs. Eko Adi Sarwoko, M.Kom.', 'email' => 'eko.sarwoko@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Priyo Sidik Sasongko, S.Si., M.Kom.', 'email' => 'priyo.sasongko@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dr. Aris Sugiharto, S.Si., M.Kom.', 'email' => 'aris.sugiharto@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Beta Noranita, S.Si, M.Kom', 'email' => 'beta.noranita@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dr. Aris Puji Widodo, S.Si, M.T', 'email' => 'aris.widodo@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dinar Mutiara K N, S.T., M.InfoTech.(Comp)., Ph.D.', 'email' => 'dinar.k@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Sukmawati Nur Endah, S.Si, M.Kom', 'email' => 'sukmawati.endah@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Helmie Arif Wibawa, S.Si, M.Cs', 'email' => 'helmie.wibawa@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Indra Waspada, ST, M.T.I', 'email' => 'indra.waspada@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Sutikno, ST, M.Cs', 'email' => 'sutikno@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Nurdin Bahtiar, S.Si, M.T', 'email' => 'nurdin.bahtiar@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Edy Suharto, S.T., M.Kom.', 'email' => 'edy.suharto@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Ragil Saputra, S.Si, M.Cs', 'email' => 'ragil.saputra@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dr. Retno Kusumaningrum, S.Si, M.Kom', 'email' => 'retno.kusumaningrum@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Panji Wisnu Wirawan, S.T., M.T.', 'email' => 'panji.wirawan@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dr. Eng. Adi Wibowo, S.Si, M.Kom', 'email' => 'adi.wibowo@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Satriyo Adhy, S.Si, M.T', 'email' => 'satriyo.adhy@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Khadijah, S.Kom, M.Cs', 'email' => 'khadijah@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Rismiyati, B.Eng, M.Cs', 'email' => 'rismiyati@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Fajar Agung Nugroho, S.Kom., M.Cs.', 'email' => 'fajar.nugroho@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Prajanto Wahyu Adi, M.Kom.', 'email' => 'prajanto.adi@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Muhammad Malik Hakim, S.T., M.T.I.', 'email' => 'malik.hakim@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Guruh Aryotejo, S.Kom., M.Sc.', 'email' => 'guruh.aryotejo@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Adhe Setya Pramayoga, S.Kom., M.T.', 'email' => 'adhe.pramayoga@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Sandy Kurniawan, S.Kom., M.kom', 'email' => 'sandy.kurniawan@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Drs. Slamet Subekti, M.Hum.', 'email' => 'slamet.subekti@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dra. Endang Kumaidah, M.Kes.', 'email' => 'endang.kumaidah@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Dra. R.A.J. Atrinawati, M.Hum', 'email' => 'atrinawati@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Prof. Dr. Dra. Sunarsih, M.Si.', 'email' => 'sunarsih@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Solikhin, S.Si., M.Sc.', 'email' => 'solikhin@lecturer.undip.ac.id', 'password' => Hash::make('root')],
            ['name' => 'Budi, S.Kom.', 'email' => 'budi@staff.undip.ac.id', 'password' => Hash::make('root')],
        ];

        DB::table('tb_user')->insert($users);

        // $mahasiswa = [
        //     ['24060122120004', 'ABISATYA HASTARANGGA PRADANA'],
        //     ['24060122140138', 'ADZKIYA QARINA SALSABILA'],
        //     ['24060122130088', 'AHLIS DINAL BAHTIAR'],
        //     ['24060122140118', 'ARYA AJISADDA HARYANTO'],
        //     ['24060122130097', 'AURA ARFANNISA AZ ZAHRA'],
        //     ['24060122130054', 'AYYUB AL ANSHOR'],
        //     ['24060122130076', 'AZZAM SAEFUDIN ROSYIDI'],
        //     ['24060122130073', 'BARON ALBANA ACHMAD'],
        //     ['24060122140140', 'DAFFA ALY MEGANENDRA'],
        //     ['24060122130074', 'DAVID NUGROHO'],
        //     ['24060122140149', 'DEMINA AYUNDA CHESARA'],
        //     ['24060122120024', 'ELSA ROSHANA R HUTAGALUNG'],
        //     ['24060122140171', 'FIKRI AZKA PRADYA'],
        //     ['24060122120019', 'GHIRSAN AHDANI'],
        //     ['24060122120023', 'HAPPY DESITA WIDYANTARI'],
        //     ['24060122130062', 'HELGA NURUL BHAITI'],
        //     ['24060122140130', 'ILHAM AZRINARGANA PULUNGAN'],
        //     ['24060122140159', 'M DIMAS SAPUTRA'],
        //     ['24060122130056', 'M YAQUTA HUSNA'],
        //     ['24060122120029', 'MAULIDA APRILLIA CINTA ARIYATIN'],
        //     ['24060122130085', 'MEYTA RIZKI KHAIRUNISA'],
        //     ['24060122130051', 'MIRIAM STEFANI ABIGAIL HUTAPEA'],
        //     ['24060122140103', 'MUFLIH MUHAMMAD IMADUDDIN'],
        //     ['24060122140043', 'MUHAMMAD FARHAN HAFIZ ALKIRAMI'],
        //     ['24060122140115', 'MUHAMMAD FIKRI FIRDAUS'],
        //     ['24060122120010', 'MUHAMMAD LUTHFAN LAZUARDI'],
        //     ['24060122130045', 'MUHAMMAD NAUFAL RIFQI SETIAWAN'],
        //     ['24060122130052', 'MUHAMMAD REYNALDI AKBAR'],
        //     ['24060122140169', 'NABILA BETARI ANJANI'],
        //     ['24060122140172', 'NABILA NAJMA MANIKA'],
        //     ['24060122130093', 'NADIVA AULIA INAYA'],
        //     ['24060122130084', 'NASHWAN ADENAYA'],
        //     ['24060122120011', 'NAUFAL RIZKI SAPUTRA'],
        //     ['24060122120014', 'RACHMAD RIFAI'],
        //     ['24060122140184', 'RADEN RICO DWIANDA'],
        //     ['24060122140128', 'RAHMAN HANIF AJI SAPUTRA'],
        //     ['24060122120013', 'RANIA'],
        //     ['24060122130075', 'REVA YASMIN NAUFALIA'],
        //     ['24060122120017', 'RIZKY FAJAR SATRIYA'],
        //     ['24060122120009', 'ROSA YOHANA SINAGA'],
        //     ['24060122140110', 'SAJID NOUVAL'],
        //     ['24060122130092', 'SAUSAN BERLIANA ARRIZQI'],
        //     ['24060122120028', 'SHERLI ARNINDA'],
        //     ['24060122120037', 'WIDIAWATI SIHALOHO'],
        //     ['24060122140162', 'ZAHRA NISAA FITRIA NUR AFIFAH'],
        // ];

        // foreach ($mahasiswa as $mhs) {
        //     $namaParts = explode(' ', $mhs[1]); // Memecah nama menjadi bagian-bagian
        //     $namaPendek = strtolower($namaParts[0] . '.' . $namaParts[1]); // Menggabungkan nama depan dan nama kedua
        //     User::create([
        //         'name' => $mhs[1],
        //         'email' => $namaPendek . '@students.undip.ac.id', // Format email
        //         'password' => bcrypt('root'), // Password yang di-hash
        //     ]);
        // }
    }
}
