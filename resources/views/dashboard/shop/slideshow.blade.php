@extends('dashboard.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">اسلایدر</li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">فروشگاه</a></li>
                        </ol>
                    </div>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <div class="text-right">
            <a href="#" data-toggle="modal" data-target="#AddProductCategoryModal" class="btn btn-primary text-white d-inline-block text-right mb-3 font-weight-bold rounded"><i class="fa fa-plus mr-2"></i>اضافه کردن اسلاید</a>
        </div>
        @include('dashboard.layouts.errors')
        <div class="modal fade bd-example-modal-xl" id="AddProductCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">افزودن اسلاید جدید</h5>
                        <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                        <form action="{{ route('slideshow.store', ['continue' => 1, 'shop' => $shop->english_name]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-0">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">عنوان اسلاید :</span></div>
                                    <textarea class="form-control" id="title" name="title">{{ old('title') }}</textarea>
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">توضیحات اسلاید :</span></div>
                                    <textarea class="form-control" id="description" name="description">{{ old('title') }}</textarea>
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">آدرس صفحه اسلاید :</span></div>
                                    <input type="text" class="form-control inputfield" value="{{ old('url') }}" name="url" placeholder="مثال: /product ">
                                </div>
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title"><i
                                           class="fas fa-star required-star mr-1"></i>عکس اسلاید</h4>
                                        <input type="file" id="input-file-now" name="image" class="dropify">
                                    </div>
                                </div>
                            </div>
                            <!--end form-group-->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger rounded" data-dismiss="modal">انصراف</button>
                        <div class="group">
                            <button type="submit" name="action" value="justSave" class="btn btn-primary rounded">ثبت درخواست</button>
                            <button type="submit" name="action" value="saveAndContinue" class="btn btn-primary rounded">ثبت درخواست و ادامه </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($slideshows as $slideshow)
        <div class="modal fade bd-example-modal-xl" id="UpdateProductCategoryModal{{ $slideshow->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویرایش دسته بندی</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                        <form action="{{ route('slideshow.update', ['id' => $slideshow->id ,'shop' => $shop->english_name]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group mb-0">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">عنوان اسلاید :</span></div>
                                    <textarea class="form-control" id="titleEdit{{ $slideshow->id }}" name="title">{{ old('title', $slideshow->title) }}</textarea>
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">توضیحات اسلاید :</span></div>
                                    <textarea class="form-control" id="descriptionEdit{{ $slideshow->id }}" name="description">{{ old('description', $slideshow->description) }}</textarea>

                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">آدرس اسلاید :</span></div>
                                    <input type="text" class="form-control inputfield" name="url" value="{{ old('url', $slideshow->url) }}">
                                </div>
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title"><i
                                           class="fas fa-star required-star mr-1"></i>عکس اسلاید</h4>
                                        <input type="file" id="input-file-now" name="image" class="dropify" data-default-file="{{ $slideshow->image['original'] }}">
                                    </div>
                                </div>
                            </div>
                            <!--end form-group-->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger rounded" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary rounded">ثبت درخواست</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">لیست اسلایدها </h4>
                        <p class="text-muted mb-4 font-13">لیست تمامی اسلاید های شما</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="searchBox bg-dark"  style="margin-top: -15px;">
                                        <input type="text" id="myInputTextField" class="searchInput">
                                        <button class="searchButton" href="#">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive dataTable no-footer font-16" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid">

                                        <thead>
                                            <tr role="row">
                                                <th style="vertical-align: middle!important;" class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Product Name: activate to sort column descending">شناسه</th>
                                                <th style="vertical-align: middle!important;" class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Product Name: activate to sort column descending">عکس</th>
                                                <th style="vertical-align: middle!important;" class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 205px;">آدرس اسلاید</th>
                                                <th style="vertical-align: middle!important;" class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Product Name: activate to sort column descending" style="width: 15px;">عنوان اسلاید</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 205px;">توضیحات</th>

                                            </tr>
                                        </thead>
                                        <tbody class="iranyekan">
                                          @php
                                            $id = 1;
                                          @endphp
                                            @foreach($slideshows as $slideshow)
                                            <tr role="row" class="odd icon-hover hover-color">
                                                <td style="vertical-align: middle!important;">{{ $id }}</td>
                                                <td style="vertical-align: middle!important;">
                                                  <img src="{{ $slideshow->image['80,80'] }}" class="rounded" alt="">
                                                </td>
                                                <td style="vertical-align: middle!important;">
                                                    {{ $slideshow->url }}
                                                </td>
                                                <td style="vertical-align: middle!important;">{{ $slideshow->title }}</td>
                                                <td style="vertical-align: middle!important;" class="d-flex justify-content-between">
                                                  {{ $slideshow->description }}
                                                    <div class="d-none icon-show">
                                                        <a href="{{ $slideshow->id }}" id="editSlide" title="ویرایش" data-toggle="modal" data-target="#UpdateProductCategoryModal{{ $slideshow->id }}"><i class="far fa-edit text-info mr-1 button font-15"></i>
                                                        </a>

                                                        @if($slideshow->deleted_at != null)
                                                              <a href="" id="restoreSlideshow" title="بازگردانی" data-id="{{ $slideshow->id }}"><i class="fas fa-undo text-success font-15"></i></a>
                                                        @else
                                                        <a href="" id="removeSlide" title="حذف" data-name="{{ $slideshow->title }}" data-id="{{ $slideshow->id }}"><i class="far fa-trash-alt text-danger font-15"></i></a>
                                                         @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                              $id ++
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
    <!-- Attachment Modal -->
    @endsection
    @section('pageScripts')
      <script src="{{ asset('/dashboard/assets/js/admin-slideshow.js') }}"></script>
      <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
      <script type="text/javascript">
         CKEDITOR.replace('description', {
             language: 'fa',
             uiColor: '#F3F6F7'
         });
         CKEDITOR.replace('title', {
             language: 'fa',
             uiColor: '#F3F6F7'
         });
         @foreach($slideshowIds as $slideshowId)
            CKEDITOR.replace('titleEdit'+{{$slideshowId}}, {
             language: 'fa',
             uiColor: '#F3F6F7'
         });
         CKEDITOR.replace('descriptionEdit'+{{$slideshowId}}, {
             language: 'fa',
             uiColor: '#F3F6F7'
         });
       @endforeach

      </script>
      @if(session()->has('flashModal'))
          <script>
              $('#AddProductCategoryModal').modal('show');
          </script>
          @endif
        @stop
