@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Команда</h1>
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
                <div class="col-10">
                    <div class="mr-4 mb-4">
                        <a href="{{ route('admin.teams.index') }}" class="btn btn-primary">Назад</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive p-3">
                            <div class="row">
                                <div class="col-md-8"> <!-- Description Column -->
                                    <p><b>ID:</b> {{ $team->id }}</p>
                                    <p><b>Название:</b> {{ $team->title }}</p>
                                                                <table class="table table-hover text-wrap">
                                                                    <label class="ml-3 mt-5">Cостав</label>
                                                                    <thead class="mt-4">
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Имя Игрока</th>
                                                                        <th>Голы</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($players as $player)
                                                                        <tr>
                                                                            <td>{{ $player->id }}</td>
                                                                            <td>{{ $player->name }}</td>
                                                                            <td>{{ $player->goalsAll() }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                </div>
                                <div class="col-md-4"> <!-- Image Column -->
                                    @if(!is_null($team->image))
                                        <div class="d-flex justify-content-end">
                                            <img src="{{ $team->image }}" alt="{{ $team->title }}" class="img-fluid">
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
                    <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-success">Редактировать</a>
                </div>
                <form action="{{ route('admin.teams.destroy', $team->id) }}" method="post">
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



