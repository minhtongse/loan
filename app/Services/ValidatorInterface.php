<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ValidatorInterface
{
    public function setContext($context);
    public function validate(Request $request);
}