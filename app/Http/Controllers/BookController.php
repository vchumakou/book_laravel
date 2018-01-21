<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use App\Message;

class BookController extends Controller
{
    public static $limit = 10;

    public function index()
    {
        return Book::paginate(self::$limit);
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
            Message::send($article,User::getUserId());
        }
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        if (!User::isAdmin()) {
            return 403;
        }
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
}
