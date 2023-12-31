@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Команды</h1>
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
                    <div class="card">
                        <div class="card-header">
                            <a  href="{{ route('admin.teams.create') }}" class="btn btn-primary">Добавить</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-wrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название команды</th>
                                    <th>Игры</th>
                                    <th>Победа</th>
                                    <th>Ничья</th>
                                    <th>Поражение</th>
                                    <th>Очки</th>
                                    <th>Голы</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $team->id }}</td>
                                        <td><a  href="{{ route('admin.teams.show', $team->id) }}">{{ $team->title }}</a></td>
                                        <td class="text-wrap">{{ $team->gamesTeamAll() + $team->gamesOpponentAll() }}</td>
                                        <td class="text-wrap">{{ $team->wins() }}</td>
                                        <td class="text-wrap">{{ $team->draws() }}</td>
                                        <td class="text-wrap">{{ $team->losses() }}</td>
                                        <td class="text-wrap">{{ $team->points }}</td>
                                        <td class="text-wrap">{{ $team->goalsAll() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <div>--}}
{{--                                {{ $teams->withQueryString()->links() }}--}}
{{--                            </div>--}}
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
