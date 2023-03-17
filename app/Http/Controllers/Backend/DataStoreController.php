<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataStoreController extends Controller
{
    public function index(Field $field)
    {
        $page_data = (object)[
            "root_icon" => $field->icon,
            "root_path" => trans("lang.backend.name_prefix") .'field',
            "root_title" => $field->name,
            "root_folder" => 'backend.pages.data_store',
            "dependency" => '',
            "parent" => $field->slug,
            "submodel" => "",
            "data" => $field,
        ];
//        $model_data = Field::all();
        $model_data = [];
        //        return view('pages.' . $root_folder . '.index', compact('submodel', 'root_icon', 'root_path', 'root_title', 'model_data', 'venue', 'dependency'));
        return view("$page_data->root_folder.index", compact('model_data', 'page_data'));
    }


    public function create(Field $field)
    {
        $page_data = (object)[
            "root_icon" => $field->icon,
            "root_path" => trans("lang.backend.name_prefix") .'field',
            "root_title" => $field->name,
            "root_folder" => 'backend.pages.data_store',
            "dependency" => '',
            "parent" => $field->slug,
            "submodel" => "Create",
            "data" => $field,
        ];


        $amenity = new Field();
        //        $amenity->order = Amenity::where("venue_id", $venue->id)->where('status', "on")->count("id")+1;
        $amenity->order = 1;
        return view("$page_data->root_folder.create", compact('page_data', 'amenity',));
        return view("$page_data->root_folder.edit", compact('page_data', 'amenity',));
    }

    public function store(Request $request, Field $field)
    {
//        dd($request->all());
        try {
            $root_path = trans("lang.backend.name_prefix") . 'field';
            $root_title = $field->name;
            $dependency = '';
            $parent = $field->slug;
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
            return redirect()->route("$root_path.index", [$parent]);
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return redirect()->back();
        }
    }

}
