<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\Gate;
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

      // Afficher le formulaire de modification
      public function edit($id)
      {
          // Trouver l'article à modifier
          $article = Article::findOrFail($id);

          // Passer l'article à la vue
          return Inertia::render('Articles/Edit', [
              'article' => $article,
          ]);
      }

      // Traiter la mise à jour de l'article
      public function update(Request $request, $id): RedirectResponse
      {
          // Valider les données
          $validated = $request->validate([
              'title' => 'required|string|max:255',
              'body' => 'required|string',
              'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
          ]);
          

          // Trouver l'article à mettre à jour
          $article = Article::findOrFail($id);

          // Mettre à jour l'article avec les données validées
          $article->update($validated);

          // Rediriger avec un message de succès
          return redirect()->route('articles')->with('success', 'Article updated successfully.');
      }
        // Méthode pour supprimer un article
    public function destroy($id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles')->with('success', 'Article deleted successfully.');
    }


}
