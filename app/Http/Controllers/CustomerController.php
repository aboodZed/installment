<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Restriction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['name' => 'required|string|max:255']
        );

        if ($validator->fails()) {
            $customers = Customer::paginate(30);
        } else {
            $customers = Customer::whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('phone', 'like', '%' . $request->name . '%')
                    ->orWhere('id_number', 'like', '%' . $request->name . '%');
            })->paginate(30);
        }

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Customer::max('user_id') + 1;
        return view('customer.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'nullable|unique:users|string|max:255',
                'phone' => 'required|integer',
                'id_number' => 'required|integer',
                'address' => 'required|string',
                'currency' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_number' => $request->id_number,
            'password' => Hash::make('12345678'),
        ]);

        Customer::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'currency_code' => $request->currency,
        ]);

        return redirect()->back()->with('success', 'Process complete successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $res = $customer->restrictions()->paginate(30);
        return view('customer.show', compact(['customer', 'res']));
    }


    public function filter($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['date' => 'required|date',]
        );

        if ($validator->fails()) {
            return redirect()->back();
        }

        $date = $request->date;
        $res = Restriction::whereDate('pay_date', $date)->paginate(30);
        $customer = Customer::find($id);
        return view('customer.show', compact(['customer', 'res']));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
