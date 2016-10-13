<?php namespace BuildGrid\Mailers;

abstract class Mailer {


    public static function sendMail($emailAddress, $subject, $view, $data = []){

        \Mail::send($view, $data, function($message) use ($emailAddress, $subject) {
            $message->to($emailAddress)
                ->subject($subject);
        });

    }


    public static function sendMailWithReplyTo($emailAddress, $subject, $replyTo ,$view, $data = []){

        \Mail::send($view, $data, function($message) use ($emailAddress, $subject, $replyTo) {
            $message->to($emailAddress)
                ->replyTo($replyTo['address'], $replyTo['name'])
                ->subject($subject);
        });

    }

}
