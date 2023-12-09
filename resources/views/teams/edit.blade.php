@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать команду</h1>
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
                    <form action="{{ route('admin.teams.update', $team->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Название команды" name="title" id="title"
                                   value="{{ $team->title }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Редактировать изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">{{ $team->image }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузка</span>
                                </div>
                            </div>
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Выберите игроков команды</label>
                            <select name="player_id[]" class="form-control" multiple style="height: 200px;">
                                @foreach($allPlayers as $player)
                                    @if(in_array($player->id, $teamPlayerIds))
                                        <option selected value="{{ $player->id }}">{{ $player->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Выберите свободных игроков</label>
                            <select name="player_id[]" class="form-control" multiple style="height: 200px;">
                                @foreach($inactivePlayers as $player)
                                    <option value="{{ $player->id }}" {{ in_array($player->id, (array) old('player_id')) ? 'selected' : '' }}>
                                        {{ $player->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" value="Редактировать">
                        </div>
                        <div class="mr-4">
                            <a href="{{ route('admin.teams.show', $team->id) }}" class="btn btn-primary">Назад</a>
                        </div>
                    </form>
                </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
