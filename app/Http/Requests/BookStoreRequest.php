<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Book Request",
 *     description="Book request schema",
 *     required={"name", "author_id", "category_id", "description"},
 * )
 */
class BookStoreRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     description="Book name",
     *     example="The Hobbit",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     property="author_id",
     *     type="integer",
     *     description="ID of the author",
     *     example=1,
     * )
     *
     * @var int
     */
    public $author_id;

    /**
     * @OA\Property(
     *     property="category_id",
     *     type="integer",
     *     description="ID of the category",
     *     example=1,
     * )
     *
     * @var int
     */
    public $category_id;

    /**
     * @OA\Property(
     *     property="description",
     *     type="string",
     *     description="Book description",
     *     example="A captivating novel about the Jazz Age in America.",
     * )
     *
     * @var string
     */
    public $description;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'author_id' => [
                'required',
                Rule::exists('authors', 'id'),
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'description' => 'required|string',
        ];
    }
}