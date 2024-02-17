<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read stores');

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => Store::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create stores');

        $store = Store::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $store,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $this->authorize('read stores');

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $store,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        $this->authorize('create stores');
    
        $store->update($request->validated());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $store,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $this->authorize('create stores');

        $store->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
