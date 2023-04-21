<?php

namespace App\Http\Controllers;

use App\Contracts\TraductionGenerator;
use App\Http\Controllers\Controller;
use App\Http\Services\RapidTranslate;
use App\Models\Traduction;
use Illuminate\Http\Request;

class TraductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $generator;
    public function __construct(TraductionGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function index()
    {
        //
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

     public function traduct(Request $information)
     {

        $setup = $this->generator->setup();
        $content = $this->generator->setContent($setup, $information->information);
        return response()->json(
            [
                'information' => 
                $this->generator->getTraduction($content)
            ], 200);

     }

    public function store(Request $request)
     {
         $traduction = Traduction::create([
             'español' => $request->español,
             'ingles' => $request->ingles
         ]);
 
         return response()->json($traduction, 201);
     }

    public function traductAndStore(Request $request)
    {
        $traduction = $this->traduct($request);

        $tr = json_encode($traduction, true);

        $traduction = Traduction::create([
            'español' => $request->information,
            'ingles' => str_replace(["\"", "[", "]", "{\"information\":\"", "\"}", "{information:", "}"], "", json_encode($traduction->original) )
            
        ]);

        return response()->json($traduction, 201);;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
