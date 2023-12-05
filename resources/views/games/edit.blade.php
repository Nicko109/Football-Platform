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
        <form action="{{route('admin.games.update', $game->id)}}" method="post">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-12">

                        @csrf
                        @method('patch')
                        <div class="form-group w-50">
                            <label>{{$game->team->title}}</label>
                        </div>
                        <div class="form-group w-50">
                            <label>Голы команды {{$game->team->title}}</label>
                            @foreach($game->team->players as $player)
                                <div class="mb-2 d-flex align-items-center">
                                    <input type="text" name="goals[{{ $game->team->id }}][{{ $player->id }}]" class="form-control w-25" placeholder="Голы"/>
                                    <label class="ml-3">{{ $player->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group w-50 d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <label for="date">Дата игры</label>
                                <label class="mt-2">Выберите победителя</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date" id="date" value="{{$game->date}}">
                                </div>
                                <select name="win" class="form-control ml-3">
                                    <option value="null" selected>Ничья</option>
                                    <option value="team_id">{{$game->team->title}}</option>
                                    <option value="opponent_id">{{$game->opponent->title}}</option>
                                </select>
                            </div>
                            @error('date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('win')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" value="Редактировать">
                        </div>
                        <div class="mr-4">
                            <a href="{{ route('admin.games.show', $game->id) }}" class="btn btn-primary">Назад</a>
                        </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group w-50">
                        <label>{{$game->opponent->title}}</label>
                    </div>
                    <div class="form-group w-50">
                        <label>Голы команды {{$game->opponent->title}}</label>
                        @foreach($game->opponent->players as $player)
                            <div class="mb-2 d-flex align-items-center">
                                <input type="text" name="goals[{{ $game->opponent->id }}][{{ $player->id }}]" class="form-control w-25" placeholder="Голы"/>
                                <label class="ml-3">{{ $player->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </form>
    </section>
    <!-- /.content -->
@endsection
