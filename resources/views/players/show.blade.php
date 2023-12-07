@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Игрок</h1>
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
                <div class="col-6">
                    <div class="mr-4 mb-4">
                        <a href="{{ route('admin.players.index') }}" class="btn btn-primary">Назад</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive p-3">
                            <div class="row">
                                <div class="col-md-8"> <!-- Description Column -->
                                    <p><b>ID:</b> {{ $player->id }}</p>
                                    <p><b>Имя:</b> {{ $player->name }}</p>
                                    <p><b>Голы:</b> {{ $player->goalsAll() }}</p>
                                    @if(!is_null($player->meta))
                                        @foreach($player->meta as $key => $value)
                                            <p><b>{{$key}}:</b> {{$value}}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-4"> <!-- Image Column -->
                                    @if(!is_null($player->image))
                                        <div class="d-flex justify-content-end">
                                            <img src="{{ $player->image }}" alt="{{ $player->name }}" class="img-fluid">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header d-flex p-3">
                <div class="mr-4">
                    <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-success">Редактировать</a>
                </div>
                <form action="{{ route('admin.players.destroy', $player->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Удалить">
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
