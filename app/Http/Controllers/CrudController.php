<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Inventory;
use App\User;
use Auth;
use Validator;
use Session;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->searchTerm)){
            $Inventories = Inventory::where('item','like','%'.$request->searchTerm.'%')->orWhere('model','like','%'.$request->searchTerm.'%')->orWhere('model_year','like','%'.$request->searchTerm.'%')->orWhere('quantity_available','like','%'.$request->searchTerm.'%')->orWhere('price','like','%'.$request->searchTerm.'%')->paginate(10)->toArray();

        } else {
            $Inventories = Inventory::paginate(10)->toArray();
        }
        if(!empty($Inventories))
            return self::Generateresponse(true,'Got data',Response::HTTP_OK,$Inventories);
        else
            return self::Generateresponse(false,'No data',Response::HTTP_NO_CONTENT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'item'               => 'required',
            'model'              => 'required',
            'model_year'         => 'nullable|numeric|min:2000|max:'.(date('Y')),
            'quantity_available' => 'required|numeric',
            'price'              => 'required|between:1,99.99',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first()); 
            return redirect()->back();
        }
        $create = [
            'item' => $request->item,
            'model' => $request->model,
            'model_year' => $request->model_year,
            'quantity_available' => $request->quantity_available,
            'price' => $request->price,
        ];
        $inventoryResult = Inventory::create($create);
        Session::flash('message', 'Inventory Added!'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'item'               => 'required',
            'model'              => 'required',
            'model_year'         => 'nullable|numeric|min:2000|max:'.(date('Y')),
            'quantity_available' => 'required|numeric',
            'price'              => 'required|between:1,99.99',
        ];
        $validator                     = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first()); 
            return redirect()->back();
        }
        $inventory                     = Inventory::findOrFail($id);
        $inventory->item               = $request->item;
        $inventory->model              = $request->model;
        $inventory->model_year         = $request->model_year;
        $inventory->quantity_available = $request->quantity_available;
        $inventory->price              = $request->price;
        $inventory->update();
        Session::flash('message', 'Inventory Updated!'); 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        Session::flash('message', 'Inventory Deleted');
        return redirect()->back();
    }

    /**
     * Generate response
     *
     * @return \Illuminate\Http\Response
     */
    public static function Generateresponse($type, $message, $statusCode, $responseData = array())
    {
        $returnData = array();

        $returnData['status'] = ($type) ? Config('constants.standard_response_values.SUCCESS') : Config('constants.standard_response_values.FAILURE');

        if (Config('constants.messages.' . $message) != '') {
            $returnData['message'] = Config('constants.messages.' . $message);
        } else {
            $returnData['message'] = $message;
        }
        $returnData['code'] = $statusCode;
        $returnData['data'] = ($responseData != '') ? $responseData : array();

        return $returnData;
    }
}
