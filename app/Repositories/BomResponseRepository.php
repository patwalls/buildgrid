<?php

namespace BuildGrid\Repositories;


use BuildGrid\BomResponse;

class BomResponseRepository {


    /**
     * @param $response
     * @param $file
     * @return bool
     * @internal param $bom
     */
    public function storeBomResponseFile($response, $file)
    {

        $path = $this->getBomResponseStoragePath($response);

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->put($path, file_get_contents($file));

    }


    /**
     * @param $response
     * @return array|bool
     * @internal param $bom
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
     * @param $response
     * @return string
     * @internal param $bom
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

    /**
     * @param $response
     * @return string
     */
    public function getBomResponsePreviewStoragePath($response)
    {
        $preview_storage_path = 'Boms'
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
            . 'preview.png';

        return $preview_storage_path;

    }

    /**
     * @param $response
     * @return bool|string
     */
    public function retrieveBomResponsePreview(BomResponse $response)
    {
        $path = $this->getBomResponsePreviewStoragePath($response);

        if( ! \Storage::disk(env('DOCUMENTS_STORAGE'))->exists( $path ) ){
            return false;
        }

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->get( $path );
    }

}
