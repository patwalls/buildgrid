<?php namespace BuildGrid\Mailers;

use BuildGrid\User;

class UserMailer extends Mailer {

    /**
     * @param User $user
     */
    public static function sendRegistrationMail(User $user)
    {
        $email = $user->email;
        $full_name = $user->full_name;
        
        $subject = 'Welcome '. $full_name;
        $view = 'email.users.user_registration';

        $data = [
            'full_name' => $full_name,
        ];

        return parent::sendMail($email, $subject, $view, $data);

    }

    /**
     * @param User $user
     */
    public static function sendPasswordChangedMail(User $user)
    {
        $email = $user->email;
        $full_name = $user->full_name;

        $subject = 'Password changed';
        $view = 'email.users.user_password_changed';

        $data = [
            'full_name' => $full_name,
        ];

        return parent::sendMail($email, $subject, $view, $data);

    }
    
}
