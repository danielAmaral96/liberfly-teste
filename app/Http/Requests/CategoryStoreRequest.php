<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Category Request",
 *     description="Category request body parameters",
 *     required={"name"}
 * )
 */
class CategoryStoreRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     property="name",
     *     description="Category name",
     *     type="string",
     *     example="Fantasy"
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}