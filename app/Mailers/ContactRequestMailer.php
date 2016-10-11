<?php


namespace BuildGrid\Mailers;

use BuildGrid\User;

class ContactRequestMailer extends Mailer
{

    /**
     * @param $data
     * @return bool
     */
    public static function sendMailToInfo($data)
    {

        parent::sendMailWithReplyTo( env('CONTACT_REQUESTS_EMAIL_TO', 'info@buildgrid.com'),
            'New Contact Request from: ' . $data['name'],
            ['name' => $data['name'], 'address' => $data['email']],
            'email.users.contact_request',
            $data);

        return true;
    }

}
