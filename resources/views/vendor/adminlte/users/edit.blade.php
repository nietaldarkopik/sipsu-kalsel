@extends('adminlte::page')


@section('title', 'Data Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pengguna</h1>
@stop
@section('content')
    <div class="card col-md-6">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Data Pengguna</h2>
            <div class="card-tools">
                @can('admin.users.index')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.users.index') }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                                placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                placeholder="Email">
                        </div>
                    </div>
                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            <input type="password" name="confirm-password" class="form-control"
                                placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Role:</strong>
                            <select class="form-control multiple" multiple name="roles[]" style="height: 200px">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
