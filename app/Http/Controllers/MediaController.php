<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //
    public function storeMediaReferences(Request $request){

        $data = array();

        // check whether user choose files
        if(!$request->hasFile('new-media-refs'))
            return $data;

        // get files
        $media_refs = $request->file('new-media-refs');
        $path = null;

        // save files and save the generated paths
        foreach ($media_refs as $media) {
            $path = Storage::putFile('media-references', $media);
            $data[] = array(
              'path' => $path,
              'origin_name' => $media->getClientOriginalName()
            );
        }

        return $data;
    }
}
