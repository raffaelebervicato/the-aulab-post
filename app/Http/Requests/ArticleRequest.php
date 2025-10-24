<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'       => ['required','string','max:150'],
            'subtitle'    => ['nullable','string','max:200'],
            'category_id' => ['required','exists:categories,id'],
            'body'        => ['required','string','min:30'],
            'cover_image' => ['nullable','image','max:2048'], // 2MB
            'tags'        => ['nullable','array'],
            'tags.*'      => ['integer','exists:tags,id'],
        ];
    }
}
