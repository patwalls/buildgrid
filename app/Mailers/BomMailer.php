<?php


namespace BuildGrid\Mailers;


use BuildGrid\Project;
use BuildGrid\User;

class BomMailer extends Mailer
{

    public function sendNewBomMail(Bom $bom)
    {
        $bom_name = $bom->name;
        $project_name = $bom->getProjectNameAttribute();
        $subject = "A new BOM has been created";
        $view = 'email.bom.new_bom';

        $admins = User::where('is_admin', '1');

        foreach ($admins as $admin) {
            $email = $admin->email;
            $admin_name = $admin->getFullNameAttribute();

            $data = [
                'bom_name' => $bom_name,
                'project_name' => $project_name,
                'admin_name' => $admin_name
            ];

            return parent::sendMail($email, $subject, $view, $data);
        }
    }

}