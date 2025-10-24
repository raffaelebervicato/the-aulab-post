<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('category')?->id;
        return [
            'name' => ['required','string','max:60',"unique:categories,name,$id"],
            'slug' => ['nullable','string','max:80',"unique:categories,slug,$id"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.unique'   => 'Questa categoria esiste già.',
            'slug.unique'   => 'Slug già in uso.',
        ];
    }
}
