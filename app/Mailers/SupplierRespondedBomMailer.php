<?php
/**
 * Created by PhpStorm.
 * User: gerardo
 * Date: 5/10/16
 * Time: 05:21 PM
 */

namespace BuildGrid\Mailers;


use BuildGrid\BomResponse;

class SupplierRespondedBomMailer  extends Mailer
{

    /**
     * @param BomResponse $bomResponse
     * @return mixed
     */
    public static function sendSupplierResponseBomMail(BomResponse $bomResponse)
    {
        $purchaser_name         = $bomResponse->bom->project->user->full_name;
        $purchaser_email        = $bomResponse->bom->project->user->email;
        $project_name           = $bomResponse->bom->project->name;
        $bom_name               = $bomResponse->bom->name;

        $subject = "A Supplier Responded to your BOM - ". $bom_name;
        $view = 'email.bom_response.supplier_responded_bom';


        $data = [
            'purchaser_name'         => $purchaser_name,
            'purchaser_email'        => $purchaser_email,
            'project_name'           => $project_name,
            'bom_name'               => $bom_name,
            'project_url'            => link_to_route('getShowBom', $bom_name , ['id' => $bomResponse->bom->id])
        ];

        return parent::sendMail($purchaser_email, $subject, $view, $data);
    }

    public static function sendConfirmationToSupplier(BomResponse $bomResponse)
    {
        $supplier_name         = $bomResponse->invitedSupplier->name;
        $supplier_email        = $bomResponse->invitedSupplier->email;
        $project_name           = $bomResponse->bom->project->name;
        $purchaser_name         = $bomResponse->bom->project->user->full_name;
        $bom_name               = $bomResponse->bom->name;


        $subject = "Your response has been subject for $project_name - $bom_name";
        $view = 'email.bom_response.supplier_confirmation';


        $data = [
            'supplier_name'         => $supplier_name,
            'purchaser_name'       => $purchaser_name,
            'bom_name'              => $bom_name,
        ];

        return parent::sendMail($supplier_email, $subject, $view, $data);
    }
    
}
