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
                        <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-warning ml-4">Играть</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-wrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Дата игры</th>
                                    <th>Название игры</th>
                                    <th>Cчёт</th>
                                    <th>Победитель</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td>{{ $game->formattedDate }}</td>
                                    <td>{{ $game->team->title }}  - {{ $game->opponent->title }}</a></td>
                                    @if($game->is_active)
                                        <td>{{ $game->teamGoalsCount() }}  - {{ $game->opponentGoalsCount() }}</td>
                                        <td>
                                            @if ($game->teamGoalsCount() > $game->opponentGoalsCount())
                                                {{ $game->team->title }}
                                            @elseif ($game->teamGoalsCount() < $game->opponentGoalsCount())
                                                {{ $game->opponent->title }}
                                            @else
                                                Ничья
                                            @endif
                                        </td>
                                    @else
                                        <td>-:-</td>
                                        <td>-:-</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Состав команды {{ $game->team->title }}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-wrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя игрока</th>
                            <th>Забитых голов</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($game->team->players as $player)
                            <tr>
                                <td>{{ $player->id }}</td>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->goalsInGame($game) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Display roster of the second team -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Состав команды {{ $game->opponent->title }}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-wrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя игрока</th>
                            <th>Забитых голов</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($game->opponent->players as $player)
                            <tr>
                                <td>{{ $player->id }}</td>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->goalsInGame($game) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card-header d-flex p-3">
                <div class="mr-4">
                    <a href="{{ route('admin.games.editDetails', $game->id) }}" class="btn btn-success">Редактировать</a>
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
