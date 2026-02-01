<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\OrderDetails;

class AdminOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $customer;
    public $shipping;
    public $orderDetails;

    /**
     * Create a new message instance.
     */




    // AdminOrderNotification মেইল ক্লাসে

public function __construct(Order $order)
{
    // এক্সপ্লিসিটলি রিলেশনশিপ লোড করুন
    $this->order = $order->load([
        'customer', 
        'shipping', 
        'orderDetails', 
        'payment'
    ]);
    
    $this->customer = $this->order->customer ?? new Customer();
    $this->shipping = $this->order->shipping ?? new Shipping();
    $this->orderDetails = $this->order->orderDetails ?? collect();
}
    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Order Received - Invoice #' . $this->order->invoice_id)
                    ->view('emails.admin_order_notification');
    }
}
