<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * File upload helper.
     */
    protected function handleFileUpload($file, $folder = 'uploads/brands')
    {
        $destinationPath = public_path($folder);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $folder . '/' . $filename;
    }

    /**
     * Show general settings page.
     */
    public function index()
    {
        $settings = [];
        foreach (Setting::all() as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update general text settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:100',
            'contact_address_tr' => 'nullable|string|max:500',
            'contact_address_en' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'footer_copy' => 'nullable|string|max:255',
            'hero_title_tr' => 'nullable|string|max:500',
            'hero_title_en' => 'nullable|string|max:500',

            // Homepage selection (Manifesto)
            'man_eyebrow_tr' => 'nullable|string|max:255',
            'man_eyebrow_en' => 'nullable|string|max:255',
            'man_p1_tr' => 'nullable|string|max:1000',
            'man_p1_en' => 'nullable|string|max:1000',

            // Trends
            'trend_otel_title_tr' => 'nullable|string|max:255',
            'trend_otel_title_en' => 'nullable|string|max:255',
            'trend_otel_desc_tr' => 'nullable|string|max:500',
            'trend_otel_desc_en' => 'nullable|string|max:500',

            'trend_rest_title_tr' => 'nullable|string|max:255',
            'trend_rest_title_en' => 'nullable|string|max:255',
            'trend_rest_desc_tr' => 'nullable|string|max:500',
            'trend_rest_desc_en' => 'nullable|string|max:500',

            'trend_yat_title_tr' => 'nullable|string|max:255',
            'trend_yat_title_en' => 'nullable|string|max:255',
            'trend_yat_desc_tr' => 'nullable|string|max:500',
            'trend_yat_desc_en' => 'nullable|string|max:500',

            'trend_beach_title_tr' => 'nullable|string|max:255',
            'trend_beach_title_en' => 'nullable|string|max:255',
            'trend_beach_desc_tr' => 'nullable|string|max:500',
            'trend_beach_desc_en' => 'nullable|string|max:500',

            // About page fields
            'about_hero_eyebrow_tr' => 'nullable|string|max:255',
            'about_hero_eyebrow_en' => 'nullable|string|max:255',
            'about_hero_title_tr' => 'nullable|string|max:255',
            'about_hero_title_en' => 'nullable|string|max:255',

            'about_story_eyebrow_tr' => 'nullable|string|max:255',
            'about_story_eyebrow_en' => 'nullable|string|max:255',
            'about_story_title_tr' => 'nullable|string|max:255',
            'about_story_title_en' => 'nullable|string|max:255',
            'about_story_p1_tr' => 'nullable|string|max:1000',
            'about_story_p1_en' => 'nullable|string|max:1000',
            'about_story_p2_tr' => 'nullable|string|max:1000',
            'about_story_p2_en' => 'nullable|string|max:1000',

            'about_stats_title_tr' => 'nullable|string|max:255',
            'about_stats_title_en' => 'nullable|string|max:255',

            'about_stat1_num' => 'nullable|string|max:50',
            'about_stat1_label_tr' => 'nullable|string|max:255',
            'about_stat1_label_en' => 'nullable|string|max:255',

            'about_stat2_num' => 'nullable|string|max:50',
            'about_stat2_label_tr' => 'nullable|string|max:255',
            'about_stat2_label_en' => 'nullable|string|max:255',

            'about_stat3_num' => 'nullable|string|max:50',
            'about_stat3_label_tr' => 'nullable|string|max:255',
            'about_stat3_label_en' => 'nullable|string|max:255',

            'about_stat4_num' => 'nullable|string|max:50',
            'about_stat4_label_tr' => 'nullable|string|max:255',
            'about_stat4_label_en' => 'nullable|string|max:255',

            'about_mission_eyebrow_tr' => 'nullable|string|max:255',
            'about_mission_eyebrow_en' => 'nullable|string|max:255',
            'about_mission_title_tr' => 'nullable|string|max:255',
            'about_mission_title_en' => 'nullable|string|max:255',
            'about_mission_p1_tr' => 'nullable|string|max:1000',
            'about_mission_p1_en' => 'nullable|string|max:1000',
            'about_mission_p2_tr' => 'nullable|string|max:1000',
            'about_mission_p2_en' => 'nullable|string|max:1000',

            // Image uploads
            'hero_slide_1' => 'nullable|image|max:5120',
            'hero_slide_2' => 'nullable|image|max:5120',
            'hero_slide_3' => 'nullable|image|max:5120',
            'trend_otel_img' => 'nullable|image|max:5120',
            'trend_rest_img' => 'nullable|image|max:5120',
            'trend_yat_img' => 'nullable|image|max:5120',
            'trend_beach_img' => 'nullable|image|max:5120',
            'about_hero_img' => 'nullable|image|max:5120',
            'about_story_img' => 'nullable|image|max:5120',
            'about_mission_img' => 'nullable|image|max:5120',
        ]);

        $fields = [
            'contact_email',
            'contact_phone',
            'contact_address_tr',
            'contact_address_en',
            'instagram',
            'linkedin',
            'whatsapp',
            'footer_copy',
            'hero_title_tr',
            'hero_title_en',

            'man_eyebrow_tr',
            'man_eyebrow_en',
            'man_p1_tr',
            'man_p1_en',

            'trend_otel_title_tr',
            'trend_otel_title_en',
            'trend_otel_desc_tr',
            'trend_otel_desc_en',

            'trend_rest_title_tr',
            'trend_rest_title_en',
            'trend_rest_desc_tr',
            'trend_rest_desc_en',

            'trend_yat_title_tr',
            'trend_yat_title_en',
            'trend_yat_desc_tr',
            'trend_yat_desc_en',

            'trend_beach_title_tr',
            'trend_beach_title_en',
            'trend_beach_desc_tr',
            'trend_beach_desc_en',

            'about_hero_eyebrow_tr',
            'about_hero_eyebrow_en',
            'about_hero_title_tr',
            'about_hero_title_en',

            'about_story_eyebrow_tr',
            'about_story_eyebrow_en',
            'about_story_title_tr',
            'about_story_title_en',
            'about_story_p1_tr',
            'about_story_p1_en',
            'about_story_p2_tr',
            'about_story_p2_en',

            'about_stats_title_tr',
            'about_stats_title_en',

            'about_stat1_num',
            'about_stat1_label_tr',
            'about_stat1_label_en',

            'about_stat2_num',
            'about_stat2_label_tr',
            'about_stat2_label_en',

            'about_stat3_num',
            'about_stat3_label_tr',
            'about_stat3_label_en',

            'about_stat4_num',
            'about_stat4_label_tr',
            'about_stat4_label_en',

            'about_mission_eyebrow_tr',
            'about_mission_eyebrow_en',
            'about_mission_title_tr',
            'about_mission_title_en',
            'about_mission_p1_tr',
            'about_mission_p1_en',
            'about_mission_p2_tr',
            'about_mission_p2_en',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field));
        }

        // Image uploads
        $imageFields = [
            'hero_slide_1',
            'hero_slide_2',
            'hero_slide_3',
            'trend_otel_img',
            'trend_rest_img',
            'trend_yat_img',
            'trend_beach_img',
            'about_hero_img',
            'about_story_img',
            'about_mission_img',
        ];

        foreach ($imageFields as $imgField) {
            if ($request->hasFile($imgField)) {
                // Delete old file if exists
                $oldPath = Setting::get($imgField);
                if ($oldPath && !str_starts_with($oldPath, 'foto.img/')) {
                    $oldFilePath = public_path($oldPath);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }
                
                $path = $this->handleFileUpload($request->file($imgField), 'uploads/settings');
                Setting::set($imgField, $path);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Genel ayarlar başarıyla güncellendi.');
    }

    /**
     * Add a brand reference with uploaded logo.
     */
    public function addBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_logo' => 'required|image|max:2048',
        ]);

        $brands = Setting::get('brands', []);
        if (!is_array($brands)) {
            $brands = [];
        }

        $logoPath = $this->handleFileUpload($request->file('brand_logo'));

        $brands[] = [
            'name' => $request->input('brand_name'),
            'img' => $logoPath,
        ];

        Setting::set('brands', $brands);

        return redirect()->route('admin.settings.index')->with('success', 'Marka referansı başarıyla eklendi.');
    }

    /**
     * Delete a brand reference.
     */
    public function deleteBrand(int $index)
    {
        $brands = Setting::get('brands', []);
        if (is_array($brands) && isset($brands[$index])) {
            $brand = $brands[$index];
            
            // Delete file if it's physically stored and not a seeded data SVG URL
            if (isset($brand['img']) && !str_starts_with($brand['img'], 'data:')) {
                $filePath = public_path($brand['img']);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            unset($brands[$index]);
            // Reset numerical array keys to avoid associative array serialization
            $brands = array_values($brands);
            Setting::set('brands', $brands);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Marka referansı başarıyla silindi.');
    }
}
