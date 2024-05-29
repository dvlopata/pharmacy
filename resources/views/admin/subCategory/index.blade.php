@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Підкатегорії</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active">Підкатегорії</li>
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
                        <div class="col-1">
                            <a href="{{ route('admin.subCategory.create') }}" class="btn btn-block btn-primary">Додати</a>
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
                                    <th>Назва</th>
                                    <th colspan="2" class="text-center">Дія</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subCategories as $subCategory)
                                <tr>
                                    <td>{{$subCategory->id}}</td>
                                    <td>{{$subCategory->name}}</td>
                                    <td class="text-center"><a  href="{{route('admin.subCategory.show', $subCategory->id)}}"><i class="far fa-eye"></i></a></td>
                                    <td class="text-center"><a  href="{{route('admin.subCategory.edit', $subCategory->id)}}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
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
