<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return News::published()->orderBy('created_at', 'desc')
            ->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'preview' => 'required',
            'category_id' => 'required',
            "publish_date" => 'nullable'
        ]);

        return News::create([
            'title' => $fields['title'],
            'content' => $fields['content'],
            'preview' => $fields['preview'],
            'category_id' => $fields['category_id'],
            'publish_date' => $fields['publish_date'],
            'views' => 0
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $news_show =  News::published()->findOrFail($id);
        $news_show->increment('views', 1);
        return  $news_show;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::find($id);
        $news->update($request->all());
        return $news;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return News::destroy($id);;
    }

    /**
     * 
     */
    public function topNews()
    {

        return News::published()->orderBy('views', 'desc')->limit(10)->get();
    }
}
