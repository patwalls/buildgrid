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


        $subject = "A Supplier Responded to your BOM";
        $view = 'email.bom_response.supplier_responded_bom';


        $data = [
            'purchaser_name'         => $purchaser_name,
            'purchaser_email'        => $purchaser_email,
            'project_name'           => $project_name,
            'project_url'            => link_to_route('getShowBom', $project_name , ['id' => $bomResponse->bom->id])
        ];

        return parent::sendMail($purchaser_email, $subject, $view, $data);
    }

}
