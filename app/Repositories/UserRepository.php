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
    public function storeProfilePicture($user, $file)
    {
        $path = $this->getProfilePictureStoragePath($user);
        $file_content = file_get_contents($file);

        $full_image = \Image::make($file_content)->resize(200, 200)->encode('png');
        $thumbnail_image = \Image::make($file_content)->resize(36, 36)->encode('png');

        return ( \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->put( $path . 'full.png', $full_image) &&
                 \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->put( $path . 'thumbnail.png', $thumbnail_image)
                );
    }


    /**
     * @param $user
     * @param string $size
     * @return array|bool
     */
    public function retrieveProfilePicture($user, $size = 'full')
    {
        $path = $this->getProfilePictureStoragePath($user);

        if(! \Storage::disk(env('PICTURES_PROFILE_STORAGE'))->exists( $path . $size . '.png' )){
           return false;
        }

        return \Storage::disk(env('DOCUMENTS_STORAGE'))->get($path . $size . '.png');

    }


    /**
     * Gets the storage path for the specified profile picture based on the User id and filename.
     * @param $user
     * @return string
     */
    public function getProfilePictureStoragePath($user)
    {

        $file_storage_path = 'Users'
            . DIRECTORY_SEPARATOR
            . $user->id
            . DIRECTORY_SEPARATOR;

        return $file_storage_path;

    }

}
