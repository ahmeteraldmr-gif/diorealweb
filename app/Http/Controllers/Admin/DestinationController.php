<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DestinationController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/destinations')
    {
        $destinationPath = public_path($folder);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        return $folder . '/' . $filename;
    }

    public function index()
    {
        $destinations = Destination::orderBy('type')->orderBy('order')->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $types = [
            'turkiye' => "Türkiye'nin Ruhu",
            'yurtdisi_popular' => 'Yurtdışı - En Popüler',
            'yurtdisi_traveller' => 'Yurtdışı - Gezgine Göre',
            'yurtdisi_month' => 'Yurtdışı - Aya Göre',
            'yurtdisi_spotlight' => 'Yurtdışı - Vitrindekiler',
        ];
        return view('admin.destinations.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
                        'slug_tr' => 'nullable|string|max:255',
            'slug_en' => 'nullable|string|max:255',
            'seo_title_tr' => 'nullable|string|max:255',
            'seo_title_en' => 'nullable|string|max:255',
            'seo_description_tr' => 'nullable|string',
            'seo_description_en' => 'nullable|string',
            'og_image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:10240',
            'seo_noindex' => 'nullable',
            'name.tr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'region.tr' => 'required|string|max:255',
            'region.en' => 'nullable|string|max:255',
            'desc.tr' => 'nullable|string',
            'desc.en' => 'nullable|string',
            'type' => 'required|string|in:turkiye,yurtdisi_popular,yurtdisi_traveller,yurtdisi_month,yurtdisi_spotlight',
            'order' => 'nullable|integer',
            'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'region', 'desc', 'type', 'order', 'video_url']);
        $data['order'] = $data['order'] ?? 0;
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

                
        // Auto-fallback EN fields if empty
        $name = $request->input('name', []);
        if (is_array($name)) {
            if (empty($name['en']) && !empty($name['tr'])) { $name['en'] = $name['tr']; }
            $data['name'] = $name;
        }
        $region = $request->input('region', []);
        if (is_array($region)) {
            if (empty($region['en']) && !empty($region['tr'])) { $region['en'] = $region['tr']; }
            $data['region'] = $region;
        }
        $desc = $request->input('desc', []);
        if (is_array($desc)) {
            if (empty($desc['en']) && !empty($desc['tr'])) { $desc['en'] = $desc['tr']; }
            $data['desc'] = $desc;
        }

        $trMainName = $data['name']['tr'] ?? ($request->input('name.tr') ?? '');
        $enMainName = $data['name']['en'] ?? ($request->input('name.en') ?? $trMainName);
        $trDesc = $data['desc']['tr'] ?? ($request->input('desc.tr') ?? '');
        $enDesc = $data['desc']['en'] ?? ($request->input('desc.en') ?? $trDesc);

        $data['slug_tr'] = $request->filled('slug_tr') ? \Illuminate\Support\Str::slug($request->input('slug_tr')) : \Illuminate\Support\Str::slug($trMainName);
        $data['slug_en'] = $request->filled('slug_en') ? \Illuminate\Support\Str::slug($request->input('slug_en')) : \Illuminate\Support\Str::slug($enMainName);

        $data['seo_title_tr'] = $request->filled('seo_title_tr') ? $request->input('seo_title_tr') : ($trMainName . ' | Dioreal Dijital Lüks Yaşam Platformu');
        $data['seo_title_en'] = $request->filled('seo_title_en') ? $request->input('seo_title_en') : ($enMainName . ' | Dioreal Digital Luxury Platform');

        $data['seo_description_tr'] = $request->filled('seo_description_tr') ? $request->input('seo_description_tr') : \Illuminate\Support\Str::limit(strip_tags($trDesc), 155);
        $data['seo_description_en'] = $request->filled('seo_description_en') ? $request->input('seo_description_en') : \Illuminate\Support\Str::limit(strip_tags($enDesc), 155);

        $data['seo_noindex'] = $request->has('seo_noindex') ? 1 : 0;
        if ($request->hasFile('og_image_file')) {
            $data['og_image'] = $this->handleFileUpload($request->file('og_image_file'), 'uploads/seo');
        }

        // Handle cover image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } else {
            $imgUrl = trim((string)$request->input('img_url'));
            $data['img'] = !empty($imgUrl) ? $imgUrl : 'foto.img/amalfi.jpg';
        }

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $this->handleFileUpload($request->file('video_file'), 'uploads/videos');
        }

        // Handle gallery images
        $gallery = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $gallery[] = $this->handleFileUpload($file);
            }
        }
        $data['gallery'] = $gallery;

        Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasyon başarıyla eklendi.');
    }

    public function edit(Destination $destination)
    {
        $types = [
            'turkiye' => "Türkiye'nin Ruhu",
            'yurtdisi_popular' => 'Yurtdışı - En Popüler',
            'yurtdisi_traveller' => 'Yurtdışı - Gezgine Göre',
            'yurtdisi_month' => 'Yurtdışı - Aya Göre',
            'yurtdisi_spotlight' => 'Yurtdışı - Vitrindekiler',
        ];
        return view('admin.destinations.edit', compact('destination', 'types'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
                        'slug_tr' => 'nullable|string|max:255',
            'slug_en' => 'nullable|string|max:255',
            'seo_title_tr' => 'nullable|string|max:255',
            'seo_title_en' => 'nullable|string|max:255',
            'seo_description_tr' => 'nullable|string',
            'seo_description_en' => 'nullable|string',
            'og_image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:10240',
            'seo_noindex' => 'nullable',
            'name.tr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'region.tr' => 'required|string|max:255',
            'region.en' => 'nullable|string|max:255',
            'desc.tr' => 'nullable|string',
            'desc.en' => 'nullable|string',
            'type' => 'required|string|in:turkiye,yurtdisi_popular,yurtdisi_traveller,yurtdisi_month,yurtdisi_spotlight',
            'order' => 'nullable|integer',
            'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'region', 'desc', 'type', 'order', 'video_url']);
        $data['order'] = $data['order'] ?? 0;
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

                
        // Auto-fallback EN fields if empty
        $name = $request->input('name', []);
        if (is_array($name)) {
            if (empty($name['en']) && !empty($name['tr'])) { $name['en'] = $name['tr']; }
            $data['name'] = $name;
        }
        $region = $request->input('region', []);
        if (is_array($region)) {
            if (empty($region['en']) && !empty($region['tr'])) { $region['en'] = $region['tr']; }
            $data['region'] = $region;
        }
        $desc = $request->input('desc', []);
        if (is_array($desc)) {
            if (empty($desc['en']) && !empty($desc['tr'])) { $desc['en'] = $desc['tr']; }
            $data['desc'] = $desc;
        }

        $trMainName = $data['name']['tr'] ?? ($request->input('name.tr') ?? '');
        $enMainName = $data['name']['en'] ?? ($request->input('name.en') ?? $trMainName);
        $trDesc = $data['desc']['tr'] ?? ($request->input('desc.tr') ?? '');
        $enDesc = $data['desc']['en'] ?? ($request->input('desc.en') ?? $trDesc);

        $data['slug_tr'] = $request->filled('slug_tr') ? \Illuminate\Support\Str::slug($request->input('slug_tr')) : \Illuminate\Support\Str::slug($trMainName);
        $data['slug_en'] = $request->filled('slug_en') ? \Illuminate\Support\Str::slug($request->input('slug_en')) : \Illuminate\Support\Str::slug($enMainName);

        $data['seo_title_tr'] = $request->filled('seo_title_tr') ? $request->input('seo_title_tr') : ($trMainName . ' | Dioreal Dijital Lüks Yaşam Platformu');
        $data['seo_title_en'] = $request->filled('seo_title_en') ? $request->input('seo_title_en') : ($enMainName . ' | Dioreal Digital Luxury Platform');

        $data['seo_description_tr'] = $request->filled('seo_description_tr') ? $request->input('seo_description_tr') : \Illuminate\Support\Str::limit(strip_tags($trDesc), 155);
        $data['seo_description_en'] = $request->filled('seo_description_en') ? $request->input('seo_description_en') : \Illuminate\Support\Str::limit(strip_tags($enDesc), 155);

        $data['seo_noindex'] = $request->has('seo_noindex') ? 1 : 0;
        if ($request->hasFile('og_image_file')) {
            $data['og_image'] = $this->handleFileUpload($request->file('og_image_file'), 'uploads/seo');
        }

        // Handle cover image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } elseif ($request->filled('cover_image')) {
            $data['img'] = $request->input('cover_image');
        } elseif ($request->filled('img_url')) {
            $data['img'] = $request->input('img_url');
        } elseif (empty($destination->img)) {
            $data['img'] = 'foto.img/amalfi.jpg';
        }

        // Handle video deletion
        if ($request->has('delete_video_file') && $request->input('delete_video_file') == '1') {
            if ($destination->video_file && File::exists(public_path($destination->video_file))) {
                File::delete(public_path($destination->video_file));
            }
            $data['video_file'] = null;
        }

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $this->handleFileUpload($request->file('video_file'), 'uploads/videos');
        }

        // Handle gallery reordering
        $gallery = [];
        if ($request->filled('gallery_order')) {
            $gallery = json_decode($request->input('gallery_order'), true) ?? [];
        } else {
            $gallery = $destination->gallery ?? [];
        }

        // Handle removals
        if ($request->has('remove_gallery')) {
            $removals = $request->input('remove_gallery');
            $gallery = array_values(array_filter($gallery, function($img) use ($removals) {
                return !in_array($img, $removals);
            }));
        }

        // Handle new additions
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $gallery[] = $this->handleFileUpload($file);
            }
        }
        $data['gallery'] = $gallery;

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasyon başarıyla güncellendi.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasyon başarıyla silindi.');
    }
}
