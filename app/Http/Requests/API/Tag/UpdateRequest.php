<?php

namespace App\Http\Requests\API\Tag;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'tag_id' => $this->route('tag'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag_id' => ['required', 'integer', 'exists:tags,id'],
            'name' => ['required', 'string', 'max:100', 'min:2', "unique:tags,name,{$this->tag_id}"]
        ];
    }
}
