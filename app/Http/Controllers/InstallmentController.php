<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallmentController extends Controller
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
    public function show($id)
    {
        $installment = Installment::find($id);
        return view('installment.show', compact('installment'));
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
    public function destroy($id)
    {
        if (!Auth::user()->admin) {
            return redirect()->back()->withErrors('Not Authroized');
        }

        Installment::find($id)->delete();
        return redirect()->route('restriction.index');
    }
}
