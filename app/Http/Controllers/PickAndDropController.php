<?php

namespace App\Http\Controllers;

use App\Models\PickAndDrop\PickAndDrop;
use Illuminate\Http\Request;
use App\Http\Requests\PickAndDrop\StorePickAndDropRequest;

class PickAndDropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('PickAndDrop/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePickAndDropRequest $request)
    {
        $pickAndDrop = $request->user()->pickAndDrops()->create($request->validated());

        $pickAndDrop->trackings()->create([
            'status_update' => 'Pick and Drop request created.',
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PickAndDrop $pickAndDrop)
    {
        $pickAndDrop->update($request->only('status'));

        $pickAndDrop->trackings()->create([
            'status_update' => "Pick and Drop status updated to {$pickAndDrop->status}.",
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
