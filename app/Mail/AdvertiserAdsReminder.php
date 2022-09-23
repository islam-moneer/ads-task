<?php

namespace App\Mail;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdvertiserAdsReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $ad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ads Reminder')
            ->markdown('vendor.mail.html.message', ['ad' => $this->ad]);
    }
}
