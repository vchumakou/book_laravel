<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function show($id)
    {
        return Book::find($id);
    }

    public function store(Request $request)
    {
        return Book::create($request->all());
    }

    public function update(Request $request, $id)
    {
        if (User::isAdmin()) {
            $article = Book::findOrFail($id);
        }
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        if (User::isAdmin()) {
            $article = Article::findOrFail($id);
        }
        $article->delete();

        return 204;
    }
}
