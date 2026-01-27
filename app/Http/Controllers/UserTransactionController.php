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
        $pasuyoQuery = Pasuyo::query();
        $pickAndDropQuery = PickAndDrop::query();

        $pasuyoQuery->where(function ($pasuyoQuery) use  ($request) {
            $pasuyoQuery->where('user_id', $request->user()->id);

            if ($request->has('status') && !empty($request->status) && $request->status !== 'all') {
                $pasuyoQuery->where('status', $request->status);
            }
        });

        $pickAndDropQuery->where(function ($pickAndDropQuery) use  ($request) {
            $pickAndDropQuery->where('user_id', $request->user()->id);

            if ($request->has('status') && !empty($request->status) && $request->status !== 'all') {
                $pickAndDropQuery->where('status', $request->status);
            }
        });

        $payusos = $pasuyoQuery->with([
                                    'attachments',
                                    'delivery.trackings',
                                    'delivery.rider'
                                ])
                                ->latest()
                                ->get();

        $pickAndDrops = $pickAndDropQuery->with([
                                            'delivery.trackings',
                                            'delivery.rider'
                                        ])
                                        ->latest()
                                        ->get();

        return inertia('User/Transactions', [
            'transactions' => $payusos->concat($pickAndDrops)->sortByDesc('created_at')->values(),
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
