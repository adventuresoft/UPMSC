<?php

namespace App\Http\Controllers;

use App\Models\People\JulyFighterInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JulyFighterInfoController extends Controller
{
    public function create($id)
    {
        $data['user'] = User::with('julyFighterInfo')->find($id);
        return view('backend.pages.people.tabs.july_fighter', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_july_fighter' => 'required',
            'fighter_type' => 'nullable',
            'incident_location' => 'nullable',
            'injury_details' => 'nullable',
            'contribution_description' => 'nullable',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {
                JulyFighterInfo::updateOrCreate([
                    'user_id' => $request->user_id
                ], [
                    'is_july_fighter' => $request->is_july_fighter ?? false,
                    'fighter_type' => $request->is_july_fighter ? $request->fighter_type : null,
                    'incident_location' => $request->is_july_fighter ? $request->incident_location : null,
                    'injury_details' => $request->is_july_fighter ? $request->injury_details : null,
                    'contribution_description' => $request->is_july_fighter ? $request->contribution_description : null
                ]);

                $data['status'] = true;
                $data['message'] = "July 24 Fighter information submitted successfully!";
                $data['redirect_url'] = route('people.index'); // Final step or next tab?
                $data['code'] = 200;
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "July 24 Fighter Information Save Failed!";
                $data['code'] = 500;
                $data['errors'] = $th;
                return $data;
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }
}
