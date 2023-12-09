@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать игрока</h1>
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
                    <form action="{{route('admin.players.update', $player->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Имя игрока" name="name" id="name"
                                   value="{{ $player->name }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Редактировать изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" value="{{$player->image}}">
                                    <label class="custom-file-label">{{$player->image}}</label>
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
                            <div>
                                <label for="content">Редактировать описание</label>
                            </div>
                            <textarea id="content" name="content" rows="8" cols="80">{{ $player->content }}</textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" value="Редактировать">
                        </div>
                        <div class="mr-4">
                            <a href="{{ route('admin.players.show', $player->id) }}" class="btn btn-primary">Назад</a>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
