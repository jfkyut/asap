<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pasuyo\StorePasuyoRequest;
use App\Models\Pasuyo\Pasuyo;
use Illuminate\Http\Request;

class PasuyoController extends Controller
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
        return inertia('Pasuyo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasuyoRequest $request)
    {
        $pasuyo = $request->user()->pasuyos()->create($request->validated());

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('pasuyo_attachments', 'public');
                $pasuyo->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        $pasuyo->trackings()->create([
            'status_update' => 'Pasuyo request created.',
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasuyo $pasuyo)
    {
        $pasuyo->update($request->only('status'));

        $pasuyo->trackings()->create([
            'status_update' => "Pasuyo status updated to {$pasuyo->status}.",
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
