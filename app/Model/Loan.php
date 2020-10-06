<?php

namespace App\Model;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan';

    protected $fillable = ['amount', 'status', 'pay_date', 'total_income'];

    public static function getPendingLoans() {
        return self::where('status', self::PENDING)->get();
    }

    public static function getPaymentLoans() {
        return self::where('pay_date', date('Y-m-d'))
            ->where('status', self::APPROVED)
            ->get();
    }

    public static function createLoan($amount) {
        return self::create([
            'amount'   => $amount,
            'status'   => Loan::PENDING,
            'pay_date' => self::getPayDate()
       ]);
    }

    public static function payLoan($loan) {
        $loan->pay_date = self::getPayDate();
        $loan->total_income = self::createPayment($loan);
        $loan->save();
    }

    /**
     * TOTO : Move it to service
     */
    public static function getPayDate() {
        return new DateTime(date("Ymd H:i:s", strtotime('+ 7 days')));
    }

    /**
     * TOTO : Move it to service
     */
    public static function createPayment($loan) {
        // This one will sum the total money that is paid by user per week
        // In this case I won't check leap year for saving time
        return ($loan->amount * 0.01 + $loan->amount / 52 ) + (float) $loan->total_income;
    }
}
