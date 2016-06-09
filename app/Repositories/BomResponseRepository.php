<?php

namespace BuildGrid\Repositories;


class BomResponseRepository {


    /**
     * @param $bom
     * @param $file
     * @return bool
     */
    public function storeBomResponseFile($response, $file)
    {
        $path = $this->getBomResponseStoragePath($response);

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->put($path, file_get_contents($file));

    }



    /**
     * @param $bom
     * @return array|bool
     */
    public function retrieveBomResponseFile($response)
    {
        $path = $this->getBomResponseStoragePath($response);

        if(! \Storage::disk(env('DOCUMENTS_STORAGE'))->exists( $path )){
            return false;
        }

        return ['mimeType' => \Storage::mimeType($path), 'contents' => \Storage::disk(env('DOCUMENTS_STORAGE'))->get($path)];
    }



    /**
     * Gets the storage path for the a Bom response in the Storage
     * @param $bom
     * @return string
     */
    public function getBomResponseStoragePath($response)
    {
        $file_storage_path = 'Boms'
            . DIRECTORY_SEPARATOR
            . $response->bom->project->user->id
            . DIRECTORY_SEPARATOR
            . $response->bom->project->id
            . '-'
            . snake_case(camel_case($response->bom->project->name))
            . DIRECTORY_SEPARATOR
            . 'Responses'
            . DIRECTORY_SEPARATOR
            . $response->id
            . '-'
            . $response->filename;

        return $file_storage_path;
    }


}
