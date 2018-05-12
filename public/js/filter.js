$(document).ready(function(){

  // control open/close filter-container through filter-btn

  $('.filter-btn').on('click', function(){

    var obj = $(this).attr('data-toggle');
    var target = $(this).attr('data-target');

    if(obj && obj.length > 0 && target && target.length > 0){

        $(target).toggle();
    }
  })

  $('.filter-container button').on('click', function(){

    var obj = $(this).attr('data-dismiss');

    if(obj && obj === "filter-container"){

        $(this).parents('.filter-container').hide();
    }
  })

});
