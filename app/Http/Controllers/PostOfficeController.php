<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostOffice;

class PostOfficeController extends Controller
{
    public function postOfficesByThana(Request $request, $id)
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
        $data['post_offices'] = PostOffice::with('thana.district')->latest()->get();
        return view('backend.pages.basic.post_office.index', $data);
    }

    public function create()
    {
        $data['divisions'] = \App\Models\Division::all();
        return view('backend.pages.basic.post_office.create', $data);
    }

    public function store(Request $request)
    {
        try {
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

            $postOffice = new PostOffice();
            $postOffice->name = $request->name;
            $postOffice->bn_name = $request->bn_name;
            $postOffice->postal_code = $request->postal_code;
            $postOffice->url = $request->url;
            $postOffice->thana_id = $request->thana_id;
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
        $post_office = PostOffice::with('thana.district')->find($id);
        $data['post_office'] = $post_office;
        $data['divisions'] = \App\Models\Division::all();
        
        $division_id = null;
        if($post_office && $post_office->thana && $post_office->thana->district) {
            $division_id = $post_office->thana->district->division_id;
            $data['districts'] = \App\Models\District::where('division_id', $division_id)->get();
            $data['thanas'] = \App\Models\Thana::where('district_id', $post_office->thana->district_id)->get();
        } else {
            $data['districts'] = collect();
            $data['thanas'] = collect();
        }
        
        return view('backend.pages.basic.post_office.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
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

            if($postOffice) {
                $postOffice->name = $request->name;
                $postOffice->bn_name = $request->bn_name;
                $postOffice->postal_code = $request->postal_code;
                $postOffice->url = $request->url;
                $postOffice->thana_id = $request->thana_id;
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
            } else {
                $data['status'] = false;
                $data['message'] = "Post Office not found!";
                return response()->json($data, 404);
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
            $postOffice = PostOffice::find($id);
            if($postOffice) {
                if ($postOffice->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Post Office Deleted successfully";
                    return response()->json($data, 200);
                } else {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response()->json($data, 500);
                }
            }else {
                $data['status'] = false;
                $data['message'] = "Post Office not found!";
                return response()->json($data, 404);
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }
}
