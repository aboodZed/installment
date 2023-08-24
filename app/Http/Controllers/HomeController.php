<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Restriction;
use Illuminate\Http\Request;
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
    public function index()
    {
        $res = Restriction::paginate(30);
        return view('home', compact('res'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
