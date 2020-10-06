<?php

namespace App\Http\Controllers;

use App\Model\Loan;
use App\Services\ValidatorInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null, Request $request)
    {
        // TODO : create role table and check it in middleware
        if (Auth::id() !== 1) {
            return redirect("home");
        }

        // Create Loan
        if ($request->isMethod('post') && ($loan = Loan::find($id))) {
           $loan->status = Loan::APPROVED;
           $loan->save();
        }

        return view('admin', ['pendingLoans' => Loan::getPendingLoans()]);
    }
}
