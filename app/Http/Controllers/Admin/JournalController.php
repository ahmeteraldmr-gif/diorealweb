<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JournalController extends Controller
{
    protected function handleFileUpload($file, $folder = 'uploads/journals')
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
        $journals = Journal::latest()->get();
        return view('admin.journals.index', compact('journals'));
    }

    public function create()
    {
        $destinations = \App\Models\Destination::all();
        return view('admin.journals.create', compact('destinations'));
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
            'title.tr' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'required|string',
            'content.tr' => 'nullable|string',
            'content.en' => 'nullable|string',
            'date' => 'required|string|max:255',
            'read_time' => 'nullable|integer|min:1|max:120',
            'is_featured' => 'nullable|boolean',
            'img_file' => 'nullable|image|max:51200',
            'img_url' => 'nullable|string',
            'destination_id' => 'nullable|exists:destinations,id',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'tag', 'desc', 'content', 'date', 'read_time', 'destination_id', 'video_url']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

        // Handle image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } else {
            $data['img'] = $request->input('img_url') ?? 'foto.img/bodrum.jpg';
        }

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $this->handleFileUpload($request->file('video_file'), 'uploads/videos');
        }

        Journal::create($data);

        return redirect()->route('admin.journals.index')->with('success', 'Journal yazısı başarıyla eklendi.');
    }

    public function edit(Journal $journal)
    {
        $destinations = \App\Models\Destination::all();
        return view('admin.journals.edit', compact('journal', 'destinations'));
    }

    public function update(Request $request, Journal $journal)
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
            'title.tr' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'tag.tr' => 'nullable|string|max:255',
            'tag.en' => 'nullable|string|max:255',
            'desc.tr' => 'required|string',
            'desc.en' => 'required|string',
            'content.tr' => 'nullable|string',
            'content.en' => 'nullable|string',
            'date' => 'required|string|max:255',
            'read_time' => 'nullable|integer|min:1|max:120',
            'is_featured' => 'nullable|boolean',
            'img_file' => 'nullable|image|max:51200',
            'img_url' => 'nullable|string',
            'destination_id' => 'nullable|exists:destinations,id',
            'video_file' => 'nullable|file|max:204800',
            'video_url' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'tag', 'desc', 'content', 'date', 'read_time', 'destination_id', 'video_url']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['show_video_on_cover'] = $request->has('show_video_on_cover') ? 1 : 0;

        // Handle image
        if ($request->hasFile('img_file')) {
            $data['img'] = $this->handleFileUpload($request->file('img_file'));
        } elseif ($request->filled('img_url')) {
            $data['img'] = $request->input('img_url');
        }

        // Handle video deletion
        if ($request->has('delete_video_file') && $request->input('delete_video_file') == '1') {
            if ($journal->video_file && File::exists(public_path($journal->video_file))) {
                File::delete(public_path($journal->video_file));
            }
            $data['video_file'] = null;
        }

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $this->handleFileUpload($request->file('video_file'), 'uploads/videos');
        }

        $journal->update($data);

        return redirect()->route('admin.journals.index')->with('success', 'Journal yazısı başarıyla güncellendi.');
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();
        return redirect()->route('admin.journals.index')->with('success', 'Journal yazısı başarıyla silindi.');
    }
}
