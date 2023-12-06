<?php

namespace App\Helpers;

use App\Models\Player;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;

use function Ramsey\Collection\add;

class FootballParser
{
    public function parse()
    {
    }

    public function parseTeamPlayers($url)
    {
        $players = [];

        $dom = $this->getDomByUrl($url);
        foreach ($dom->find('.table-responsive__body td._name a') as $link) {
            $url = 'https://www.championat.com' . $link->getAttribute('href');
            $player = $this->parsePlayer($url);
            $players[] = $player;
        }


        return $players;
    }


    public function parsePlayer($url)
    {
        try {
            $dom = $this->getDomByUrl($url);


            if (count($dom->find('.entity-header__title-name a')) > 0) {
                $playerName = trim($dom->find('.entity-header__title-name')->find('a')[0]->text);
            } else {
                $playerName = trim($dom->find('.entity-header__title-name')->text);
            }

            $playerImage = $dom->find('.entity-header__img')->find('img')[0]->getAttribute('src');
            $playerFacts = [];
            $facts = $dom->find('.entity-header__facts')[0];
            foreach ($facts->find('li') as $fact) {
                $param = $fact->find('div')[0]->text;
                $param = str_replace(':', '', $param);
                if (count($fact->find('a')) > 0) {
                    $value = trim($fact->find('a')[0]->text);
                } else {
                    $value = trim($fact->text);
                }
                $playerFacts[$param] = $value;
            }


            return Player::firstOrCreate(
                ['name' => $playerName],
                ['image' => $playerImage, 'meta' => $playerFacts]
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function parseTeam($url)
    {

    }

    public function parseGame($url)
    {

    }


    /**
     * @param $url
     * @return Dom
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     */
    private function getDomByUrl($url)
    {
        $client = new Client(['verify' => false]);


        $request = $client->get($url);

        $content = $request->getBody()->getContents();

        $dom = new Dom;
        $dom->loadStr($content);
        return $dom;
    }

}