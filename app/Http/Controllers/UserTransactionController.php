<?php

namespace App\Http\Controllers;

use App\Models\PickAndDrop\PickAndDrop;
use Illuminate\Http\Request;
use App\Models\Pasuyo\Pasuyo;

class UserTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payusos = Pasuyo::where('user_id', $request->user()->id)
                         ->with([
                            'attachments',
                            'delivery.trackings',
                            'delivery.rider'
                         ])
                         ->latest()
                         ->get();

        $pickAndDrops = PickAndDrop::where('user_id', $request->user()->id)
                                    ->with([
                                        'delivery.trackings',
                                        'delivery.rider'
                                    ])
                                    ->latest()
                                    ->get();

        return inertia('User/Transactions', [
            'transactions' => [
                'pasuyos' => $payusos,
                'pickAndDrops' => $pickAndDrops
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
