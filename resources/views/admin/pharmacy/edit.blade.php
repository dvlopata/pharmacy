@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редагування аптеки</h1>
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
                <div class="col-12">
                    <form action="{{route('admin.pharmacy.update', $pharmacy->id)}}" method="POST" class="w-25">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" class="form-control" name="city" placeholder="Місто"
                            value="{{$pharmacy->city}}">
                            @error('city')
                            <div class="text-danger">Це поле необхідно заповнити!</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="region" placeholder="Область"
                                   value="{{$pharmacy->region}}">
                            @error('region')
                            <div class="text-danger">Це поле необхідно заповнити!</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Адреса"
                                   value="{{$pharmacy->address}}">
                            @error('address')
                            <div class="text-danger">Це поле необхідно заповнити!</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="Оновити">
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
