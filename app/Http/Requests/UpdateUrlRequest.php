<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\URL;
class UpdateUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $url_id =$this->route()->id;
        $url = URL::findOrFail($url_id);

        return ($url->user_id = auth()->user()->id) ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->method());
        if ($this->method() != "GET"){
            return [
                'url'=> 'required|url|max:2048'
            ];
        } return [];

    }
}
