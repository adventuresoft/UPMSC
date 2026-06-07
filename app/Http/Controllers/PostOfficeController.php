<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostOffice;
use App\Models\User;
use App\Models\Union;
use App\Models\Upazilla;
use App\Models\District;
use App\Models\Division;

class PostOfficeController extends Controller
{
    private function getUserUpazillaInfo($user)
    {
        $thana_id = null;
        $district_id = null;
        $division_id = null;
        $is_union_admin = false;

        if ($user->role_id == 6 && $user->area) {
            $is_union_admin = true;
            $area = trim($user->area);
            
            if (str_contains($area, 'Union:')) {
                $unionId = str_replace('Union:', '', $area);
                $union = Union::find($unionId);
                if ($union && $union->upazilla) {
                    $thana_id = $union->thana_id;
                    if ($union->upazilla->district) {
                        $district_id = $union->upazilla->district_id;
                        if ($union->upazilla->district->division) {
                            $division_id = $union->upazilla->district->division_id;
                        }
                    }
                }
            } elseif (str_contains($area, 'Upazilla:')) {
                $thana_id = str_replace('Upazilla:', '', $area);
                $upazilla = Upazilla::find($thana_id);
                if ($upazilla) {
                    if ($upazilla->district) {
                        $district_id = $upazilla->district_id;
                        if ($upazilla->district->division) {
                            $division_id = $upazilla->district->division_id;
                        }
                    }
                }
            }
        } elseif ($user->institute_id) {
            $institute = $user->institute;
            if ($institute) {
                if ($institute->union_id && $institute->union) {
                    $is_union_admin = true;
                    $thana_id = $institute->union->thana_id;
                    if ($institute->union->upazilla) {
                        if ($institute->union->upazilla->district) {
                            $district_id = $institute->union->upazilla->district_id;
                            if ($institute->union->upazilla->district->division) {
                                $division_id = $institute->union->upazilla->district->division_id;
                            }
                        }
                    }
                }
            }
        }

        return compact('thana_id', 'district_id', 'division_id', 'is_union_admin');
    }

    public function postOfficesByUpazilla(Request $request, $id)
    {
        $html = '<option value="">ডাকঘর নির্বাচন করুন</option>';

        $postOffices = PostOffice::where('thana_id', $id)->get();

        if(count($postOffices)) {
            foreach ($postOffices as $postOffice) {
               $name = $postOffice->bn_name ?: $postOffice->name;
               $html .='<option value="'.$postOffice->id.'">'.$name.'</option>';
            }
        }

        return $html;
    }

    public function index()
    {
        $user = auth()->user();
        $upazillaInfo = $this->getUserUpazillaInfo($user);

        $query = PostOffice::with('upazilla.district')->latest();

        if ($upazillaInfo['is_union_admin'] && $upazillaInfo['thana_id']) {
            $query->where('thana_id', $upazillaInfo['thana_id']);
        }

        $data['post_offices'] = $query->get();
        return view('backend.pages.basic.post_office.index', $data);
    }

    public function create()
    {
        $user = auth()->user();
        $upazillaInfo = $this->getUserUpazillaInfo($user);

        $data['divisions'] = Division::all();
        $data['is_union_admin'] = $upazillaInfo['is_union_admin'];
        $data['selected_division'] = $upazillaInfo['division_id'];
        $data['selected_district'] = $upazillaInfo['district_id'];
        $data['selected_thana'] = $upazillaInfo['thana_id'];

        if ($upazillaInfo['is_union_admin']) {
            if ($upazillaInfo['district_id']) {
                $data['districts'] = District::where('division_id', $upazillaInfo['division_id'])->get();
            } else {
                $data['districts'] = collect();
            }
            if ($upazillaInfo['thana_id']) {
                $data['upazillas'] = Upazilla::where('district_id', $upazillaInfo['district_id'])->get();
            } else {
                $data['upazillas'] = collect();
            }
        }

        return view('backend.pages.basic.post_office.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $upazillaInfo = $this->getUserUpazillaInfo($user);

            $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'name' => 'required',
                'thana_id' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response()->json($data, 400);
            }

            $thana_id = $request->thana_id;
            if ($upazillaInfo['is_union_admin'] && $upazillaInfo['thana_id']) {
                $thana_id = $upazillaInfo['thana_id'];
            }

            $postOffice = new PostOffice();
            $postOffice->name = $request->name;
            $postOffice->bn_name = $request->bn_name;
            $postOffice->postal_code = $request->postal_code;
            $postOffice->url = $request->url;
            $postOffice->thana_id = $thana_id;
            $postOffice->status = $request->status ? $request->status : 1;

            if ($postOffice->save()) {
                $data['status'] = true;
                $data['message'] = "Post Office Saved Successfully!";
                return response()->json($data, 200);
            } else {
                $data['status'] = false;
                $data['message'] = "Failed to save data!";
                return response()->json($data, 500);
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        $upazillaInfo = $this->getUserUpazillaInfo($user);

        $post_office = PostOffice::with('upazilla.district')->find($id);

        if ($upazillaInfo['is_union_admin'] && $upazillaInfo['thana_id']) {
            if (!$post_office || $post_office->thana_id != $upazillaInfo['thana_id']) {
                return redirect()->route('basic-settings.post-office.index')->with('error', 'You are not authorized to edit this post office.');
            }
        }

        $data['post_office'] = $post_office;
        $data['divisions'] = Division::all();
        $data['is_union_admin'] = $upazillaInfo['is_union_admin'];
        
        $division_id = null;
        if($post_office && $post_office->upazilla && $post_office->upazilla->district) {
            $division_id = $post_office->upazilla->district->division_id;
            $data['districts'] = District::where('division_id', $division_id)->get();
            $data['upazillas'] = Upazilla::where('district_id', $post_office->upazilla->district_id)->get();
        } else {
            $data['districts'] = collect();
            $data['upazillas'] = collect();
        }
        
        return view('backend.pages.basic.post_office.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $upazillaInfo = $this->getUserUpazillaInfo($user);

            $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'name' => 'required',
                'thana_id' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response()->json($data, 400);
            }

            $postOffice = PostOffice::find($id);

            if (!$postOffice) {
                $data['status'] = false;
                $data['message'] = "Post Office not found!";
                return response()->json($data, 404);
            }

            if ($upazillaInfo['is_union_admin'] && $upazillaInfo['thana_id']) {
                if ($postOffice->thana_id != $upazillaInfo['thana_id']) {
                    $data['status'] = false;
                    $data['message'] = "You are not authorized to update this post office.";
                    return response()->json($data, 403);
                }
            }

            $thana_id = $request->thana_id;
            if ($upazillaInfo['is_union_admin'] && $upazillaInfo['thana_id']) {
                $thana_id = $upazillaInfo['thana_id'];
            }

            $postOffice->name = $request->name;
            $postOffice->bn_name = $request->bn_name;
            $postOffice->postal_code = $request->postal_code;
            $postOffice->url = $request->url;
            $postOffice->thana_id = $thana_id;
            $postOffice->status = $request->status ? $request->status : 1;

            if ($postOffice->save()) {
                $data['status'] = true;
                $data['message'] = "Post Office Updated Successfully!";
                return response()->json($data, 200);
            } else {
                $data['status'] = false;
                $data['message'] = "Failed to save data!";
                return response()->json($data, 500);
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = auth()->user();
            $upazillaInfo = $this->getUserUpazillaInfo($user);

            $postOffice = PostOffice::find($id);
            
            if (!$postOffice) {
                $data['status'] = false;
                $data['message'] = "Post Office not found!";
                return response()->json($data, 404);
            }

            if ($upazillaInfo['is_union_admin'] && $upazillaInfo['thana_id']) {
                if ($postOffice->thana_id != $upazillaInfo['thana_id']) {
                    $data['status'] = false;
                    $data['message'] = "You are not authorized to delete this post office.";
                    return response()->json($data, 403);
                }
            }

            if ($postOffice->delete()) {
                $data['status'] = true;
                $data['message'] = "Post Office Deleted successfully";
                return response()->json($data, 200);
            } else {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                return response()->json($data, 500);
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }
}
