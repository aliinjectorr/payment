<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopContact extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
      protected $guarded = ['id'];

      public function shop()
     {
         return $this->belongsTo('App\Shop');
     }
      public function province()
     {
         return $this->belongsTo('App\Province');
     }
}
