@yield('headerStyles')


        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>پایان پی - داشبورد اصلی</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="پایان پی - داشبورد اصلی" name="description">
    <meta name="author" content="Setareh Nooran Co. Ali Rahmani">
    <!-- App favicon -->
    <link href="/dashboard/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <!-- App css -->
    <link href="/dashboard/assets/css/jquery.steps.css" rel="stylesheet" type="text/css">
    <link href="/dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/dashboard/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/dashboard/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="/dashboard/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="/dashboard/assets/css/custom.css" rel="stylesheet" type="text/css">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <style>
        .main-icon-menu{
            overflow: scroll!important;
        }
        .dataTables_info{
            font-family: BYekan!important;
        }
        .custom-select{
            font-family: BYekan!important;
        }
        .page-link{
            font-family: BYekan!important;
        }
    </style>
</head>

<body>@section('content')
<link href="/dashboard/assets/css/dropify.min.css" rel="stylesheet" type="text/css">

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "> دسته بندی </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">فروشگاه</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ $shop->name }}</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>

        {{--  <div class="text-right">
            <a href="#" data-toggle="modal" data-target="#AddProductCategoryModal" class="btn btn-primary text-white d-inline-block text-right mb-3 font-weight-bold"><i class="fa fa-plus mr-2"></i>اضافه کردن دسته بندی</a>
        </div>
  --}}

        @include('dashboard.layouts.errors')

        <div class="modal fade bd-example-modal-xl" id="AddProductCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">افزودن خدمت جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-scroll">
                        <form action="{{ route('product-category.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="form-group mb-0">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend"><span class="input-group-text bg-light min-width-140" id="basic-addon7">عنوان دسته بندی :</span></div>
                                    <input type="text" class="form-control inputfield" name="name" placeholder="مثال: ورزشی">
                                </div>

                                <div class="input-group mt-3">
                                    <div class="input-group-prepend"><span class="input-group-text bg-light min-width-140" id="basic-addon7">توضیحات دسته بندی :</span></div>
                                    <input type="text" class="form-control inputfield" name="description" placeholder="مثال: توضیحات مختصری درمورد دسته بندی">
                                </div>
                            </div>
                            <!--end form-group-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ثبت درخواست</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>
@if($lastProducts->count() == 0)
<div class="d-flex justify-content-center align-items-center" style="height:80vh">
<h4>
    هیچ محصولی در این فروشگاه وجود ندارد

</h4>
</div>
@else
        <!-- end page title end breadcrumb -->
         <div class="row">

            @if($lastProducts[0])
                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[0]->id]) }}"><img src="{{ $lastProducts[0]->image }}" alt="" class="img-fluid"></a>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title">{{ $lastProducts[0]->title }}</a>
                                <div class="d-flex justify-content-between my-2 byekan">
                                    <p class="product-price byekan">{{ $lastProducts[0]->price }} تومان  <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif


                    <!--end col-->

                    @if(isset($lastProducts[1]))
                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[1]->id]) }}"><img src="{{ $lastProducts[1]->image }}" alt="" class="img-fluid"></a>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title">{{ $lastProducts[1]->title }}</a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[1]->price }} تومان <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    @endif



                    @if(isset($lastProducts[2]))
                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[2]->id]) }}"><img src="{{ $lastProducts[2]->title }}" alt="" class="img-fluid"></a>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title">{{ $lastProducts[2]->title }}</a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[1]->price }} تومان <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif

                    <!--end col-->
                    @if(isset($lastProducts[3]))
                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[3]->id]) }}"><img src="{{ $lastProducts[3]->image }}" alt="" class="img-fluid"></a>
                            <div class="ribbon ribbon-pink"><span class="byekan">50% تخفیف</span></div>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title"></a>{{ $lastProducts[3]->title }}</a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[3]->price }} تومان <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif

                    <!--end col-->
                </div>
    </div>





    <div class="row">
                <div class="col-12">
                    <div class="card offer-box">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mx-auto">
                                    <div class="offer-content text-center justify-content-center">
                                        <p class="text-muted">پیشنهاد ویژه</p>
                                        <h3 class="mb-3">50% صرفه جویی در هزینه ها</h3>
                                        <hr class="thick">
                                        <h5 class="text-muted iranyekan">با خرید از سامانه آنلاین</h5></div>
                                </div>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>





            <div class="row">
                    @if(isset($lastProducts[4]))

                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[4]->id]) }}"><img src="{{ $lastProducts[4]->image }}" alt="" class="img-fluid"></a>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title"></a> {{ $lastProducts[4]->title }} <small class="text-muted">size-04</small></a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[4]->price }} تومان<span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif

                    <!--end col-->
                    @if(isset($lastProducts[5]))

                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[5]->id]) }}"><img src="{{ $lastProducts[5]->image }}" alt="" class="img-fluid"></a>
                            <div class="ribbon ribbon-secondary"><span>جدید</span></div>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title"></a>{{ $lastProducts[5]->title }}</a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[5]->price }} تومان <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif

                    <!--end col-->

                    @if(isset($lastProducts[6]))

                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[6]->id]) }}"><img src="{{ $lastProducts[6]->image }}" alt="" class="img-fluid"></a>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title">{{ $lastProducts[6]->title }}</a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[6]->price }} تومان <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif

                    <!--end col-->

                    @if(isset($lastProducts[7]))

                    <div class="col-lg-3">
                        <div class="card e-co-product">
                            <a href="{{ route('shop.show.product', ['shop'=>$shop->english_name, 'id'=>$lastProducts[7]->id]) }}"><img src="{{ $lastProducts[7]->image }}" alt="" class="img-fluid"></a>
                            <div class="card-body product-info"><a href="/dashboard/product-detail" class="product-title">{{ $lastProducts[7]->title }}</a>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="product-price byekan">{{ $lastProducts[7]->price }} تومان <span class="ml-2 byekan"></span></p>

                                </div>
                                <button class="btn btn-cart btn-sm waves-effect waves-light iranyekan"><i class="mdi mdi-cart mr-1"></i> اضافه کردن به سبد خرید</button>
                                <button class="btn btn-wishlist btn-sm waves-effect waves-light wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="موردعلاقه"><i class="mdi mdi-heart"></i></button>
                                <button class="btn btn-quickview btn-sm waves-effect waves-light quickview" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش سریع"><i class="mdi mdi-magnify"></i></button>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    @endif

                    <!--end col-->
                </div>
                @endif

    <!-- container -->


    {{--  <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">لیست محصولات</h4>


                    <p class="text-muted mb-4 font-13">لیست تمامی محصولات شما</p>
                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length">
                                    <label>نمایش
                                        <select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> ورودی ها</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="datatable_filter" class="dataTables_filter">
                                    <label class="text-left">جستوجو:
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Product Name: activate to sort column descending" style="width: 405px;">نام
                                                محصول
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 115px;">توضیحات</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 123px;">تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="byekan">
                                        @foreach($categoires as $category)
                                        <tr role="row" class="odd">
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                <a><i class="far fa-edit text-info mr-1 button"></i>
                                                </a>
                                                <a href="" id="ttttt" data-id="{{ $category->id }}" data-test="{{ $category->name }}"><i class="far fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @if ($categoires->count() == 0)
                                  <p class="font-17 text-center font-weight-bold"> دسته بندی وجود ندارد
                                  </p>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"></div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">قبلی</a></li>
                                        <li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">بعدی</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>  --}}
</div>
@endsection


@section('pageScripts')
<script>
    $(document).on('click', '#ttttt', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var test = $(this).data('test');
        $.ajax({
            type: "post",
            url: "{{url('dashboard/product-category/delete')}}",
            data: {
                id: id,
                test: test,
                "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
            },
            success: function(data) {
                var url = document.location.origin + "/dashboard/product-category";
                location.href = url;
            }
        });
    });
</script>
@stop
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @yield('content')

    <!--end row-->
    </div>
    <!-- container -->
    <footer class="footer text-center text-sm-left">&copy; ۱۳۹۸ - کلیه حقوق محفوظ است. <span class="text-muted d-none d-sm-inline-block float-right">طراحی و توسعه در دپارتمان فناوری اطلاعات شرکت فناور ستاره نوران</span></footer>
    <!--end footer-->
</div>
<!-- end page content -->
</div>
<!-- end page-wrapper -->
<!-- jQuery  -->
<script src="/dashboard/assets/js/jquery.min.js"></script>
<script src="/dashboard/assets/js/bootstrap.bundle.min.js"></script>
<script src="/dashboard/assets/js/metisMenu.min.js"></script>
<script src="/dashboard/assets/js/waves.min.js"></script>
<script src="/dashboard/assets/js/jquery.slimscroll.min.js"></script>
<script src="/dashboard/assets/plugins/moment/moment.js"></script>
<script src="/dashboard/assets/plugins/apexcharts/apexcharts.min.js"></script>
<script src="/dashboard/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/dashboard/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/dashboard/assets/pages/jquery.eco_dashboard.init.js"></script>
<script src="/dashboard/assets/js/jquery.form-wizard.init.js"></script>
<script src="/dashboard/assets/js/jquery.steps.min.js"></script>
<!-- App js -->
<script src="/dashboard/assets/js/app.js"></script>
<script src="/dashboard/assets/js/sweetalert.min.js"></script>
@include('sweet::alert')
@yield('pageScripts')

<script>
$(window).on('load', function() {

    // if (window.location.href.indexOf("wallet") == -1) {
    //     $('#PardakhtYari').removeClass("active");
    //     $("a[href$='PardakhtYari']").removeClass("active");
    //
    // }
    // if (window.location.href.indexOf("card") == -1) {
    //     $('#PardakhtYari').removeClass("active");
    //     $("a[href$='PardakhtYari']").removeClass("active");
    // }
    //
    //
    //
    // if (window.location.href.indexOf("wallet") > -1) {
    //     $('#PardakhtYari').addClass("active");
    //     $("a[href$='PardakhtYari']").addClass("active");
    //
    // }
    // if (window.location.href.indexOf("card") > -1) {
    //     $('#PardakhtYari').addeClass("active");
    //     $("a[href$='PardakhtYari']").addClass("active");
    // }



    });

</script>
</body>

</html>