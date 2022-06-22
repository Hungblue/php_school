@extends('layouts.front')

@section('title', $product->name)

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Đánh giá {{ $product->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Bình luận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6>Danh mục / {{ $product->category->name }} / {{ $product->name }}</h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        {{-- <img src="{{ asset('assets/uploads/product/' . $product->image) }}" class="w-100"
                            alt="image here"> --}}
                        <div class="grid images_3_of_2">
                            <div class="flexslider">
                                <ul class="slides">
                                    @php
                                        $arrayImage = explode(',', $product->image);
                                    @endphp
                                    @foreach ($arrayImage as $image)
                                        <li data-thumb="{{ asset('assets/uploads/product/' . $image) }}">
                                            <div class="thumb-image">
                                                <img src="{{ asset('assets/uploads/product/' . $image) }}"
                                                    data-imagezoom="true" class="img-fluid" alt="">
                                            </div>
                                        </li>
                                    @endforeach

                                    {{-- <li data-thumb="{{ asset('assets/uploads/product/' . $product->image) }}">
                                        <div class="thumb-image">
                                            <img src="{{ asset('assets/uploads/product/' . $product->image) }}"
                                                data-imagezoom="true" class="img-fluid" alt="">
                                        </div>
                                    </li>
                                    <li data-thumb="{{ asset('assets/uploads/product/' . $product->image) }}">
                                        <div class="thumb-image">
                                            <img src="{{ asset('assets/uploads/product/' . $product->image) }}"
                                                data-imagezoom="true" class="img-fluid" alt="">
                                        </div>
                                    </li> --}}
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            <div style="float: left">
                                {{ $product->name }}
                            </div>
                            <div style="float: right">
                                @if ($product->trending == '1')
                                    <label style="font-size: 16px" class="float-end badge bg-danger trending_tag">Xu
                                        hướng</label>
                                @endif
                            </div>
                            <div class="clearfix"></div>
                        </h2>
                        <hr>
                        <label class="me-3">Giá: <s>$ {{ $product->original_price }}</s></label>
                        <label class="me-3"><b>Giá khuyến mãi: $ {{ $product->selling_price }}</b></label>
                        @php
                            $ratenum = number_format($rating_value);
                        @endphp
                        <div class="rating">
                            @for ($i = 0; $i < $ratenum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $ratenum + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @if ($ratings->count() > 0)
                                <span>{{ $ratings->count() }} Đánh giá</span>
                            @else
                                Không có đánh giá
                            @endif
                        </div>
                        <p class="mt-3">
                            {!! $product->small_description !!}
                        </p>
                        <hr>
                        @if ($product->qty > 0)
                            <label class="badge bg-success">Còn hàng</label>
                        @else
                            <label class="badge bg-danger">Hết hàng</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" class="prod_id" value="{{ $product->id }}">
                                <label for="Quantity">Số lượng</label>
                                <div class="input-group text-center mb-3" style="width: 130px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity " class="form-control qty-input text-center"
                                        value="1">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>
                                <button type="button" class="btn btn-success me-3 addToWishlist float-start">Thêm vào danh
                                    sách yêu thích
                                    <i class="fa fa-heart"></i></button>
                                <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">Thêm vào giỏ
                                    hàng<i class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h3>Mô tả</h3>
                            <p class="mt-3">
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            Đánh giá sản phẩm
                        </button>
                        <a href="{{ url('add-review/' . $product->slug . '/userreview') }}" class="btn btn-link">
                            Viết bình luận
                        </a>
                    </div>
                    <div class="col-md-8">
                        @foreach ($reviews as $item)
                            <div class="user-review">
                                <label for="">{{ $item->user->name . ' ' . $item->user->lastname }}</label>
                                @if ($item->user_id == Auth::id())
                                    <a href="{{ url('edit-review/' . $product->slug . '/userreview') }}">Sửa</a>
                                @endif
                                <br>
                                @if ($item->rating)
                                    @php
                                        $user_rated = $item->rating->stars_rated;
                                    @endphp
                                    @for ($i = 1; $i <= $user_rated; $i++)
                                        <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for ($j = $user_rated + 1; $j <= 5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                @endif
                                <small>Bình luận trên {{ $item->created_at->format('d-m-Y') }}</small>
                                <p>
                                    {{ $item->user_review }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
