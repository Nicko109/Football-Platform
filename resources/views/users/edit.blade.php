@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать пользователя</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
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
                <div class="col-lg-6 col-12">
                    <form action="{{route('admin.users.update', $user->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="name">Редактировать имя</label>
                            <input id="name" type="text" class="form-control" placeholder="Имя пользователя" name="name"  value="{{ $user->name }}">
                            @error('name')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Редактировать email</label>
                            <input id="email" type="text" class="form-control" placeholder="Электронная почта" name="email"
                                   value="{{ $user->email }}"
                            >
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Редактировать пароль</label>
                            <input id="password" type="password" class="form-control" placeholder="Пароль" name="password"
                                   value="{{old('password')}}"
                            >
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Подтвердите пароль</label>
                            <input id="password_confirmation" type="password" class="form-control" placeholder="Подтвердите пароль" name="password_confirmation" value="{{ old('password_confirmation') }}"
                            >
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" value="Редактировать">
                        </div>
                        <div class="mr-4">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary">Назад</a>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
