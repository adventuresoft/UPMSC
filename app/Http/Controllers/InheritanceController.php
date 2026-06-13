<?php

namespace App\Http\Controllers;

use App\Models\Certificate\DeathCertificate;
use App\Models\Certificate\Inheritance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class InheritanceController extends Controller
{
    public function index()
    {
        $data['certificates'] = Inheritance::with([
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
            'deathPerson.user'
        ])
        ->applyMultitenancy()
        ->latest()
        ->get();
        return view('backend.pages.certificate.inheritance.index', $data);
    }

    public function create()
    {
        $data['users'] = User::with('people')
        ->where('status', true)
        ->whereNotIn('role_id', [1, 2, 3, 4])
        ->whereHas('people', function ($q) {$q->whereNotNull('approved_id');})
        ->applyMultitenancy()
        ->get();
        return view('backend.pages.certificate.inheritance.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
                'applicant_id' => 'required|exists:users,system_id',
                'death_certificate_id' => 'nullable|exists:death_certificates,system_id',
            ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Invalid input contains! Please check your entries...";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $user = User::where('system_id', $request->applicant_id)->first();
        $death_certificate = null;
        if ($request->filled('death_certificate_id')) {
            $death_certificate = DeathCertificate::where('system_id', $request->death_certificate_id)->first();
        }
        
        if (!$user) {
            $data['status'] = false;
            $data['message'] = "Invalid input contains! Please check your entries...";
            $data['errors'] = [];
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $new_certificate = new Inheritance();
            $new_certificate->user_id = $user->id;
            $new_certificate->death_certificate_id  = $death_certificate ? $death_certificate->id : null;
            $new_certificate->members = $request->members ? json_encode($request->members) : NULL;
            $new_certificate->created_by = Auth::id();
            $new_certificate->save();
            $data['status'] = true;
            $data['message'] = "Submitted successfully!";
            $data['redirect_url'] = route('inheritance.index');
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to save data!";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }

    }

    public function show($id)
    {
        $data['certificate'] = Inheritance::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard');
            }))->with(array('institute' => function($q3){
                $q3->with('union.thana.district', 'pourashava.District', 'cityCorporation.District');
            }));
        }))->with('deathPerson')->find($id);
        return view('backend.pages.certificate.inheritance.certificate', $data);
        $html = view('backend.pages.certificate.inheritance.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');
    }

    public function bn_certificate($id)
    {
        $data['certificate'] = Inheritance::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard');
            }))->with(array('institute' => function($q3){
                $q3->with('union.thana.district', 'pourashava.District', 'cityCorporation.District');
            }));
        }))->with('deathPerson')->find($id);
        return view('backend.pages.certificate.inheritance.bn_certificate', $data);
        $html = view('backend.pages.certificate.inheritance.bn_certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');
    }

    public function edit(Inheritance $inheritance)
    {
        $data['inheritance'] = $inheritance;
        $data['users'] = User::with('people')
        ->where('status', true)
        ->where('role_id', 5)
        ->whereHas('people', function ($q) {$q->whereNotNull('approved_id');})
        ->applyMultitenancy()
        ->get();
        return view('backend.pages.certificate.inheritance.edit', $data);
    }

    public function update(Request $request, Inheritance $inheritance)
    {
        $validate = Validator::make($request->all(), [
                'applicant_id' => 'required|exists:users,system_id',
                'death_certificate_id' => 'nullable|exists:death_certificates,system_id',
            ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Invalid input contains! Please check your entries...";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $user = User::where('system_id', $request->applicant_id)->first();
        $death_certificate = null;
        if ($request->filled('death_certificate_id')) {
            $death_certificate = DeathCertificate::where('system_id', $request->death_certificate_id)->first();
        }
        
        if (!$user) {
            $data['status'] = false;
            $data['message'] = "Invalid input contains! Please check your entries...";
            $data['errors'] = [];
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $inheritance->user_id = $user->id;
            $inheritance->death_certificate_id  = $death_certificate ? $death_certificate->id : null;
            $inheritance->members = $request->members ? json_encode($request->members) : NULL;
            $inheritance->save();
            
            $data['status'] = true;
            $data['message'] = "Updated successfully!";
            $data['redirect_url'] = route('inheritance.index');
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to update data!";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }

    public function destroy(Inheritance $inheritance)
    {
        //
    }
}
