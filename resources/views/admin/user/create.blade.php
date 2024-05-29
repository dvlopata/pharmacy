@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Додавання користувача</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.user.index')}}">Користувачі</a></li>
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
                    <form action="{{route('admin.user.store')}}" method="POST" class="w-25">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Ім'я" value="{{old('name')}}">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="surname" placeholder="Прізвище" value="{{old('surname')}}">
                            @error('surname')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Дата народження:</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="dateOfBirth" id="dateOfBirth" value="{{old('dateOfBirth')}}">
                                @error('dateOfBirth')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Телефон:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="phone" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" value="{{old('phone')}}">
                            </div>
                            @error('phone')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label>Email:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}">
                            </div>
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Місто:</label>
                            <input type="text" name="city" class="form-control" placeholder="Київ" value="{{old('city')}}">
                            @error('city')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Область:</label>
                            <input type="text" name="region" class="form-control" placeholder="Київська" value="{{old('region')}}">
                            @error('region')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Номер/індекс поштового відділення:</label>
                            <input type="text" name="postNumber" class="form-control" placeholder="28" value="{{old('postNumber')}}">
                            @error('postNumber')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Адреса:</label>
                            <input type="text" name="address" class="form-control" placeholder="вул. Миру 29, кв.5" value="{{old('address')}}">
                            @error('address')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Введіть пароль" value="{{old('password')}}">
                            @error('password')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Роль: </label>
                            <select class="form-control" name="role">
                                @foreach($roles as $id => $role)
                                    <option value={{$id }}
                                        {{ $id == old('role_id') ? 'selected' : 'Виберіть роль' }}
                                    >{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                        <div class="text-danger">Необхідно обрати категорію!</div>
                        @enderror
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
