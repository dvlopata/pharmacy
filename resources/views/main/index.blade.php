@extends('layouts.main')

@section('content')
<main>
    <section>
        <div class="container wow fadeIn">
            <div id="oleezLandingCarousel" class="oleez-landing-carousel carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="{{ asset('dist/img/enterozherminka.jpg') }}" onclick="openProductModal({{ $data['enterozherminka']->toJson() }})" alt="Second slide" class="w-100">
                        <div class="carousel-caption">
                            <h2 data-animation="animated fadeInRight"><span>Вибір</span></h2>
                            <h2 data-animation="animated fadeInRight"><span>клієнтів</span></h2>
                            <a onclick="openProductModal({{ $data['enterozherminka']->toJson() }})" class="carousel-item-link" data-animation="animated fadeInRight">Перегляднути</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('dist/img/kreon.png') }} " onclick="openProductModal({{ $data['kreon']->toJson() }})" alt="First slide" class="w-100">
                        <div class="carousel-caption">
                            <h2 data-animation="animated fadeInRight"><span>Вибір</span></h2>
                            <h2 data-animation="animated fadeInRight"><span>клієнтів</span></h2>
                            <a onclick="openProductModal({{ $data['kreon']->toJson() }})" class="carousel-item-link" data-animation="animated fadeInRight">Перегляднути</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('dist/img/dr_organic.png') }}" onclick="openProductModal({{ $data['drOrganic']->toJson() }})" alt="Third slide" class="w-100">
                        <div class="carousel-caption">
                            <h2 data-animation="animated fadeInRight"><span>Вибір</span></h2>
                            <h2 data-animation="animated fadeInRight"><span>клієнтів</span></h2>
                            <a onclick="openProductModal({{ $data['drOrganic']->toJson() }})" class="carousel-item-link" data-animation="animated fadeInRight">Перегляднути</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="oleez-landing-section oleez-landing-section-about">
        <div class="container">
            <div class="oleez-landing-section-content">
                <div class="oleez-landing-section-verticals wow fadeIn">
                    <span class="number"></span> <img src="{{ asset('dist/img/pharmacy.png') }}" alt="ollez" height="12px">
                </div>
                <div class="row landing-about-content wow fadeInUp">
                    <div class="col-md-12">
                        <h2>Ваше здоров'я – наша турбота</h2>
                        <p>Дбаємо про ваше здоров'я: якісні ліки, широкий асортимент, швидка доставка.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 landing-about-feature wow fadeInUp">
                        <img src="{{ asset('assets/images/research.png') }}" alt="document" class="about-feature-icon">
                        <h5 class="about-feature-title">Дослідження Ринку</h5>
                        <p class="about-feature-description">Аналіз потреб клієнтів і поточних ринкових тенденцій для покращення асортименту та сервісу</p>
                    </div>
                    <div class="col-md-4 landing-about-feature wow fadeInUp">
                        <img src="{{ asset('assets/images/writing.png') }}" alt="document" class="about-feature-icon">
                        <h5 class="about-feature-title">Відділ організаціі</h5>
                        <p class="about-feature-description">Організація процесу замовлення та доставки препаратів із дотриманням усіх норм</p>
                    </div>
                    <div class="col-md-4 landing-about-feature wow fadeInUp">
                        <img src="{{ asset('assets/images/computer.png') }}" alt="document" class="about-feature-icon">
                        <h5 class="about-feature-title">Завжди онлйан</h5>
                        <p class="about-feature-description">Здоров'я у вашому смартфоні чи комп'ютері</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="shop-page">
            <div class="container">
                <div class="page-header wow fadeInUp">
                    <h2 class="page-title">Популярні товари</h2>
                </div>
                <div class="row">
                    @foreach($data['products'] as $product)
                        <div class="col-md-4 product-card wow fadeInUp">
                            <div class="product-thumbnail-wrapper">
                                <img src="{{ 'storage/'. $product->image }}" alt="product" class="product-thumbnail" onclick="openProductModal({{ $product->toJson() }})">
                            </div>
                            <h5 class="product-title" onclick="openProductModal({{ $product->toJson() }})">{{$product->name}}</h5>
                            <p class="product-price">{{$product->price}} ₴</p>
                            <form action="{{route('main.product.store')}}" method="POST" class="w-md-25 mb-3" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="hide" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" class="hide" name="price" value="{{ $product->price }}">
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="oleez-landing-section oleez-landing-section-team" style="padding-top: 0;">
        <div class="container">
            <div class="oleez-landing-section-content">
                <div class="oleez-landing-section-verticals wow fadeIn">
                    <span class="number"></span> <img src="{{ asset('dist/img/pharmacy.png') }}" alt="ollez" height="12px">
                </div>
                <div class="row landing-team-content wow fadeInUp">
                    <div class="col-md-6">
                        <h2 class="section-title">Спеціалізовані брендові <br> товари</h2>
                    </div>
                    <div class="col-md-6">
                        <p>Відкрийте для себе найкращі спеціалізовані брендові товари для здоров'я та краси. Оберіть якість та ефективність разом з нами!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-5 mb-md-0 landing-team-card wow flipInY">
                        <img src="{{ asset('dist/img/ivatherm.jpg') }}" alt="Ivatherm" class="team-card-img" onclick="openProductModal({{ $data['ivatherm']->toJson() }})">
                        <h5 class="team-card-name" onclick="openProductModal({{ $data['ivatherm']->toJson() }})">ivatherm</h5>
                        <p class="team-card-job">Eau Thermale Herculane</p>
                    </div>
                    <div class="col-md-4 mb-5 mb-md-0 landing-team-card wow flipInY">
                        <img src="{{ asset('dist/img/nutrilon.jpg') }}" alt="Nutrilon" class="team-card-img" onclick="openProductModal({{ $data['nutrilon']->toJson() }})">
                        <h5 class="team-card-name" onclick="openProductModal({{ $data['nutrilon']->toJson() }})">Nutrilon Premium+</h5>
                        <p class="team-card-job">Успішне майбутнє починається з Nutrilon</p>
                    </div>
                    <div class="col-md-4 mb-5 mb-md-0 landing-team-card wow flipInY">
                        <img src="{{ asset('dist/img/organic.jpg') }}" alt="Organic" class="team-card-img" onclick="openProductModal({{ $data['drOrganic']->toJson() }})">
                        <h5 class="team-card-name" onclick="openProductModal({{ $data['drOrganic']->toJson() }})">dr.organic</h5>
                        <p class="team-card-job">В гормонії з природою</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

