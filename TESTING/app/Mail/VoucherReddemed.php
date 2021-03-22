<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoucherReddemed extends Mailable
{

    protected $data = [
        "voucher_title"              => null,
        "user_name"               => null,
        "created_at"              => null,
        "voucher_range"               => null,
        "ponits_requested"               => null
    ];

    protected $bcc_mail = "joaosjc@hotmail.com";
    protected $cc_mail = "anne.priante@hotmail.com";


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data){
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view("emails.vouchers")
            //Passed data
            ->with($this->data)

            //Mail options
            ->bcc($this->bcc_mail, config("app.name"))
            ->cc($this->cc_mail, config("app.name"))
            ->from("no-reply@imarkinfotech.com", config("app.name"))
            ->subject('Voucher Redeemed');
    }
}
