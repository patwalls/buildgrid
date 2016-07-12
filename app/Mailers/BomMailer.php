<?php


namespace BuildGrid\Mailers;


use BuildGrid\Bom;
use BuildGrid\User;

class BomMailer extends Mailer
{

    /**
     * @param Bom $bom
     * @return bool
     */
    public static function sendNewBomMail(Bom $bom)
    {
        $bom_name = $bom->name;
        $project_name = $bom->project_name;
        $project_bom_admin_url = url('admin/boms/' . $bom->id );
        
        $subject = "A new BOM has been created";
        $view = 'email.bom.new_bom';
        $data = [
            'bom_name' => $bom_name,
            'project_name' => $project_name,
            'project_bom_admin_url' => $project_bom_admin_url
        ];

        return AdminMailer::sendMailToAdmin($data, $subject, $view);
    }

}

