<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Yacht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class YachtController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/yachts')
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
        $yachts = Yacht::latest()->get();
        return view('admin.yachts.index', compact('yachts'));
    }

    public function create()
    {
        return view('admin.yachts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.tr' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'required|string',
            'long_desc.tr' => 'nullable|string',
            'long_desc.en' => 'nullable|string',
            'img_file' => 'nullable|image|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:51200',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'tag', 'desc', 'long_desc', 'video_url']);
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

        // Handle cover image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } else {
            $data['img'] = $request->input('img_url') ?? 'foto.img/yat_hero.jpg';
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

        Yacht::create($data);

        return redirect()->route('admin.yachts.index')->with('success', 'Yat başarıyla eklendi.');
    }

    public function edit(Yacht $yacht)
    {
        return view('admin.yachts.edit', compact('yacht'));
    }

    public function update(Request $request, Yacht $yacht)
    {
        $request->validate([
            'name.tr' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'required|string',
            'long_desc.tr' => 'nullable|string',
            'long_desc.en' => 'nullable|string',
            'img_file' => 'nullable|image|max:51200',
            'img_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:51200',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'tag', 'desc', 'long_desc', 'video_url']);
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

        // Handle cover image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } elseif ($request->filled('img_url')) {
            $data['img'] = $request->input('img_url');
        }

        // Handle video deletion
        if ($request->has('delete_video_file') && $request->input('delete_video_file') == '1') {
            if ($yacht->video_file && File::exists(public_path($yacht->video_file))) {
                File::delete(public_path($yacht->video_file));
            }
            $data['video_file'] = null;
        }

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $this->handleFileUpload($request->file('video_file'), 'uploads/videos');
        }

        // Handle gallery
        $gallery = $yacht->gallery ?? [];

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

        $yacht->update($data);

        return redirect()->route('admin.yachts.index')->with('success', 'Yat başarıyla güncellendi.');
    }

    public function destroy(Yacht $yacht)
    {
        $yacht->delete();
        return redirect()->route('admin.yachts.index')->with('success', 'Yat başarıyla silindi.');
    }
}
