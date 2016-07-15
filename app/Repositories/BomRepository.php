<?php

namespace BuildGrid\Repositories;


class BomRepository {


    /**
     * @param $bom
     * @param $file
     * @return bool
     */
    public function storeBomFile($bom, $file)
    {
        $path = $this->getBomFileStoragePath($bom);

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->put($path, file_get_contents($file));

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
