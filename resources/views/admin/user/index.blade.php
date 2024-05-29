@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Користувачі</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active">Користувачі</li>
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
                            <a href="{{ route('admin.user.create') }}" class="btn btn-block btn-primary">Додати</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mt-3">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ім'я</th>
                                    <th>Прізвище</th>
                                    <th>Телефон</th>
                                    <th>Роль</th>
                                    <th colspan="3" class="text-center">Дія</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surname}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($user->role == 0)
                                        <td><b>Адміністратор</b></td>
                                    @elseif ($user->role == 1)
                                        <td>Покупець</td>
                                    @endif
                                    <td class="text-center"><a  href="{{route('admin.user.show', $user->id)}}"><i class="far fa-eye"></i></a></td>
                                    <td class="text-center"><a  href="{{route('admin.user.edit', $user->id)}}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td class="text-center">
                                    <button type="button" class="border-0 bg-transparent" data-toggle="modal" data-target="#confirmDelete" onclick="deleteModalShow({{ $user->toJson() }})">
                                        <i class="fas fa-trash text-danger" role="button"></i>
                                    </button>
                                    </td>
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

<script>
    function deleteModalShow(user) {
        document.getElementById('text').textContent = "Ви впевнені, що хочете видалити користувача " + user.name + " " + user.surname + "?";
        document.getElementById('deleteButton').onclick =  function() {
            confirmDelete(user);
        }
        $('#confirmDelete').modal('show');
    }

    function confirmDelete(user) {
        console.log(user.id);
        $.ajax({
            url: '{{ route("admin.user.delete", ":userId") }}'.replace(':userId', user.id),

            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                $('#confirmDelete').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection
