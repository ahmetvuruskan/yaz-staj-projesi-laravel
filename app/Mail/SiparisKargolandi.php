<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Orders;
use Illuminate\Queue\SerializesModels;

class SiparisKargolandi extends Mailable
{
    use Queueable, SerializesModels;
protected $_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->_id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = Orders::where('order_unique_id',$this->_id)->get();
        return  $this->view('shipped')->with('detay',$data);
    }
}
