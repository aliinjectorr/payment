@extends('app.shop.2.layouts.master')
@section('headerScripts')
  <link href="/app/shop/1/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/app/shop/1/assets/css/style.css" rel="stylesheet" type="text/css">
  <style media="screen">
    .fa-address-card{
          margin-left: .5rem!important;
          margin-right: 0!important;
    }
  </style>
@endsection
@section('content')
  <div>
      @if($errors->any())
          <div class="alert alert-danger p-5">
              <p><strong>متاسفانه خطایی پیش آمده:</strong></p>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
  </div>
  <div class="row p-5">
      <div class="col-lg-12">
          <div class="card">
              @if(isset($products))

              <div class="card-body font-18">
                  <h4 class="header-title mt-0">{{ __('app-shop-1-cart.cart') }}</h4>
                  <p class="mb-4 text-muted">{{ __('app-shop-1-cart.cartDesc') }}.</p>
                  <div class="table-responsive shopping-cart">
                      <table class="table mb-0">
                          <thead>
                              <tr>
                                  <th>{{ __('app-shop-1-cart.cartTableItem1') }}</th>
                                  <th>{{ __('app-shop-1-cart.cartTableItem2') }}</th>
                                  <th>{{ __('app-shop-1-cart.cartTableItem3') }}</th>
                                  <th>{{ __('app-shop-1-cart.cartTableItem4') }}</th>
                                  <th>خصوصیت محصول</th>
                                  <th>{{ __('app-shop-1-cart.cartTableItem5') }}</th>
                              </tr>
                          </thead>
                          <tbody class="">
                              <form action="{{ route('purchase-list',['shop'=>$shop->english_name, 'userID' => \Auth::user()->id]) }}" method="post">
                                  @csrf
                                  @foreach ($cart->cartProduct as $cartProduct)
                                  <tr>
                                      <td><img src="{{ asset($cartProduct->product->image['80,80'] ? $cartProduct->product->image['80,80'] : '/images/no-image.png') }}" alt="" height="52">
                                          <p class="d-inline-block align-middle mb-0"><a href="{{ route('product', ['shop'=>$cartProduct->product->shop->english_name, 'slug'=>$cartProduct->product->slug, 'id' => $cartProduct->product->id]) }}" target="_blank"
                                                class="d-inline-block align-middle mb-0 product-name">{{ $cartProduct->product->title }}</a>
                                              <br><span class="text-muted font-13">{{ !$cartProduct->color ? '' : $cartProduct->color->name}}</span></p>
                                      </td>
                                      <td>{{ number_format($cartProduct->product->price) }} {{ __('app-shop-1-cart.tooman') }} </td>
                                      <td>
                                          @if(isset($discountedPrice)){{ number_format($voucherDiscount) }} @elseif($cartProduct->product->off_price != null and $cartProduct->product->off_price_started_at < now() and $cartProduct->product->off_price_expired_at > now())
                                             {{ number_format($cartProduct->product->price-$cartProduct->product->off_price)}}
                                          @else
                                            0
                                              @endif
                                      </td>
                                      <td>
                                          <select class="form-control p-1" style="width: 65px;" autocomplete="off" tabindex="-1" name="{{ $cartProduct->product->id }}-{{ $cartProduct->id }}">
                                            @if($cartProduct->product->type == 'product' && $cartProduct->product->amount == null)
                                              @if($cartProduct->product->color_amount_status == 'enable' and $cartProduct->product->specification_amount_status == 'disable')
                                              @for ($i=1; $i <= $cartProduct->product->colors->where('id', $cartProduct->color->id)->first()->pivot->amount / $cart->cartProduct->count(); $i++)
                                                <option @if($cartProduct->product->carts()->where('user_id' , \auth::user()->id)->first()->cartProduct->where('product_id' , $cartProduct->product->id)->first()->quantity == $i) selected @endif value="{{ $i }}">
                                                    {{ $i }}
                                                  </option>

                                                  @endfor
                                              @elseif($cartProduct->product->specification_amount_status == 'enable' and $cartProduct->product->color_amount_status == 'disable')
                                                @php
                                                $minAmount = $specificationItems->where('id', $cartProduct->specification[0])->unique('id')->first()->productSpecificationItems->where('product_id', $cartProduct->product->id)->first()->amount;
                                                @endphp
                                                @foreach($cartProduct->specification as $specificationId)
                                                  @foreach($specificationItems->where('id', $specificationId)->unique('id') as $specificationItem)
                                                   @php
                                                   if($specificationItem->productSpecificationItems->where('product_id', $cartProduct->product->id)->first()->amount < $minAmount)
                                                     $minAmount = $specificationItem->productSpecificationItems->where('product_id', $cartProduct->product->id)->first()->amount;
                                                   @endphp
                                                     <br>
                                                  @endforeach
                                                @endforeach
                                              @for ($i=1; $i <= $minAmount / $cart->cartProduct->count(); $i++)
                                                <option @if($cartProduct->product->carts()->where('user_id' , \auth::user()->id)->first()->cartProduct->where('product_id' , $cartProduct->product->id)->first()->quantity == $i) selected @endif value="{{ $i }}">
                                                    {{ $i }}
                                                  </option>
                                                  @endfor
                                                @elseif ($cartProduct->product->specification_amount_status == 'enable' and $cartProduct->product->color_amount_status == 'enable')
                                                  @php
                                                  $colorMinAmount = $cartProduct->product->colors->where('id', $cartProduct->color->id)->first()->pivot->amount;
                                                  $specificationMinAmount = $specificationItems->where('id', $cartProduct->specification[0])->unique('id')->first()->productSpecificationItems->where('product_id', $cartProduct->product->id)->first()->amount;
                                                  @endphp
                                                  @foreach($cartProduct->specification as $specificationId)
                                                    @foreach($specificationItems->where('id', $specificationId)->unique('id') as $specificationItem)
                                                     @php
                                                     if($specificationItem->productSpecificationItems->where('product_id', $cartProduct->product->id)->first()->amount < $specificationMinAmount)
                                                       $specificationMinAmount = $specificationItem->productSpecificationItems->where('product_id', $cartProduct->product->id)->first()->amount;
                                                     @endphp
                                                    @endforeach
                                                  @endforeach
                                                  @php
                                                  if($colorMinAmount < $specificationMinAmount){
                                                  $theMostMinAmount = $colorMinAmount;
                                                  $theMostMinAmount = $theMostMinAmount / $cart->cartProduct->count();
                                                  if($theMostMinAmount < 1){
                                                    $theMostMinAmount = 1;
                                                  }
                                                  }
                                                  else{
                                                  $theMostMinAmount = $specificationMinAmount;
                                                  $theMostMinAmount = $theMostMinAmount;
                                                  if($theMostMinAmount < 1){
                                                    $theMostMinAmount = 1;
                                                  }
                                                  }
                                                  @endphp
                                                  @for ($i=1; $i <= $theMostMinAmount; $i++)
                                                    <option @if($cartProduct->product->carts()->where('user_id' , \auth::user()->id)->first()->cartProduct->where('product_id' , $cartProduct->product->id)->first()->quantity == $i) selected @endif value="{{ $i }}">
                                                        {{ $i }}
                                                      </option>

                                                      @endfor
                                            @endif
                                          @else
                                            @for ($i=1; $i <= $cartProduct->product->amount / $cart->cartProduct->count(); $i++)
                                              <option @if($cartProduct->product->carts()->where('user_id' , \auth::user()->id)->first()->cartProduct->where('product_id' , $cartProduct->product->id)->first()->quantity == $i) selected @endif value="{{ $i }}">
                                                  {{ $i }}
                                                </option>

                                                @endfor
                                              @endif

                                          </select>

                                      </td>
                                      <td>

                                      @if ($cartProduct->specification != null)
                                      @foreach($cartProduct->specification as $specificationId)
                                        @foreach($specificationItems->where('id', $specificationId)->unique('id') as $specificationItem)
                                        {{ $specificationItem->specification->name }} :  {{ $specificationItem->name }} <br>
                                        @endforeach
                                      @endforeach
                                    @endif

                                    </td>

                                      <td>
                                          <a href="" class="text-danger" id="removeProduct" data-color="{{  !$cartProduct->color ? null : $cartProduct->color->id }}"  data-cart="{{ \Auth::user()->cart()->get()->first()->id }}" data-id="{{ $cartProduct->product->id }}" data-cartp="{{ $cartProduct->id }}"><i class="fa fa-trash font-18"></i></a>
                                      </td>
                                  </tr>
                                  @endforeach

                          </tbody>
                      </table>
                  </div>
                  <div class="d-flex input-group-append justify-content-end">
                      <button type="submit" class="btn btn-blue mt-4 text-white rounded">{{ __('app-shop-1-cart.sabtVaEdame') }}</button>
                      </form>

                  </div>

                  <!--end row-->
              </div>
              @else

              <h4 class="d-flex justify-content-center p-4">{{ __('app-shop-1-cart.noProduct') }}</h4>

              @endif

              <!--end card-->
          </div>
          <!--end card-body-->
      </div>
      <!--end col-->
  </div>
@endsection
@section('footerScripts')
@endsection
