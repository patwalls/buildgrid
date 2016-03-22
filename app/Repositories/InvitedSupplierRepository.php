<?php

namespace BuildGrid\Repositories;


use BuildGrid\InvitedSupplier;
use BuildGrid\Mailers\InvitedSupplierMailer;


class InvitedSupplierRepository {

    /**
     * @param $suppliers
     * @param $bom_id
     * @return array|mixed
     */
    public function store($suppliers, $bom_id)
    {

        if( isset(array_values($suppliers)[0]) && is_array(array_values($suppliers)[0])){
            return $this->storeMany($suppliers, $bom_id);
        }

        return $this->storeOne($suppliers, $bom_id);

    }


    /**
     * @param $suppliers
     * @param $bom_id
     * @return array
     */
    private function storeMany($suppliers, $bom_id)
    {
        $stored_suppliers = [];

        foreach($suppliers as $supplier) {
            $stored_suppliers[] = $this->storeOne($supplier, $bom_id);
        }

        return $stored_suppliers;
    }


    /**
     * @param $supplier
     * @param $bom_id
     * @return mixed
     */
    private function storeOne($supplier, $bom_id)
    {
        $bom_supplier = InvitedSupplier::create([
            'name'   => $supplier['name'],
            'email'  => $supplier['email'],
            'bom_id' => $bom_id
        ]);

        // Generate hashid for this Bom-Supplier relation
        $bom_supplier->hashid = \Hashids::encode([$bom_id, $bom_supplier->id]);
        $bom_supplier->update();

        // Todo: Move this into a Queue to prevent delay on page response.
        InvitedSupplierMailer::sendBomInvitationToSupplier($bom_supplier->id);

        return $bom_supplier->id;
    }


    /**
     * @param $bom_id
     * @return mixed
     */
    public function getBomSuppliers($bom_id)
    {
        return InvitedSupplier::where('bom_id', $bom_id);
    }


}
