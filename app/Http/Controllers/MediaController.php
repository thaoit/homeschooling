<?php

namespace App\Http\Controllers;

use Storage;
use Config;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //
    public function create(){

    }

    public function storeMediaReferences(Request $request){

        $data = array();

        // check whether user choose files
        if(!$request->hasFile('new-media-refs'))
            return $data;

        // get files
        $media_refs = $request->file('new-media-refs');
        $user_id = $request->input('user_id');
        $folder = "media-references";

        // save files and save the generated paths
        foreach ($media_refs as $media_ref) {
            $path = Storage::putFile($folder, $media_ref);

            $media = new Media;
            $media->name = substr($path, strrpos($path, "/") + 1);
            $media->origin_name = $media_ref->getClientOriginalName();
            $media->url = $path;
            $media->media_type = $this->getMediaType($media_ref->getClientOriginalExtension());
            $media->user_id = $user_id;

            $media->save();


            $data[] = array(
              'id' => $media->id,
              'origin_name' => $media_ref->getClientOriginalName(),
              'path' => $path
            );
        }

        return $data;
    }

    public function getMediaType($extension){

        switch (strtolower($extension)) {

          case 'png':
          case 'jpg':
          case 'jpeg':
          case 'bmp':
            return Config::get('constants.media_type.image');

          case 'mp3':
          case 'mp4':
            return Config::get('constants.media_type.video');

          case 'doc':
          case 'docx':
          case 'ppt':
          case 'pptx':
          case 'xls':
            return Config::get('constants.media_type.document');

          default:
            return Config::get('constants.undefined');
        }
    }
}
