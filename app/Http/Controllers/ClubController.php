<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        return view('club.index', compact('clubs'));
    }

    public function store(Request $request)
    {
        $customMessages = [
            'name.unique' => 'The club name is already in use',
            'name.required' => 'Club name must be filled in',
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('clubs', 'name')
            ]
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Club::create($request->all());

        return redirect()->back()->with('success', 'Club created successfully!');
    }
}
