<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Matchs;
use App\Models\Standing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MatchesController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        $matches = Matchs::with(['club1', 'club2'])->get();
        $standings = Standing::with('club')->orderBy('points', 'desc')->get();
        return view('matches.index', compact('clubs',  'matches', 'standings'));
    }

    public function store(Request $request)
    {
        $rules = [
            'club1_id' => ['required', 'integer'],
            'club2_id' => [
                'required', 'integer', 'different:club1_id',
                Rule::unique('matchs')->where(function ($query) use ($request) {
                    return $query->where('club1_id', $request->club1_id)
                        ->where('club2_id', $request->club2_id);
                }),
                Rule::notIn([$request->club1_id])
            ],
        ];

        $customMessages = [
            'club2_id.different' => 'The second club must be different from the first club.',
            'club2_id.unique' => 'The combination of clubs already exists.',
            'club2_id.not_in' => 'The second club cannot be the same as the first club.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $match = Matchs::create($request->all());

        $this->updateStandings($match);

        return redirect()->route('matches')->with('success', 'Match created successfully!');
    }
    
    private function updateStandings($match)
    {
        $club1 = Club::find($match->club1_id);
        $club2 = Club::find($match->club2_id);
    
        $this->updateStanding($club1, $match->score1, $match->score2);
        $this->updateStanding($club2, $match->score2, $match->score1);
    }
    
    private function updateStanding($club, $scoreFor, $scoreAgainst)
    {
        $standing = $club->standing ?? new Standing();
        
        $standing->played++;
        if ($scoreFor > $scoreAgainst) {
            $standing->won++;
            $standing->points += 3; 
        } elseif ($scoreFor == $scoreAgainst) {
            $standing->drawn++;
            $standing->points += 1; 
        } else {
            $standing->lost++;
        }
        $standing->goals_for += $scoreFor;
        $standing->goals_against += $scoreAgainst;
    
        $club->standing()->save($standing);
    }
}
