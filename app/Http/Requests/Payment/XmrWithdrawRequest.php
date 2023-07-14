<?php

namespace App\Http\Requests\Payment;

use App\Exceptions\RequestException;
use App\Marketplace\Payment\MoneroPayment;
use Illuminate\Foundation\Http\FormRequest;

class XmrWithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sendAddr' => 'required',
            'amount' => 'required',
            'pin' => 'required|digits:6'
        ];
    }

    /**
     * @throws RequestException
     */
    public function persist()
    {
        if (auth()->user()->pin == $this->pin) {
            $monero = new MoneroPayment();
            if (!$monero->checkValidXmrAddress($this->sendAddr)) {
                throw new RequestException('Given address is not correct!');
            }
            try {
                $amount = $this->amount;
                $amount = (int)($amount * 1000000000000);
                $monero->sendPayment($this->sendAddr, $amount);
                session()->flash('success', 'Withdraw request has been submitted!');
            } catch (\RuntimeException $e) {
                throw new RequestException(explode("; \n", $e->getMessage())[0]);
            }
        } else
            throw new RequestException('PIN is not correct');

    }
}
