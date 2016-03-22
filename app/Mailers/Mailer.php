<?php namespace BuildGrid\Mailers;

abstract class Mailer {


    public static function sendMail($emailAddress, $subject, $view, $data = []){
        \Mail::send($view, $data, function($message) use ($emailAddress, $subject) {
            $message->to($emailAddress)
                ->subject($subject);
        });
    }


}
