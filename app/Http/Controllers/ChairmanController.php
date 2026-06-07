<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
use App\Models\People\AddressInfo;
use App\Models\People\AreaInfo;
use App\Models\People\ChairmanAreaInfo;
use App\Models\People\CouncilMemberHistory;
use App\Models\People\CharimanAreaDetail;
use App\Models\People\EducationalInfo;
use App\Models\People\FinancialInfo;
use App\Models\People\DisabilityInfo;
use App\Models\People\PropertyInfo;
use App\Models\People\FreedomFighterInfo;
use App\Models\BasicSettings\Profession;
use App\Models\People\FamilyInfo;
use App\Models\ChairmanMayor;
use App\Models\Council;
use App\Models\CouncilMember;
use App\Models\Religion;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazilla;
use App\Models\Union;
use App\Models\BasicSettings\Country;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ChairmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      if(isset($user->institute->union_id) && $user->institute->union_id) {
          $data['councils']=Council::where('union_id', $user->institute->union_id)->paginate(100);
      } else {
          $data['councils']=Council::paginate(100);
      }
      return view('backend.pages.chairman.index', $data);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $data['religions'] = Religion::where('status', true)->get();
        $data['countries'] =  Country::orderBy('name')->get();
        
        // Initialize with empty collections
        $data['divisions'] = collect();
        $data['districts'] = collect();
        $data['userUnion'] = null;
        $data['unionPeople'] = collect();
        $data['userThana'] = null;
        $data['userDistrict'] = null;
        $data['userDivision'] = null;
        $data['districtsForDivision'] = collect();
        $data['thanasForDistrict'] = collect();
        
        // Get user's union data and restrict all selections to that union
        if($user->institute && $user->institute->union_id) {
            $union = Union::find($user->institute->union_id);
            $data['userUnion'] = $union;
            $data['unionPeople'] = AddressInfo::where(function ($query) use ($user) {
                $query->where('present_union_id', $user->institute->union_id)
                      ->orWhere('permanent_union_id', $user->institute->union_id);
            })->get()->unique('user_id')->values();
            
            // Get the hierarchy: union -> thana -> district -> division
            if($union && $union->upazilla) {
                $thana = $union->upazilla;
                $data['userThana'] = $thana;
                
                if($thana->district) {
                    $district = $thana->district;
                    $data['userDistrict'] = $district;
                    
                    // Only show districts from this division
                    $data['districtsForDivision'] = District::where('division_id', $district->division_id)->get();
                    // For the main districts dropdown, only show this district
                    $data['districts'] = District::where('id', $district->id)->get();
                    
                    if($district->Division) {
                        $data['userDivision'] = $district->Division;
                        // Only show this division
                        $data['divisions'] = Division::where('id', $district->division_id)->get();
                    }
                    
                    // Get thanas for this district
                    $data['thanasForDistrict'] = Upazilla::where('district_id', $district->id)->get();
                }
            }
        } else {
            // If no union assigned, show all data
            $data['districts'] = District::where('status', true)->orderBy('name')->get(); 
            $data['divisions'] = Division::latest()->get();
        }
        
        return view('backend.pages.chairman.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function personalstore(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {

                $user = Auth::user();
                $council = new Council();
                // enforce union multitenancy: if the authenticated user is tied to a union, use it
                $council->union_id = $user->institute->union_id ?? $request->union_id;
                $council->start_date=date('Y-m-d',strtotime($request->start_date));
                $council->end_date=date('Y-m-d',strtotime($request->end_date));
                $council->status=1;
                if ($council->save()) {
                   $wordTitles=[
                    2=>'ওয়ার্ড নং-১',
                    3=>'ওয়ার্ড নং-২',
                    4=>'ওয়ার্ড নং-৩',
                    5=>'ওয়ার্ড নং-৪',
                    6=>'ওয়ার্ড নং-৫',
                    7=>'ওয়ার্ড নং-৬',
                    8=>'ওয়ার্ড নং-৭',
                    9=>'ওয়ার্ড নং-৮',
                    10=>'ওয়ার্ড নং-৯',
                    11=>'ওয়ার্ড নং-১ (১,২,৩)',
                 12=>'ওয়ার্ড নং-২ (৪,৫,৬)',
                 13=>'ওয়ার্ড নং-৩ (৭,৮,৯)', 
                ];

                for($i=1;$i<15;$i++){
                    if($i==1){
                        $position=1;
                        $word_no_text='';
                    }else if($i>1 && $i < 11){
                        $position=2;
                        $word_no_text=$wordTitles[$i];

                    }elseif($i>10 && $i<14){
                        $position=3;  
                        $word_no_text=$wordTitles[$i];                          
                    }
                    else{
                        $position=4;
                        $word_no_text='';
                    }
                    $userId = $request->userinfo[$i-1] ?? null;
                    if($userId && is_numeric($userId)) {
                        $cmember=new CouncilMember;
                        $cmember->council_id=$council->id;
                        $cmember->word_no_text=$word_no_text;

                        $cmember->user_id=$userId;
                        $cmember->concilor_designation_id=$position;
                        $cmember->start_date=date('Y-m-d',strtotime($request->start_date));
                        $cmember->end_date=date('Y-m-d',strtotime($request->end_date));
                        $cmember->status=1;
                        $cmember->order=$i;

                        $cmember->save();
                    }

                }
                $data['status'] = true;
                $data['message'] = "Council saved successfully.";

                $data['code'] = 200;
                $data['redirect_url'] = route('chairman.index');
                return $data;
            } else {
                $data['status'] = false;
                $data['message'] = "People save failed! Please try again...";
                $data['people'] = $people;
                $data['code'] = 500;
                return $data;
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['code'] = 500;
            $data['errors'] = $th;
            $data['message'] = "Something went wrong! Please try again or contact on support...";

            return $data;
        }
    });
        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    function fetch(Request $request)
    {
    $user = Auth::user();
    if($request->get('query'))
    {
       $query = $request->get('query');
       // enforce union filtering if user has a union
       $unionId = $user->institute->union_id ?? null;
       $data = DB::table('users')
       ->join('people','users.id','=','people.user_id');
       if ($unionId) {
           $data = $data->join('institutes', 'users.institute_id', '=', 'institutes.id')
                        ->where('institutes.union_id', $unionId);
       }
       $data = $data->where('system_id', 'LIKE', "%{$query}%")->get();
          {
             $output .= '
             <li class="droplist" id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
             ';
         }
         $output .= '</ul>';
         echo $output;
     }
 }

 public function getPeopleByUnion(Request $request, $id){
    $html = '<option value="">Select Select</option>';

    $thanas = AddressInfo::where(function ($query) use ($id) {
                $query->where('present_union_id', $id)
                      ->orWhere('permanent_union_id', $id);
            })->get()->unique('user_id')->values();
    if(count($thanas)) {
        foreach ($thanas as $thana) {
         $html .='<option value="'.$thana->user_id.'">'.$thana->User->system_id.' : '.$thana->User->name.'</option>';
     }
 }

 return $html;
}

public function edit($id)
{
    $data['religions'] = Religion::where('status', true)->get();
    $data['districts'] =  District::where('status', true)->orderBy('name')->get(); 
    $data['countries'] =  Country::orderBy('name')->get(); 
    $data['divisions'] = Division::latest()->get();

    $user = Auth::user();
    $council = Council::find($id);
    // enforce union multitenancy
    if ($user->institute->union_id ?? null) {
        if ($council->union_id != $user->institute->union_id) {
            abort(403, 'Unauthorized: Council does not belong to your union');
        }
    }
    $data['council'] =$council;
    $data['districts'] = District::where('division_id',$council->union->Upazilla->District->division_id)->get();

    $data['thanas'] = Upazilla::where('district_id',$council->union->Upazilla->district_id)->get();
    $data['unions'] = Union::where('thana_id',$council->union->thana_id)->get();
    $data['chairmans']=AddressInfo::where(function ($query) use ($council) {
                $query->where('present_union_id', $council->union_id)
                      ->orWhere('permanent_union_id', $council->union_id);
            })->get()->unique('user_id')->values();

    return view('backend.pages.chairman.edit', $data);
}

public function show($id)
{
    $user = Auth::user();
    $data['council'] = Council::find($id);
    // enforce union multitenancy
    if ($user->institute->union_id ?? null) {
        if ($data['council']->union_id != $user->institute->union_id) {
            abort(403, 'Unauthorized: Council does not belong to your union');
        }
    }
    return view('backend.pages.chairman.show', $data);
}


public function fromupdate(Request $request)
{


    $validate = Validator::make($request->all(), [
        'start_date' => 'required',
        'end_date' => 'required',

    ]);
// dd($request);
    if ($validate->fails()) {
        $data['status'] = false;
        $data['message'] = "Sorry! Invalid Entry.";
        $data['errors'] = $validate->errors();
        return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
    }

    $result = DB::transaction(function () use ($request) {
        try {         

            $id=$request->id;       
            $council = Council::find($id);
            $user = Auth::user();
            // enforce union multitenancy: do not allow changing union to a different union than user's
            $council->union_id = $user->institute->union_id ?? $request->union_id;
            $council->start_date=date('Y-m-d',strtotime($request->start_date));
            $council->end_date=date('Y-m-d',strtotime($request->end_date));
            $council->status=$request->status;
            $save=$council->save();

            if ($save) {

                CouncilMember::where('council_id',$id)->delete();

                for($i=1;$i<15;$i++){
                    if($i==1){
                        $position=1;
                    }else if($i>1 && $i < 11){
                        $position=2;
                    }elseif($i>10 && $i<14){
                        $position=3;

                    }
                    else{
                        $position=4;
                    }
                    $userId = $request->userinfo[$i-1] ?? null;
                    if($userId && is_numeric($userId)) {
                        $cmember=new CouncilMember;
                        $cmember->council_id=$council->id;
                        $cmember->user_id=$userId;
                        $cmember->concilor_designation_id=$position;
                        $cmember->start_date=date('Y-m-d',strtotime($request->start_date));
                        $cmember->end_date=date('Y-m-d',strtotime($request->end_date));
                        $cmember->status=1;
                        $cmember->order=$i;

                        $csave=$cmember->save();
                    }                    
                }
                $data['status'] = true;
                $data['message'] = "Council Update successfully.";

                $data['code'] = 200;
                $data['redirect_url'] = route('chairman.index');
                return $data;
            } else {
                $data['status'] = false;
                $data['message'] = "People save failed! Please try again...";
                $data['people'] = $people;
                $data['code'] = 500;
                return $data;
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['code'] = 500;
            $data['errors'] = $th;
            $data['message'] = "Something went wrong! Please try again or contact on support...";

            return $data;
        }
    });
    return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
}

public function changeMember($id){
    $user = Auth::user();
    $cm=CouncilMember::find($id);
    $council =Council::find($cm->council_id);
    // enforce union multitenancy
    if ($user->institute->union_id ?? null) {
        if ($council->union_id != $user->institute->union_id) {
            abort(403, 'Unauthorized: Council Member does not belong to your union');
        }
    }
    $data['chairmans']=AddressInfo::where(function ($query) use ($council) {
                $query->where('present_union_id', $council->union_id)
                      ->orWhere('permanent_union_id', $council->union_id);
            })->get()->unique('user_id')->values();
    $data['council']=$council;
    $data['cm']=$cm;
    return view('backend.pages.chairman.show_single', $data);
}

public function councilorUpdate(Request $request){


    $result = DB::transaction(function () use ($request) {
        try {      
           $comh=new CouncilMemberHistory;
           $comh->council_id=$request->council_id;
           $comh->council_member_id=$request->council_member_id;
           $comh->user_id=$request->user_id;
           $comh->concilor_designation_id=$request->concilor_designation_id;
           $comh->word_no_text=$request->word_no_text;
           $comh->start_date=date('Y-m-d',strtotime($request->start_date));
           $comh->end_date=date('Y-m-d',strtotime($request->end_date));
           $comh->reason=$request->reason;
           $comh->note=$request->note;
           $comh->status=2;
           $comh->order=$request->order;
           $comh->save();

           // validate council and member belong to same union as authenticated user
           $user = Auth::user();
           $cm=CouncilMember::find($request->council_member_id);
           $council = Council::find($request->council_id);
           if ($user->institute->union_id ?? null) {
               if ($council->union_id != $user->institute->union_id) {
                   return response()->json(['status'=>false,'message'=>'Unauthorized: union mismatch'], 403);
               }
           }
           // ensure the selected member user belongs to the same union (if possible)
           $newMemberUser = User::find($request->member_id);
           if ($newMemberUser && ($newMemberUser->institute->union_id ?? null) && $council->union_id && $newMemberUser->institute->union_id != $council->union_id) {
               return response()->json(['status'=>false,'message'=>'Selected member does not belong to this union'], 403);
           }
           $cm->user_id=$request->member_id;
           $cm->start_date=date('Y-m-d',strtotime($request->new_start_date));
           $cm->end_date=date('Y-m-d',strtotime($request->new_end_date));
           $cm->status=$request->status;
           $cm->save();



           $data['status'] = true;
           $data['message'] = "Council Update successfully.";
           $data['code'] = 200;
           $data['redirect_url'] = route('chairman.index');
           return $data;

       } catch (\Throwable $th) {
        $data['status'] = false;
        $data['code'] = 500;
        $data['errors'] = $th;
        $data['message'] = "Something went wrong! Please try again or contact on support...";

        return $data;
    }
});

    return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
}

public function chairmanList()
{
    $user = Auth::user();
    $query = CouncilMember::with(['user', 'council', 'council.union', 'council.union.Upazilla', 'council.union.Upazilla.District', 'council.union.Upazilla.District.Division'])
        ->where('concilor_designation_id', 1);

    if(isset($user->institute->union_id) && $user->institute->union_id) {
        $query->whereHas('council', function($q) use ($user) {
            $q->where('union_id', $user->institute->union_id);
        });
    }

    $data['members'] = $query->paginate(100);
    return view('backend.pages.chairman.chairman_list', $data);
}

public function memberList()
{
    $user = Auth::user();
    $query = CouncilMember::with(['user', 'council', 'council.union', 'council.union.Upazilla', 'council.union.Upazilla.District', 'council.union.Upazilla.District.Division'])
        ->where('concilor_designation_id', 2);

    if(isset($user->institute->union_id) && $user->institute->union_id) {
        $query->whereHas('council', function($q) use ($user) {
            $q->where('union_id', $user->institute->union_id);
        });
    }

    $data['members'] = $query->paginate(100);
    return view('backend.pages.chairman.member_list', $data);
}

public function reserveMemberList()
{
    $user = Auth::user();
    $query = CouncilMember::with(['user', 'council', 'council.union', 'council.union.Upazilla', 'council.union.Upazilla.District', 'council.union.Upazilla.District.Division'])
        ->where('concilor_designation_id', 3);

    if(isset($user->institute->union_id) && $user->institute->union_id) {
        $query->whereHas('council', function($q) use ($user) {
            $q->where('union_id', $user->institute->union_id);
        });
    }

    $data['members'] = $query->paginate(100);
    return view('backend.pages.chairman.reserve_member_list', $data);
}

public function panelList()
{
    $user = Auth::user();
    $isSuperAdmin = in_array($user->role_id, [1, 4]);
    $selectedUnionId = request('union_id', null);

    $query = CouncilMember::with(['user', 'council', 'council.union', 'council.union.Upazilla', 'council.union.Upazilla.District', 'council.union.Upazilla.District.Division']);

    if($isSuperAdmin && $selectedUnionId) {
        $query->whereHas('council', function($q) use ($selectedUnionId) {
            $q->where('union_id', $selectedUnionId);
        });
    } elseif(isset($user->institute->union_id) && $user->institute->union_id) {
        $query->whereHas('council', function($q) use ($user) {
            $q->where('union_id', $user->institute->union_id);
        });
    }

    $councilsQuery = Council::with(['union', 'union.Upazilla', 'union.Upazilla.District', 'union.Upazilla.District.Division']);

    if($isSuperAdmin && $selectedUnionId) {
        $councilsQuery->where('union_id', $selectedUnionId);
    } elseif(isset($user->institute->union_id) && $user->institute->union_id) {
        $councilsQuery->where('union_id', $user->institute->union_id);
    }

    $data['councils'] = $councilsQuery->get();
        
    $data['members'] = $query->get();

    $data['isSuperAdmin'] = $isSuperAdmin;
    $data['selectedUnionId'] = $selectedUnionId;

    if($isSuperAdmin) {
        $data['unions'] = \App\Models\Union::with(['Upazilla', 'Upazilla.District', 'Upazilla.District.Division'])->get();
    }

    $unionIds = $data['councils']->pluck('union_id')->filter()->unique()->values();
    $data['institutes'] = \App\Models\Institute::whereIn('union_id', $unionIds)->get()->keyBy('union_id');

    return view('backend.pages.chairman.panel_list', $data);
}

}
