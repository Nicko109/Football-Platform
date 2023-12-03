<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Player;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];

        $data['usersCount'] = User::all()->count();
        $data['notesCount'] = Note::all()->count();
        $data['playersCount'] = Player::all()->count();
        $data['teamsCount'] = Team::all()->count();

        return view('main.index',compact('data'));
    }
}
