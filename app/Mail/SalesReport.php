<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalesReport extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $seller;
    public $sumAllSalesDay;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seller, $sumAllSalesDay)
    {
        $this->seller = $seller;
        $this->sumAllSalesDay = $sumAllSalesDay;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('teste@gmail.com', 'Contato Tray'),
            subject: 'Relatório de Vendas de Hoje',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.sales.report',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
