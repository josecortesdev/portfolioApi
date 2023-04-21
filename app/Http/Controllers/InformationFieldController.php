<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationFieldRequest;
use App\Http\Requests\UpdateInformationFieldRequest;
use App\Models\InformationField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationFieldController extends Controller
{
    public $informationField;

    public function __construct()
    {
        $this->informationField = new InformationField;
    }

    public function index()
    {
        $technologies = InformationField::all();
        return response()->json($technologies, 200);
    }
    public function store(InformationFieldRequest $request)
    {
        $techonology = InformationField::create($request->all());
        return response()->json($techonology, 201);
    }
    public function update(InformationFieldRequest $request, $id)
    {
        $techonology = InformationField::find($id);
        $techonology->update($request->all());
        return response()->json($techonology, 200);
    }
}
