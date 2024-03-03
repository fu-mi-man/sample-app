<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): HttpResponse
    {
        $books = Book::all();
        $books = Book::with('category')
            ->orderBy('category_id')
            ->orderBy('title')
            ->get();

        return response()
            ->view('admin.book.index', ['books' => $books])
            ->header('Content-Type', 'text/html')
            ->header('Content-Encoding', 'UTF-8');
    }

    public function show(Book $book): View
    {
        return view('admin.book.show', compact('book'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('admin.book.create', compact('categories', 'authors'));
    }

    public function store(BookPostRequest $request): RedirectResponse
    {
        $book = new Book();
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        DB::transaction(function () use ($book, $request) {
            $book->save();
            $book->authors()->attach($request->author_ids); // 著書書籍テーブルを登録
        });

        return redirect(route('book.index'))
            ->with('message', $book->title . 'を追加しました');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        $authorIds = $book->authors->pluck('id')->all();

        return view('admin.book.edit', compact('book', 'categories', 'authors', 'authorIds'));
    }

    public function update(BookPutRequest $request, Book $book)
    {
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        DB::transaction(function () use ($book, $request) {
            $book->update();
            $book->authors()->sync($request->author_ids); // 著書書籍テーブルを更新する
        });

        return redirect(route('book.index'))
            ->with('message', $book->title . 'を変更しました');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect(route('book.index'))
            ->with('message', $book->title . 'を削除しました');
    }
}
