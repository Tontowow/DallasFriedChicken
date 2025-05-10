<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\destinasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Pastikan ini ada!

class DestinasiSeeder extends Seeder
{
    public function run()
    {
        $destinasi = [
            // Kategori Alam
            [
                'nama' => 'Tebing Keraton',
                'deskripsi' => 'Tebing Keraton adalah salah satu tempat wisata paling memukau di Bandung yang menawarkan pemandangan alam yang luar biasa. Dari atas tebing, Anda dapat menikmati panorama hutan belantara yang hijau dan kabut pagi yang menyejukkan. Ini adalah tempat yang sempurna untuk menikmati keindahan alam sambil merasakan ketenangan. Fasilitas di sini sangat lengkap, dengan area parkir yang luas, warung makan yang menyajikan camilan tradisional, serta spot-spot foto yang Instagramable untuk mengabadikan momen spesial Anda. Tak lupa, udara sejuk dan suasana yang menenangkan membuat Tebing Keraton menjadi destinasi yang wajib dikunjungi. Alamat: Jl. Taman Hutan Raya No.1, Ciburial, Kec. Cimenyan, Bandung.',
                'harga' => 20000,
                'kategori' => 'Alam',
                'gambar' => 'tebing_keraton.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Situ Patenggang',
                'deskripsi' => 'Nikmati pesona keindahan alam di Situ Patenggang, sebuah danau alami yang dikelilingi oleh hutan pinus dan pegunungan hijau. Di sini, Anda bisa berkeliling danau menggunakan perahu, menikmati udara segar sambil melihat pemandangan yang luar biasa. Fasilitas yang tersedia meliputi area parkir yang luas, warung makan dengan aneka hidangan lokal, serta area piknik yang nyaman untuk bersantai bersama keluarga dan teman. Tempat ini juga cocok untuk Anda yang ingin menikmati ketenangan dan keindahan alam sambil menikmati keindahan matahari terbenam. Alamat: Jl. Raya Ciwidey, Kec. Rancabali, Bandung.',
                'harga' => 25000,
                'kategori' => 'Alam',
                'gambar' => 'situ_patenggang.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gunung Tangkuban Perahu',
                'deskripsi' => 'Gunung Tangkuban Perahu adalah destinasi wisata yang mempesona dengan kawah vulkaniknya yang aktif. Anda bisa melihat langsung aktivitas alam yang luar biasa sambil menikmati udara sejuk pegunungan. Fasilitas yang ada di sini sangat memadai, mulai dari area parkir yang luas, jalur pendakian untuk para petualang, hingga warung makan yang menawarkan berbagai hidangan lezat. Jangan lewatkan pemandangan spektakuler dari puncak gunung yang memberikan pengalaman tak terlupakan. Alamat: Jl. Raya Tangkuban Perahu, Kec. Cikole, Bandung.',
                'harga' => 50000,
                'kategori' => 'Alam',
                'gambar' => 'tangkuban_perahu.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori Hiburan
            [
                'nama' => 'Trans Studio Bandung',
                'deskripsi' => 'Bersiaplah untuk pengalaman seru dan mendebarkan di Trans Studio Bandung, taman hiburan indoor terbesar di Indonesia! Di sini, Anda bisa menikmati berbagai wahana menarik yang cocok untuk semua usia, mulai dari wahana bertema superhero, petualangan luar angkasa, hingga dunia fantasi yang memukau. Fasilitas lengkap seperti area parkir yang luas, restoran dengan pilihan makanan lezat, dan toko oleh-oleh membuat pengalaman Anda semakin menyenankan. Trans Studio Bandung adalah tempat yang tepat untuk berlibur bersama keluarga atau teman-teman tercinta. Alamat: Jl. Jendral Gatot Subroto No.289, Bandung.',
                'harga' => 250000,
                'kategori' => 'Hiburan',
                'gambar' => 'trans_studio.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dago Dreampark',
                'deskripsi' => 'Dago Dreampark adalah taman wisata yang menyuguhkan berbagai wahana seru dan pemandangan alam yang menakjubkan. Taman ini memiliki berbagai spot foto yang Instagramable, wahana permainan yang menyenangkan, serta area untuk piknik yang nyaman. Jika Anda mencari tempat yang cocok untuk keluarga, Dago Dreampark adalah pilihan yang tepat. Dengan fasilitas lengkap seperti area parkir yang luas, restoran, dan berbagai wahana menarik, Anda pasti akan betah berlama-lama di sini. Alamat: Dago Giri, Cimenyan, Bandung.',
                'harga' => 35000,
                'kategori' => 'Hiburan',
                'gambar' => 'dago_dreampark.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Farm House Lembang',
                'deskripsi' => 'Farm House Lembang adalah tempat wisata yang unik dengan konsep peternakan Eropa dan rumah-rumah bergaya Eropa yang cantik. Di sini, Anda bisa berkeliling menikmati pemandangan yang indah, bermain dengan hewan ternak, dan berfoto di spot-spot menarik. Fasilitasnya meliputi area parkir, restoran dengan menu khas, dan spot foto yang sempurna untuk Anda yang suka berpose. Tempat ini sangat cocok untuk liburan keluarga dan para pengunjung yang ingin merasakan suasana berbeda di tengah alam. Alamat: Jl. Raya Lembang No.108, Lembang, Bandung.',
                'harga' => 50000,
                'kategori' => 'Hiburan',
                'gambar' => 'farm_house.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori Kuliner
            [
                'nama' => 'Kampung Daun',
                'deskripsi' => 'Kampung Daun bukan hanya sekadar tempat makan, tetapi juga sebuah pengalaman kuliner yang menyatu dengan alam. Restoran ini menawarkan suasana alami dengan udara sejuk dan pemandangan hijau yang menenangkan. Anda dapat menikmati berbagai hidangan tradisional Sunda yang lezat sambil ditemani dengan alunan musik live. Fasilitas yang disediakan sangat memadai, mulai dari tempat makan yang nyaman hingga area parkir yang luas. Jangan lewatkan kesempatan untuk menikmati makan malam romantis di tengah suasana alam yang indah. Alamat: Jl. Sersan Bajuri No.102, Cihideung, Lembang, Bandung.',
                'harga' => 100000,
                'kategori' => 'Kuliner',
                'gambar' => 'kampung_daun.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'The Valley Bistro Café',
                'deskripsi' => 'Nikmati makan malam sambil menikmati pemandangan indah kota Bandung dari ketinggian di The Valley Bistro Café. Restoran ini menawarkan menu internasional yang lezat, dengan suasana yang tenang dan elegan, cocok untuk acara romantis atau pertemuan bisnis. Fasilitas di sini sangat lengkap, dengan area parkir yang luas, tempat makan yang nyaman, dan pemandangan yang luar biasa. Selain itu, Anda juga dapat menikmati berbagai pilihan minuman segar untuk melengkapi hidangan Anda. Alamat: Jl. Lembah Pakar Timur No.28, Ciburial, Bandung.',
                'harga' => 150000,
                'kategori' => 'Kuliner',
                'gambar' => 'the_valley.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Saung Angklung Udjo',
                'deskripsi' => 'Saung Angklung Udjo bukan hanya tempat kuliner, tetapi juga pusat kebudayaan yang mengangkat seni angklung sebagai daya tarik utamanya. Di sini, Anda dapat menikmati hidangan lezat sambil menyaksikan pertunjukan angklung yang mengagumkan. Fasilitas yang tersedia termasuk restoran dengan berbagai hidangan tradisional, tempat pertunjukan seni, dan area parkir yang luas. Saung Angklung Udjo adalah tempat yang tepat untuk merasakan kehangatan budaya Sunda sambil menikmati kuliner khasnya. Alamat: Jl. Padasuka No.118, Cicalengka, Bandung.',
                'harga' => 20000,
                'kategori' => 'Kuliner',
                'gambar' => 'saung_angklung.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($destinasi as $data) {
            Destinasi::create($data);
        }
    }
}
