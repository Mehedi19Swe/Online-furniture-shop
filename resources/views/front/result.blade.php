@extends('front.layout.master')
@section('content')

    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-item" style="background-image: url('style/images/1.jpg');">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">Various Company Furniture Products</h1>
                            <h2 class="subheading mb-4">Choice your furniture products</h2>

                        </div>

                    </div>
                </div>
            </div>

            <div class="slider-item" style="background-image: url('style/images/2.jpg');">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-sm-12 ftco-animate text-center">
                            <h1 class="mb-2">Various Company Furniture Products</h1>
                            <h2 class="subheading mb-4">Choice your furniture products</h2>

                        </div>

                    </div>
                </div>
            </div>
            <div class="slider-item" style="background-image: url('style/images/3.jpg');">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-sm-12 ftco-animate text-center">
                            <h1 class="mb-2">Various Company Furniture Products</h1>
                            <h2 class="subheading mb-4">Choice your furniture products</h2>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section mb-10 pb-5">
        <div class="container">
            <!-- Default search bars with input group -->
            <div class="row justify-content">
                <form action="{{route('product.search')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="input-group mb-5">
                        <select name="category">
                            <option value="0">Select Category</option>
                            @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <input type="search" name="content" placeholder="Search Product..."
                               aria-describedby="button-addon5" class="form-control">
                        <div class="input-group-append">
                            <button id="button-addon6" type="submit" class="btn btn-primary"><i class="fa
                    fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End -->
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Featured Products</span>
                    <h2 class="mb-4">Our Products</h2>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach($product as $item)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="/singleProduct/{{$item->id}}" class="img-prod"><img class="img-fluid"
                                                                                         src="/images/{{$item->image}}"
                                                                                         alt="Colorlib Template">

                                @foreach($discount as $dis)
                                    @if($item->id == $dis->product)
                                        <span class="status">{{$dis->discount}}%</span>
                                        <div class="overlay bg-success"></div>
                                    @endif
                                @endforeach
                            </a>
                            <div>
                                @foreach($stock as $stk)
                                    @if($item->id == $stk->product)
                                        <?php $a = 1; ?>
                                        @break
                                    @else
                                        <?php $a = 0; ?>
                                    @endif
                                @endforeach
                                @if($a !=1)
                                    <span style="background-color: darkred; color: whitesmoke; width: 400px; padding: 6px;">Out of Stock</span>
                                @endif
                            </div>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="/singleProduct/{{$item->id}}">{{$item->name}}</a></h3>
                                <h3><a href="/singleProduct/{{$item->id}}"><b>{{$item->company}}</b></a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        @foreach($discount as $dis)
                                            @if($item->id == $dis->product)
                                                <p class="price"><span class="mr-2
												price-dc">${{$item->price}}</span><span
                                                            class="price-sale">${{$dis->newPrice}}</span></p>
                                                <?php $a = 1; ?>
                                                @break
                                            @else
                                                <?php $a = 0; ?>
                                            @endif
                                        @endforeach

                                        @if($a != 1)
                                            <p class="price"><span class="price-sale">{{$item->price}}{{$item->id}}</span></p>
                                        @endif

                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{route('addTo_cart',$item->id)}}"
                                           class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span title="Add to Cart"><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a href="#"
                                           class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span title="Order Now"><i class="ion-ios-browsers"></i></span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="pagination">
            {!! $product->render("pagination::bootstrap-4") !!}
        </div>

        </div>
    </section>

    <hr>

    <section class="ftco-section ftco-partner">
        <div class="container">
            <div class="row">
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{asset('style/images/partner-1.png')}}" class="img-fluid"
                                                     alt="Colorlib Template"></a>
                </div>
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{asset('style/images/partner-2.png')}}" class="img-fluid"
                                                     alt="Colorlib Template"></a>
                </div>
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{asset('style/images/partner-3.png')}}" class="img-fluid"
                                                     alt="Colorlib Template"></a>
                </div>

                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{asset('style/images/partner-5.png')}}" class="img-fluid"
                                                     alt="Colorlib Template"></a>
                </div>
            </div>
        </div>
    </section>



@endsection

