<?php

namespace App\Http\Controllers;

use Storage;
use Config;
use Response;
use PDF;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //

    public function create(){

    }

    public function storeUploadMediaReferences(Request $request){

        $data = array();

        // check whether user choose files
        if(!$request->hasFile('new-media-refs'))
            return $data;

        // get files
        $media_refs = $request->file('new-media-refs');
        $user_id = $request->input('user_id');
        //$folder = "media-references";

        // save files and save the generated paths
        foreach ($media_refs as $media_ref) {
            $path = Storage::putFile('media-references', $media_ref);

            $media = new Media;
            $media->name = substr($path, strrpos($path, "/") + 1);
            $media->origin_name = $media_ref->getClientOriginalName();

            $media->url = action('MediaController@viewMediaReference', $media->name);
            $media->media_type = MediaService::getMediaType($media_ref->getClientOriginalExtension());
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

    public function getMediaReferencesByUser(Request $request){

        $user_id = $request->input('user_id');

        if($user_id == null)
          return [];

        return Media::where('user_id', $user_id)
                    ->whereNotNull('name')
                    ->orderBy('origin_name', 'desc')
                    ->get();
    }

    public function storeUrlMediaReferences(Request $request){

        $url = $request->input('url');
        $user_id = $request->input('user_id');
        $origin_name = substr($url, strrpos($url, "/") + 1);

        if($url == null || $user_id == null)
          return [];

        $media = new Media;

        if( strrpos($media->origin_name, ".") == false){
            $media->origin_name = $url;
            $media->media_type = MediaService::getMediaType($origin_name);
        }
        else{
            $media->origin_name = $origin_name;
            $media->media_type = MediaService::getMediaType(substr($media->origin_name, strrpos($media->origin_name, ".") + 1));
        }

        $media->url = $url;
        $media->user_id = $user_id;

        $media->save();

        return array(
            'id' => $media->id,
            'origin_name' => $media->origin_name,
            'path' => $media->url
        );
    }

    public function viewMediaReference(Request $request, $name){

      //$url = storage_path("app\\".$request->input('url'));
      //$res = response()->file($url, ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
      //$storage_res = Storage::get($request->input('url'));
      //$res2 = response()->download($url);
      //$url = 'http://homeschooling.test/img/123.docx';
      //$pdf = PDF::loadView('community.viewfile');
      //$pdf = PDF::loadFile(storage_path("app\\media-references\\123.docx"))->save(storage_path("app\\media-references\\123.docx"));
      //$pdf = PDF::loadFile('../public/img/123.pdf');
      //return $pdf->stream('test.pdf');

      $path = storage_path("app/media-references/$name");
      $type = Storage::getMimeType("media-references/$name");

      return response()->file(
        $path,
        [
          'Content-Type' => $type,
          'Content-Disposition' => 'inline'
        ]
      );

    }

    public function download(){
        /*return response()->file(
          storage_path("app\\media-references\\00crx1rrOZpvYAslp19UD1NJeTV3XSCLO2poUyT6.docx"),
          ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        );*/
        $path = storage_path("app\\media-references\\123.png");
        $type = Storage::getMimeType("media-references/123.png");
        /*return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'inline'
        ]);*/
        /*return response()->file(
          $path,
          [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline'
          ]
        );*/

        /*return response()->download($path, 'test.docx', [], 'inline');*/
    }
}
