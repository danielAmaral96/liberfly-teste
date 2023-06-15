<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function getAll()
    {
        return Book::all();
    }

    public function getById($id)
    {
        return Book::find($id);
    }

    public function create($data)
    {
        return Book::create($data);
    }

    public function update($id, $data)
    {
        $book = Book::find($id);
        if (!$book) {
            return null;
        }
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return null;
        }
        $book->delete();
        return $book;
    }

    public function getBooksByAuthor($authorId)
    {
        return Book::where('author_id', $authorId)->get();
    }

    public function getBooksByCategory($categoryId)
    {
        return Book::where('category_id', $categoryId)->get();
    }
}