<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@dioreal.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
                'permissions' => ['hotels', 'restaurants', 'yachts', 'guides', 'events', 'journals', 'settings', 'users', 'destinations'],
            ]
        );

        // Seed General Settings
        Setting::set('contact_email', 'info@diorealdijital.com');
        Setting::set('contact_phone', '+90 212 555 0100');
        Setting::set('contact_address_tr', 'İstanbul, Türkiye');
        Setting::set('contact_address_en', 'Istanbul, Turkey');
        Setting::set('instagram', 'https://instagram.com');
        Setting::set('linkedin', 'https://linkedin.com');
        Setting::set('whatsapp', '905449157011');
        Setting::set('footer_copy', '© 2026 Dioreal Dijital. All Rights Reserved.');
        Setting::set('hero_title_tr', "Türkiye ve dünyada seçkin\ndeneyimlerin kapısını aralıyoruz.");
        Setting::set('hero_title_en', "Opening doors to exclusive\nexperiences globally.");

        // SVG Logo Generator Helper for Brands Seeding
        $svgLogo = function ($text, $font, $style, $size) {
            return "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 60'><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-family='{$font}' font-size='{$size}' font-style='{$style}' fill='%2394a3b8'>{$text}</text></svg>";
        };

        $defaultBrands = [
            ['name' => 'Nautical', 'img' => $svgLogo('Nautical', 'serif', '', 24)],
            ['name' => 'PERDUE', 'img' => $svgLogo('PERDUE', 'sans-serif', '', 28)],
            ['name' => 'Kassandra', 'img' => $svgLogo('Kassandra', 'serif', 'italic', 22)],
            ['name' => 'ZAKROS', 'img' => $svgLogo('ZAKROS', 'sans-serif', '', 26)],
            ['name' => 'HUAWEI', 'img' => $svgLogo('HUAWEI', 'sans-serif', '', 26)],
            ['name' => 'SONY', 'img' => $svgLogo('SONY', 'sans-serif', '', 26)],
            ['name' => 'oppo', 'img' => $svgLogo('oppo', 'sans-serif', '', 26)],
            ['name' => 'CapCut', 'img' => $svgLogo('CapCut', 'sans-serif', '', 22)],
            ['name' => 'Hus Wines', 'img' => $svgLogo('Hus Wines', 'serif', 'italic', 24)],
            ['name' => 'RUPS', 'img' => $svgLogo('RUPS', 'sans-serif', '', 22)],
            ['name' => 'Despot Evi', 'img' => $svgLogo('Despot Evi', 'serif', '', 20)],
            ['name' => 'BLUE VOYAGE', 'img' => $svgLogo('BLUE VOYAGE', 'sans-serif', '', 20)],
        ];

        Setting::set('brands', $defaultBrands);

        // Run resource content import
        $this->call(JsonToDbSeeder::class);
        $this->call(DestinationSeeder::class);
    }
}
