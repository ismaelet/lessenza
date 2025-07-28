<?php

namespace App\Mail;

use App\Helpers\EcommerceHelper;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderStatusMail extends Mailable {

	use Queueable, SerializesModels;

	public $subject;
	public Order $order;

	/**
	 * Create a new message instance
	 */
	public function __construct(Order $order) {
		$this->order = $order;
		$this->subject = 'Aggiornamento dell\'ordine ' . $order->id_code;
	}

	/**
	 * Generate the mail envelope
	 */
	public function envelope(): Envelope {
		return new Envelope(
			from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
			replyTo: [
				new Address(config('custom.contacts.email.label'), env('MAIL_FROM_NAME')),
			],
			subject: $this->subject,
		);
	}

	/**
	 * Generate the mail content
	 */
	public function content(): Content {
		$showRecap = in_array($this->order->status, [1, 2]);

		return new Content(
			view: 'emails.order-status',
			with: [
				'order' => $this->order,
				'orderIdCode' => $this->order->id_code,
				'showRecap' => $showRecap,
			],
		);
	}
}
