<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Book $book)
    {   
        if( ! $books = redisKeyExist('books',1) ) {
            $books = $book->bookLists();
            redisSetData( 'books', $books, 86400 );
        }

        return view('welcome',compact('books'));
    }

    public function show(Request $request, Author $author, Book $book)
    {   
        return view('show',[
            'book' => $book->show($request)
        ]);
    }

    public function search(Book $book)
    {   
        return $book->bookSearch();
    }

    public function download(Book $book)
    {   
        $book->downloadBookPdf($book);
    }
}
