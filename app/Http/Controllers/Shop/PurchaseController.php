<?php

namespace App\Http\Controllers\Shop;

use App\Shop;
use App\Product;
use App\Voucher;
use App\UserPurchase;
use App\Cart;
use Illuminate\Http\Request;
use Request as RequestFacade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\SEOTools;

class PurchaseController extends Controller
{
  public function approved($shopName, $productId, Request $request) {
    $shop = Shop::where('english_name', $shopName)->first();
    $product = Product::where('id', $productId)->get()->first();
    $shopCategories = $shop->ProductCategories()->get();
    $total_price = \Auth::user()->cart()->get()->first()->total_price;
    $cart = \Auth::user()->cart()->get()->first()->id;
    $voucher = Voucher::where('code' , $request->code)->get()->first();
    $userID = \Auth::user()->id;
    $userVoucherName =  \Auth::user()->firstName .' '.   \Auth::user()->lastName . '-' . \Auth::user()->email;
      if (Voucher::where([['code', $request->code], ['status', 1], ['expires_at', '>', now() ], ['starts_at', '<', now() ], ])->get()->first() == null) {
          $productsID = [];
          $quantity = [];
          $productTotal_price = [];
          foreach (DB::table('cart_product')->where('cart_id', '=', $cart)->get() as $a) {
              $productsID[] = $a->product_id;
              $quantity[] = $a->quantity;
              $productTotal_price[] = $a->total_price;
          }
          $products = [];
          foreach ($productsID as $productID) {
              $product = Product::where('id', $productID)->get()->first();
              $products[] = $product;
          }
          alert()->error('کد تخفیف شما معتبر نیست.', 'خطا');

          $template_folderName = $shop->template->folderName;

          return view("app.shop.$template_folderName.purchase-list", compact('shop', 'shopCategories', 'product', 'products', 'quantity', 'productTotal_price', 'total_price'));
      }
      if (Voucher::where([['code', $request->code], ['status', 1], ['expires_at', '>', now() ], ['starts_at', '<', now() ], ])->get()->first()->shop_id == Shop::where('english_name', $shopName)->get()->first()->id) {
        if(Voucher::where([['code', $request->code], ['status', 1], ['expires_at', '>', now() ], ['starts_at', '<', now() ], ])->get()->first()->users == null){
          $productsID = [];
          $quantity = [];
          $productTotal_price = [];
          foreach (DB::table('cart_product')->where('cart_id', '=', $cart)->get() as $a) {
              $productsID[] = $a->product_id;
              $quantity[] = $a->quantity;
              $productTotal_price[] = $a->total_price;
          }
          $products = [];
          foreach ($productsID as $productID) {
              $product = Product::where('id', $productID)->get()->first();
              $products[] = $product;
          }
          $cartTotalPrice = \Auth::user()->cart()->get()->first()->total_price;
          $voucherDiscount = Voucher::where('code', $request->code)->get()->first()->discount_amount;
          $discountedPrice = $cartTotalPrice - $voucherDiscount;
          Session::put( \Auth::user()->id .'-'. $shop->english_name, $discountedPrice);
          Session::put('voucher_code', $request->code);
          alert()->success('کد تخفیف شما باموفقیت اعمال شد.', 'ثبت شد');
          $template_folderName = $shop->template->folderName;

          return view("app.shop.$template_folderName.purchase-list", compact('shop', 'shopCategories', 'product', 'discountedPrice', 'voucherDiscount', 'products', 'quantity', 'productTotal_price', 'total_price'));
        }
        else{
          $voucherId = Voucher::where('code', $request->code)->get()->first()->id;
          if(collect($this->getVochersUsers($voucherId))->contains($userVoucherName)){
            $productsID = [];
            $quantity = [];
            $productTotal_price = [];
            foreach (DB::table('cart_product')->where('cart_id', '=', $cart)->get() as $a) {
                $productsID[] = $a->product_id;
                $quantity[] = $a->quantity;
                $productTotal_price[] = $a->total_price;
            }
            $products = [];
            foreach ($productsID as $productID) {
                $product = Product::where('id', $productID)->get()->first();
                $products[] = $product;
            }
            $cartTotalPrice = \Auth::user()->cart()->get()->first()->total_price;
            $voucherDiscount = Voucher::where('code', $request->code)->get()->first()->discount_amount;
            $discountedPrice = $cartTotalPrice - $voucherDiscount;
            Session::put(\Auth::user()->id .'-'. $shop->english_name, $discountedPrice);
            Session::put('voucher_code', $request->code);
            alert()->success('کد تخفیف شما باموفقیت اعمال شد.', 'ثبت شد');
            $template_folderName = $shop->template->folderName;

            return view("app.shop.$template_folderName.purchase-list", compact('shop', 'shopCategories', 'product', 'discountedPrice', 'voucherDiscount', 'products', 'quantity', 'productTotal_price', 'total_price'));
          }
          else{
            alert()->error('کد تخفیف شما معتبر نیست.', 'خطا');
            return redirect()->back();
          }
        }
      } else {
          alert()->error('کد تخفیف شما معتبر نیست.', 'خطا');
          return redirect()->back();
      }
  }


      public function purchaseList($shop, Request $request) {
        $cart = \Auth::user()->cart()->get()->first()->id;
        $productsID = [];
        foreach(DB::table('cart_product')->where('cart_id', '=', $cart)->get() as $a){
          $productsID[] = $a->product_id;
        }
          if (\Auth::guest()) {
              return redirect()->route('register');
          } else {
              $cart = \Auth::user()->cart()->get()->first()->id;
              foreach ($productsID as $productID) {
                if (Product::where('id', $productID)->get()->first()->off_price == null) {
                  $singleProductPrice = Product::where('id', $productID)->get()->first()->price;
                }
                else{
                  $singleProductPrice = Product::where('id', $productID)->get()->first()->off_price;
                }

                if(RequestFacade::server('HTTP_REFERER') !== route('purchase-list',['shop'=>$shop, 'userID' => \Auth::user()->id])){
                    $quantity = DB::table('cart_product')->where([['cart_id', '=', $cart], ['product_id', '=', $productID]])->update(['quantity' => $request->except('_token') [$productID], 'total_price' => $singleProductPrice * $request->except('_token') [$productID]]);
                }
              }
              $total_price = \Auth::user()->cart()->get()->first()->total_price;
              $cart = \Auth::user()->cart()->get()->first()->id;
              $productsID = [];
              $quantity = [];
              $productTotal_price = [];
              foreach(DB::table('cart_product')->where('cart_id', '=', $cart)->get() as $a){
               $productsID[] = $a->product_id;
               $quantity[] = $a->quantity;
               $productTotal_price[] = $a->total_price;
              }
             $products = [];
             foreach ($productsID as $productID) {
                 $product = Product::where('id', $productID)->get()->first();
                 $products[] = $product;
             }
                  $total_price = array_sum($productTotal_price);
                  $cartUpdate = \Auth::user()->cart()->get()->first()->update([
                  'total_price' => $total_price,
                  ]);
              $shop = Shop::where('english_name', $shop)->first();
              $shopCategories = $shop->ProductCategories()->get();
              $template_folderName = $shop->template->folderName;
              return view("app.shop.$template_folderName..purchase-list", compact('shop', 'shopCategories', 'products', 'quantity', 'productTotal_price','total_price'));
          }
      }


      public function purchaseSubmit($shop, $cartID, Request $request) {
          $total_price = \Auth::user()->cart()->get()->first()->total_price;
          $cart = \Auth::user()->cart()->get()->first()->id;
          $productsID = [];
          $quantity = [];
          $productTotal_price = [];
          foreach (DB::table('cart_product')->where('cart_id', '=', $cart)->get() as $a) {
              $productsID[] = $a->product_id;
              $quantity[] = $a->quantity;
              $productTotal_price[] = $a->total_price;
          }
          $products = [];
          foreach ($productsID as $productID) {
              $product = Product::where('id', $productID)->get()->first();
              $products[] = $product;
          }
          $cart = Cart::where('id', $cartID)->get()->first();
          $shopId = Shop::where('english_name', $shop)->get()->first()->id;
          if (!isset($request->address)) {
              $request->validate(['new_address' => 'required']);
          } else {
              $request->validate(['address' => 'required']);
          }
          if (isset(\Auth::user()->userInformation()->get()->first()->address)) {
              $userAddress1 = \Auth::user()->userInformation()->get()->first()->address;
          }
          if (isset(\Auth::user()->userInformation()->get()->first()->address_2)) {
              $userAddress2 = \Auth::user()->userInformation()->get()->first()->address_2;
          }
          if (isset(\Auth::user()->userInformation()->get()->first()->address_3)) {
              $userAddress3 = \Auth::user()->userInformation()->get()->first()->address_3;
          }
          $purchase = new UserPurchase;
          $purchase->cart_id = $cartID;
          $purchase->user_id = \Auth::user()->id;
          $purchase->shop_id = $shopId;
          if ($request->new_address == null) {
              if ($request->address == "address_1") {
                  $purchase->address = $userAddress1;
              } elseif ($request->address == "address_2") {
                  $purchase->address = $userAddress2;
              } elseif ($request->address == "address_3") {
                  $purchase->address = $userAddress3;
              }
          } else {
              $purchase->address = $request->new_address;
          }
          $purchase->shipping = $request->shipping_way;
          $shop = Shop::where('english_name', $shop)->first();

          if (Session::get(\Auth::user()->id .'-'. $shop->english_name) == null) {

            if($shop->VAT == 'enable') {
              $purchase->total_price = (\Auth::user()->cart()->get()->first()->total_price) + (\Auth::user()->cart()->get()->first()->total_price * $shop->VAT_amount / 100);
            }
            else{
              $purchase->total_price = \Auth::user()->cart()->get()->first()->total_price;
            }
          }
          else {
            $voucher = Voucher::where('code' , Session::get('voucher_code'))->get()->first();
            if($shop->VAT == 'enable') {
              $purchase->total_price = (Session::get(\Auth::user()->id .'-'. $shop->english_name)) + (Session::get(\Auth::user()->id .'-'. $shop->english_name) * $shop->VAT_amount / 100);
            }
            else{
              $purchase->total_price = Session::get(\Auth::user()->id .'-'. $shop->english_name);
            }
          }
          $purchase->save();
          // the only way that store data in pivot table to find that which user use which voucher in which shop is this if statement
          if(isset($voucher)){
            DB::table('user_vouchers')->insert(['user_id' => \Auth::user()->id, 'voucher_id' => $voucher->id, 'user_purchase_id' => $purchase->id, 'shop_id' => $shop->id]);
            Session::pull('voucher_code', $request->code);
          }
          Session::pull(\Auth::user()->id .'-'. $shop->english_name);
          DB::table('carts')->where('id', '=', \Auth::user()->cart()->get()->first()->id)->update(['status' => 1]);
          Cart::where('id', \Auth::user()->cart()->get()->first()->id)->get()->first()->delete();
          alert()->success('خرید شما با موفقیت ثبت شد', 'تبریک');
          SEOTools::setTitle($shop->name);
          SEOTools::setDescription($shop->description);
          SEOTools::opengraph()->addProperty('type', 'website');
          return redirect()->route('user.purchased.list', ['userID' => \auth::user()->id]);
      }


          public function getVochersUsers($id){
          $shop = Shop::where('english_name', RequestFacade::segment(1))->get()->first();
          $users = $shop->vouchers()->where('id' , $id)->get()->first()->users;
          return $users;
          }
}