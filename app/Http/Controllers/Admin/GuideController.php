<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GuideController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/guides')
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
        $guides = Guide::latest()->get();
        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        return view('admin.guides.create');
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
            'title.tr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'nullable|string',
            'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'tag', 'desc', 'video_url']);
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

                
        // Auto-fallback EN fields if empty
        $title = $request->input('title', []);
        if (is_array($title)) {
            if (empty($title['en']) && !empty($title['tr'])) { $title['en'] = $title['tr']; }
            $data['title'] = $title;
        }
        $tag = $request->input('tag', []);
        if (is_array($tag)) {
            if (empty($tag['en']) && !empty($tag['tr'])) { $tag['en'] = $tag['tr']; }
            $data['tag'] = $tag;
        }
        $desc = $request->input('desc', []);
        if (is_array($desc)) {
            if (empty($desc['en']) && !empty($desc['tr'])) { $desc['en'] = $desc['tr']; }
            $data['desc'] = $desc;
        }

        $trMainName = $data['title']['tr'] ?? ($request->input('title.tr') ?? '');
        $enMainName = $data['title']['en'] ?? ($request->input('title.en') ?? $trMainName);
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
            $data['img'] = $request->input('img_url') ?? 'foto.img/bodrum.jpg';
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

        Guide::create($data);

        return redirect()->route('admin.guides.index')->with('success', 'Gezi rehberi başarıyla eklendi.');
    }

    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    public function update(Request $request, Guide $guide)
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
            'title.tr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'nullable|string',
            'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'tag', 'desc', 'video_url']);
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

                
        // Auto-fallback EN fields if empty
        $title = $request->input('title', []);
        if (is_array($title)) {
            if (empty($title['en']) && !empty($title['tr'])) { $title['en'] = $title['tr']; }
            $data['title'] = $title;
        }
        $tag = $request->input('tag', []);
        if (is_array($tag)) {
            if (empty($tag['en']) && !empty($tag['tr'])) { $tag['en'] = $tag['tr']; }
            $data['tag'] = $tag;
        }
        $desc = $request->input('desc', []);
        if (is_array($desc)) {
            if (empty($desc['en']) && !empty($desc['tr'])) { $desc['en'] = $desc['tr']; }
            $data['desc'] = $desc;
        }

        $trMainName = $data['title']['tr'] ?? ($request->input('title.tr') ?? '');
        $enMainName = $data['title']['en'] ?? ($request->input('title.en') ?? $trMainName);
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
        }

        // Handle video deletion
        if ($request->has('delete_video_file') && $request->input('delete_video_file') == '1') {
            if ($guide->video_file && File::exists(public_path($guide->video_file))) {
                File::delete(public_path($guide->video_file));
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
            $gallery = $guide->gallery ?? [];
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

        $guide->update($data);

        return redirect()->route('admin.guides.index')->with('success', 'Gezi rehberi başarıyla güncellendi.');
    }

    public function destroy(Guide $guide)
    {
        $guide->delete();
        return redirect()->route('admin.guides.index')->with('success', 'Gezi rehberi başarıyla silindi.');
    }
}
