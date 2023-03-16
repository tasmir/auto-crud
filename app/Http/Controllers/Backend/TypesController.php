<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except([]);
        $root = "types";
        $per_dependency = "";
        $this->root_icon = "fa-solid fa-tags";
        $this->root_path = trans("lang.backend.name_prefix") . $root;
        $this->root_folder = "backend.pages.$per_dependency.$root";
        $this->root_title = 'Types';
        $this->dependency = "";
        $this->per_dependency = $per_dependency;

        // $this->middleware("permission:" . $root . ".list", ['only' => ['index']]);
        //        $this->middleware("permission:".$root.".create", ['only' => ['create', 'store']]);
        // $this->middleware("permission:" . $root . ".edit", ['only' => ['edit', 'update']]);
        // $this->middleware("permission:" . $root . ".delete", ['only' => 'destroy']);
        // $this->middleware("permission:" . $root . ".dashboard", ['only' => 'dashboard']);
        // $this->middleware("permission:" . $root . ".status_change", ['only' => 'status']);
        // $this->middleware("permission:" . $root . ".show", ['only' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_data = (object)[
            "root_icon" => $this->root_icon,
            "root_path" => $this->root_path,
            "root_title" => $this->root_title,
            "root_folder" => $this->root_folder,
            "dependency" => $this->dependency,
            "submodel" => ""
        ];
        $model_data = Field::all();
//        $model_data = [];
        //        return view('pages.' . $root_folder . '.index', compact('submodel', 'root_icon', 'root_path', 'root_title', 'model_data', 'venue', 'dependency'));
        return view("$page_data->root_folder.index", compact('model_data', 'page_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_data = (object)[
            "root_icon" => $this->root_icon,
            "root_path" => $this->root_path,
            "root_title" => $this->root_title,
            "root_folder" => $this->root_folder,
            "dependency" => $this->dependency,
            "submodel" => "Create"
        ];


        $amenity = new Field();
        //        $amenity->order = Amenity::where("venue_id", $venue->id)->where('status', "on")->count("id")+1;
        $amenity->order = 1;
        return view("$page_data->root_folder.create", compact('page_data', 'amenity',));
//        return view("$page_data->root_folder.edit", compact('page_data', 'amenity',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        try {
            $root_path = $this->root_path;
            $root_title = $this->root_title;
            $dependency = $this->dependency;
            $submodel = "Create";
            DB::beginTransaction();
            $field = Field::create([
                "name" => $request->name,
                "slug" => $request->slug,
                "status" => $request->status,
                "icon" => $request->icon,
                'field' => json_encode($request->field, true)
            ]);
            DB::commit();
            if ($field) {
                Session::flash('success', "$root_title Information $submodel Successfully");
            } else {
                Session::flash('error', "Could Not $submodel $root_title Information");
            }
            return redirect()->route("$root_path.index");
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Field $type)
    {
        dd($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $types)
    {
        $page_data = (object)[
            "root_icon" => $this->root_icon,
            "root_path" => $this->root_path,
            "root_title" => $this->root_title,
            "root_folder" => $this->root_folder,
            "dependency" => $this->dependency,
            "submodel" => "Update"
        ];
        $amenity = $types;

        return view("$page_data->root_folder.create", compact('page_data', 'amenity',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenity $amenity)
    {
        //        dd($request->all());
        try {
            $root_path = $this->root_path;
            $root_title = $this->root_title;
            $dependency = $this->dependency;
            $submodel = "Update";
            $path = null;
            if ($request->file('image')) {

                $file = $request->file('image');
                $path = $this->FileUploadHelper($file, 'amenity');
            }
            DB::beginTransaction();
            $amenity->update([
                "name" => $request->name,
                "order" => $request->order,
                "status" => $request->status,
                "image" => $path ?? $amenity->image ?? null,
            ]);
            DB::commit();
            if ($amenity) {
                Session::flash('success', "$root_title Information $submodel Successfully");
            } else {
                Session::flash('error', "Could Not $submodel $root_title Information");
            }
            return redirect()->route("$dependency$root_path.index", $amenity);
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rearangStore(Request $request)
    {
        $model_data = Amenity::where('venue_id', $request->model)->get();
        foreach ($model_data as $key => $amenity) {
            $id = $amenity->id;

            foreach ($request->positions as $ps) {
                if ($ps[0] == $id) {
                    $amenity->update(['order' => $ps[1]]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }

    public function statusChange(Request $request)
    {
        $model_data = Amenity::where('id', $request->model)->first();
        $model_data->update([
            "status" => $request->positions
        ]);
        return response('Update Successfully.', 200);
    }

    public function slugChecking(Request $request)
    {
        $count = Field::where(DB::raw('lower(name)'), trim(strtolower($request->name)))->count();
        if($count == 0) {
            return response()->json([
                'status' => '200',
                'slug' => $request->slug,
            ]);
        }else {
            return response()->json([
                'status' => '200',
                'slug' => $request->slug.'-'.$count,
            ]);
        }
    }
}
