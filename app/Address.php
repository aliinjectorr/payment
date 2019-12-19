<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];


  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
