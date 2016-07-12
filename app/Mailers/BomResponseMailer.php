<?php


namespace BuildGrid\Mailers;


use BuildGrid\BomResponse;

class BomResponseMailer extends Mailer
{

    /**
     * @param BomResponse $bomResponse
     */
    public static function sendBomResponseAcceptedMail(BomResponse $bomResponse)
    {
        $invited_supplier_email = $bomResponse->invitedSupplier->email;
        $invited_supplier_name  = $bomResponse->invitedSupplier->name;
        $purchaser_name         = $bomResponse->bom->project->user->full_name;
        $purchaser_email        = $bomResponse->bom->project->user->email;
        $project_name           = $bomResponse->bom->project->name;


        $subject = "Your BOM has been accepted on BuildGrid";
        $view = 'email.bom_response.bom_response_accepted';


        $data = [
            'invited_supplier_name'  => $invited_supplier_name,
            'invited_supplier_email' => $invited_supplier_email,
            'purchaser_name'         => $purchaser_name,
            'purchaser_email'        => $purchaser_email,
            'project_name'           => $project_name
        ];


        AdminMailer::sendMailToAdmin($data, $subject, $view);

        return parent::sendMail($invited_supplier_email, $subject, $view, $data);
    }

}
