<?php

namespace App\Service;

use App\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use tpaySDK\Api\TpayApi;
use tpaySDK\Api\Transactions\TransactionsApi;

class TpayService extends Model
{
    public $fillable = ['order_uuid', 'title', 'amount'];
    protected $table = 'tpay_payments';
    public $MERCHANT_ID = 36979;
    public $API_KEY = 'c8cb5084278bdfed81d4193eefa10aa5792e6a8f';
    public $API_PASSWORD = 'Wroclaw71#1';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getBankLists(){
        try{
            $data =  json_decode(file_get_contents("https://secure.tpay.com/groups-369790.js?json", true));
            return $data;
        }catch(\Exception $e){
            return ['errors' => 'Błąd w pobieraniu banków'];
        }
    }
    public function handleNotification($request){
        Log::info('CRC '.$request->tr_crc);
        $order = Order::where('uuid', $request->tr_crc)->first();
        if(!$order){
            Log::error('BRAK ZAMÓWIENIA '.$request->tr_crc);
            return 'FALSE - Brak zamwienia';
        }
        if(!TpayService::where('title', $request->tr_id)->where('order_uuid', $order->uuid)->first()){
            Log::error('Nie ma takiej płatności '.$request->tr_id);
            return 'FALSE - Brak platnosci';
        }
        if ($request->tr_status=='TRUE' && $request->tr_error=='none') {
            $order->paid = true;
            $order->update();
            return 'TRUE';
        }else{
            Log::error('ER ', $request->tr_error);
            return "FALSE";
        }
    }
    public function createTransaction($order){
          $client = new Client();
          $config = array(
              'id' => $this->MERCHANT_ID,
              'amount' => number_format($order->amount, 2, '.', ''),
              /*'md5sum' => md5(number_format($order->amount, 2, '.', '')),*/
              'description' => 'Płatność za zamówienie #'.$order->id,
              'crc' => $order->uuid,
              'result_url' => route('tpay_confirm'),
              'result_email' => 'mbielak@ideashirt.pl',
              'return_url' => route('orders.show', ['id' => $order->uuid]),
              'email' => $order->email,
              'name' => $order->name,
              'group' => $order->group_id,
              'accept_tos' => 1,
              'api_password' => $this->API_PASSWORD,
          );
        try{
            $response = $client->request('POST', 'https://secure.tpay.com/api/gw/'.$this->API_KEY.'/transaction/create', [
                'form_params' => $config
            ]);
            $response = new \SimpleXMLElement($response->getBody()->getContents());
            if($response->title){
                TpayService::create([
                    'order_uuid' => $order->uuid,
                    'title' => (string) $response->title,
                    'amount' => (string) $response->amount
                ]);
                $order->payment_link = (string) $response->url;
                $order->update();
                return $order;
            }else{
                throw new ClientException('Błąd w zamówieniu');
            }
        }catch(ClientException $e){
            return $e;
        }

    }
}
