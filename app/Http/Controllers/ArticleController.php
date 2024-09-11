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
        // dd($request["image"]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        //Gérer la sauvegarde de l'image (s'il y en a )
        if ($request["image"]) {
            $path = $request
                ->file("image")
                ->store("images", "public");
            $validated["image"] = $path;
        }



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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //Gestion de l'image


        // Trouver l'article à mettre à jour
        $article = Article::findOrFail($id);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($article->image) {
                Storage::disk( 'public')->delete($article->image);
            }

            // Stocker la nouvelle image
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        // Mettre à jour l'article avec les données validées
        $article->update($validated);


        // Rediriger avec un message de succès
        return redirect()->route('articles')->with('success', 'Article updated successfully.');
    }
    // Méthode pour supprimer un article
    public function destroy($id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        return redirect()->route('articles')->with('success', 'Article deleted successfully.');
    }


}
