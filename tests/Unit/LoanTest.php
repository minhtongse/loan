<?php

namespace Tests\Unit;

use App\Model\Loan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoanTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDate()
    {
        static::assertEquals(Loan::getPayDate(), new \DateTime(date("Ymd H:i:s", strtotime('+ 7 days'))));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testcreatePayment()
    {
        static::assertSame(
            Loan::createPayment(new Loan(['amount' => 9999999, 'total_income' => 0])), 
            292307.66307692305
        );
    }
}
