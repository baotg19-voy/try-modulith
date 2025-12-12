<?php

namespace Modules\Product\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?: Str::slug($this->name)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('category'); // null for store, ID for update

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pgsql.categories', 'name')->ignore($id)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('pgsql.categories', 'slug')->ignore($id)
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
