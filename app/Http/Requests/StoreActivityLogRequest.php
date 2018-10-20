<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreActivityLogRequest extends Request
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
            'title' => 'required|string|max:255',
            'content_type' => 'required|string|in:blog,plog,vlog',
            'blog_content' => 'required_if:content_type,blog|string',
            'plog_content' => 'required_if:content_type,plog|image',
            'vlog_content' => 'required_if:content_type,vlog|mimes:mp4,mov,ogg,qt',
            'status' => 'required|integer'
        ];
    }
}
