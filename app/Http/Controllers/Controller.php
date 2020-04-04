<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Image;
use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $path;
    public $dimentions;

    public function uploadImage( $fileImage, $fileImageName )
    {
        try {
            if ( !File::isDirectory( $this->path ) ) {
                File::makeDirectory( $this->path );
            }

            $file       = $fileImage;
            $fileName   = Carbon::now()->timestamp . '_' . str::slug( $fileImageName, '_' ) . '.JPEG';

            Image::make( $fileImage )->save( $this->path . '/' . $fileName );

            foreach ( $this->dimentions as $dimention ) {
                $canvas         = Image::canvas( $dimention, $dimention );
                $resizeImage    = Image::make( $file )->resize( $dimention, $dimention, function( $constraint ) {
                    $constraint->aspectRatio();
                });

                if ( !File::isDirectory( $this->path . '/' . $dimention ) ) {
                    File::makeDirectory( $this->path . '/' . $dimention );
                }

                $canvas->insert( $resizeImage, 'center' );
                $canvas->save( $this->path . '/' . $dimention . '/' . $fileName );
            }
        } catch (\Exception $e) {
            return redirect()->back()->with( 'error', $e->getMessage() );
        }

        return $fileName;
    }
}
