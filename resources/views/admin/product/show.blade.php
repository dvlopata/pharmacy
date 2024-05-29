@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0 mr-3">{{$product->name}}</h1>
                    <a  href="{{route('admin.product.edit', $product->id)}}" class="text-success mr-2"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{route('admin.product.delete', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-transparent">
                            <i class="fas fa-trash text-danger" role="button"></i>
                        </button>
                    </form>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.product.index')}}">Товари</a></li>
                        <li class="breadcrumb-item active">{{$product->name}}</li>
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
                <div class="col-7">
                    <div class="card d-flex">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                <tr>
                                    <td><b>ID</b></td>
                                    <td>{{$product->id}}</td>
                                </tr>
                                <tr>
                                    <td><b>Назва</b></td>
                                    <td>{{$product->name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Ціна</b></td>
                                    <td>{{$product->price}}</td>
                                </tr>
                                <tr>
                                    <td><b>Кількість</b></td>
                                    <td>{{$product->quantity}}</td>
                                </tr>
                                <tr>
                                    <td><b>Опис</b></td>
                                    <td style="max-height: 200px; overflow: auto;">
                                        <pre style="white-space: pre-wrap;">{{$product->description}}</pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Рекомендації</b></td>
                                    <td style="max-height: 200px; overflow: auto;">
                                        <pre style="white-space: pre-wrap;">{{$product->recommendation}}</pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Склад</b></td>
                                    <td style="max-height: 200px; overflow: auto;">
                                        <pre style="white-space: pre-wrap;">{{$product->composition}}</pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Спосіб застосування</b></td>
                                    <td style="max-height: 200px; overflow: auto;">
                                        <pre style="white-space: pre-wrap;">{{$product->methodApplication}}</pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Виробник</b></td>
                                    <td>{{$product->manufacturer->name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Підкатегорія</b></td>
                                    <td>{{$product->subcategory->name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-2">
                    <div class="card border-0">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="image" class="card-img-top rounded img-fluid border border-primary">
                    </div>
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
