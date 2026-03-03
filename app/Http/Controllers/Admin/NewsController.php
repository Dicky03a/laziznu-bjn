<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        // Handle publish/draft action
        $action = $request->input('action', 'draft');
        if ($action === 'publish') {
            $data['published_at'] = now();
        } else {
            $data['published_at'] = null;
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $relatedNews = News::where('published_at', '<=', now())
            ->where('id', '!=', $news->id)
            ->when($news->category_id, function ($q) use ($news) {
                $q->where('category_id', $news->category_id);
            })
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $allCategories = Category::withCount('news')
            ->orderBy('name')
            ->get();

        return view('pages.public.berita.show', compact('news', 'relatedNews', 'allCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();

        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $request->validated();

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        } elseif ($request->input('remove_image') === '1') {
            // Remove image if checkbox is checked
            if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $data['featured_image'] = null;
        } else {
            unset($data['featured_image']);
        }

        // Handle publish/draft action
        $action = $request->input('action');

        if ($action === 'publish') {
            if (! $news->published_at) {
                $data['published_at'] = now();
            }
        } elseif ($action === 'draft') {
            $data['published_at'] = null;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus');
    }
}
