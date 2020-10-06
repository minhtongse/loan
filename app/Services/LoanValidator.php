<?php

namespace App\Services;

use Illuminate\Http\Request;

class LoanValidator implements ValidatorInterface
{
    protected $context;

    public function setContext($context) {
        $this->context = $context;
        
        return $this;
    }

    public function validate(Request $request) {
        return $this->context->validate($request, [
            'amount' => 'required|numeric|max:1000000000'
        ]);
    }

}