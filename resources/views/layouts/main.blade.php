<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharmacy Health</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate.css/animate.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendors/slick-carousel/slick.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendors/slick-carousel/slick-theme.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/js/loader.js') }} "></script>
</head>

<body>
<div class="oleez-loader"></div>
<header class="oleez-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/"><img src="{{ asset('dist/img/pharmacy.png') }}" alt="Logo"> <img src="{{ asset('dist/img/title.png') }}" alt="Title"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#oleezMainNav"
                aria-controls="oleezMainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="oleezMainNav">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main.index') }}">Головна <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main.product.index') }}">Каталог <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Про нас <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main.pharmacy.index') }}">Аптеки <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item">
                    <form action="{{route('main.product.searchByName')}}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="text" name="value" id="value" class="form-control border-bottom mr-2" placeholder="Пошук...">
                    </form>
                </li>

                <li class="nav-item nav-item-cart">
                    <a class="nav-link nav-link-btn" href="{{ route('main.cart.index') }}">
                        <span class="cart-item-count">{{session('cart_item_count', 0)}}</span>
                        <img src="{{ asset('assets/images/shopping-cart.svg') }}" alt="cart">
                    </a>
                </li>
                @if (Auth::check())
                    @if (Auth::user()->role == App\Models\User::ROLE_BUYER)
                    <li class="nav-item">
                        <a class="nav-link nav-link-btn" href="{{ route('personal.main.index') }}" >
                            <img src="{{ asset('dist/img/user_bl.png') }}" alt="user">
                        </a>
                    </li>
                    @elseif (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                        <li class="nav-item">
                            <a class="nav-link nav-link-btn" href="{{ route('admin.main.index') }}" >
                                <img src="{{ asset('dist/img/setting.png') }}" alt="user">
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link nav-link-btn" href="#!" >
                        @if (Auth::check())
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn-link">
                                    <img src="{{ asset('dist/img/user-logout.png') }}" alt="user-logout">
                                </button>
                            </form>
                        @else
                            <!-- Если пользователь не авторизован, переход на форму регистрации -->
                            <form action="{{ route('login') }}" method="get">
                                <button type="submit" class="btn-link">
                                    <img src="{{ asset('dist/img/user-login.png') }}" alt="user-login">
                                </button>
                            </form>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    @if(session('success'))
        <div id="successAlert" class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session('danger'))
        <div id="successAlert" class="alert alert-danger">
            {{session('danger')}}
        </div>
    @endif
    <?php
        session()->forget('success');
        session()->forget('danger');
    ?>
</div>

<body>
    <div class="wrapper">
        <main class="content">
            @yield('content')
        </main>

    <footer class="oleez-footer wow fadeInUp ">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-md-6">
                        <a class="navbar-brand mb-3" href="/"><img src="{{ asset('dist/img/pharmacy.png') }}" alt="Logo"> <img src="{{ asset('dist/img/title.png') }}" alt="Title"></a>
                        <p class="footer-intro-text">Надаємо перевагу тільки перевіреним та ефективним лікам</p>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">Контакти</h6>
                                <p class="widget-content">+38 (095) 061 74 85</p>
                            </div>
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">EMAIL</h6>
                                <p class="widget-content">pharmacyhealth@cource.work</p>
                            </div>
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">ГОЛОВНИЙ ОФІС</h6>
                                <p class="widget-content">вул. Городоцька, 95<br> Київ, Україна</p>
                            </div>
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">ГРАФІК РОБОТИ</h6>
                                <p class="widget-content">ПН-НД: 08:00 - 20:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-text">
                <p class="mb-md-0">©  2024, Cource Work Lopata 621pst</p>
            </div>
        </div>
    </footer>
        <div class="modal fade bd-example-modal-lg" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-narrow" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Інформація про товар</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="productImage" src="#" alt="Product Image" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <h5 id="productName" class="modal-product-name"></h5>
                                <p><strong>Ціна:</strong> <span id="productPrice" class="modal-product-price"></span></p>
                                <p><strong>Опис:</strong> <span id="productDescription" class="modal-product-description"></span></p>
                                <p><strong>Рекомендації:</strong> <span id="productRecommendation" class="modal-product-recommendation"></span></p>
                                <p><strong>Спосіб застосування:</strong> <span id="productApplication" class="modal-product-application"></span></p>
                                <p><strong>Склад:</strong> <span id="productComposition" class="modal-product-composition"></span></p>
                                <p><strong>Виробник:</strong> <span id="productManufacturer" class="modal-product-manufacturer"></span></p>
                                <p><strong>Категорія:</strong> <span id="productCategory" class="modal-product-category"></span><span id="productSubcategory" class="modal-product-subcategory"></span></p>
                                <form action="{{route('main.cart.store')}}" method="POST" class="w-md-25 mb-3" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" id="formProductId">
                                    <input type="hidden" name="price" id="formProductPrice">
                                    <div class="btn-wrapper">
                                        <button class="btn btn-success" type="submit">До кошика</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/vendors/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/wowjs/wow.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/slick-carousel/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/landing.js') }}"></script>
<script src="{{ asset('assets/vendors/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/wowjs/wow.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/slick-carousel/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


<script>
    new WOW({mobile: false}).init();
    new WOW().init();

    $(document).ready(function() {
        setTimeout(function() {
            $("#successAlert").fadeOut("slow", function() {
                $(this).remove();
            });
        }, 3000);
    });

    function openProductModal(product) {
        console.log(product); // Use console.log instead of document.console.log
        // Fill modal with product information
        document.getElementById('productImage').src = '{{ asset('storage/') }}' + '/' + product.image; // Adjust the image path if necessary
        document.getElementById('productName').textContent = product.name;
        document.getElementById('productPrice').textContent = product.price + ' ₴';
        document.getElementById('productDescription').textContent = product.description;
        document.getElementById('productRecommendation').textContent = product.recommendation;
        document.getElementById('productApplication').textContent = product.methodApplication;
        document.getElementById('productComposition').textContent = product.composition;
        document.getElementById('productManufacturer').textContent = product.manufacturer.name;
        document.getElementById('productSubcategory').textContent = product.subcategory.name;

        document.getElementById('formProductId').value = product.id;
        document.getElementById('formProductPrice').value = product.price;

        // Show the modal
        $('#productModal').modal('show');
    }

</script>
</body>
</html>
