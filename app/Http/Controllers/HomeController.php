<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Restriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            ['date' => 'required|date',]
        );

        if ($validator->fails()) {
            $date = now()->format('Y-m-d');
        } else {
            $date = $request->date;
        }

        $res = Restriction::whereDate('pay_date', $date)->paginate(30);

        // return $res;
        return view('home', compact(['res', 'date']));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
