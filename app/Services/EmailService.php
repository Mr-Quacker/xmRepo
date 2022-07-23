<?php

namespace App\Services;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\SendmailTransport;
use Symfony\Component\Mime\Email;

class EmailService
{

    public function prepareEmail($data)
    {
        $transport = new SendmailTransport();
        $mailer = new Mailer($transport);

        $companyName = (new SymbolsService())->getCompanyNameBySymbol($data['symbol']);
        dd($companyName);

        $email = (new Email())
            ->from('someone@example.com')
            ->to($data['email'])
            ->subject($companyName ?? '')
            ->text($this->prepareText($data));

        $mailer->send($email);
    }

    private function prepareText($data)
    {
        return 'test';
    }

}
