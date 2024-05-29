@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Головна</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Головна</li>
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$data['orderCount']}}</h3>

                            <p>Замовлення</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-folder-open"></i>
                        </div>
                        <a href="{{route('admin.order.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$data['categoryCount']}}</h3>

                            <p>Категорії</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-th-list"></i>
                        </div>
                        <a href="{{route('admin.category.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$data['subcategoryCount']}}</h3>

                            <p>Підкатегорії</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-th-list"></i>
                        </div>
                        <a href="{{route('admin.subCategory.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$data['manufacturerCount']}}</h3>

                            <p>Виробники</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-tags"></i>
                        </div>
                        <a href="{{route('admin.manufacturer.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$data['productCount']}}</h3>

                            <p>Товари</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <a href="{{route('admin.product.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$data['userCount']}}</h3>

                            <p>Користувачі</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{route('admin.user.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$data['pharmacyCount']}}</h3>

                            <p>Аптеки</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-store"></i>
                        </div>
                        <a href="{{route('admin.pharmacy.index')}}" class="small-box-footer">Переглянути  <i class="fas fa-arrow-circle-right"></i></a>
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
