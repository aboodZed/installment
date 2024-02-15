<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
            $users = User::where('admin', '0')->doesntHave('customer')->paginate(30);
        } else {
            $users = User::where('admin', '0')->doesntHave('customer')
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->name . '%')
                        ->orWhere('phone', 'like', '%' . $request->name . '%')
                        ->orWhere('id_number', 'like', '%' . $request->name . '%');
                })->paginate(30);
        }

        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
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
                'phone' => 'required|string',
                'id_number' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_number' => $request->id_number,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Process complete successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'required|string',
                'id_number' => 'required|string',
                'address' => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->id_number = $request->id_number;

        if ($request->has('address')) {
            $user->customer->address = $request->address;
            $user->customer->save();
        }

        $user->save();

        return redirect()->back()->with('success', 'Process complete successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::user()->admin) {
            return redirect()->back()->withErrors('Not Authroized');
        }
        User::find($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Process complete successfully');
    }
}
