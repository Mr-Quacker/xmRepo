<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class Email extends Mailable
{
    use Queueable;

    public $subject;
    public $data;
    public $prices;

    public function __construct($data, $prices)
    {
        $this->data = $data;
        $this->prices = $prices;
    }

    public function build()
    {
        return $this->view('email')->with(['data '=> $this->data, 'prices' => $this->prices]);
    }
}
