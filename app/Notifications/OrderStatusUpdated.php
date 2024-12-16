<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusUpdated extends Notification
{
    public $order;
    public $newStatus;

    public function __construct(Order $order, $newStatus)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
    }

    // Delivery Channels (mail, database, etc.)
    public function via($notifiable)
    {
        return ['mail', 'database']; // You can also use 'sms', 'broadcast', etc.
    }

    // Build the notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Status Updated')
            ->line('Your order ID ' . $this->order->id . ' has been updated.')
            ->line('New Status: ' . $this->newStatus)
            ->action('View Order', route('orders.show', $this->order))
            ->line('Thank you for shopping with us!');
    }

    // Store notification in the database (optional)
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->newStatus,
            'message' => 'Your order status has been updated to ' . $this->newStatus,
        ];
    }
}
