<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UnitRequestStore;
use App\Http\Requests\UnitRequestUpdate;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnitController extends Controller
{
    function allData() {
        $data = Unit::all();
        return response()->json(['status' => 'success', 'data' => $data])->setStatusCode(200);;
    }

    function detailData(int $id_unit) {
        $data = Unit::find($id_unit);
        if(!$data) {
            throw new HttpResponseException(response([
                'status' => 'failed',
                'error' => 'Data not found.'
            ], 404));
        }
        return response()->json(['status' => 'success', 'data' => $data])->setStatusCode(200);;
    }

    function store(UnitRequestStore $request): JsonResponse
    {
        $validateData = $request->validated();

        if(Unit::where('initial', $validateData['initial'])->count() == 1) {
            // ada data di database 
            throw new HttpResponseException(response([
                'status' => 'failed',
                'error' => 'Initial already exists'
            ], 400));
        }
        $validateData['created_at'] = date('Y-m-d H:i:s');
        $validateData['created_by'] = Auth::user()->username;
        // dd($validateData);
        Unit::create($validateData);

        return response()->json(['status' => 'success', 'message' => 'Data stored successfully'])->setStatusCode(201);;
    }

    function update(UnitRequestUpdate $request, $id_unit): JsonResponse
    {
        $validateData = $request->validated();
        
        $validateData['created_at'] = date('Y-m-d H:i:s');
        $validateData['created_by'] = Auth::user()->username;
        // dd($validateData);
        Unit::where(['id_unit' => $id_unit])->update($validateData);

        return response()->json(['status' => 'success', 'message' => 'Data updated successfully'])->setStatusCode(200);;
    }

    function destroy(int $id) {
        $data = Unit::find($id);
        if(!$data) {
            throw new HttpResponseException(response([
                'status' => 'failed',
                'error' => 'Data not found.'
            ], 404));
        }
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully'])->setStatusCode(202);;
    }
}
