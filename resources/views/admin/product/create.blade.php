@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Додавання товару</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.product.index')}}">Товари</a></li>
                        <li class="breadcrumb-item active">Додавання</li>
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
                    <form action="{{route('admin.product.store')}}" method="POST" class="w-25" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Назва товару" value="{{old('name')}}">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₴</span>
                                </div>
                                <input type="text" class="form-control" name="price" placeholder="Ціна товару" value="{{old('price')}}">
                                <div class="input-group-append">
                                    <span class="input-group-text"></span>
                                </div>
                            </div>
                            @error('price')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <div class="input-group mt-3">
                                <input type="text" class="form-control " name="quantity" placeholder="К-сть товару" value="{{old('quantity')}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            @error('quantity')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <textarea class="form-control mt-3" rows="5" name="description" placeholder="Опис ...">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <textarea class="form-control mt-3" rows="5" name="recommendation" placeholder="Рекомендації ...">{{ old('recommendation') }}</textarea>
                            @error('recommendation')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <textarea class="form-control mt-3" rows="5" name="composition" placeholder="Склад ...">{{ old('composition') }}</textarea>
                            @error('composition')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <textarea class="form-control mt-3" rows="5" name="methodApplication" placeholder="Спосіб застосування ...">{{ old('methodApplication') }}</textarea>
                            @error('methodApplication')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                        <label class="custom-file-label">Виберіть фото..</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Завантажити</span>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="text-danger mb-2">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label>Оберіть виробника: </label>
                                <select class="form-control" name="manufacturer_id">
                                    @foreach($manufacturers as $manufacturer)
                                        <option value={{$manufacturer->id}}
                                            {{ $manufacturer->id == old('manufacturer_id') ? 'selected' : 'Виберіть виробника' }}
                                        >{{$manufacturer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('manufacturer_id')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label>Оберіть підкатегорію: </label>
                                <select class="form-control" name="subcategory_id">
                                    @foreach($subcategories as $subcategory)
                                        <option value={{$subcategory->id}}
                                            {{ $subcategory->id == old('subcategory_id') ? 'selected' : 'Виберіть підкатегорію' }}
                                        >{{$subcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subcategory_id')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary mb-3" value="Додати">
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
