<?php

namespace App\Http\Requests;

use App\Models\Enumerations\MovieReactionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieReactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'movie_id' => ['required', 'exists:movies,id'],
          'reaction' => ['required', 'string', Rule::in(MovieReactionEnum::$values)]
        ];
    }
}
