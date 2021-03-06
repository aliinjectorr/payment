<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;



class Voucher extends Model
{
  use SoftDeletes, CascadeSoftDeletes;
  protected $cascadeDeletes = ['userVouchers'];

    protected $casts = ['users' => 'array'];
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function userVouchers()
  {
       return $this->hasMany('App\UserVoucher');
   }
}
