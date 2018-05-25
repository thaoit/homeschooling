<?php
namespace App\Services;

use Config;
use App\Models\Lesson;

class MediaService{

  public static function getMediaType($extension){

      switch (strtolower($extension)) {

        case 'png':
        case 'jpg':
        case 'jpeg':
        case 'bmp':
          return Config::get('constants.media_type.image');

        case 'mp3':
        case 'mp4':
        case 'wav':
          return Config::get('constants.media_type.audio_video');

        case 'doc':
        case 'docx':
        case 'ppt':
        case 'pptx':
        case 'xls':
        case 'pdf':
        case 'txt':
          return Config::get('constants.media_type.document');

        default:
          return Config::get('constants.media_type.others');
      }
  }

  public static function getCategorizedMediaBy($lesson_id){

      $lesson = Lesson::find($lesson_id);

      // check if lesson existed or not
      if($lesson == null){
          return array();
      }

      // get each media type
      $image_name = Config::get('constants.media_type.image');
      $audio_video_name = Config::get('constants.media_type.audio_video');
      $document_name = Config::get('constants.media_type.document');
      $undefined_name = Config::get('constants.media_type.others');
      $count_name = 'num_of_media';

      // find media with each type
      $image     = $lesson->medias()->where('media_type', $image_name)
                                    ->get();
      $audio_video     = $lesson->medias()->where('media_type', $audio_video_name)
                                    ->get();
      $document  = $lesson->medias()->where('media_type', $document_name)
                                    ->get();
      $undefined = $lesson->medias()->where('media_type', $undefined_name)
                                    ->get();

      $count = $image->count() + $audio_video->count() + $document->count() + $undefined->count();
      $image = ($image->count() > 0) ? $image: array();
      $audio_video = ($audio_video->count() > 0) ? $audio_video:array();
      $document = ($document->count() > 0) ? $document: array();
      $undefined = ($undefined->count() > 0) ? $undefined: array();

      return [
        'types' =>    [
                        $image_name => $image,
                        $audio_video_name => $audio_video,
                        $document_name => $document,
                        $undefined_name => $undefined
                      ],
        'num_of_media' => $count
      ];
  }
}
