@extends('layouts.main')

@section('content')
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100" >
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px; background-color: #f7f7f8;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Оформлення замовлення</h1>
                                        </div>
                                        <hr class="my-4">
                                        <form action="{{route('main.order.store')}}" method="POST" class="w-50">
                                            @csrf
                                            <div class="form-group">

                                                @if (Auth::check())
                                                    <input type="text" class="form-control" name="name" placeholder="Ім'я" value="{{Auth::user()->name}}">
                                                @else
                                                    <input type="text" class="form-control" name="name" placeholder="Ім'я" value="{{old('name')}}">
                                                @endif

                                                @error('name')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">

                                                @if (Auth::check())
                                                    <input type="text" class="form-control" name="surname" placeholder="Прізвище" value="{{Auth::user()->surname}}">
                                                @else
                                                    <input type="text" class="form-control" name="surname" placeholder="Прізвище" value="{{old('surname')}}">
                                                @endif

                                                @error('surname')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Телефон:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    </div>

                                                    @if (Auth::check())
                                                        <input type="text" class="form-control" name="phone" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" value="{{Auth::user()->phone}}">
                                                    @else
                                                        <input type="text" class="form-control" name="phone" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" value="{{old('phone')}}">
                                                    @endif

                                                </div>
                                                @error('phone')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <label>Email:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>

                                                    @if (Auth::check())
                                                        <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                                                    @else
                                                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                                    @endif

                                                </div>
                                                @error('email')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Місто:</label>

                                                @if (Auth::check())
                                                    <input type="text" name="city" class="form-control" placeholder="Київ" value="{{Auth::user()->city}}">
                                                @else
                                                    <input type="text" name="city" class="form-control" placeholder="Київ" value="{{old('city')}}">
                                                @endif

                                                @error('city')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Область:</label>

                                                @if (Auth::check())
                                                    <input type="text" name="region" class="form-control" placeholder="Київська" value="{{Auth::user()->region}}">
                                                @else
                                                    <input type="text" name="region" class="form-control" placeholder="Київська" value="{{old('region')}}">
                                                @endif

                                                @error('region')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Номер/індекс поштового відділення:</label>

                                                @if (Auth::check())
                                                    <input type="text" name="postNumber" class="form-control" placeholder="28" value="{{Auth::user()->postNumber}}">
                                                @else
                                                    <input type="text" name="postNumber" class="form-control" placeholder="28" value="{{old('postNumber')}}">
                                                @endif

                                                @error('postNumber')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Адреса:</label>

                                                @if (Auth::check())
                                                    <input type="text" name="address" class="form-control" placeholder="вул. Миру 29, кв.5" value="{{Auth::user()->address}}">
                                                @else
                                                    <input type="text" name="address" class="form-control" placeholder="вул. Миру 29, кв.5" value="{{old('address')}}">
                                                @endif

                                                @error('address')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <label>До сплати: <b>{{$totalPrice}} грн. </b></label>
                                            <br>
                                            <br>
                                            <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
                                            <input type="submit" class="btn btn-primary mb-3" value="Підтвердити">
                                        </form>
                                        <p><em>* Сума доставки розраховується за тарифами перевізника</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
