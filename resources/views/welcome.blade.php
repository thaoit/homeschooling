@extends('master.master')

@section('content')

<div id="welcome">
  <h2 class="text-center" >Which WAY for yourself?</h2>
  <h4 class="text-center">Coming to Homy</h4>
  <h4 class="text-center" style="padding-bottom: 80px">For drawing children's future</h4>
  <div class="welcome-background" style="margin-top: 15%">
    <div id="img-carousel" class="carousel slide" data-ride="carousel" style="float: none; margin: 0 auto">
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{ asset('img/family 2.jpg') }}" alt="Los Angeles">
        </div>
        <div class="item">
          <img src="{{ asset('img/family 3.jpg') }}" alt="Chicago">
        </div>
        <div class="item">
          <img src="{{ asset('img/family 4.jpg') }}" alt="New York">
        </div>
        <div class="item">
          <img src="{{ asset('img/family 5.jpg') }}" alt="Chicago">
        </div>
        <div class="item">
          <img src="{{ asset('img/family 6.jpg') }}" alt="New York">
        </div>
      </div>
    </div>
    <div id="img-carousel-container" style="position: relative">
      <img id="img-carousel-background" src="{{ asset('img/earth.png') }}" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" alt="Homepage image">
      <div id="recommend-lesson-container" class="col-xs-12" style="position: absolute; overflow: hidden">
        <h4 class="title" style="">Some lessons</h4>
        <div class="col-xs-3 col-sm-4 main-lesson-boundary slide-updown-container">
          <div class="slide-updown sub-lesson-boundary" style="right: 0">
            <p class="slide-item"><a href="">1. Discovery about the Earth</a></p>
            <p class="slide-item"><a href="">2. Moon night</a></p>
            <p class="slide-item"><a href="">3. Discovery about the Earth</a></p>
            <p class="slide-item"><a href="">4. Moon night</a></p>
            <p class="slide-item"><a href="">5. Discovery about the Earth</a></p>
            <p class="slide-item"><a href="">6. Moon night</a></p>
            <p class="slide-item"><a href="">7. Discovery about the Earth</a></p>
            <p class="slide-item"><a href="">8. Moon night</a></p>
          </div>
        </div>
        <div class="col-xs-6 col-sm-4"></div>
        <div class="col-xs-3 col-sm-4 main-lesson-boundary slide-updown-container" style="position: relative">
          <div class="slide-updown sub-lesson-boundary" style="left: 0">
            <p class="slide-item"><a href="">1. Discovery about the Earth</a></p>
            <p class="slide-item"><a href="">2. Moon night</a></p>
            <p class="slide-item"><a href="">3. Discovery about the Earth</a></p>
            <p class="slide-item"><a href="">4. Moon night</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="intro-container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    <div class="intro">
      <h4>Homeschooling</h4>
      <p>Homeschooling is a progressive movement around the country and the world, in which parents choose to educate their children at home instead of sending them to a traditional public or private school.</p>
      <p>The homeschooling movement began growing in the 1970s, when some popular authors and researchers, such as John Holt and Dorothy and Raymond Moore, started writing about educational reform. They suggested homeschooling as an alternative educational option.</p>
      <p>According to the National Home Education Research Institute, there are now more than two million children being homeschooled in the U.S., with the percentage rapidly increasing by 7 percent to 15 percent each year. Homeschooling is legal in all 50 states and in many foreign countries.</p>
    </div>
    <div class="intro">
      <h4>Homy Community</h4>
      <p>Homeschooling is a progressive movement around the country and the world, in which parents choose to educate their children at home instead of sending them to a traditional public or private school.</p>
      <p>The homeschooling movement began growing in the 1970s, when some popular authors and researchers, such as John Holt and Dorothy and Raymond Moore, started writing about educational reform. They suggested homeschooling as an alternative educational option.</p>
      <p>According to the National Home Education Research Institute, there are now more than two million children being homeschooled in the U.S., with the percentage rapidly increasing by 7 percent to 15 percent each year. Homeschooling is legal in all 50 states and in many foreign countries.</p>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script>

$(document).ready(function(){

    // init
    initUI();
    slideUpDown();

    // resize window, reset ui
    $(window).resize(function(){
        initUI();
    });

    //
    function initUI(){

        // set img height in carousel
        var img_height = $('#img-carousel-background').height() * 0.55;
        $('#img-carousel .item > img').css('height', img_height);

        // set carousel width in container
        var carousel_width = $('#img-carousel-background').width() * 0.62;
        $('#img-carousel').css('width', carousel_width);

        // set container center the carousel
        var carousel_margin_top = - $('#img-carousel').height() / 2 - $('#img-carousel-background').height() / 2;
        $('#img-carousel-container').css('margin-top', carousel_margin_top);

        // set recommend lessons in center the carousel container and max height for showing
        var lesson_container_margin_top = $('#img-carousel-background').height() * 0.2;
        $('#recommend-lesson-container').css('margin-top', lesson_container_margin_top);
        var max_height = $('#img-carousel-background').height() * 0.6;
        $('#recommend-lesson-container .slide-updown-container').css('height', max_height);

        // change if small screen
        resetUIWhenSmallScreen(420);
    }

    function resetUIWhenSmallScreen(min_width_screen){

        if( window.innerWidth <= min_width_screen){

            $('#recommend-lesson-container').css('position', 'static');
            $('#recommend-lesson-container .main-lesson-boundary').addClass('full-width');
            $('#recommend-lesson-container .sub-lesson-boundary').css({
                'position': 'static',
                'text-align': 'left'
            });
            $('#recommend-lesson-container p').css('margin-bottom', 15);
            $('#recommend-lesson-container .title').show();
            $('#recommend-lesson-container .slide-updown-container').css('height', '');
        }
        else{

            $('#recommend-lesson-container').css('position', 'absolute');
            $('#recommend-lesson-container .main-lesson-boundary').removeClass('full-width');
            $('#recommend-lesson-container .sub-lesson-boundary').css('position', 'absolute');
            $('#recommend-lesson-container .sub-lesson-boundary:first').css({
                right: '0',
                'text-align': 'right'
            });
            $('#recommend-lesson-container .sub-lesson-boundary:last').css({
                left: '0',
                'text-align': 'left'
            });
            $('#recommend-lesson-container p').css('margin-bottom', 25);
            $('#recommend-lesson-container .title').hide();
        }
    }

    function slideUpDown(){

        setInterval(function(){

            var containers = $('.slide-updown-container .slide-updown');

            // move the first slide item out the vision of slide container
            for(var i = 0; i < containers.length; i++){

                var first_item = containers.eq(i).find('.slide-item:first');

                if( first_item.length > 0 ){

                    var top_move = containers.eq(i).position().top - first_item.outerHeight(true);
                    containers.eq(i).addClass('slide-updown-transition');
                    containers.eq(i).css('top', top_move);
                }
            }

            // get transition duration for moving slide item
            var transition = $('.slide-updown-container .slide-updown-transition');
            var transition_duration = (transition.length > 0) ? parseFloat(transition.css('transition-duration')) : 0;

            // after the first item complete moving, remove that first item and,
            // append to the last container
            setTimeout(function(){

                for(var i = 0; i < containers.length; i++){

                    var first_item = containers.eq(i).find('.slide-item:first');

                    if(first_item.length > 0){

                        var html = first_item[0].outerHTML;

                        var top_move = containers.eq(i).position().top + first_item.outerHeight(true);

                        first_item.remove();
                        containers.eq(i).append(html);

                        containers.eq(i).removeClass('slide-updown-transition');
                        containers.eq(i).css('top', top_move);
                    }
                }
            }, transition_duration * 1000);

        }, 4000);
    }

});
</script>

@endsection
