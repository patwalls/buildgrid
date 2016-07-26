<?php

namespace BuildGrid\Repositories;


use BuildGrid\Events\BomFileStored;

class BomRepository {


    /**
     * @param $bom
     * @param $file
     * @return bool
     */
    public function storeBomFile($bom, $file)
    {
        $path = $this->getBomFileStoragePath($bom);

        if ( ! \Storage::disk(env('DOCUMENTS_STORAGE'))->put($path, file_get_contents($file))){
            return false;
        }

        event(new BomFileStored($bom));

        return true;

    }


    /**
     * @param $bom
     * @return array|bool
     */
    public function retrieveBomFile($bom)
    {
        $path = $this->getBomFileStoragePath($bom);

        if(! \Storage::disk(env('DOCUMENTS_STORAGE'))->exists( $path )){
            return false;
        }

        return ['mimeType' => \Storage::mimeType($path), 'contents' => \Storage::disk(env('DOCUMENTS_STORAGE'))->get($path)];
    }


    /**
     * Gets the storage path for the specified Bom file based on the User id, project id and name and filename.
     * @param $bom
     * @return string
     */
    public function getBomFileStoragePath($bom)
    {

        $file_storage_path = 'Boms'
            . DIRECTORY_SEPARATOR
            . $bom->project->user->id
            . DIRECTORY_SEPARATOR
            . $bom->project->id
            . '-'
            . snake_case(camel_case($bom->project->name))
            . DIRECTORY_SEPARATOR
            . snake_case(camel_case($bom->filename));

        return $file_storage_path;

    }


    public function requestPreview($bom)
    {
        $fp = app('FilePreviews');

        $options = [
            'data' => [
                'bom_id' => $bom->id,
                'project' => $bom->project->name
            ],
            'sizes' => [
                '400'
            ]
        ];

        $url =  route('bomDownloadFilePreviews.io', [$bom->id]);

        return $fp->generate($url, $options);

    }


    public function storePreview($bom, $file_url)
    {
        $curl = curl_init ($file_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
        $preview_file = curl_exec($curl);
        curl_close ($curl);

        $path = $this->getPreviewStoragePath($bom);

        if( ! $preview_file === false){

            if ( \Storage::disk(env('DOCUMENTS_STORAGE'))->put($path, $preview_file)){
                return true;
            }

        }

        return false;
    }


    /**
     * @param $bom
     * @return string
     */
    public function getPreviewStoragePath($bom)
    {

        $preview_storage_path = 'Boms'
            . DIRECTORY_SEPARATOR
            . $bom->project->user->id
            . DIRECTORY_SEPARATOR
            . $bom->project->id
            . '-'
            . snake_case(camel_case($bom->project->name))
            . DIRECTORY_SEPARATOR
            . 'preview.png';

        return $preview_storage_path;

    }


    /**
     * @param $bom
     * @return bool|string
     */
    public function retrievePreview($bom)
    {
        $path = $this->getPreviewStoragePath($bom);
        
        if( ! \Storage::disk(env('DOCUMENTS_STORAGE'))->exists( $path ) ){
            return false;
        }

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->get( $path );
    }

}
