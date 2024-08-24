# Notes sur Laravel

<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->

- Installer l'outil de ligne de commande : `composer global require laravel/installer;`
- Créer un projet Laravel : `composer create-project laravel/laravel="version" nom_projet;`
- Démarrer le serveur Laravel : `php artisan serve;` ou `php artisan serve --port 5000;` (pour choisir un port).

- Les routes dans Laravel sont des appels de façades et se trouvent dans le fichier `web.php` du dossier `routes`.
- Les routes sont sous la forme : `Route::get('/...chemin', function () { return view('...chemin.nom_fichier'); });`
- Pour qu'un fichier enfant s'étende et bénéficie du contenu d'un fichier parent : `@extends('layouts.master')`
- Dans ce cas, la variable `content` de la directive `section` garde le contenu qui sera affiché dans le fichier parent plus tard : `@section('content') ...contenu @endsection;`
- Le contenu est affiché dans le fichier parent grâce à la directive : `@yield('content')`.

- Pour créer un contrôleur dans le dossier `App\Http\Controllers` : `php artisan make:controller nom_Controller;`
  - Note intéressante : `php artisan make:nom_dossier nom_fichier` permet de créer dans le bon dossier avec la bonne extension.
- La commande suivante recharge toutes les classes après la création des contrôleurs : `composer dump-autoload;`
- Ajout des méthodes pour accéder aux pages dans le contrôleur :
  ```php
  class PagesController extends Controller {
      public function index() {
          return view('layouts.master');
      }
  }
  NB : La fonction index accède à la vue master, c'est un exemple.
  ```

À partir de Laravel 8, dans le fichier qui gère les routes (web.php), il faut importer le fichier contrôleur avec : use .../chemin du fichier; ensuite la méthode : Route::get('/chemin', [nom_fichier::class, 'la fonction à appeler']);

Exemple : use App\Http\Controllers\PagesController; (importe le fichier PagesController) et Route::get('/', [PagesController::class, 'index']); (indique le chemin pour accéder à la fonction index du contrôleur).
Quelques directives Blade (elles commencent toujours par @ et se terminent par @endnom_de_la_directive) :

@foreach($articles as $article) <p>{{ $article['title'] }}</p> @endforeach : elle sert à retourner une liste de choses généralement contenues dans un tableau.
@php ...votre code... @endphp : pour écrire uniquement du PHP.
@if(condition) @else @elseif @endif : pour mettre des conditions.
@each('articles.index', $articles, 'article', 'articles.no-articles') : parcourir des fichiers dans des cas.
Le fichier .env définit des variables d'environnement et de configuration du framework.
La commande suivante sert à générer la clé du fichier .env après clonage afin qu'elle fonctionne : php artisan key:generate;
Ces commandes servent à nettoyer les caches : php artisan cache:clear et php artisan config:clear;
Pour créer des migrations (une base de données) : php artisan make:migration create_articles_table;

Créer un nouveau projet Laravel : laravel new nom-du-projet
Lancer un serveur de développement local : php artisan serve
Créer un nouveau contrôleur : php artisan make:controller NomDuControleur
Créer un modèle : php artisan make:model NomDuModele
Créer une migration (pour la base de données) : php artisan make:migration nom_de_la_migration
Exécuter toutes les migrations en attente : php artisan migrate
Créer un seeder (pour peupler la base de données avec des données de test) :php artisan make:seeder NomDuSeeder
Exécuter tous les seeders : php artisan db:seed
Créer un middleware : php artisan make:middleware NomDuMiddleware
Lister toutes les routes définies : php artisan route:list
Nettoyer le cache des configurations : php artisan config:cache
Effacer le cache des vues : php artisan view:clear
Créer une clé de chiffrement pour l'application :php artisan key:generate
Tinker: outil en ligne de commande qui permet d'interagir avec l'application directement dans le terminal: php artisan tinker
Seeder: outil qui va nous permettre d'ajouter des données automatiquement: php artisan db:seed.

### Note : @each('articles.index', $articles, 'article', 'articles.no-articles') 
- Le premier argument est le fichier que l'on veut inclure.
- le second est notre liste d'articles.
- le troisième est le nom de la variable à laquelle sera assigné la valeur de l'itération en cours.
- le dernier est le fichier inclut si il n'y a pas d'articles.

- En cas d'erreur de migration on fait : php artisan migrate:fresh

