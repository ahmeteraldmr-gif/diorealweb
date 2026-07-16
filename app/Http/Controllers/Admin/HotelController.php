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
            'og_image_file' => 'nullable|image|max:5120',
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
            'img_file' => 'nullable|image|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:51200',
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
            $destination = \App\Models\Destination::where('name->tr', $destinationName)
                ->orWhere('name->en', $destinationName)
                ->first();
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

        $data['slug_tr'] = $request->input('slug_tr') ? \Illuminate\Support\Str::slug($request->input('slug_tr')) : \Illuminate\Support\Str::slug($request->input('name.tr'));
        $data['slug_en'] = $request->input('slug_en') ? \Illuminate\Support\Str::slug($request->input('slug_en')) : \Illuminate\Support\Str::slug($request->input('name.en'));
        $data['seo_title_tr'] = $request->input('seo_title_tr');
        $data['seo_title_en'] = $request->input('seo_title_en');
        $data['seo_description_tr'] = $request->input('seo_description_tr');
        $data['seo_description_en'] = $request->input('seo_description_en');
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
            'og_image_file' => 'nullable|image|max:5120',
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
            'img_file' => 'nullable|image|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:51200',
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
            $destination = \App\Models\Destination::where('name->tr', $destinationName)
                ->orWhere('name->en', $destinationName)
                ->first();
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

        $data['slug_tr'] = $request->input('slug_tr') ? \Illuminate\Support\Str::slug($request->input('slug_tr')) : \Illuminate\Support\Str::slug($request->input('name.tr'));
        $data['slug_en'] = $request->input('slug_en') ? \Illuminate\Support\Str::slug($request->input('slug_en')) : \Illuminate\Support\Str::slug($request->input('name.en'));
        $data['seo_title_tr'] = $request->input('seo_title_tr');
        $data['seo_title_en'] = $request->input('seo_title_en');
        $data['seo_description_tr'] = $request->input('seo_description_tr');
        $data['seo_description_en'] = $request->input('seo_description_en');
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
