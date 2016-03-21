<?php

namespace BuildGrid\Repositories;


class BomResponseRepository {


    /**
     * @param $bom
     * @param $file
     * @return bool
     */
    public function storeBomResponse($bom_response_id, $file)
    {
        $path = $this->getBomResponseStoragePath($bom);

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->put($path, file_get_contents($file));

    }


    /**
     * Gets the storage path for the a Bom response in the Storage
     * @param $bom
     * @return string
     */
    public function getBomResponseStoragePath($bom)
    {
        $file_storage_path = 'Boms'
            . DIRECTORY_SEPARATOR
            . $bom->project->user->id
            . DIRECTORY_SEPARATOR
            . $bom->project->id
            . '-'
            . snake_case(camel_case($bom->project->name))
            . DIRECTORY_SEPARATOR
            . 'responses';

        return $file_storage_path;
    }


}
