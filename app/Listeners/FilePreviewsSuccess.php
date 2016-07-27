<?php

namespace BuildGrid\Listeners;

use BuildGrid\Bom;
use BuildGrid\Repositories\BomRepository;


class FilePreviewsSuccess
{

    public function __construct(BomRepository $bomRepository)
    {
        $this->bomRepository = $bomRepository;
    }


    /**
     * Handle the event.
     *
     * @param  array  $results
     * @return void
     */
    public function handle($results)
    {
        $bom_id   = $results['user_data']['bom_id'];
        $bom      = Bom::findOrFail($bom_id);
        $file_url = $results['preview']['url'];

        $this->bomRepository->storePreview($bom, $file_url);
    }

}
