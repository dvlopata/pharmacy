@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <div class="container mb-5">
            <section class="categories row ">
                <div class="categories-menu col-3">
                    <h3 class="d-flex align-items-center">Категорії</h3>
                    <nav class="menu">
                        <ul>
                            @foreach($data['categories'] as $category)
                            <li class="{{ isset($data['categoryShow']) && $category->id == $data['categoryShow']->id ? 'active' : '' }}">
{{--                                <a href="{{route('main.product.showCategory', $category->id)}}">{{$category->name}}</a>--}}
                                <p class="categories-title">{{$category->name}}</p>
                                <ul class="sub-categories">
                                    @foreach($data['subcategories'] as $subcategory)
                                        @if($subcategory->category_id == $category->id)
                                            <li class="{{ isset($data['subCategoryShow']) && isset($data['subCategoryShow']->id) && $subcategory->id == $data['subCategoryShow']->id ? 'active' : '' }}">
                                                <a href="{{route('main.product.showSubCategory', $subcategory->id)}}">{{$subcategory->name}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="items col-9">
                    @if (count($data['products']) == 0)
                        <div class="boxes d-flex justify-content-center mt-5">
                            <h5>Товарів не знайдено</h5>
                        </div>
                    @else
                        <div class="boxes d-flex flex-wrap justify-content-between">
                            @foreach($data['products'] as $product)
                                <div class="box" >
                                    <figure>
                                        <div class="figure d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="product" onclick="openProductModal({{ $product->toJson() }})">
                                        </div>
                                        <figcaption class="text-center">
                                            <h5 class="product-title" onclick="openProductModal({{ $product->toJson() }})">{{$product->name}}</h5>
                                            <p class="product-price">{{$product->price}} ₴</p>
                                            <form action="{{route('main.cart.store')}}" method="POST" class="w-md-25 mb-3" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="hide" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" class="hide" name="price" value="{{ $product->price }}">
                                                <div class="btn-wrapper">
                                                    <button class="btn btn-add-to-cart" type="submit">До кошика</button>
                                                </div>
                                            </form>
                                        </figcaption>
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    </div>
            </section>
        </div>
    </main>
@endsection


