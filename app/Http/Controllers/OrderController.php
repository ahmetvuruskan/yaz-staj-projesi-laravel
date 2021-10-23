<?php

namespace App\Http\Controllers;

use App\Mail\SiparisKargolandi;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Orders::orderBy('id','desc')->get();
        return view('Admin.Orders.index')->with('orders', $orders);
    }

    public function editOrder($id)
    {
        $order = Orders::where('order_unique_id', $id)
            ->join('products', 'products.product_id', '=', 'orders.order_product_id')
            ->first();

        return view('Admin.Orders.editorder')->with('order', $order);
    }

    public function createShipment($id)
    {
        $track_id = Rand(123456, 9123456);
        Orders::where('order_unique_id', $id)->update([
            'shipment_track_id' => $track_id,
            'order_status' => 'Kargolandı'
        ]);
        $order = Orders::where('order_unique_id', $id)->get();

        //Sms api başlangıç
        $curl = curl_init();
        $params = [
            'api_id' => 'e02252eff3289b9af0ca7a3b',
            'api_key' => '95cb0da6233045ed8d6c4103',
            'sender' => '08502740533',
            'message_type' => 'normal',
            'message' => "Siparişiniz kargolanmıştır. Kargo Takip No: ".$order[0]['shipment_track_id'],
            'phones' => [
                $order[0]['order_phone']
            ]
        ];
        $curl_options = [
            CURLOPT_URL => 'https://api.vatansms.net/api/v1/1toN',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ];
        curl_setopt_array($curl, $curl_options);

        $response = curl_exec($curl);

        curl_close($curl);
        Mail::to($order[0]['order_mail'])->send(new SiparisKargolandi($id));
        return back();
    }
}
