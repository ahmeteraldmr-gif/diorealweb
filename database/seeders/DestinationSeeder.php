<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            // Türkiye'nin Ruhu (turkiye)
            [
                'name' => ['tr' => 'İstanbul', 'en' => 'Istanbul'],
                'region' => ['tr' => 'Metropol', 'en' => 'Metropolis'],
                'img' => 'foto.img/istanbul.jpg',
                'type' => 'turkiye',
                'order' => 1,
            ],
            [
                'name' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
                'region' => ['tr' => 'Luxury & Beach', 'en' => 'Luxury & Beach'],
                'img' => 'foto.img/bodrum.jpg',
                'type' => 'turkiye',
                'order' => 2,
            ],
            [
                'name' => ['tr' => 'Fethiye', 'en' => 'Fethiye'],
                'region' => ['tr' => 'Doğa & Yatçılık', 'en' => 'Nature & Yachting'],
                'img' => 'foto.img/fethiye.jpg',
                'type' => 'turkiye',
                'order' => 3,
            ],
            [
                'name' => ['tr' => 'Kapadokya', 'en' => 'Cappadocia'],
                'region' => ['tr' => 'Kültür & Büyü', 'en' => 'Culture & Magic'],
                'img' => 'foto.img/kapadokya.jpg',
                'type' => 'turkiye',
                'order' => 4,
            ],
            [
                'name' => ['tr' => 'Çeşme', 'en' => 'Cesme'],
                'region' => ['tr' => 'Ege Ruhu', 'en' => 'Aegean Spirit'],
                'img' => 'foto.img/cesme.jpg',
                'type' => 'turkiye',
                'order' => 5,
            ],
            [
                'name' => ['tr' => 'Kaş', 'en' => 'Kas'],
                'region' => ['tr' => 'Butik & Yavaş', 'en' => 'Boutique & Slow'],
                'img' => 'foto.img/kas.jpg',
                'type' => 'turkiye',
                'order' => 6,
            ],
            [
                'name' => ['tr' => 'Datça', 'en' => 'Datca'],
                'region' => ['tr' => 'Saf Doğa', 'en' => 'Pure Nature'],
                'img' => 'foto.img/datca.jpg',
                'type' => 'turkiye',
                'order' => 7,
            ],

            // Yolculuğunuza Başlayın - En Popüler (yurtdisi_popular)
            [
                'name' => ['tr' => 'Maldivler', 'en' => 'Maldives'],
                'region' => ['tr' => 'Tropik', 'en' => 'Tropical'],
                'img' => 'foto.img/maldivler.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 1,
            ],
            [
                'name' => ['tr' => 'Japonya', 'en' => 'Japan'],
                'region' => ['tr' => 'Asya & Kültür', 'en' => 'Asia & Culture'],
                'img' => 'foto.img/japonya.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 2,
            ],
            [
                'name' => ['tr' => 'Patagonya', 'en' => 'Patagonia'],
                'region' => ['tr' => 'Vahşi Doğa', 'en' => 'Wild Nature'],
                'img' => 'foto.img/patagonya.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 3,
            ],
            [
                'name' => ['tr' => 'Amalfi Kıyısı', 'en' => 'Amalfi Coast'],
                'region' => ['tr' => 'Akdeniz Rüyası', 'en' => 'Mediterranean Dream'],
                'img' => 'foto.img/amalfi.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 4,
            ],
            [
                'name' => ['tr' => 'Norveç Fiyortları', 'en' => 'Norway Fjords'],
                'region' => ['tr' => 'Kuzey Işıkları', 'en' => 'Northern Lights'],
                'img' => 'foto.img/norvec.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 5,
            ],
            [
                'name' => ['tr' => 'Sahra Çölü', 'en' => 'Sahara Desert'],
                'region' => ['tr' => 'Sonsuzluk', 'en' => 'Infinity'],
                'img' => 'foto.img/sahra.jpg',
                'type' => 'yurtdisi_popular',
                'order' => 6,
            ],

            // Yolculuğunuza Başlayın - Gezgine Göre (yurtdisi_traveller)
            [
                'name' => ['tr' => 'İsviçre Alpleri', 'en' => 'Swiss Alps'],
                'region' => ['tr' => 'Macera & Kar', 'en' => 'Adventure & Snow'],
                'img' => 'foto.img/norvec.jpg',
                'type' => 'yurtdisi_traveller',
                'order' => 1,
            ],
            [
                'name' => ['tr' => 'İzlanda', 'en' => 'Iceland'],
                'region' => ['tr' => 'Ateş & Buz', 'en' => 'Fire & Ice'],
                'img' => 'foto.img/norvec.jpg',
                'type' => 'yurtdisi_traveller',
                'order' => 2,
            ],
            [
                'name' => ['tr' => 'Kosta Rika', 'en' => 'Costa Rica'],
                'region' => ['tr' => 'Eko-Turizm', 'en' => 'Eco-Tourism'],
                'img' => 'foto.img/patagonya.jpg',
                'type' => 'yurtdisi_traveller',
                'order' => 3,
            ],

            // Yolculuğunuza Başlayın - Aya Göre (yurtdisi_month)
            [
                'name' => ['tr' => 'Toskana', 'en' => 'Tuscany'],
                'region' => ['tr' => 'Eylül Hasatı', 'en' => 'September Harvest'],
                'img' => 'foto.img/amalfi.jpg',
                'type' => 'yurtdisi_month',
                'order' => 1,
            ],
            [
                'name' => ['tr' => 'Kyoto', 'en' => 'Kyoto'],
                'region' => ['tr' => 'Nisan Baharı', 'en' => 'April Cherry Blossom'],
                'img' => 'foto.img/japonya.jpg',
                'type' => 'yurtdisi_month',
                'order' => 2,
            ],
            [
                'name' => ['tr' => 'Lapland', 'en' => 'Lapland'],
                'region' => ['tr' => 'Aralık Büyüsü', 'en' => 'December Magic'],
                'img' => 'foto.img/norvec.jpg',
                'type' => 'yurtdisi_month',
                'order' => 3,
            ],

            // Yolculuğunuza Başlayın - Vitrindekiler (yurtdisi_spotlight)
            [
                'name' => ['tr' => 'Seyşeller', 'en' => 'Seychelles'],
                'region' => ['tr' => 'Özel Ada', 'en' => 'Private Island'],
                'img' => 'foto.img/maldivler.jpg',
                'type' => 'yurtdisi_spotlight',
                'order' => 1,
            ],
            [
                'name' => ['tr' => 'Petra Antik Kenti', 'en' => 'Ancient Petra'],
                'region' => ['tr' => 'Dünya Mirası', 'en' => 'World Heritage'],
                'img' => 'foto.img/sahra.jpg',
                'type' => 'yurtdisi_spotlight',
                'order' => 2,
            ],
            [
                'name' => ['tr' => 'Paris', 'en' => 'Paris'],
                'region' => ['tr' => 'Şehir Işıkları', 'en' => 'City of Lights'],
                'img' => 'foto.img/istanbul.jpg',
                'type' => 'yurtdisi_spotlight',
                'order' => 3,
            ],
        ];

        foreach ($destinations as $d) {
            Destination::updateOrCreate(
                ['name->tr' => $d['name']['tr']],
                $d
            );
        }
    }
}
