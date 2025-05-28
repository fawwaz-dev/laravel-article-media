<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('updated_at', 'desc')->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articles',
            'content' => 'required',
            'status' => 'required|in:draft,published',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Title is required.',
            'title.unique' => 'Title already exists.',
            'content.required' => 'Content is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be "draft" or "published".',
            'featured_image.image' => 'Featured image must be an image.',
            'featured_image.mimes' => 'Featured image must be in JPEG, PNG, JPG, or GIF format.',
            'featured_image.max' => 'Featured image size must not exceed 2MB.',
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->status = $request->input('status');
        $article->user_id = 1;
        $article->slug = Str::slug($article->title);

        $article->save();

        if ($request->hasFile('featured_image')) {
            $article
                ->addMediaFromRequest('featured_image')
                ->usingName('featured_image')
                ->toMediaCollection('featured_images');
        }

        return redirect()->route('articles.show', $article->slug)->with('success', 'Article created successfully.');
    }

    public function edit(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|unique:articles,title,' . $article->id . ',id',
            'content' => 'required',
            'status' => 'required|in:draft,published',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Title is required.',
            'title.unique' => 'Title already exists.',
            'content.required' => 'Content is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be "draft" or "published".',
            'featured_image.image' => 'Featured image must be an image.',
            'featured_image.mimes' => 'Featured image must be in JPEG, PNG, JPG, or GIF format.',
            'featured_image.max' => 'Featured image size must not exceed 2MB.',
        ]);

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->status = $request->input('status');
        $article->user_id = 1;
        $article->slug = Str::slug($article->title);

        $article->save();

        if ($request->hasFile('featured_image')) {
            $article->clearMediaCollection('featured_images');
            $article
                ->addMediaFromRequest('featured_image')
                ->usingName('featured_image')
                ->toMediaCollection('featured_images');
        }

        return redirect()->route('articles.show', $article->slug)->with('success', 'Article updated successfully.');
    }

    public function destroy(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
