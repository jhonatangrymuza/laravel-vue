<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  DB::table('contratos')
            ->join('imovels', 'contratos.id', '=', 'imovels.id')
            ->select('*')
            ->get();
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
            $contrato = Contrato::where('id_imovel', $request->all()['id_imovel'])->first();
            if(!$contrato){
                $create = Contrato::Create($request->all());
            }else{
                return response()->json(['message' => 'Já existe um contrato com esse imovel'], 404);
            }
            return response()->json(['data' => $request->all()], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'contrato not found!'], 404);
        }
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
            $contrato = Contrato::FindOrFail($id);
            return response()->json(['data' => $contrato], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'contrato not found!'], 404);
        }
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
        try {
            $contrato_existe = Contrato::where('id_imovel', $request->all()['id_imovel'])->first();
            $contrato = Contrato::FindOrFail($id);

            if (!$contrato_existe) {

                $contrato->update($request->all());
                return response()->json("update contrato", 200);

            } else if($contrato_existe && ($contrato['id'] == $contrato_existe['id'])){

                $contrato->update($request->all());
                return response()->json("update contrato", 200);

            }else {
                return response()->json(['message' => 'Já existe um contrato com esse imovel'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'contrato not found!'], 404);
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
            $contrato = Contrato::FindOrFail($id);
            $contrato->delete();
            return response()->json("deleted contrato", 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'contrato not found!'], 404);
        }
    }
}
