@php use Illuminate\Support\Facades\Auth; @endphp
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
                                            <h1 class="fw-bold mb-0 text-black">Кошик</h1>
                                        </div>
                                        <hr class="my-4">
                                        <?php $totalPrice = 0; ?>
                                        @foreach($cartItems as $index => $cartItem)
                                            <div class="cart-item">
                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        @if (Auth::check())
                                                            <img src="{{ asset('storage/'. $cartItem->product->image) }}"  class="img-fluid rounded-3" alt="product">
                                                        @else
                                                            <img src="{{ asset('storage/'. $cartItem['product']['image']) }}" class="img-fluid rounded-3" alt="product">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        @if (Auth::check())
                                                            <a><h6 class="text-muted">{{$cartItem->product->name}}</h6></a>
                                                            <h6 class="text-black mb-0">{{$cartItem->product->price}} х 1</h6>
                                                        @else
                                                            <a><h6 class="text-muted">{{$cartItem['product']['name']}}</h6></a>
                                                            <h6 class="text-black mb-0">{{$cartItem['product']['price']}} х 1</h6>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                            <i class="fas fa-minus"></i>
                                                        </button>

                                                        @if (Auth::check())
                                                            <input id="form{{$cartItem->id}}" min="1" name="quantity" value="{{$cartItem->quantity}}" type="number" class="form-control form-control-sm"  onchange="updateQuantity(this)" data-cart-id="{{$cartItem->id}}"/>
                                                        @else
                                                            <input id="form{{$index}}" min="1" name="quantity" value="{{$cartItem['quantity']}}" type="number" class="form-control form-control-sm" onchange="updateQuantity(this)" data-cart-id="{{$index}}"/>
                                                        @endif

                                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <?php
                                                        if (Auth::check())
                                                            $subtotal = $cartItem->price;
                                                        else
                                                            $subtotal = $cartItem['product']['price'] * $cartItem['quantity'];
                                                        $totalPrice += $subtotal;
                                                        ?>

                                                        @if (Auth::check())
                                                            <h6 class="mb-0 subtotal" id = "subtotal{{$cartItem->id}}">{{$subtotal}} ₴</h6>
                                                        @else
                                                            <h6 class="mb-0 subtotal" id = "subtotal{{$index}}">{{$subtotal}} ₴</h6>
                                                        @endif

                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        @if (Auth::check())
                                                            <button onclick="removeItem(this)" id="{{$cartItem->id}}" class="text-muted" style="border: none; background: none; padding: 0;">
                                                        @else
                                                            <button onclick="removeItem(this)" id="{{$index}}" class="text-muted" style="border: none; background: none; padding: 0;">
                                                        @endif
                                                                <img src="{{ asset('dist/img/times-solid.svg') }}" width="20" height="20" role="button">
                                                            </button>
                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                            </div>
                                        @endforeach
                                        <div id="empty-cart" @if($totalPrice != 0) style="display: none;" @endif>
                                            <h5 class="text-center">Ваш кошик порожній!</h5>
                                            <h6 class="text-center"><em>Додавайте товари в кошик кнопкою «До кошика»</em></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">

                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Підсумок</h3>

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Сума</h5>
                                            <h5 id="total-price"><b>{{$totalPrice}} грн.</b></h5>
                                        </div>

                                        <form action="{{route('main.order.create')}}" method="GET">
                                            @csrf
                                            <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
                                            @if($totalPrice == 0)
                                                <button id="confirm-button" type="submit" class="btn btn-success btn-block btn-lg" data-mdb-ripple-color="dark" disabled>Підтвердити</button>
                                            @else
                                                <button id="confirm-button" type="submit" class="btn btn-success btn-block btn-lg" data-mdb-ripple-color="dark">Підтвердити</button>
                                            @endif
                                        </form>
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
<script>
    function updateQuantity(element) {
        var quantity = element.value; // Получаем новое значение количества товара
        var cartId = element.dataset.cartId; // Получаем идентификатор корзины
        // Отправляем AJAX запрос на сервер для обновления количества товара
        $.ajax({
            url: '{{ route("main.cart.updateElCart") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity,
                cart_id: cartId
            },
            success: function(response) {
                // Обновляем интерфейс при успешном выполнении запроса
                console.log('Quantity updated successfully');

                var subtotalElement = document.querySelector(`[id="subtotal${cartId}"]`);
                if (subtotalElement) {
                    subtotalElement.textContent = response.subtotal + ' ₴';
                }
                // Найдите элемент для обновления totalPrice
                var totalPriceElement = document.getElementById('total-price');
                if (totalPriceElement) {
                    totalPriceElement.textContent = response.totalPrice + ' грн.';
                    document.querySelector('input[name="totalPrice"]').value = response.totalPrice;
                }
            },
            error: function(xhr) {
                // Обработка ошибок при выполнении запроса
                console.log('Error updating quantity');
            }
        });
    }

    function removeItem(element) {

        var cartId = element.id;

        $.ajax({
            url: '{{ route("main.cart.deleteElFromCart") }}',
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
                cartId: cartId
            },

            success: function (response) {
                // Обновляем интерфейс при успешном выполнении запроса
                console.log('Deleted successfully');

                $(element).closest('.cart-item').remove();

                // Найдите элемент для обновления totalPrice
                var totalPriceElement = document.getElementById('total-price');
                if (totalPriceElement) {
                    totalPriceElement.textContent = response.totalPrice + ' грн.';
                }

                var cartItemCountElement = document.querySelector('.cart-item-count');
                if (cartItemCountElement) {
                    cartItemCountElement.textContent = response.cartItemCount;
                }

                var confirmButton = document.getElementById('confirm-button');
                var emptyCart = document.getElementById('empty-cart');
                if (confirmButton) {
                    if (response.totalPrice === 0) {
                        confirmButton.disabled = true;
                        emptyCart.style.display = 'block';
                    } else {
                        confirmButton.disabled = false;
                        emptyCart.style.display = 'none';
                    }
                }
            },
            error: function (xhr) {
                // Обработка ошибок при выполнении запроса
                console.log('Error delete');
            }
        })
    }
</script>
