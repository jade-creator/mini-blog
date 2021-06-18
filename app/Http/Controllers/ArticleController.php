<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Tag;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['categories:id,name', 'tags:id,name', 'user:id,name'])
                        ->when(request('query'), function($query) {
                            if (request('query') == 'this week') {
                                return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                            }

                            return $query->where('title', 'like', '%'.request('query').'%')
                                    ->orWhere('body_text', 'like', '%'.request('query').'%');
                        })
                        ->when(request('tag_id'), function($query) {
                            return $query->whereHas('tags', function($nestedQuery) {
                                return $nestedQuery->where('id', request('tag_id'));
                            });
                        })
                        ->when(request('category_id'), function($query) {
                            return $query->whereHas('categories', function($nestedQuery) {
                                return $nestedQuery->where('id', request('category_id'));
                            });
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(5);

        $tags = Tag::get(['id', 'name']);

        $categories = Category::get(['id', 'name']);
        
        return view('article.index', ['articles' => $articles, 'tags' => $tags, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id', 'name']);
        return view('article.create', ['categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->all() + ['user_id' => Auth::user()->id ]);

        if (isset($request->categories)) {
            $article->categories()->attach($request->categories);
        }

        if ($request->tags != '') {
            $tags = explode(' ', $request->tags);
            foreach ($tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $article->tags()->attach($tag);
            }
        }

        if ($request->hasFile('main_image')) {
            $article->addMediaFromRequest('main_image')->toMediaCollection('main_images');
        }

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['categories', 'tags']);

        return view('article.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
