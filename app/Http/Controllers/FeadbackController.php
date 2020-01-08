<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Feadback as FeadbackRequests;
use App\Http\Requests;
use App\Feadback;
use App\Http\Resources\Feadback as FeadbackResource;

class FeadbackController extends Controller
{

     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feadback = Feadback::paginate(10);
        return FeadbackResource::collection($feadback);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FeadbackRequests $request)
    {
        // TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validated();
        if($validated->fails()){
            return $this->sendError('Validation Error.', $validated->errors());       
        }
        $feadback = new Feadback;
        $feadback->not = $request->not;
        $feadback->commant = $request->commant;
        $feadback->title = $request->title;
        $feadback->comand_num = $request->comand_num;
        $feadback->is_private = $request->is_private;
        $feadback->exp_date_start = $request->exp_date_start;
        $feadback->exp_date_fin = $request->exp_date_fin;
        $time_span->user_id = $request->user()?$request->user()->id : 1;
        $feadback->save();

        return response()->json([
            "message" => "feadback created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($feadback)
    {
        if (!$feadback) {
            return $this->sendError('feadback not found.');
        }
        return $this->sendResponse($feadback, 'feadback retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO
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
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO
    }
}
