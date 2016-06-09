<?php namespace BuildGrid\Mailers;


use BuildGrid\InvitedSupplier;


class InvitedSupplierMailer extends Mailer {

    /**
     * @param $invited_supplier_id
     * @return mixed
     */
    public static function sendBomInvitationToSupplier($invited_supplier_id)
    {
        $supplier = InvitedSupplier::find($invited_supplier_id);

        $email = $supplier->email;
        $subject = 'Invitation to bid as supplier on project '. $supplier->bom->project->name;
        $view = 'email.supplier.bom_invitation';

        $data = [
            'supplier_name' => $supplier->name,
            'purchaser_name' => $supplier->bom->project->user->fullname,
            'project_name'=> $supplier->bom->project->name,
            'supplier_hashid' => $supplier->hashid
        ];

        return parent::sendMail($email, $subject, $view, $data);

    }


}
