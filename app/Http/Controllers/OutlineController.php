<?php

namespace App\Http\Controllers;

use App\Services\OutlineService;
use Illuminate\Http\Request;

class OutlineController extends Controller
{
    //

    public function doStoreUpdateDelete(Request $request){

        $input = $request->all();

        // variables for returning
        $success = true;
        $new_outlines_id = array();

        // store new outlines
        if(isset( $input['new'] )){

            foreach ($input['new'] as $new_outline) {

                $id = OutlineService::store($new_outline);
                if($id > 0){
                    $new_outlines_id[] = $id;
                }
                else {
                    $success = false;
                }
            }
        }

        // update outlines
        if(isset( $input['update'] )){

            foreach ($input['update'] as $update_outline) {
                if(!OutlineService::update($update_outline)){
                    $success = false;
                }
            }
        }

        // delete outlines with id
        if(isset( $input['delete'] )){

            foreach ($input['delete'] as $delete_id) {
                if(!OutlineService::delete($delete_id)){
                    $success = false;
                }
            }
        }

        return [
          'success' => $success,
          'new_outlines_id' => $new_outlines_id
        ];
    }
}
