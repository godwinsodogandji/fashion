<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->get(); // Charger l'utilisateur associé si nécessaire
        return Inertia::render('Articles/Index', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return Inertia::render('Articles/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ]);
        $request->user()->Articles()->create($validated);
        // // Gestion du téléchargement de l'image
        // $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images', 'public');
        // }

       

        return redirect(route('article.index'));
    }

    public function edit(Article $article)
    {
        return Inertia::render('Articles/Edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Gestion du téléchargement de l'image
        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($imagePath && Storage::exists("public/{$imagePath}")) {
                Storage::delete("public/{$imagePath}");
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imagePath,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('articles.index');
    }
}
