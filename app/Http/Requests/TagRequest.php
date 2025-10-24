<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('tag')?->id;
        return [
            'name' => ['required','string','max:60',"unique:tags,name,$id"],
            'slug' => ['nullable','string','max:80',"unique:tags,slug,$id"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.unique'   => 'Questo tag esiste già.',
            'slug.unique'   => 'Slug già in uso.',
        ];
    }
}
