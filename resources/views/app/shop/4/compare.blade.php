@extends('app.shop.4.layouts.master')
@section('content')

    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    {{-- {{ dd($compareProducts) }} --}}
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>

                                    <li class="breadcrumb-item active" aria-current="page">مقایسه محصولات</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- compare main wrapper start -->
        <div class="compare-page-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Compare Page Content Start -->
                            <div class="compare-page-content-wrap">
                                <div class="compare-table table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="first-column">Product</td>
                                                <td class="product-image-title">
                                                    <a href="product-details.html" class="image">
                                                        <img class="img-fluid" src="assets/img/product/product-1.jpg" alt="Compare Product">
                                                    </a>
                                                    <a href="#" class="category">Daimond</a>
                                                    <a href="product-details.html" class="title">Perfect Diamond Jewelry</a>
                                                </td>
                                                <td class="product-image-title">
                                                    <a href="product-details.html" class="image">
                                                        <img class="img-fluid" src="assets/img/product/product-2.jpg" alt="Compare Product">
                                                    </a>
                                                    <a href="#" class="category">Gold</a>
                                                    <a href="product-details.html" class="title">Handmade Golden Necklace</a>
                                                </td>
                                                <td class="product-image-title">
                                                    <a href="product-details.html" class="image">
                                                        <img class="img-fluid" src="assets/img/product/product-3.jpg" alt="Compare Product">
                                                    </a>
                                                    <a href="#" class="category">Ring</a>
                                                    <a href="product-details.html" class="title">Diamond Exclusive Ornament</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Description</td>
                                                <td class="pro-desc">
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
                                                        nulla, explicabo iste a rerum pariatur.</p>
                                                </td>
                                                <td class="pro-desc">
                                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit
                                                        commodi obcaecati cumque consectetur alias incidunt?</p>
                                                </td>
                                                <td class="pro-desc">
                                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius,
                                                        facere. Fuga asperiores inventore iste tempora.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Price</td>
                                                <td class="pro-price">$295</td>
                                                <td class="pro-price">$275</td>
                                                <td class="pro-price">$395</td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Color</td>
                                                <td class="pro-color">Black</td>
                                                <td class="pro-color">Red</td>
                                                <td class="pro-color">Blue</td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Stock</td>
                                                <td class="pro-stock">In Stock</td>
                                                <td class="pro-stock">Stock Out</td>
                                                <td class="pro-stock">In Stock</td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Add to cart</td>
                                                <td><a href="cart.html" class="btn btn-sqr">Add to Cart</a></td>
                                                <td><a href="cart.html" class="btn btn-sqr disabled">Add to Cart</a></td>
                                                <td><a href="cart.html" class="btn btn-sqr">Add to Cart</a></td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Rating</td>
                                                <td class="pro-ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </td>
                                                <td class="pro-ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </td>
                                                <td class="pro-ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="first-column">Remove</td>
                                                <td class="pro-remove">
                                                    <button><i class="fa fa-trash-o"></i></button>
                                                </td>
                                                <td class="pro-remove">
                                                    <button><i class="fa fa-trash-o"></i></button>
                                                </td>
                                                <td class="pro-remove">
                                                    <button><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Compare Page Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- compare main wrapper end -->
    </main>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->
@endsection
