<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Retorna todos os livros.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        dd('aqui');
        $books = $this->bookService->getAllBooks();
        return response()->json($books);
    }

    /**
     * Retorna um livro pelo ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = $this->bookService->getBookById($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    /**
     * Cria um novo livro.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $book = $this->bookService->createBook($request->all());
        return response()->json($book, 201);
    }

    /**
     * Atualiza um livro existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $book = $this->bookService->updateBook($id, $request->all());
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    /**
     * Exclui um livro.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = $this->bookService->deleteBook($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json(['message' => 'Book deleted']);
    }

    /**
     * Retorna os livros de um autor pelo ID do autor.
     *
     * @param int $authorId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByAuthor($authorId)
    {
        $books = $this->bookService->getBooksByAuthor($authorId);
        if (!$books) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        return response()->json($books);
    }

    /**
     * Retorna os livros de uma categoria pelo ID da categoria.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCategory($categoryId)
    {
        $books = $this->bookService->getBooksByCategory($categoryId);
        if (!$books) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($books);
    }
}