<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/hotels')
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
        $hotels = Hotel::orderBy('order')->orderBy('id', 'desc')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $destinations = \App\Models\Destination::all();
        return view('admin.hotels.create', compact('destinations'));
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
            'tag.tr' => 'nullable|string|max:255',
            'location.tr' => 'nullable|string|max:255',
            'location.en' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'nullable|string',
            'long_desc.tr' => 'nullable|string',
            'long_desc.en' => 'nullable|string',
            'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'destination_name' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_archived' => 'nullable',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'tag', 'location', 'desc', 'long_desc', 'order', 'video_url']);
        $data['order'] = $data['order'] ?? 0;
        $data['is_archived'] = $request->has('is_archived') ? 1 : 0;
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

        // Handle custom typed destination name
        $destinationName = $request->input('destination_name');
        if ($destinationName) {
            $destination = \App\Models\Destination::all()->first(function($d) use ($destinationName) {
                $tr = is_array($d->name) ? ($d->name['tr'] ?? '') : $d->name;
                $en = is_array($d->name) ? ($d->name['en'] ?? '') : $d->name;
                return $tr === $destinationName || $en === $destinationName;
            });
            if (!$destination) {
                $destination = \App\Models\Destination::create([
                    'name' => ['tr' => $destinationName, 'en' => $destinationName],
                    'slug_tr' => \Illuminate\Support\Str::slug($destinationName),
                    'slug_en' => \Illuminate\Support\Str::slug($destinationName),
                    'type' => 'turkiye',
                ]);
            }
            $data['destination_id'] = $destination->id;
        } else {
            $data['destination_id'] = null;
        }

        
        // Auto-fallback EN fields if empty
        $name = $request->input('name', []);
        if (is_array($name)) {
            if (empty($name['en']) && !empty($name['tr'])) { $name['en'] = $name['tr']; }
            $data['name'] = $name;
        }
        $tag = $request->input('tag', []);
        if (is_array($tag)) {
            if (empty($tag['en']) && !empty($tag['tr'])) { $tag['en'] = $tag['tr']; }
            $data['tag'] = $tag;
        }
        $location = $request->input('location', []);
        if (is_array($location)) {
            if (empty($location['en']) && !empty($location['tr'])) { $location['en'] = $location['tr']; }
            $data['location'] = $location;
        }
        $desc = $request->input('desc', []);
        if (is_array($desc)) {
            if (empty($desc['en']) && !empty($desc['tr'])) { $desc['en'] = $desc['tr']; }
            $data['desc'] = $desc;
        }
        $long_desc = $request->input('long_desc', []);
        if (is_array($long_desc)) {
            if (empty($long_desc['en']) && !empty($long_desc['tr'])) { $long_desc['en'] = $long_desc['tr']; }
            $data['long_desc'] = $long_desc;
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
            $data['og_image'] = $this->handleFileUpload($request->file('og_image_file'));
        }


        // Handle cover image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } else {
            $data['img'] = $request->input('img_url') ?? 'foto.img/otel_aman.jpg';
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

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Otel başarıyla eklendi.');
    }

    public function edit(Hotel $hotel)
    {
        $destinations = \App\Models\Destination::all();
        return view('admin.hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, Hotel $hotel)
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
            'tag.tr' => 'nullable|string|max:255',
            'location.tr' => 'nullable|string|max:255',
            'location.en' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'nullable|string',
            'long_desc.tr' => 'nullable|string',
            'long_desc.en' => 'nullable|string',
            'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'destination_name' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_archived' => 'nullable',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'tag', 'location', 'desc', 'long_desc', 'order', 'video_url']);
        $data['order'] = $data['order'] ?? 0;
        $data['is_archived'] = $request->has('is_archived') ? 1 : 0;
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

        // Handle custom typed destination name
        $destinationName = $request->input('destination_name');
        if ($destinationName) {
            $destination = \App\Models\Destination::all()->first(function($d) use ($destinationName) {
                $tr = is_array($d->name) ? ($d->name['tr'] ?? '') : $d->name;
                $en = is_array($d->name) ? ($d->name['en'] ?? '') : $d->name;
                return $tr === $destinationName || $en === $destinationName;
            });
            if (!$destination) {
                $destination = \App\Models\Destination::create([
                    'name' => ['tr' => $destinationName, 'en' => $destinationName],
                    'slug_tr' => \Illuminate\Support\Str::slug($destinationName),
                    'slug_en' => \Illuminate\Support\Str::slug($destinationName),
                    'type' => 'turkiye',
                ]);
            }
            $data['destination_id'] = $destination->id;
        } else {
            $data['destination_id'] = null;
        }

        
        // Auto-fallback EN fields if empty
        $name = $request->input('name', []);
        if (is_array($name)) {
            if (empty($name['en']) && !empty($name['tr'])) { $name['en'] = $name['tr']; }
            $data['name'] = $name;
        }
        $tag = $request->input('tag', []);
        if (is_array($tag)) {
            if (empty($tag['en']) && !empty($tag['tr'])) { $tag['en'] = $tag['tr']; }
            $data['tag'] = $tag;
        }
        $location = $request->input('location', []);
        if (is_array($location)) {
            if (empty($location['en']) && !empty($location['tr'])) { $location['en'] = $location['tr']; }
            $data['location'] = $location;
        }
        $desc = $request->input('desc', []);
        if (is_array($desc)) {
            if (empty($desc['en']) && !empty($desc['tr'])) { $desc['en'] = $desc['tr']; }
            $data['desc'] = $desc;
        }
        $long_desc = $request->input('long_desc', []);
        if (is_array($long_desc)) {
            if (empty($long_desc['en']) && !empty($long_desc['tr'])) { $long_desc['en'] = $long_desc['tr']; }
            $data['long_desc'] = $long_desc;
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
            $data['og_image'] = $this->handleFileUpload($request->file('og_image_file'));
        }


        // Handle cover image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } elseif ($request->filled('cover_image')) {
            $data['img'] = $request->input('cover_image');
        } elseif ($request->filled('img_url')) {
            $data['img'] = $request->input('img_url');
        }

        // Handle video deletion
        if ($request->has('delete_video_file') && $request->input('delete_video_file') == '1') {
            if ($hotel->video_file && File::exists(public_path($hotel->video_file))) {
                File::delete(public_path($hotel->video_file));
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
            $gallery = $hotel->gallery ?? [];
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

        $hotel->update($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Otel başarıyla güncellendi.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Otel başarıyla silindi.');
    }
}
