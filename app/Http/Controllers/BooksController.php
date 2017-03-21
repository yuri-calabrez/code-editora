<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Auth;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(15);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Book::create($data);
        $url = $request->get('redirectTo', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso!');
        return redirect()->to($url);
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $data = $request->except('user_id');
        $book->fill($data);
        $book->save();
        $url = $request->get('redirectTo', route('books.index'));
        $request->session()->flash('message', 'Livro editado com sucesso!');
        return redirect()->to($url);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        \Session::flash('message', 'Livro removido com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
