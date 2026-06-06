<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\HouseCategory;
use App\Models\BasicSettings\HouseType;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HouseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('getCategoryOptions');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryOptions($id)
    {
        $categories = HouseCategory::where('status', true)->where('house_type_id', $id)->get();
        $html = '<option value="">Select House Category</option>';
        if (count($categories)) {
            foreach ($categories as  $category) {
                $html .='<option value="'.$category->id.'">'.$category->en_name.'</option>';
            }
        }

        $html .='';
        return $html;
    }

    public function index()
    {
        $data['categories'] = HouseCategory::latest()->get();
        return view('backend.pages.basic.house.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types'] = HouseType::latest()->get();
        return view('backend.pages.basic.house.category.create', $data);
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
            $validate = Validator::make($request->all(), [
                'house_type_id' => 'required|integer',
                'en_name' => 'required',
                'bn_name' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            if (!HouseType::whereKey($request->house_type_id)->exists()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = new MessageBag(['house_type_id' => ['Selected house type is not available for your area.']]);
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            if ($this->hasVisibleDuplicate('en_name', $request->en_name) || $this->hasVisibleDuplicate('bn_name', $request->bn_name)) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = new MessageBag(['name' => ['This house category already exists for your area.']]);
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = new HouseCategory();
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->house_type_id = $request->house_type_id;
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Family Category Saved Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseCategory  $houseCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.house.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseCategory  $houseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = HouseCategory::findOrFail($id);
        $data['types'] = HouseType::latest()->get();
        return view('backend.pages.basic.house.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseCategory  $houseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'house_type_id' => 'required|integer',
                'en_name' => 'required',
                'bn_name' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                if (!HouseType::whereKey($request->house_type_id)->exists()) {
                    $data['status'] = false;
                    $data['message'] = "Sorry! Invalid Entry.";
                    $data['errors'] = new MessageBag(['house_type_id' => ['Selected house type is not available for your area.']]);
                    return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
                }

                if ($this->hasVisibleDuplicate('en_name', $request->en_name, $id) || $this->hasVisibleDuplicate('bn_name', $request->bn_name, $id)) {
                    $data['status'] = false;
                    $data['message'] = "Sorry! Invalid Entry.";
                    $data['errors'] = new MessageBag(['name' => ['This house category already exists for your area.']]);
                    return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
                }

                $query = HouseCategory::find($id);

                if ($query) {
                    $query->house_type_id = $request->house_type_id;
                    $query->en_name = $request->en_name;
                    $query->bn_name = $request->bn_name;
                    $query->slug = Str::slug($request->en_name, '-');
                    $query->status = $request->status ? $request->status : true;
                    $query->created_by = Auth::id();

                    if ($query->save()) {
                        $data['status'] = true;
                        $data['message'] = "House Category Updated Successfully!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Failed to save data!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Not found!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseCategory  $houseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = HouseCategory::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "House Category Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            }else {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    private function hasVisibleDuplicate(string $column, ?string $value, ?int $ignoreId = null): bool
    {
        return HouseCategory::where($column, $value)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists();
    }
}
