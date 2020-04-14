<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Shop;


class FeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

      public function authorize()
      {
        $shop_userid = Shop::where('english_name', \request('shop'))->get()->first()->user_id;
        if($shop_userid == \auth::user()->id){
          return true;
        }
        else{
          return false;
        }
      }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1|max:100|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'icon' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
