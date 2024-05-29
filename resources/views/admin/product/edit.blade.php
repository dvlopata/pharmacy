@extends('admin.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редагування товару {{$product->name}}</h1>
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
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.product.update', $product->id)}}" method="POST" class="w-25" enctype="multipart/form-data">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @csrf
                            @method('PATCH')
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="name" placeholder="Назва товару" value="{{$product->name}}">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₴</span>
                                </div>
                                <input type="text" class="form-control" name="price" placeholder="Ціна товару" value="{{$product->price}}">
                                <div class="input-group-append">
                                    <span class="input-group-text"></span>
                                </div>
                            </div>
                            @error('price')
                            <div class="text-danger">{{$message}}</div>
                            @enderror

                            <div class="input-group mt-3">
                                <input type="text" class="form-control" name="quantity" placeholder="К-сть товару" value="{{$product->quantity}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            @error('quantity')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="input-group mt-3">
                                <textarea class="form-control" rows="5" name="description"
                                          placeholder="Опис ...">{{$product->description}}</textarea>
                            </div>
                            @error('description')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="input-group mt-3">
                                <textarea class="form-control" rows="5" name="recommendation"
                                      placeholder="Рекомендації ...">{{$product->recommendation}}</textarea>
                            </div>
                            @error('recommendation')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="input-group mt-3">
                                <textarea class="form-control" rows="5" name="composition"
                                      placeholder="Склад ...">{{$product->composition}}</textarea>
                            </div>
                            @error('composition')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="input-group mt-3">
                                <textarea class="form-control" rows="5" name="methodApplication"
                                      placeholder="Спосіб застосування ...">{{$product->methodApplication}}</textarea>
                            </div>
                            @error('methodApplication')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="cal-4 mt-3">
                                <div class="card border-0">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="image" class="card-img-top rounded img-fluid border border-primary">
                                </div>
                            </div>

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
                            <div class="form-group">
                                <label>Оберіть виробника: </label>
                                <select class="form-control" name="manufacturer_id">
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->id}}" {{ $manufacturer->id == $product->manufacturer->id ? 'selected' : '' }}>{{$manufacturer->name}}</option>
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
                                            <option value="{{$subcategory->id}}"
                                                {{ $subcategory->id == $product->subCategory->id ? 'selected' : '' }}
                                            >{{$subcategory->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            @error('subcategory_id')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary mb-3" value="Оновити">
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
