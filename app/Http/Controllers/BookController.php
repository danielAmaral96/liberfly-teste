<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Repositories\BookRepository;
use OpenApi\Annotations as OA;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Books",
 *     description="API Endpoints for Books"
 * )
 */

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService, BookRepository $bookRepository)
    {
        $this->bookService = $bookService;
        $this->bookRepository = $bookRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Get all books",
     *     description="Returns a list of all books",
     *     operationId="getBooks",
     *     tags={"Books"},
     *     @OA\Response(response="200", description="Successful operation")
     * )
     */
    public function index()
    {
        $books = $this->bookRepository->getAll();
        return response()->json($books);
    }

    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Create a new book",
     *     description="Creates a new book",
     *     operationId="createBook",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookStoreRequest")
     *     ),
     *     @OA\Response(response="201", description="Book created"),
     *     @OA\Response(response="422", description="Validation error")
     * )
     */
    
     public function store(BookStoreRequest $request)
     {
         $book = $this->bookService->createBook($request->validated());
         return response()->json($book, 201);
     }

    /**
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Get a book by ID",
     *     description="Returns a single book by its ID",
     *     operationId="getBook",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Book not found")
     * )
     */
    public function show($id)
    {
        $book = $this->bookRepository->getById($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     summary="Update a book",
     *     description="Updates an existing book",
     *     operationId="updateBook",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookStoreRequest")
     *     ),
     *     @OA\Response(response="200", description="Book updated"),
     *     @OA\Response(response="404", description="Book not found"),
     *     @OA\Response(response="422", description="Validation error")
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'author_id' => 'required|integer|exists:authors,id',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required|string',
        ]);
        $book = $this->bookRepository->getById($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $updatedBook = $this->bookService->updateBook($id, $request->all());
        return response()->json($updatedBook);
    }

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete a book",
     *     description="Deletes a book by its ID",
     *     operationId="deleteBook",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Book deleted"),
     *     @OA\Response(response="404", description="Book not found")
     * )
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->getById($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $this->bookService->deleteBook($id);
        return response()->json(['message' => 'Book deleted successfully']);
    }

    /**
     * @OA\Get(
     *     path="/api/books/by-author/{authorId}",
     *     summary="Get books by author",
     *     description="Returns a list of books written by a specific author",
     *     operationId="getBooksByAuthor",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="authorId",
     *         in="path",
     *         description="ID of the author",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Author not found")
     * )
     */
    public function getByAuthor($authorId)
    {
       
        $books = $this->bookService->getBooksByAuthor($authorId);

        if ($books->isEmpty()) {
            return response()->json(['message' => 'Author not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($books, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/books/by-category/{categoryId}",
     *     summary="Get books by category",
     *     description="Returns a list of books belonging to a specific category",
     *     operationId="getBooksByCategory",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="categoryId",
     *         in="path",
     *         description="ID of the category",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Category not found")
     * )
     */
    public function getByCategory($categoryId)
    {
        $books = $this->bookService->getBooksByCategory($categoryId);

        if ($books->isEmpty()) {
            return response()->json(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($books, Response::HTTP_OK);
    }

    
    
}