@extends('admin.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h1 class="m-0 mr-3">{{$user->surname}} {{$user->name}}</h1>
                        <a href="{{route('admin.user.edit', $user->id)}}" class="text-success mr-2"><i
                                    class="fas fa-pencil-alt"></i></a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.index')}}">Користувачі</a></li>
                            <li class="breadcrumb-item active">{{$user->name}} {{$user->surname}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pb-4">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-6 mt-3">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td><b>ID</b></td>
                                        <td>{{$user->id}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Ім'я</b></td>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Прізвище</b></td>
                                        <td>{{$user->surname}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Дата народження</b></td>
                                        <td>{{$user->dateOfBirth}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Телефон</b></td>
                                        <td>{{$user->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Місто</b></td>
                                        <td>{{$user->city}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Область</b></td>
                                        <td>{{$user->region}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Номер/індекс поштового відділення</b></td>
                                        <td>{{$user->postNumber}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Адреса</b></td>
                                        <td>{{$user->address}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Роль</b></td>
                                        @if($user->role == 0)
                                            <td>Адміністратор</td>
                                        @elseif ($user->role == 1)
                                            <td>Покупець</td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                @if (count($user->orders) != 0)
                    <h4 class="mb-4 mt-4">Наявні замовлення:</h4>
                    <div class="col-6" id="accordion">
                        @foreach($user->orders as $order)
                            <div class="card">
                                <div class="card-header d-flex" id="headingOne">
                                    <h5 class="mb-0 btn" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapseOne">Замовлення #{{$order->id}}</h5>
                                    <p class="btn pr-0" data-toggle="collapse" data-target="#collapse{{$order->id}}"
                                       aria-expanded="true" aria-controls="collapseOne">({{$order->date}}) ↷</p>
                                </div>
                                <div id="collapse{{$order->id}}" class="collapse"
                                     aria-labelledby="heading{{$order->id}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <div>
                                            <ul class="list-group list-group-flush">
                                                @foreach($order->orderProducts as $product)
                                                    <li class="list-group-item">{{$product->name}}
                                                        <br><em>{{$product->pivot->price}}
                                                            x {{$product->pivot->quantity}}</em></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="text-right">
                                            <p><b>{{$order->sum}} грн</b></p>
                                            <p>{{$user->city}}</p>
                                            <p>{{$user->region}}</p>
                                            <p># пошти: {{$user->postNumber}}</p>
                                            <p>{{$user->address}}</p>
                                            <br>
                                            <p><em>{{$order->status}}</em></p>
                                            @if (!empty($order->waybill))
                                                <p><em>TTH: {{ $order->waybill }}</em></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
