<?php

namespace App\Http\Controllers;

use App\Model\Loan;
use App\Services\ValidatorInterface;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $validator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->middleware('auth');
        $this->validator = $validator;

          
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // TODO : create role table and check it in middleware
        if (Auth::id() === 1) {
            return redirect("admin");
        }

        // Create Loan
        if ($request->isMethod('post')) {
           $this->validator->setContext($this)->validate($request);
        
           Loan::createLoan($request->get('amount'));
        }

        return view(
            'home', 
            [
                'pendingLoans' => Loan::getPendingLoans(), 
                'paymentLoans' => Loan::getPaymentLoans()
            ]
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay($id, Request $request)
    {
        // TODO : create role table and check it in middleware
        if (Auth::id() === 1) {
            return redirect("admin");
        }
        
        // Create Loan
        if ($request->isMethod('post') && ($loan = Loan::find($id))) {
           Loan::payLoan($loan);
        }

        return redirect("home");
    }
}
