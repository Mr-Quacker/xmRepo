<?php

namespace App\Services;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\SendmailTransport;
use App\Mail\Email;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailService extends Mailable
{

    public function sendEmail($data, $prices)
    {
        Mail::to($data['email'])->send($this->prepareEmail($data, $prices));
    }

    public function prepareEmail($data, $prices)
    {

        $companyName = (new SymbolsService())->getCompanyNameBySymbol($data['symbol']);

        return (new Email($data, $prices))
            ->from('someone@example.com')
            ->subject($companyName ?? '')
            ->text('email');

    }

}
