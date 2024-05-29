@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Замовлення</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active">Замовлення</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col mb-3">
                    <div class="row">
                        <div class="col-2 d-flex">
                            <form action="{{ route('admin.order.filter') }}" method="GET" id="filterForm">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control" onchange="document.getElementById('filterForm').submit();">
                                        <option @if(!isset($status) || $status == 'Всі замовлення') selected @endif>Всі замовлення</option>
                                        <option @if(isset($status) && $status == 'Сформовано покупцем') selected @endif>Сформовано покупцем</option>
                                        <option @if(isset($status) && $status == 'Комплектується') selected @endif>Комплектується</option>
                                        <option @if(isset($status) && $status == 'Відправлено') selected @endif>Відправлено</option>
                                        <option @if(isset($status) && $status == 'Скасовано покупцем') selected @endif>Скасовано покупцем</option>
                                    </select>
                                </div>
                                <button type="submit" class="hidden-button" style="display: none;"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mt-3">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Отримувач</th>
                                    <th>Статус</th>
                                    <th colspan="1" class="text-center">Перегляд</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->name}} {{$order->user->surname}}</td>
                                    <td>{{$order->status}}</td>
                                    <td class="text-center"><a  href="{{route('admin.order.show', $order->id)}}"><i class="far fa-eye"></i></a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
