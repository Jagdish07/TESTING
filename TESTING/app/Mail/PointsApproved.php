<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PointsApproved extends Mailable
{
    protected $data = [
        'user_name'	=> null,
        'point_type'	=> null,
        'points_alloted' =>  null,
        'points_expiry' =>null
    ];

    protected $bcc_mail = "anne.priante@hotmail.com";


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
        return $this->view("emails.pointsApproved")
            //Passed data
            ->with($this->data)

            //Mail options
            ->bcc($this->bcc_mail, config("app.name"))
            ->from("no-reply@imarkinfotech.com", config("app.name"))
            ->subject('Voucher Redeemed');
    }
}
