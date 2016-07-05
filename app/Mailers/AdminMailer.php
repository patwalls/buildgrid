<?php


namespace BuildGrid\Mailers;

use BuildGrid\User;

class AdminMailer extends Mailer
{

    /**
     * @param $data
     * @param $subject
     * @param $view
     * @return bool
     */
    public static function sendMailToAdmin($data, $subject, $view)
    {
        $admins = User::where('is_admin', 1)->get();

        foreach ($admins as $admin) {
            $email = $admin->email;
            $admin_name = $admin->full_name;

            $data = array_add($data, 'name', $admin_name);

            parent::sendMail($email, $subject, $view, $data);
        }
        
        return true;
    }

}
