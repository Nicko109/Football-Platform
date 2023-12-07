<?php

namespace App\Services;


use App\Models\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlayerService
{
    public static function index()
    {
        $players = Player::paginate(15);

        return $players;
    }




    public static function store(array $data) : Player
    {
        $path = Storage::disk('public')->put('player' , $data['image']);
        $fullPath = Storage::disk('public')->url($path);
        $data['image'] = $fullPath;
        return Player::create($data);
    }

    public static function show(Player $player)
    {

        return $player;
    }



    public static function update(Player $player, array $data)
    {

        return $player->update($data);
    }



    public static function destroy(Player $player)
    {
        return $player->delete();
    }


    public static function updateImage(Player $player, array $data)
    {
        // Проверяем, предоставлен ли новый файл изображения
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            // Удаляем старое изображение
            Storage::disk('public')->delete($player->image);

            // Сохраняем новое изображение
            $path = Storage::disk('public')->put('player', $data['image']);
            $fullPath = Storage::disk('public')->url($path);
            $data['image'] = $fullPath;
        }

        // Возвращаем обновленные данные
        return $data;
    }

}
