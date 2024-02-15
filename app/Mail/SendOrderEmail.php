<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $email;
    public $name;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $email, $name) {
        $this->order = $order;
        $this->email = $email;
        $this->name = $name;
    }

    public function build()
    {
        return $this->from('zakaz-risroll@yandex.ru')
            ->to($this->email, $this->name)
            ->view('client.mails.order')
            ->with([
                'order' => $this->order
            ]);
    }
//
//    /**
//     * Get the message envelope.
//     */
//    public function envelope(): Envelope
//    {
//        return new Envelope();
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        dd($this->order);
//        return new Content(
//            view: 'client.mails.order',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
