@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Игра</h1>
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
                <div class="col-12">
                    <div class="mr-4 mb-4">
                        <a href="{{ route('admin.games.index') }}" class="btn btn-primary">Назад</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-wrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Дата игры</th>
                                    <th>Название игры</th>
                                    <th>Победитель</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td>{{ $game->date }}</td>
                                    <td>{{ $game->team->title }} - {{ $game->opponent->title }}</a></td>
                                    <td>{{ $game->win }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card-header d-flex p-3">
                <div class="mr-4">
                    <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-success">Редактировать</a>
                </div>
                <form action="{{ route('admin.games.destroy', $game->id) }}" method="post">
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
