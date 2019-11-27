<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];
  protected $casts = ['icon' => 'array'];

  public function shop()
  {
      return $this->belongsTo('App\Shop');
  }
  public function products()
  {
      return $this->hasMany('App\Product');
  }

}
