<?php

namespace App\Console\Commands;

use App\Helpers\FootballParser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class go extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'parsing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $parser = new FootballParser();
        $players = $parser->parseTeamPlayers('https://www.championat.com/football/_england/tournament/5467/teams/242797/pstat/');
    }
}
