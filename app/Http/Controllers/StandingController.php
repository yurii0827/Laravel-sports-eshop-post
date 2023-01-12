<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use App\Models\Team;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StandingController extends Controller
{

    public function index() {
        $east = Team::where('conference','=','east')->get();
        $west = Team::where('conference','=','west')->get();
        return view('teams.standings',compact('east','west'));
    }

    public function standings()
    {

        $data = Http::get('https://cdn.nba.com/static/json/staticData/scheduleLeagueV2_9.json');

        json_encode($data);

        foreach ($data['leagueSchedule']['gameDates'] as $games) {
            foreach ($games['games'] as $game) {

                $standings = new Standing();

              //  $standings->gameDate = date("Y-m-d H:i:s", strtotime($game['gameDateTimeEst']." +12 hours"));
                $standings->gameDate = $game['gameDateEst'];
                $standings->homeTeam =   $game['homeTeam']['teamName'];
                $standings->awayTeam =   $game['awayTeam']['teamName'];
                $standings->homeScore =  $game['homeTeam']['score'];
                $standings->awayScore =    $game['awayTeam']['score'];
                foreach ($game['pointsLeaders'] as $player) {
                    $standings->player =  $player['firstName'] . $player['lastName'];
                    $standings->playerScore = $player['points'];
                }
                $standings->save();

            }
        }
    }
}