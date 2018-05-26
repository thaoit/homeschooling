$(document).ready(function(){

    // store the curren index of slided section
    var current_index = 0;
    // store slide container which is waiting for the slide child moving
    var slide_container_wait_child=[];

    // INIT: hide all the slide elements
    init();

    // slide the first section
    $(window).on('load', function(){

        var slides = $('.slide-container').find('.slide');

        slideToInsideBrowser(slides.eq(0), 1);
        changeHeightOfContainer(0, slides, 1);
    });

    // click to slide the next section
    $(document).on('click', '.slide-next', function(){

        // target is the most top slide-container
        // that contains all the slide desired
        var target = $(this).attr('data-target');

        if(typeof target !== 'undefined'){

            var slides = $(target).find('.slide');

            // if the current is not the last slide

            if(current_index + 1 === slides.length){
                return true;
            }

            // else start to slide

            var slides_in = getSlideInElementsWhenNext(current_index, slides);
            var top_slide_out = getTopSlideOutElementWhenNext(current_index, slides);

            slideWhenNext(slides, slides_in, top_slide_out);

            // update index for the latest current slide
            current_index += slides_in.length;

            // slide changes, so change the container for showing full content
            changeHeightOfContainer(current_index, slides, 1);

        }
    })

    $(document).on('click', '.slide-back', function(){

        // target is the most top slide-container
        // that contains all the slide desired
        var target = $(this).attr('data-target');

        if(typeof target !== 'undefined'){

            var slides = $(target).find('.slide');

            // if the current is not the last slide

            if(current_index === 0){
                return true;
            }

            // else start to slide

            var top_slide_in = getTopSlideInElementWhenBack(current_index, slides);
            var slides_out = getSlideOutElementWhenBack(current_index, slides, top_slide_in);

            slideWhenBack(slides, slides_out, top_slide_in);

            // update index for the latest current slide
            current_index -= slides_out.length;

            // slide changes, so change the container for showing full content
            changeHeightOfContainer(current_index, slides, 1);

        }
    })

    $(document).on('keyup', function(e){

        switch (e.key) {
          case 'ArrowRight':
          case 'Right':

            var slide_next_element = $('.slide-next');
            slide_next_element.click();
            break;
            
          case 'ArrowLeft':
          case 'Left':

            var slide_back_element = $('.slide-back');
            slide_back_element.click();
            break;
        }
    })

    function init(){

        var elements = $('.slide-container:first').children('.slide');

        for(var i = 0; i < elements.length; i++){

            slideToTheRightBrowser(elements.eq(i), 0);
        }
    }

    /*function hideOnTheRight(element){

        var nearest_parent = element.parent('.slide-container');

        if(typeof nearest_parent !== 'undefined'){

            var left = nearest_parent.position().left + nearest_parent.outerWidth();
            element.css('left', left);
        }
    }

    function slideFromLeftToInside(element){

        var nearest_parent = element.parent('.slide-container');

        if(typeof nearest_parent !== 'undefined'){

            var center = nearest_parent.position().left + nearest_parent.outerWidth() / 2;
            var left = center - element.outerWidth() / 2;
            element.css({
              'left': left,
              'transition': 'left 1s'
            });
        }
    }

    function slideFromLeftToOutside(element){

        var nearest_parent = element.parent('.slide-container');

        if(typeof nearest_parent !== 'undefined'){

            var left = nearest_parent.position().left + nearest_parent.outerWidth();
            element.css({
              'left': left,
              'transition': 'left 1s'
            });
        }
    }

    function slideFromRightToInside(element){

        var nearest_parent = element.parent('.slide-container');

        if(typeof nearest_parent !== 'undefined'){

            var center = nearest_parent.position().left + nearest_parent.outerWidth() / 2;
            var left = center - element.outerWidth() / 2;
            element.css({
              'left': left,
              'transition': 'left 1s'
            });
        }
    }

    function slideFromRightToOutside(element){

        var nearest_parent = element.parent('.slide-container');

        if(typeof nearest_parent !== 'undefined'){

            var left = nearest_parent.position().left - element.outerWidth();
            element.css({
              'left': left,
              'transition': 'left 1s'
            });
        }
    }*/

    function getSlideInElementsWhenNext(current_index, slides_all){

        var arr = [];
        var element = slides_all.eq(current_index + 1);

        arr.push(element);

        while(true){

            var container = element.find('.slide-container:first');

            if(container.length === 0){
                break;
            }
            else {
                element = container.children('.slide:first');
                arr.push(element);
            }
        }

        return arr;
    }

    function getTopSlideOutElementWhenNext(current_index, slides_all){

        var top;
        var next_slide_in = slides_all.eq(current_index + 1);

        //if(typeof next_slide_in !== 'undefined'){

            var next_slide_in_parent = next_slide_in.parent();

            for(var i = current_index; i >= 0; i--){

                if(slides_all.eq(i).parent().is(next_slide_in_parent)){

                    top = slides_all.eq(i);
                    break;
                }
            }
        //}

        return top;
    }

    function slideWhenNext(slides_all, slides_in, top_slide_out){

        // slide out
        slideToTheLeftBrowser(top_slide_out, 1);

        // slide in
        slideToInsideBrowser(slides_in[0], 1);

        for(var i = 1; i < slides_in.length; i++){

            var siblings_after = slides_in[i].nextAll('.slide');

            for(var j = 0; j < siblings_after.length; j++){

                slideToTheRightBrowser(siblings_after.eq(j), 0);
            }
        }
    }

    function getTopSlideInElementWhenBack(current_index, slides_all){

        var element = slides_all.eq(current_index).prev('.slide');

        if(element.length === 0){

            var i = current_index;

            while (element.length === 0) {
                i--;
                element = slides_all.eq(i).prev('.slide');
            }
        }

        //if(typeof element !== 'undefined'){
            //arr.push(element);

            /*while(true){

                var container = element.find('.slide-container:last');
                console.log('Container');
                console.log(container);
                if(container.length === 0){
                    break;
                }
                else {
                    element = container.children('.slide:last');
                    arr.push(element);
                    console.log('Element');
                    console.log(element);
                }
            }*/
        //}

        return element;
    }

    function getSlideOutElementWhenBack(current_index, slides_all, top_slide_in){

        var arr = [];

        //if(top_slide_in.length !== 0){

          var back_slide_in_parent = top_slide_in.parent();

          for(var i = current_index; i >= 0; i--){

              arr.push(slides_all.eq(i));
              if(slides_all.eq(i).parent().is(back_slide_in_parent)){
                  break;
              }
          }

        return arr;
    }

    function slideWhenBack(slides_all, slides_out, top_slide_in){

        // slide in
        slideToInsideBrowser(top_slide_in, 1);

        // slide out
        slideToTheRightBrowser(slides_out[slides_out.length - 1], 1);

        for(var i = 1; i < slides_out.length; i++){

            var siblings_after = slides_out[i].nextAll('.slide');

            for(var j = 0; j < siblings_after.length; j++){

                slideToTheLeftBrowser(siblings_after.eq(j), 0);
            }
        }
    }

    function slideToTheRightBrowser(element, duration){

        element.css({
          'left': window.innerWidth,
          'transition': 'left ' + duration + 's'
        });
    }

    function slideToTheLeftBrowser(element, duration){

        element.css({
          'left': -window.innerWidth,
          'transition': 'left ' + duration + 's'
        });
    }

    function slideToInsideBrowser(element, duration){

        element.css({
          'left': 0,
          'transition': 'left ' + duration + 's'
        });
    }

    function changeHeightOfContainer(index, slides_all, duration){

        // set the current container
        var current = slides_all.eq(index);
        var container = current.parent();

        container.css({
            'height': current.outerHeight(),
            'transition': 'height ' + duration + 's'
        });

        // set the ancestor container
        var ancestor_slide = container.parents('.slide');

        // wait for the current container change height after duration (ms)
        // before change for the ancestor
        setTimeout(function () {

            for(var i = 0; i < ancestor_slide.length; i++){

                ancestor_slide.eq(i).parent().css({
                    'height': ancestor_slide.eq(i).outerHeight(),
                    'transition': 'height 0.5s'
                });
            }
        }, duration * 1000);

    }

  });
