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
        $article = Article::all(); // Charger l'utilisateur associé si nécessaire
        return Inertia::render('Articles/Index', [
            'article' => $article
        ]);


    }

    public function create()
    {
        return Inertia::render('Articles/Create', [
            'articles' => Article::with('user:id,name')->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',

        ]);
        $request->user()->articles()->create($validated);
        return redirect(route('articles'));
    }
    public function getArticle()
    {
        $article = Article::all();
        return response()->json($article, 200);
    }

}
