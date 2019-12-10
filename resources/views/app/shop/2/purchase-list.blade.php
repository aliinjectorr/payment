@extends('app.shop.2.layouts.master')

@section('headerScripts')

@endsection

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div id="tt-pageContent" class="d-flex justify-content-center">

    <div class="card col-lg-8 mb-5 mr-16 mt-5 col-md-8 col-sm-12 print-big">

        @include('dashboard.layouts.errors')
        <div class="card-body invoice-head">
            <div class="row">
                <div class="col-md-4 align-self-center">
                    <img src="{{ $shop->logo['200,100'] }}" alt="logo-small" class="logo-sm mr-2" height="26">
                    <p class="mt-2 mb-0 text-muted">{{ $shop->description }}.</p>
                </div>
                <!--end col-->
                <div class="col-md-8">
                    <ul class="list-inline mb-0 contact-detail float-right">
                        <li class="list-inline-item">
                            <div class="pr-3">
                                <i class="mdi mdi-web"></i>
                                <p class="text-muted mb-0">www.modirproje/{{ $shop->english_name }}.com</p>
                                <p class="text-muted mb-0"><br></p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="pr-3">
                                <i class="mdi mdi-phone"></i>
                                <p class="text-muted mb-0">{{ $shop->shopContact->tel }}</p>
                                <p class="text-muted mb-0">{{ $shop->shopContact->phone }}</p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="pr-3">
                                <i class="mdi mdi-map-marker"></i>
                                <p class="text-muted mb-0">{{ $shop->shopContact->city }} {{ $shop->shopContact->province }}</p>
                                <p class="text-muted mb-0">{{ $shop->shopContact->address }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-body-->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="d-flex d-flex justify-content-between">
                        <h6 class="mb-0"><b>تاریخ ثبت فاکتور :</b> {{ jdate() }}</h6>
                        <a href="{{ route('user-cart' , ['shop' => $shop->english_name , 'userID' => \Auth::user()->id]) }}) }}">
                            <button class="btn rounded d-none-print tt-btn-addtocart"><i class="fa fa-undo pl-1"></i>سبد خرید</button>
                        </a>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive project-invoice">
                        <table class="table table-bordered mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th>نام محصول</th>
                                    <th>قیمت واحد کالا</th>
                                    <th> میزان تخفیف</th>
                                    <th>تعداد</th>
                                    <th>قیمت مجموع</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody class="iranyekan font-14">
                                @php $i=0
                                @endphp
                                @php $j=0
                                @endphp
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('product', ['shop'=>$shop->english_name, 'id'=>$product->id]) }}">
                                            <h5 class="mt-0 mb-1">{{ $product->title }}</h5>
                                        </a>
                                    </td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>
                                        @if($product->off_price == null) 0
                                            @else {{ number_format($product->price-$product->off_price)}}
                                            @endif
                                    </td>
                                    <td>{{ $quantity[$i] }}</td>
                                    <td> {{ number_format($productTotal_price[$j]) }} </td>
                                </tr>
                                @php $i++
                                @endphp
                                @php $j++
                                @endphp

                                @endforeach
                                <!--end tr-->
                                <!--end tr-->
                                <tr class="bg-dark text-white">
                                    <th colspan="3" class="border-0"></th>
                                    <td class="border-0 font-14"><b>جمع کل</b></td>
                                    <td>
                                        @if(isset($discountedPrice)) {{number_format($discountedPrice)}}
                                        @else {{ number_format($total_price) }}
                                        @endif</td>
                                </tr>
                                <!--end tr-->
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <div class="col-lg-6 mt-3 mr-lg-n4 d-none-print">
                        <form class="form-inline col-lg-12" action="{{ route('approved',['shop'=>$shop->english_name, 'id'=>$product->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="total_price" value="{{ $total_price }}">
                            <input type="text" name="code" class="border-muted form-control col-lg-6 col-md-12 col-sm-12" placeholder="کد" aria-describedby="button-addon2">
                            <button class="btn tt-btn-addtocart col-lg-6 rounded " type="submit" id="button-addon2">اعمال تخفیف</button>
                        </form>
                    </div>
                    <form action="{{ route('purchase-list.store', ['shop'=>$shop->english_name, 'cartID'=>\Auth::user()->cart()->get()->first()->id]) }}" method="post" class="form-horizontal">
                        @csrf
                        @if($product->type != 'file')
                            <div class="col-lg-6 mt-5 d-none-print">
                                <div class="total-payment">
                                    <h4 class="header-title">مجموع پرداختی</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="payment-title border-bottom-0">قیمت کل :</td>
                                                <td class="border-bottom-0">
                                                    @if(isset($discountedPrice)) {{number_format($discountedPrice)}}
                                                    @else {{ number_format($total_price) }}
                                                    @endif</td>
                                            </tr>
                                            @if($shop->VAT == 'enable')
                                                <tr>
                                                    <td class="payment-title">مالیات بر ارزش افزوده :</td>
                                                    <td>% 9</td>
                                                </tr>
                                                @endif

                                                <tr>
                                                    <td class="payment-title"> روش ارسال :</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            <li>
                                                                @if($shop->quick_way == 'enable')
                                                                    <div class="radio radio-info">
                                                                        <input type="radio" name="shipping_way" id="quick_way" value="quick_way" checked="checked">
                                                                        <label for="quick_way">ارسال سریع</label>
                                                                    </div>
                                                                    @endif
                                                            </li>
                                                            <li>
                                                                @if($shop->posting_way == 'enable')
                                                                    <div class="radio radio-info mt-2">
                                                                        <input type="radio" name="shipping_way" id="posting_way" value="posting_way">
                                                                        <label for="posting_way">ارسال پستی</label>
                                                                    </div>
                                                                    @endif
                                                                    @if($shop->person_way == 'enable')
                                                                        <div class="radio radio-info mt-2">
                                                                            <input type="radio" name="shipping_way" id="person_way" value="person_way">
                                                                            <label for="person_way">دریافت حضوری</label>
                                                                        </div>
                                                                        @endif
                                                            </li>
                                                            <li class="mt-2 "><span class=" showAddresses btn tt-btn-addtocart font-weight-bolder">انتخاب آدرس
                                                                </span>
                                                            </li>
                                                            <li>
                                                                @if(isset(\auth::user()->userInformation()->get()->first()->address))
                                                                    <div class="radio radio-info mt-3 d-none address_1">
                                                                        <input type="radio" name="address" id="address_1" value="address_1" checked>
                                                                        <label class="min-width-100-fix" for="address_1">{{ \auth::user()->userInformation()->get()->first()->address }}</label>
                                                                    </div>
                                                                    @endif
                                                                    @if(isset(\auth::user()->userInformation()->get()->first()->address_2))
                                                                        <div class="radio radio-info mt-3 d-none address_2">
                                                                            <input type="radio" name="address" id="address_2" value="address_2">
                                                                            <label class="min-width-100-fix" for="address_2">{{ \auth::user()->userInformation()->get()->first()->address_2 }}</label>
                                                                        </div>
                                                                        @endif
                                                                        @if(isset(\auth::user()->userInformation()->get()->first()->address_3))
                                                                            <div class="radio radio-info mt-3 d-none address_3">
                                                                                <input type="radio" name="address" id="address_3" value="address_3">
                                                                                <label class="min-width-100-fix" for="address_3">{{ \auth::user()->userInformation()->get()->first()->address_3 }}</label>
                                                                            </div>
                                                                            @endif
                                                            </li>
                                                            <span class="btn tt-btn-addtocart font-weight-bolder d-none newAddress mt-3"><i class="fa fa-plus mr-2"></i> اضافه کردن آدرس
                                                            </span>
                                                            <li class="col-lg-12 address_input d-none">
                                                                <textarea class="form-control mt-3" name="new_address" id="" cols="90" rows="5" placeholder="در صورت تمایل به ارسال به آدرس جدید لطفا آدرس مورد نظر را در کادر زیر وارد کنید"></textarea>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="payment-title font-weight-bolder">مبلغ قابل پرداخت :</td>
                                                    <td>
                                                        @if(isset($discountedPrice))
                                                        @if($shop->VAT == 'enable') {{ number_format(($discountedPrice) + ($discountedPrice * $shop->VAT_amount / 100)) }}
                                                            @else {{ number_format($discountedPrice) }}
                                                            @endif
                                                            @else
                                                            @if($shop->VAT == 'enable') {{ number_format(($total_price) + ($total_price * $shop->VAT_amount / 100))  }}
                                                                @else {{ number_format($total_price) }}
                                                                @endif
                                                                @endif</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            <!--end /div-->
                </div>
                <div class="col-12 justify-content-between mt-5 d-none printable">
                    <div class="">
                        محل امضای فروشنده
                    </div>
                    <div class="">
                        محل امضای مشتری
                    </div>
                </div>
                <div class="d-lg-flex col-lg-12 justify-content-end d-none-print">
                    <div class="mt-4">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button type="submit" class="btn tt-btn-addtocart  mt-4">ثبت فاکتور</button>
                                </form>
                                <button onclick="myFunction()" class="btn tt-btn-addtocart text-white mt-4 mr-2">چاپ فاکتور</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
        <!--end row-->
        <!--end row-->
        <!--end row-->
    </div>

</div>

@endsection

@section('footerScripts')
<script>
    function myFunction() {
        window.print();
    }
</script>
<script>
    $(document).ready(function() {
        $(".showAddresses").click(function() {
            $(".address_1").removeClass("d-none");
            $(".address_2").removeClass("d-none");
            $(".address_3").removeClass("d-none");
            $(".newAddress").removeClass("d-none");
            $(".showAddresses").addClass("d-none");
            $(".address_input").addClass("d-none");
        });
    });
    $(document).ready(function() {
        $(".newAddress").click(function() {
            $(".address_input").removeClass("d-none");
            $(".newAddress").addClass("d-none");
            $(".address_1").addClass("d-none");
            $(".address_2").addClass("d-none");
            $(".address_3").addClass("d-none");
            $(".showAddresses").removeClass("d-none");

        });
    });
</script>
@endsection
