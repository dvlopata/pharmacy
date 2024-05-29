@extends('admin.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Виробники</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                        <li class="breadcrumb-item active">Виробники</li>
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
                            <a href="{{ route('admin.manufacturer.create') }}" class="btn btn-block btn-primary">Додати</a>
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
                                    <th colspan="3" class="text-center">Дія</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>{{$manufacturer->id}}</td>
                                    <td>{{$manufacturer->name}}</td>
                                    <td class="text-center"><a  href="{{route('admin.manufacturer.show', $manufacturer->id)}}"><i class="far fa-eye"></i></a></td>
                                    <td class="text-center"><a  href="{{route('admin.manufacturer.edit', $manufacturer->id)}}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td class="text-center">
                                        <button type="button" class="border-0 bg-transparent" data-toggle="modal" data-target="#confirmDelete" onclick="deleteModalShow({{ $manufacturer->toJson() }})">
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
    function deleteModalShow(manufacturer) {
        document.getElementById('text').textContent = "Ви впевнені, що хочете видалити постачальника " + manufacturer.name + "? Всі товари щого постачальника будуть також видалені!";
        document.getElementById('deleteButton').onclick =  function() {
            confirmDelete(manufacturer);
        }
        $('#confirmDelete').modal('show');
    }

    function confirmDelete(manufacturer) {
        console.log(manufacturer.id);
        $.ajax({
            url: '{{ route("admin.manufacturer.delete", ":manufacturerId") }}'.replace(':manufacturerId', manufacturer.id),

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
