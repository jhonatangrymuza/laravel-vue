<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImovelFormRequest;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController extends Controller
{

    public function index()
    {
        return Imovel::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImovelFormRequest $request)
    {

        $create = Imovel::Create($request->all());
        return response()->json($create, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $imovel = Imovel::FindOrFail($id);
            return response()->json(['data' => $imovel], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'imovel not found!'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImovelFormRequest $request, $id)
    {
        try {
            $imovel = Imovel::FindOrFail($id);
            $imovel->update($request->all());
            return response()->json("update imovel", 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'imovel not found!'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $imovel = Imovel::FindOrFail($id);
            $imovel->delete();
            return response()->json("deleted imovel", 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'imovel not found!'], 404);
        }
    }
}
