@extends('master.master')


@section('content')

  <input type="button" name="creating_lesson" value="Create lesson" class="btn btn-default" data-toggle="modal" data-target="#lesson-modal">

  <div id="lesson-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <form action="" method="post">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <input class="form-control" id="title" type="text" name="title" placeholder="Title here" required>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" type="text" name="intro" placeholder="Intro here">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="topic" placeholder="Topic here" required>
            </div>

            <div class="form-group" id="outline-container">
              <p>Outline</p>
              <div class="input-group">
                <span class="input-group-addon step-index">Step 1 - </span>
                <input class="form-control outline" type="text">
                <span class='input-group-addon close-outline'>&times;</span>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <div class="">
              <input class="btn btn-default" type="submit" name="submit" value="OK">
              <input class="btn btn-default" type="button" name="cancel" value="Cancel" data-dismiss="modal">
            </div>
          </div>

        </form>
      </div>

    </div>
  </div>

@endsection

@section('styles')
  <style media="screen">
    #outline-container{
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 10px;
    }

    #outline-container > p{

    }

    #outline-container > .input-group > .input-group-addon{
      color: #ccc;
      background-color: #fff;
      border: none;
    }

    #outline-container > .input-group > input{
      border: none;
      box-shadow: none;
      border-bottom: 1px solid #ccc;
    }

    .modal-header > #title{
      font-size: 2em;
      font-weight: bold;
      border: none;
      box-shadow: none;
      border-bottom: 1px solid #ccc;
    }

  </style>
@endsection

@section('scripts')

  <script>
    $(document).ready(function(){
      var step = 2;

      $('#outline-container').on('keypress', '.outline', function(e){

        // pressing Enter or not
        if(e.which == 13 || e.keyCode == 13){
          e.preventDefault();

          var new_outline = "<div class='input-group'>" +
                              "<span class='input-group-addon step-index'>Step " + step + " - </span>" +
                              "<input class='form-control outline' type='text' >" +
                              "<span class='input-group-addon close-outline'>&times;</span>" +
                            "</div>";

          $('#outline-container').append(new_outline);
          $('#outline-container .outline').last().focus();
          step++;
        }
      });

      $('#outline-container').on('click', '.close-outline', function(){
          var num_of_outline = $('#outline-container .outline').length;

          if(num_of_outline > 1){

              var current_outline_index = $(this).parent().index();

              // change name of steps following the current outline
              for(var i = current_outline_index; i < num_of_outline; i++){
                $('#outline-container .step-index')[i].textContent = 'Step ' + i + ' - ';
              }

              // remove the outline and decrease step
              $(this).parent().remove();
              step--;
          }
      })

    });
  </script>

@endsection
