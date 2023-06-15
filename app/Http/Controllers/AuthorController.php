<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Http\Requests\AuthorStoreRequest;
use Illuminate\Http\Response;


/**
 * @OA\Tag(
 *     name="Authors",
 *     description="API Endpoints for Authors"
 * )
 */

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @OA\Get(
     *     path="/api/authors",
     *     summary="Get all authors",
     *     description="Returns a list of all authors",
     *     operationId="getAllAuthors",
     *     tags={"Authors"},
     *     @OA\Response(response="200", description="Successful operation"),
     * )
     */
    public function index()
    {
        $authors = $this->authorService->getAllAuthors();
        return response()->json($authors);
    }

    /**
     * @OA\Get(
     *     path="/api/authors/{id}",
     *     summary="Get an author by ID",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Author ID",
     *         required=true,
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *         
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     )
     * )
     */ 
    public function show($id)
    {
        $author = $this->authorService->getAuthorById($id);
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        return response()->json($author);
    }

    /**
     * @OA\Post(
     *     path="/api/authors",
     *     summary="Create a new author",
     *     description="Creates a new author",
     *     operationId="createAuthor",
     *     tags={"Authors"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthorStoreRequest")
     *     ),
     *     @OA\Response(response="201", description="Author created"),
     *     @OA\Response(response="422", description="Validation error"),
     * )
     */
    public function store(AuthorStoreRequest $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $author = $this->authorService->createAuthor($request->all());
        return response()->json($author, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/authors/{id}",
     *     summary="Update an existing author",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Author ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Author data",
     *         @OA\JsonContent(ref="#/components/schemas/AuthorStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Author updated successfully",
     *         
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $author = $this->authorService->updateAuthor($id, $request->all());
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json($author);
    }

    /**
     * @OA\Delete(
     *     path="/api/authors/{id}",
     *     summary="Delete an author",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Author ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Author deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Author not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $author = $this->authorService->deleteAuthor($id);
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json(['message' => 'Author deleted']);
    }
}
