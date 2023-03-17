<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DataStore;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

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
        $model_data = DataStore::where('field_id', $field->id)->get();
//        $model_data = [];
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


        $dataStore = new DataStore();
        return view("$page_data->root_folder.create", compact('page_data', 'dataStore',));
//        return view("$page_data->root_folder.edit", compact('page_data', 'amenity',));
    }

    public function store(Request $request, Field $field)
    {
        try {
            $root_path = trans("lang.backend.name_prefix") . 'field';
            $root_title = $field->name;
            $dependency = '';
            $parent = $field->slug;
            $submodel = "Create";

            $input = $request->all();
            unset($input["_token"]);


            DB::beginTransaction();
            $dataStore = DataStore::create([
                "field_id" => $field->id,
                'data' => json_encode($input, true)
            ]);
            DB::commit();
            if ($dataStore) {
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

    public function edit(Field $field, DataStore $dataStore) {
        $page_data = (object)[
            "root_icon" => $field->icon,
            "root_path" => trans("lang.backend.name_prefix") .'field',
            "root_title" => $field->name,
            "root_folder" => 'backend.pages.data_store',
            "dependency" => '',
            "parent" => $field->slug,
            "submodel" => "Update",
            "data" => $field,
        ];
        return view("$page_data->root_folder.create", compact('page_data', 'dataStore'));
    }

    public function update(Request $request, Field $field, DataStore $dataStore)
    {
//        dd($request->all());
        try {
            $root_path = trans("lang.backend.name_prefix") . 'field';
            $root_title = $field->name;
            $dependency = '';
            $parent = $field->slug;
            $submodel = "Update";

            $input = $request->all();
            unset($input["_token"]);
            unset($input["_method"]);


            DB::beginTransaction();
            $dataStore->update([
                "field_id" => $field->id,
                'data' => json_encode($input, true)
            ]);
            DB::commit();
            if ($dataStore) {
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
