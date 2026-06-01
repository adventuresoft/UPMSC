<?php

namespace App\Http\Controllers;

use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{

    public function unionsByThana(Request $request, $id)
    {
        $html = '<option value="">Select '.($request->id ? ucfirst($request->id) : '').' Union</option>';

        $unions = Union::withoutGlobalScope(\App\Scopes\AreaMultitenancyScope::class)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        if(count($unions)) {
            foreach ($unions as $union) {
               $html .='<option value="'.$union->id.'">'.$union->name.'</option>';
            }
        }

        return $html;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['unions'] = Union::with('thana')->latest()->get();
        return view('backend.pages.basic.union.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['thanas'] = \App\Models\Thana::latest()->get();
        return view('backend.pages.basic.union.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

            $union = new Union();
            $union->name = $request->name;
            $union->bn_name = $request->bn_name;
            $union->url = $request->url;
            $union->thana_id = $request->thana_id;
            $union->status = $request->status ? $request->status : 1;

            if ($union->save()) {
                $data['status'] = true;
                $data['message'] = "Union Saved Successfully!";
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['union'] = Union::find($id);
        $data['thanas'] = \App\Models\Thana::latest()->get();
        return view('backend.pages.basic.union.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
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

            $union = Union::find($id);

            if($union) {
                $union->name = $request->name;
                $union->bn_name = $request->bn_name;
                $union->url = $request->url;
                $union->thana_id = $request->thana_id;
                $union->status = $request->status ? $request->status : 1;

                if ($union->save()) {
                    $data['status'] = true;
                    $data['message'] = "Union Updated Successfully!";
                    return response()->json($data, 200);
                } else {
                    $data['status'] = false;
                    $data['message'] = "Failed to save data!";
                    return response()->json($data, 500);
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Union not found!";
                return response()->json($data, 404);
            }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $union = Union::find($id);
            if($union) {
                if ($union->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Union Deleted successfully";
                    return response()->json($data, 200);
                } else {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response()->json($data, 500);
                }
            }else {
                $data['status'] = false;
                $data['message'] = "Union not found!";
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
