<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Matchs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MatchesController extends Controller
{
    public function index()
    {
        $matches = Matchs::with(['club1', 'club2'])->get();
        $clubs = Club::all();
        return view('matches.index', compact('clubs',  'matches'));
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

        Matchs::create($request->all());

        return redirect()->route('matches')->with('success', 'Match created successfully!');
    }
}
