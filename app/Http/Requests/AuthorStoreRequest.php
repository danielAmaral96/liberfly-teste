<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Author Request",
 *     description="Author request schema",
 *     required={"name"},
 * )
 */
class AuthorStoreRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     description="Author name",
     *     example="John Doe",
     * )
     *
     * @var string
     */
    public $name;

    

    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }
}