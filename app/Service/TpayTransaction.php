<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Model;
use tpaySDK\Api\TpayApi;
use tpaySDK\Api\Transactions\TransactionsApi;
class TpayTransaction extends TransactionsApi{
    public function __construct()
    {
        $this->merchantSecret = 'demo';
        $this->merchantId = 1010;
        $this->trApiKey = '75f86137a6635df826e3efe2e66f7c9a946fdde1';
        $this->trApiPass = 'p@$$w0rd#@!';
        parent::__construct();
    }
    public function createTransaction($config)
    {

        try {
            $res = $this->create($config);
            dd($res);
            $this->trId = $res['title'];
            echo '<a href="https://secure.tpay.com/?gtitle=' . $this->trId . '">go to payment</a>';

        } catch (TException $e) {
            var_dump($e);
        }

    }
}
