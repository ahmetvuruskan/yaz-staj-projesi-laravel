<?php

namespace App\Mail;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SiparisAlindi extends Mailable
{
    use Queueable, SerializesModels;

    protected $detail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $detay = Orders::where('order_unique_id', $this->detail)
            ->join('products', 'products.product_id', '=', 'orders.order_product_id')
            ->get();
        return $this->view('mail')->with('detay', $detay);
    }
}
