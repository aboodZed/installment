<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Price;
use App\Models\Restriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestrictionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Restriction::paginate(30);
        return view('restriction.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('restriction.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'customer' => 'required|integer',
                'res.*.date' => 'required|date',
                'res.*.amount' => 'required|numeric',
                'res.*.desc' => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $c = Customer::find($request->customer);

        foreach ($request->res as $value) {
            $p = Price::create([
                'currency_code' => $c->currency_code,
                'value' => $value['amount'],
            ]);

            Restriction::create([
                'price_id' => $p->id,
                'customer_id' => $c->user_id,
                'desc' => $value['desc'],
                'is_credit' => true,
                'paid' => false,
                'pay_date' => $value['date'],
            ]);
        }

        return redirect()->back()->with('success', 'process complete successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $res = Restriction::find($id);
        return view('restriction.show', compact('res'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restriction $instellment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required|date',
                'amount' => 'required|numeric',
                'desc' => 'nullable|string',
                'paid' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $res = Restriction::find($id);
        // return $res;

        $res->price->value = $request->amount;
        $res->price->save();

        $res->pay_date = $request->date;
        $res->paid = $request->paid != null;
        $res->desc = $request->desc;
        $res->save();

        return redirect()->back()->with('success', 'process complete successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restriction $instellment)
    {
        //
    }

    public function search(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['date' => 'required|date',]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $res = Restriction::whereDate('pay_date', $request->date)->get();
        // return $res;
        return view('home', compact('res'));
    }
}
