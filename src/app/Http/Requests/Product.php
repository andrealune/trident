<?php

namespace App\Http\Requests;

use \Illuminate\Http\Request;

class Product
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function create(Request $request)
    {
        return [
            'name' => 'required',
            'detail' => 'required'
        ];
    }
}
