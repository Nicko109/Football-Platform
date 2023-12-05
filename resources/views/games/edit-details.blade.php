@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать игру</h1>
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
                    <form action="{{route('admin.games.updateDetails', $game->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group w-25">
                            <label for="date">Дата игры</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="date" id="date"
                                       value="{{$game->date}}">
                            </div>
                            @error('date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label>Выберите первую команду</label>
                            <select name="team_id" class="form-control">
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $team->id == $game->team_id ? 'selected' : '' }}>
                                        {{ $team->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('team_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group w-50">
                            <label>Выберите вторую команду</label>
                            <select name="opponent_id" class="form-control">
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $team->id == $game->opponent_id ? 'selected' : '' }}>
                                        {{ $team->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('opponent_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" value="Редактировать">
                        </div>
                        <div class="mr-4">
                            <a href="{{ route('admin.games.show', $game->id) }}" class="btn btn-primary">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
