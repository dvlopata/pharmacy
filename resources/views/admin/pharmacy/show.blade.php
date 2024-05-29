@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0 mr-3">Аптека {{$pharmacy->id}}</h1>
                    <a  href="{{route('admin.pharmacy.edit', $pharmacy->id)}}" class="text-success mr-2"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{route('admin.pharmacy.delete', $pharmacy->id)}}" method="POST">
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
                        <li class="breadcrumb-item active"><a href="{{route('admin.pharmacy.index')}}">Аптеки</a></li>
                        <li class="breadcrumb-item active">{{$pharmacy->id}}</li>
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
                <div class="col-6 mt-3">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                <tr>
                                    <td><b>ID</b></td>
                                    <td>{{$pharmacy->id}}</td>
                                </tr>
                                <tr>
                                    <td><b>Місто</b></td>
                                    <td>{{$pharmacy->city}}</td>
                                </tr>
                                <tr>
                                    <td><b>Область</b></td>
                                    <td>{{$pharmacy->region}}</td>
                                </tr>
                                <tr>
                                    <td><b>Адреса</b></td>
                                    <td>{{$pharmacy->address}}</td>
                                </tr>
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
