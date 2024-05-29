@extends('layouts.main')

@section('content')
<main>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100" >
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px; background-color: #f7f7f8;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h1 class="fw-bold mb-0 text-black">{{Auth::user()->name}} {{Auth::user()->surname}}</h1>
                                    </div>
                                    <div>
                                        <p>Дата Народження: {{Auth::user()->dateOfBirth}}</p>
                                        <p>Телефон: {{Auth::user()->phone}}</p>
                                        <p>Email: {{Auth::user()->email}}</p>
                                        <p>Місто: {{Auth::user()->city}}</p>
                                        <p>Область: {{Auth::user()->region}}</p>
                                        <p>Номер/відділення пошти: {{Auth::user()->postNumber}}</p>
                                        <p>Адреса: {{Auth::user()->address}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (count($orders) != 0)
            <h4 class="mb-4 mt-4">Наявні замовлення:</h4>
            <div id="accordion">
                @foreach($orders as $order)
                <div class="card">
                    <div class="card-header d-flex justify-content-between" id="headingOne">
                        <h5 class="mb-0">
                            <span class="btn" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapseOne">
                                Замовлення #{{$order->id}}
                            </span>
                        </h5>
                        <p class="btn" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapseOne"><em>{{$order->date}}</em>     ↷</p>
                    </div>

                    <div id="collapse{{$order->id}}" class="collapse" aria-labelledby="heading{{$order->id}}" data-parent="#accordion">
                        <div class="card-body">
                            <div>
                                <ul class="list-group list-group-flush">
                                    @foreach($order->orderProducts as $product)
                                        <li class="list-group-item">{{$product->pivot->name}}<br><em>{{$product->pivot->price}} x {{$product->pivot->quantity}}</em></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="text-right">
                                <p><b>{{$order->sum}} грн</b></p>
                                <p>{{Auth::user()->city}}</p>
                                <p>{{Auth::user()->region}}</p>
                                <p># пошти: {{Auth::user()->postNumber}}</p>
                                <p>{{Auth::user()->address}}</p>
                                <br>
                                <p><em>{{$order->status}}</em></p>
                                @if (!empty($order->waybill))
                                    <p><em>TTH: {{ $order->waybill }}</em></p>
                                @endif
                                @if ($order->status != "Відправлено" && $order->status != "Отримано" && $order->status != "Скасовано покупцем" && $order->status != "Скасовано")
                                    <form action="{{route('personal.main.cancelOrder', $order->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Скасувати замовлення</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</main>
@endsection
