@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0 mr-3">Замовлення {{$order->id}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.order.index')}}">Замовлення</a></li>
                        <li class="breadcrumb-item active">{{$order->id}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class=" d-flex">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card d-flex">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                <tr>
                                    <td><b>ID</b></td>
                                    <td>{{$order->id}}</td>
                                </tr>
                                <tr>
                                    <td><b>Отримувач</b></td>
                                    <td>{{$order->user->name}} {{$order->user->surname}}</td>
                                </tr>
                                <tr>
                                    <td><b>Телефон</b></td>
                                    <td>{{$order->user->phone}}</td>
                                </tr>
                                <tr>
                                    <td><b>Місто</b></td>
                                    <td>{{$order->user->city}}</td>
                                </tr>
                                <tr>
                                    <td><b>Область</b></td>
                                    <td>{{$order->user->region}}</td>
                                </tr>
                                <tr>
                                    <td><b>Номер пошти/відділення</b></td>
                                    <td>{{$order->user->postNumber}}</td>
                                </tr>
                                <tr>
                                    <td><b>Адреса</b></td>
                                    <td>{{$order->user->address}}</td>
                                </tr>
                                <tr>
                                    <td><b>Статус</b></td>
                                    <td>{{$order->status}}</td>
                                </tr>
                                <tr>
                                    @if ($order->status == "Відправлено")
                                        <td><b>ТТН</b></td>
                                        <td>{{$order->waybill}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div>
                        @if ($order->status == "Сформовано покупцем")
                            <form action="{{route('admin.order.acceptOrder', $order->id)}}" method="POST" class="w-25" enctype="multipart/form-data">
                                @csrf
                                <input type="submit" class="btn btn-primary mb-3" value="Прийняти в обробку">
                            </form>
                            <form action="{{route('admin.order.cancelOrder', $order->id)}}" method="POST" class="w-25" enctype="multipart/form-data">
                                @csrf
                                <input type="submit" class="btn btn-danger mb-3" value="Скасувати замовлення">
                            </form>
                        @elseif (!isset($order->waybill) && $order->status != "Скасовано" && $order->status != "Скасовано покупцем")
                            <form action="{{route('admin.order.addWayBill', $order->id)}}" method="POST" class="w-50" enctype="multipart/form-data">
                                @csrf
                                @error('waybill')
                                <div class="text-danger">Це поле необхідно заповнити!</div>
                                @enderror
                                <div class="input-group mt-3 mb-3">
                                    <input type="text" class="form-control " name="waybill" placeholder="Сформований номер ТТН">
                                </div>
                                <input type="submit" class="btn btn-primary mb-3" value="Додати ТТН">
                            </form>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div>
                <ul>
                    @foreach($order->orderProducts as $product)
                        <li>{{$product->name}}<br><em>{{$product->pivot->price}} x {{$product->pivot->quantity}}</em></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
