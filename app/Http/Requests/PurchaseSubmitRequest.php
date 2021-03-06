<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseSubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if(\auth::user()){
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
    if(request()->type == 'product'){
      return [
        'shipping_way' => 'in:quick_way,posting_way,person_way',
        'payment_method' => 'required|in:cash_payment,online_payment',
        'new_address' => 'required_without:address|min:1|max:120|string|nullable|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
        'city' => 'required_without:address|min:1|max:20|regex:/^[\pL\s\-]+$/u|nullable',
        'province' => 'required_without:address|min:1|max:20|regex:/^[\pL\s\-]+$/u|nullable',
        'address' => 'min:1|max:400|string|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u'
      ];
    }
  elseif(request()->type == 'service'){
    return [
      'shipping_way' => 'nullable|in:quick_way,posting_way,person_way',
      'payment_method' => 'required|in:cash_payment,online_payment',
      'new_address' => 'nullable|min:1|max:120|string||regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
      'city' => 'nullable|min:1|max:20|regex:/^[\pL\s\-]+$/u',
      'province' => 'nullable|min:1|max:40|regex:/^[\pL\s\-]+$/u',
      'address' => 'nullable|min:1|max:400|string|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u'
    ];
  }
  else{
    return [
      'shipping_way' => 'nullable|in:quick_way,posting_way,person_way',
      'payment_method' => 'in:cash_payment,online_payment',
      'new_address' => 'nullable|min:1|max:120|string|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
      'city' => 'nullable|min:1|max:20|regex:/^[\pL\s\-]+$/u',
      'province' => 'nullable|min:1|max:20|regex:/^[\pL\s\-]+$/u',
      'address' => 'nullable|min:1|max:400|string|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u'
    ];
  }
    }
}
