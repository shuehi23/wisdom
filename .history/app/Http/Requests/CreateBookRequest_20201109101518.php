<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'title_img_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024',
            'phrase' => 'required|string|max:100',
            'impression' => 'nullable|string|max:255',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'integer',
            
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'title_img_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024',
            'phrase' => 'required|string|max:100',
            'impression' => 'nullable|string|max:255',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'integer',
            
        ];
    }
}
