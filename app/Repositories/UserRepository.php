<?php


namespace BuildGrid\Repositories;


class UserRepository
{
    /**
     * @param $user
     * @param $file
     * @return bool
     * @internal param $user
     */
    public function storePictureProfile($user, $file)
    {
        $path = $this->getPictureProfileStoragePath($user);

        return \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->put($path, file_get_contents($file));

    }


    /**
     * @param $user
     * @return array|bool
     */
    public function retrievePictureProfile($user)
    {
        $path = $this->getPictureProfileStoragePath($user);

        if(! \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->exists( $path )){
            return false;
        }

        return ['mimeType' => \Storage::mimeType($path), 'contents' => \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->get($path)];
    }


    /**
     * Gets the storage path for the specified profile picture based on the User id and filename.
     * @param $user
     * @return string
     */
    public function getPictureProfileStoragePath($user)
    {

        $file_storage_path = 'User'
            . DIRECTORY_SEPARATOR
            . $user->id
            . '-'
            . snake_case(camel_case($user->id))
            . DIRECTORY_SEPARATOR
            . snake_case(camel_case($user->picture));

        return $file_storage_path;

    }

    public function getThumbnailProfileStoragePath($user)
    {

        $file_storage_path = 'User'
            . DIRECTORY_SEPARATOR
            . $user->id
            . '-'
            . snake_case(camel_case($user->id))
            . DIRECTORY_SEPARATOR
            . snake_case(camel_case($user->picture))
            . '-thumbnail';

        return $file_storage_path;

    }

    public function retrieveThumbailProfile($user)
    {
        $path = $this->getPictureProfileStoragePath($user);


        if(! \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->exists( $path )){
            return false;
        }

        return ['mimeType' => \Storage::mimeType($path), 'contents' => \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->get($path)];
    }
}