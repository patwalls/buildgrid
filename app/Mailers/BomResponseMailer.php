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
        $invited_supplier_name = $bomResponse->invitedSupplier->name;

        $bom_name = $bomResponse->bom->name;
        $bom_id = $bomResponse->bom->id;

        $subject = "A response has been accepted";
        $view = 'email.bom_response.bom_response_accepted';
        $data = [
            'bom_name' => $bom_name,
            'bom_id' => $bom_id
        ];

        AdminMailer::sendMailToAdmin($data, $subject, $view);

        $data = array_add($data, 'name', $invited_supplier_name);

        return parent::sendMail($invited_supplier_email, $subject, $view, $data);
    }

}