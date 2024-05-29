<!-- resources/views/order/success.blade.php -->
@extends('layouts.main')

@section('content')
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px; background-color: #f7f7f8;">
                        <div class="card-body p-0">
                            <div class="p-5 text-center">
                                <h1 class="fw-bold mb-0 text-black">Дякуємо за Ваше замовлення!</h1>
                                <br>
                                <p class="mb-4">Ми зв'яжемося з Вами найближчим часом для підтвердження деталей замовлення.</p>
                                <a href="{{ route('main.index') }}" class="btn btn-primary">Повернутися на головну</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
