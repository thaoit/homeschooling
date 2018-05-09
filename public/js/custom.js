var delete_outlines = [];
var delete_topics = [];
var delete_medias = [];

setupAjax();

function setupAjax(){

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function ajaxGetMediaReferencesByUser(user_id, process_url){

    // load uploaded references by current user
    $.ajax({

        type: 'get',
        url: process_url,
        data: {
            'user_id': user_id
        },
        success: function(data){

            var html_data = generateUploadReferencesBeforeChosen(data);

            $('#references-modal .uploaded-refs').children().remove();
            $('#references-modal .uploaded-refs').append(html_data);
        },
        error: function(data){
            console.log(data);
        }
    });
}

function ajaxStoreAndAssignNewUploadMediaReferences(new_media_refs, references_container, user_id, process_url, view_process_url){

    var formData = new FormData(new_media_refs);
    formData.append('user_id', user_id);

    $.ajax({
        type: 'post',
        url: process_url,
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){

            var html_data = generateReferencesAfterChosen(data, view_process_url);
            references_container.append(html_data);

        },
        error: function(data){
            console.log(data);
        }
    });
}

function ajaxStoreAndAssignNewUrlMediaReferences(url_media_ref, references_container, user_id, process_url, view_process_url){

    var url = url_media_ref.children('input').val();
    var html_data = generateReferenceAfterChosen(
        '',
        url,
        url.substr(url.lastIndexOf('/') + 1),
        false,
        view_process_url
    );

    $.ajax({

        type: 'post',
        url: process_url,
        data: {
            url: url_media_ref.children('input').val(),
            user_id: user_id
        },
        success: function(data){

            var html_data = generateReferenceAfterChosen(data.id, data.path, data.origin_name, false, view_process_url);
            references_container.append(html_data);
        },
        error: function(data){
          console.log(data);
        }
    });
}

function generateUploadReferencesBeforeChosen(data){

    var uploaded_refs = '';
    for(var i = 0; i < data.length; i++){

        uploaded_refs +=  '<li class="uploaded-ref" data-id=' + data[i].id + ' data-path="' + data[i].url + '" >' +
                              data[i].origin_name +
                          '</li>';
    }

    return uploaded_refs;
}

function generateReferencesAfterChosen(data, view_process_url){

    var references = ''
    for(var i = 0; i < data.length; i++){

        references += generateReferenceAfterChosen(data[i].id, data[i].path, data[i].origin_name, true, view_process_url);
    }

    return references;
}

function generateReferenceAfterChosen(id, path, origin_name, isUploaded, view_process_url){

    if(isUploaded){

        var href = view_process_url;
        var name = path.substr(path.lastIndexOf('/') + 1);

        href = href.replace('url', name);

        var link =  '<a href="' + href + '" target="_blank">' +
                      origin_name +
                    '</a>';
    }
    else{
        var link =  '<a href="' + path + '">'+
                      origin_name +
                    '</a>';
    }

    var data_id = 'data-id="' + id + '"';

    return '<li ' + data_id + ' data-path="' + path + '" >' +
              link +
              '<span class="close-reference" title="Close this reference">&times;</span>' +
            '</li>';

}

function ajaxSearchAndShowTopicsHints(search_text, hints_container, message, message_text, process_url){

    $.ajax({
        type: 'get',
        url: process_url,
        data: {
              'name': search_text
        },
        success: function(data){
            // remove the old hints
            if(hints_container.children().length > 0){
                hints_container.children().remove();
            }

            // if has data returned, create and show data
            // if not, hide hint container and inform user
            if(data.length > 0){
              generateTopicHints(data, hints_container);

              hints_container.show();
              message.hide();
            }
            else{
              hints_container.hide();
              message[0].innerText = message_text;
              message.show();
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

function generateTopicHints(data, hints_container){
  // convert to html
  var hints = "";

  for(var i = 0; i < data.length; i++){

      hints += "<li data-id=" + data[i].id + ">" + data[i].name + "</li>";
  }

  hints = "<ul>" + hints + "</ul>";

  hints_container.append(hints);
}

function ajaxSaveAllRelatingLesson(is_publish, process_url, element_data){

    var new_outline_elements = $('.outline-container .outline:not([data-outline-id])');
    var update_outline_elements = $('.outline-container .outline[data-outline-id]');
    var new_topic_elements = $('#general .chosen-hints .chosen-hint:not([data-id])');
    var update_topic_elements = $('#general .chosen-hints .chosen-hint[data-id]');
    var media_reference_elements = $('#references-container .content li');

    var general = getObjOfGeneralLesson(
        $('#general').attr('data-lesson-id'),
        $('#title').val(),
        $('#intro').val(),
        1,
        is_publish
    );

    var outlines = getObjOfOutlines(
        new_outline_elements,
        update_outline_elements,
        delete_outlines
    );

    var topics = getObjOfTopics(
        new_topic_elements,
        update_topic_elements,
        delete_topics
    );

    var media_references = getObjOfMediaReferences(media_reference_elements, delete_medias);

    // send request
    $.ajax({

        type: 'post',
        url: process_url,
        data:{
            'general': general,
            'outlines': outlines,
            'topics': topics,
            'media_references': media_references
        },
        success: function(data){
            console.log(data);
            if( !data['success'] ){
                return;
            }

            // assign lesson's id
            lesson_id = data['id'];
            $('#general').attr('data-lesson-id', lesson_id);

            // assign outlines's id
            var new_outlines_id = data['new_outlines_id'];

            for(var i = 0; i < new_outlines_id.length; i++){

                new_outline_elements.eq(i).attr('data-outline-id', new_outlines_id[i]);
            }

            // assign topics's id
            var new_topics_id = data['new_topics_id'];
            for(var i = 0; i < new_topics_id.length; i++){
                new_topic_elements.eq(i).attr('data-id', new_topics_id[i]);
            }

            // remove the delete outlines / topics / medias
            delete_outlines = [];
            delete_topics = [];
            delete_medias = [];

            // save as craft / publish button
            if(is_publish){

                $('#save_as_draft').hide();
                $('#publish')[0].innerText = "Save";
            }
        },
        error: function(data){
          console.log(data);
        }
    });
}

function getObjOfGeneralLesson(lesson_id, title, intro, author_id, is_publish){

    var array = {
        id: lesson_id,
        title: title,
        intro: intro,
        author_id: author_id,
        is_publish: is_publish
    };

    return array;
}

function getObjOfOutlines(new_outline_elements, update_outline_elements, delete_outlines){

    var new_contents = getArrayOfObjFromOutlineContents(new_outline_elements);
    var update_contents = getArrayOfObjFromOutlineContents(update_outline_elements);

    var array = {
      new: new_contents,
      update: update_contents,
      delete: delete_outlines
    };

    return array;
}

function getObjOfTopics(new_topic_elements, update_topic_elements, delete_topics){

    var new_topics = getArrayOfObjFromTopics(new_topic_elements);
    var update_topics = getArrayOfObjFromTopics(update_topic_elements);

    var array = {
      new: new_topics,
      update: update_topics,
      delete: delete_topics
    };

    return array;
}

function getObjOfMediaReferences(new_media_reference_elements, delete_media_refs){

    var new_media_refs = getArrayOfObjFromMediaReferences(new_media_reference_elements);

    var array = {
      new: new_media_refs,
      delete: delete_media_refs
    }

    return array;
}

/*function saveGeneralLesson(is_publish){

    var lesson_id = $('#general').attr('data-lesson-id');
    var url;
    var isNew = true;

    // check lesson is added or updated
    if(typeof lesson_id === 'undefined'){
        url = '{{ action('LessonController@store') }}';
    }
    else{
        isNew =false;
        url = '{{ action('LessonController@update') }}';
    }

    $.ajax({

        type: 'post',
        url: url,
        data:{
            'id' :        lesson_id,
            'title':      $('#title').val(),
            'intro':      $('#intro').val(),
            'author_id':  1,
            'is_publish': is_publish
        },
        success: function(data){

            if(isNew && typeof data['id'] !== "undefined"){
                lesson_id = data['id'];
                $('#general').attr('data-lesson-id', lesson_id);
            }

            if(is_publish){

                $('#save_as_draft').hide();
                $('#publish')[0].innerText = "Save";
            }

            saveOutlines(lesson_id);
            saveTopics(lesson_id);
        },
        error: function(data){
            console.log(data);
        }
    });
}

function saveOutlines(lesson_id){

    var new_outlines = $('.outline-container .outline:not([data-outline-id])');
    var update_outlines = $('.outline-container .outline[data-outline-id]');
    var new_contents = getArrayOfObjFromOutlineContents(new_outlines);
    var update_contents = getArrayOfObjFromOutlineContents(update_outlines);

    $.ajax({

        type: 'post',
        url: '{{ action('OutlineController@doStoreUpdateDelete') }}',
        data: {
            new: new_contents,
            update: update_contents,
            delete: delete_outlines
        },
        success: function(data){

            if(data['success'] == true){

                // update new outlines id
                var new_outlines_id = data['new_outlines_id'];
                for(var i = 0; i < new_outlines_id.length; i++){
                    new_outlines.attr('data-outline-id', new_outlines_id[i]);
                }

                // remove the deleted outlines
                delete_outlines = [];
            }
            else{
                alert('There are errors!');
            }
        },
        error: function(data){
            console.log(data);
        }
    })
}*/

function getArrayOfObjFromOutlineContents(outline_elements){

    var contents = [];
    for(var i = 0; i < outline_elements.length; i++){

        contents.push(getObjFromOutlineContent(outline_elements.eq(i)));
    }

    return contents;
}

function getObjFromOutlineContent(outline_element){

    var outline_id = outline_element.attr('data-outline-id');
    var outline_name = outline_element.val();
    var index = parseInt(outline_element.attr('data-id')) - 1;
    var inner_html = $('#outline-content').find('.note-editor .note-editable')[index].innerHTML;

    return {
        id: outline_id,
        name: outline_name,
        content: inner_html
        //lesson_id: lesson_id
    };
}

/*function saveTopics(lesson_id){

    var new_topic_elements = $('#general .chosen-hints .chosen-hint:not([data-id])');
    var update_topic_elements = $('#general .chosen-hints .chosen-hint[data-id]');
    var new_topics = getArrayOfObjFromTopics(new_topic_elements);
    var update_topics = getArrayOfObjFromTopics(update_topic_elements);

    $.ajax({

        type: 'post',
        url: '{{ action('TopicController@doStoreUpdateDelete') }}',
        data:{
            new: new_topics,
            update: update_topics,
            delete: delete_topics,
            lesson_id: lesson_id
        },
        success: function(data){

            if(data['success'] == true){

              var new_topics_id = data['new_topics_id'];
              for(var i = 0; i < new_topics_id.length; i++){
                  new_topic_elements.attr('data-id', new_topics_id[i]);
              }

              // remove the deleted topics
              delete_topics = [];
            }
            else{
                alert('There are errors!');
            }
        },
        error: function(data){
            console.log(data);
        }
    });

}*/

function getArrayOfObjFromTopics(topic_elements){

    var topics = [];

    for(var i = 0; i < topic_elements.length; i++){
        topics.push(getObjFromTopic( topic_elements.eq(i) ));
    }

    return topics;
}

function getObjFromTopic(topic_element){

    var id = topic_element.attr('data-id');

    var name = topic_element[0].innerText;
    var close_name = topic_element.children('.close-chosen-hint')[0].innerText;
    var name = name.substr(0, name.length - close_name.length);

    return {
      id: id,
      name: name
    }
}

function getArrayOfObjFromMediaReferences(media_elements){

    var medias = [];

    for(var i = 0; i < media_elements.length; i++){

        var id = media_elements.eq(i).attr('data-id');
        if(typeof id !== "undefined"){
            medias.push( getObjFromMediaReference( media_elements.eq(i) ) );
        }
    }

    return medias;
}

function getObjFromMediaReference(media_element){

    var id = media_element.attr('data-id');

    return {
      media_id: id
    }
}

function ajaxFilterLessons(topic_data, lesson_id_data, urls, elements){

    $.ajax({

        type: 'get',
        url: urls['find_lessons_by_topics'],
        data:{
          topics: topic_data,
          lesson_ids: lesson_id_data
        },
        beforeSend: function(){

            showWaitingFilter(elements['filter_button'], elements['filter_clear_button']);
        },
        success: function(data){

            ajaxResetLessonsAfterFilter(data, urls, elements);
        },
        error: function(data){
            console.log(data);
        }
    });
}

// clear the current lessons and return all lessons in public status
function ajaxClearFilterLessons(is_filter_all, search_text, urls, elements){

    $.ajax({

        type: 'get',
        url: urls['all_lessons_in_public'],
        data:{
            is_all: is_filter_all,
            name: search_text
        },
        beforeSend: function(){

            showWaitingClearingFilter(elements['filter_button'], elements['filter_clear_button']);
        },
        success: function(data){

            ajaxResetLessonsAfterClearingFilter(data, urls, elements);
        },
        error: function(data){
            console.log(data);
        }
    });
}

function ajaxResetLessonsAfterFilter(lesson_objs, urls, elements){

    $.ajax({

        type: 'get',
        url: urls['default_media_types'],
        data: {},
        success: function(data){

            resetLessonElements(lesson_objs, data, urls, elements);
        },
        error: function(data){
            console.log(data);
        },
        complete: function(){

              showAfterCompleteFilter(elements['filter_button'], elements['filter_clear_button']);
        }
    });
}

function ajaxResetLessonsAfterClearingFilter(lesson_objs, urls, elements){

    $.ajax({

        type: 'get',
        url: urls['default_media_types'],
        data: {},
        success: function(data){

            resetLessonElements(lesson_objs, data, urls, elements);
        },
        error: function(data){
            console.log(data);
        },
        complete: function(){

              showAfterCompleteClearingFilter(elements['filter_button'], elements['filter_clear_button']);
        }
    });
}

function resetLessonElements(lesson_objs, default_media_types, urls, elements){

    var lesson_container = elements['lesson_container'];

    // remove the old
    lesson_container.empty();

    // get html from lesson objs
    var html = generateLessonsInResources(lesson_objs, default_media_types, urls['view_media_reference']);

    // append new lessons
    lesson_container.append(html);

}

function generateLessonsInResources(lesson_objs, default_media_types, media_viewing_process_url){

    var html = ``;

    for(var i = 0; i < lesson_objs.length; i++){

        html += generateLessonInResources(lesson_objs[i], default_media_types, media_viewing_process_url);
    }

    return html;
}

function generateLessonInResources(lesson_obj, default_media_types, media_viewing_process_url){

    // general info
    var id = lesson_obj['general']['id'];
    var title = lesson_obj['general']['title'];
    var no_of_love = lesson_obj['general']['no_of_love'];

    // topic info
    var topic_html = ``;

    for( var i = 0; i < lesson_obj['topics'].length; i++ ){
        topic_html += `<span>` + lesson_obj['topics'][i]['name']  +`</span>`;
    }

    // outline info
    var outline_html = ``;
    for( var i = 0; i < lesson_obj['outlines'].length; i++ ){

        outline_html += `<li><span class="index">Step ` + (i + 1) + ` -</span>` +
                            lesson_obj['outlines'][i]['name'] +
                        `</li>`;
    }

    // reference info
    var reference_html = ``;
    var media_process_url = media_viewing_process_url.substring(1, media_viewing_process_url.lastIndexOf(':'));

    for( var i = 0; i < default_media_types.length; i++ ){

        var type = default_media_types[i];

        for( var j = 0; j < lesson_obj['media'][type].length; j++ ){

            reference_html += `<li class="col-xs-12 col-sm-4 col-md-3">`;

            switch ( type ) {
              case 'Image':
                reference_html += `<span class="glyphicon glyphicon-picture"></span>`;
                break;
              case 'Video':
                reference_html += `<span class="glyphicon glyphicon-film"></span>`;
                break;
              case 'Document':
                reference_html += `<span class="glyphicon glyphicon-file"></span>`;
                break;
              default:
                reference_html += `<span class="glyphicon glyphicon-question-sign"></span>`;
            }

            var media = lesson_obj['media'][type][j];

            if( media['name'] == null ){

                reference_html += `<a target="_blank" href="` + media['url'] + `">` +
                                      media['origin_name'] +
                                  `</a>`;
            }
            else{

                reference_html += `<a target="_blank" href="` + media_process_url + media['name'] + `">` +
                                      media['origin_name'] +
                                  `</a>`;
            }

            reference_html += `</li>`;
        }
    }

    // like button
    var like_button;

    if( lesson_obj['favorite_lesson_ids'].indexOf(id) >= 0 ){

        like_button = `<button class="like-btn" type="button" name="" title="Remove this from my favourite lessons">
                          <span class="glyphicon glyphicon-heart"></span>
                       </button>`;
    }
    else{

        like_button = `<button class="like-btn" type="button" name="" title="Like if this is useful!">
                          <span class="glyphicon glyphicon-heart-empty"></span>
                       </button>`;
    }

    // combine all
    var html =
    `<div class="lesson" data-id="` + id + `">
          <div class="head">
            <div class="col-xs-12 col-sm-9">
              <h4 class="title"><a href="">` + title  + `</a></h4>
              <div class="topics">
                ` +
                topic_html +
                `
              </div>
            </div>
            <div class="col-xs-12 col-sm-3">
              <h4 class="likes">
                <span class="number">` + no_of_love + `</span>` +
                like_button +
              `</h4>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="content">
            <div>
              <p>Outlines</p>
              <ul class="outlines">` +
                  outline_html +
              `</ul>
            </div>
            <div>
              <p>References</p>
              <ul class="references">` +
                  reference_html +
              `</ul>
            </div>
          </div>
        </div>`;

      return html;
}

function showWaitingFilter(filter_button, filter_clear_button){

    filter_button.readOnly = true;
    filter_button[0].innerText = 'Filtering...';

    filter_clear_button.hide();
}

function showAfterCompleteFilter(filter_button, filter_clear_button){

    // set filter button
    filter_button.readOnly = false;
    filter_button[0].innerText = 'OK';

    // show button for clearing filter results
    filter_clear_button.show();
}

function showWaitingClearingFilter(filter_button, filter_clear_button){

    filter_button.hide();

    filter_clear_button.readOnly = true;
    filter_clear_button[0].innerText = 'Clearing...';
}

function showAfterCompleteClearingFilter(filter_button, filter_clear_button){

    filter_button.show();

    filter_clear_button.hide();
    filter_clear_button.readOnly = false;
    filter_clear_button[0].innerText = 'Clear';
}

function ajaxLoveLesson(lesson_id, user_id, process_url, elements){

    $.ajax({

        type: 'get',
        url: process_url,
        data: {
          lesson_id: lesson_id,
          user_id: user_id
        },
        success: function(data){

            if( data['result'] ){

              // change content and shape when starting to love
              elements['icon'].removeClass('glyphicon-heart-empty');
              elements['icon'].addClass('glyphicon-heart');
              elements['number'].innerText = parseInt( elements['number'].innerText ) + 1;
              elements['like-btn'].attr('title', 'Remove this from my favourite lessons');
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

function ajaxUnloveLesson(lesson_id, user_id, process_url, elements){

    $.ajax({

        type: 'get',
        url: process_url,
        data: {
          lesson_id: lesson_id,
          user_id: user_id
        },
        success: function(data){

            if( data['result'] ){

              // change content and shape when stopping to love
              elements['icon'].removeClass('glyphicon-heart');
              elements['icon'].addClass('glyphicon-heart-empty');
              elements['number'].innerText = parseInt( elements['number'].innerText ) - 1;
              elements['like-btn'].attr('title', 'Like if this is useful!');
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

function ajaxPartnerPost(data, process_url){

    $.ajax({

        type: 'post',
        url: process_url,
        data: data,
        success: function(data){

            window.location.href = data;
        },
        error: function(data){
            console.log(data);
        }
    });
}

function ajaxPartnerSearch(data, process_url){

}
