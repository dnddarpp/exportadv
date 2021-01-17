function upload(url, data, progress_cb, done_cb){
  if( !FormData ) return done_cb(null);

  var form = new FormData;
  var key;
  for(key in data)
    form.append(key, data[key]);

  var xhr = new XMLHttpRequest;

  xhr.onreadystatechange = function(){
    if( xhr.readyState===XMLHttpRequest.DONE ){
      xhr.onreadystatechange = new Function('');
      done_cb(xhr);
    }
  };

  if( xhr.upload )
    xhr.upload.onprogress = function(evt){
      if( evt.total > 0 )
        progress_cb(evt.loaded, evt.total);
    };

  xhr.open('POST', url);
  xhr.send(form);
  return xhr;
}

function res_handler(root, res){
  if( !res )
    return;
  if( typeof(res)==='string' )
    res = JSON.parse(res);
  if( res.msg )
    $(root).find('.msg').html(res.msg);
  if( res.act )
    (new Function(res.act))();
}

$(function(){
  $('.datepicker-input').datepicker({
    dateFormat: 'yy-mm-dd',
    monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    dayNamesMin: '日一二三四五六',
    yearSuffix: '年',
    showMonthAfterYear: true,
    changeMonth: true,
    changeYear: true
  });

  $('body').on('click', function(evt){
    var $target = $(evt.target);
    if( $target.data('method') === 'post' ){
      if( !$target.data('confirm') || confirm($target.data('confirm')) ){
        $.post($target.attr('href'), $target.data('param'), function(res){ res_handler(document, res) });
      }
      return false;
    }

    if( $target.get(0).classList.contains('delete_btn') ){
      var $parent_form = $target.closest('form');
      if( $parent_form.length && $parent_form.data('ajax') ){
        $parent_form.find('textarea.ckeditor').each(function(){
          $(this).val($(this).data('editor').getData());
        });
        var param = {};
        param[$target.attr('name')] = $target.val();
        $parent_form.find('[name]').each(function(elem){
          var $this = $(this);
          var ty = $this.attr('type');
          if( (ty!=='radio' && ty!=='checkbox' && this.nodeName!=='BUTTON') || $this.prop('checked') )
            param[$(this).attr('name')] = $(this).val();
        });
        $.ajax($parent_form.attr('action'), {
          method: $parent_form.attr('method'),
          data: param,
          dataType: 'json',
          success: function(res){ res_handler($parent_form, res) }
        });
        return false;
      }
    }

    if( $target.closest('.anchor').length ){
      var href = $target.closest('.anchor').find('a[href]').attr('href');
      if( href )
        window.location = href;
    }
  });

  $('#index_news').load('index_news');

  $('#index_calendar_selector').on('click', 'li>a', function(evt){
    $('#index_calendar_selector li').removeClass('evt-active');
    $(this).closest('li').addClass('evt-active');
    $.get(this.href, function(res){
      $('#index_calendar_content').html(res);
    }, 'text');
    return false;
  }).find('a:eq(0)').click();

  $('.meetingfloor').on('click', 'a', function(evt){
    $('.meetingfloor .meet_bluebg').addClass('meet_gray');
    $(this).find('.meet_bluebg').removeClass('meet_gray');
    $.get(this.href, function(res){
      $('#conference-room-container').html(res)
    });
    return false;
  }).find('a:eq(2)').click();

  var booking_room_calendar_data = {};
  function update_booking_room_calendar(){
    if( !$('.booking-room-calendar').length )
      return;

    var yy = $('.booking-calender .yy').html()|0;
    var mm = $('.booking-calender .mm').html()|0;
    if( booking_room_calendar_data.yy!=yy || booking_room_calendar_data.mm!=mm ){
      booking_room_calendar_data = {yy: yy, mm: mm};
      $('.booking-calender tr.calendate').remove();

      var date = new Date();
      date.setFullYear(yy);
      date.setMonth(mm-1);
      date.setDate(1);
      date.setHours(0);
      date.setMinutes(0);
      date.setSeconds(0);
      date.setMilliseconds(0);

      var btime = date.getTime() - date.getDay() * 86400000;
      if( mm==12 ){
        date.setFullYear(yy+1);
        date.setMonth(0);
      }
      else
        date.setMonth(mm);
      var etime = date.getTime() + (7-date.getDay())%7 * 86400000;

      var tr = null;
      for(var time=btime; time<etime; time+=86400000){
        if( (time-btime) % 604800000 == 0 ){
          if( tr )
            $('.booking-calender tbody').append(tr);
          tr = $('<tr class=calendate>');
        }
        date = new Date(time);
        if( date.getMonth()==mm-1 )
          tr.append('<td data-time=' + time/1000 + '>' + date.getDate());
        else
          tr.append('<td>&nbsp;');
      }
      $('.booking-calender tbody').append(tr);
    }

    $.each(booking_room_calendar_data, function(key){
      if( key!='mm' && key!='yy' && !$('input[value=' + key + ']').prop('checked') ){
        delete booking_room_calendar_data[key];
        $('.booking-calender .calendate td div[data-key=' + key + ']').remove()
      }
    });

    $('.room_set input:checked').each(function(){
      var name= $(this).attr('name').substr(1).toUpperCase();
      var key = $(this).val();
      if( key && !(key in booking_room_calendar_data) ){
        booking_room_calendar_data[key] = [];
        $.get('conference-room_item3_content.' + key + '.' + yy + '.' + mm, function(res){
          if( booking_room_calendar_data[key] ){
            booking_room_calendar_data[key] = res;
            var p = 0;
            $('.booking-calender .calendate td').each(function(){
              var $td = $(this);
              var time = $td.data('time');
              if( !time )
                return;

              var $elem;

              $.each({'上午': time+8*3600, '下午': time+13*3600, '晚上': time+18*3600}, function(seg_name, seg_time){
                if( p<res.length && res[p][1]<=seg_time )
                  ++p;
                $elem = $("<div data-key=" + key + " data-time=" + seg_time + ">" + name + " " + seg_name + "</div>");
                if( p<res.length && res[p][0]<=seg_time )
                  $elem.addClass('occupied');
                else
                  $elem.addClass('available');

                var $siblings = $td.children();
                for(var q=0; q<$siblings.length; ++q){
                  var t = $($siblings.get(q)).data('time');
                  var k = $($siblings.get(q)).data('key');
                  if( t>seg_time || t==seg_time && k>key ){
                    $($siblings.get(q)).before($elem);
                    $elem = null;
                  }
                }
                if( $elem )
                  $td.append($elem);
              });
            });
          }
        }, 'json');
      }
    });
  }

  $('.booking-calender .yy').html((new Date).getFullYear());
  $('.booking-calender .mm').html((new Date).getMonth()+1);
  $('.booking-calender')
    .on('click', '.bookmark', function(evt){
      $('.booking-calender .bookmark').removeClass('active');
      $(this).addClass('active');
      $.get('organizers_booking_calendar_content.' + $(this).data('f') + '.' + $('.booking-calender .yy').html() + '.' + $('.booking-calender .mm').html(), function(res){
        $('.calendate').remove();
        $('.booking-calender tbody').append(res);
      }, 'text');
    })
    .on('click', '.prev_mm_btn', function(evt){
      if( $('.booking-calender .mm').html() == '1' ){
        $('.booking-calender .yy').html($('.booking-calender .yy').html()-1);
        $('.booking-calender .mm').html(12);
      }
      else{
        $('.booking-calender .mm').html($('.booking-calender .mm').html()-1);
      }
      $('.booking-calender .bookmark.active').click();
      update_booking_room_calendar();
      return false;
    })
    .on('click', '.next_mm_btn', function(evt){
      if( $('.booking-calender .mm').html() == '12' ){
        $('.booking-calender .yy').html($('.booking-calender .yy').html()-0+1);
        $('.booking-calender .mm').html(1);
      }
      else{
        $('.booking-calender .mm').html($('.booking-calender .mm').html()-0+1);
      }
      $('.booking-calender .bookmark.active').click();
      update_booking_room_calendar();
      return false;
    })
    .on('click', '.prev_yy_btn', function(evt){
      $('.booking-calender .yy').html($('.booking-calender .yy').html()-1);
      $('.booking-calender .bookmark.active').click();
      update_booking_room_calendar();
      return false;
    })
    .on('click', '.next_yy_btn', function(evt){
      $('.booking-calender .yy').html($('.booking-calender .yy').html()-0+1);
      $('.booking-calender .bookmark.active').click();
      update_booking_room_calendar();
      return false;
    })
    .find('.bookmark:eq(0)').click();
  update_booking_room_calendar();

  $('.remove_cover').click(function(){
    $(this).parent().find('.cover_img').data('src', '').empty();
    $(this).parent().find('.remove_cover').css('display', 'none');
    $(this).parent().find('[name=cover]').val('');
    $(this).parent().find('.cover').val('');
    return false;
  });

  $('.cover').change(function(evt){
    if( FormData && evt.target.files.length ){
      var $parent_form = $(evt.target).closest('form');
      var id = $parent_form.find('[name=id]').val();
      $(evt.target).parent().find('.cover_upload_loaded').css('width', '0%');
      $(evt.target).parent().find('.cover_upload_total').css('display', 'block');
      upload(
        $(evt.target).data('url'), {id: id, file: evt.target.files[0]},
        function(loaded, total){
          $(evt.target).parent().find('.cover_upload_loaded').css('width', loaded/total*100 + '%');
        },
        function(xhr){
          $(evt.target).parent().find('.cover_upload_total').css('display', 'none');
          if( xhr.status==200 ){
            var res = JSON.parse(xhr.responseText);
            if( res.reason )
              alert(res.reason);
            else{
              if( res.id ){
                $parent_form.find('[name=id]').val(id = res.id);
                delete res.id;
              }
              if( $(evt.target).parent().find('.cover_img').length ){
                $(evt.target).parent().find('.cover_img').data('src', res.default + '#' + Math.random()).data('w', 0);
                load_adaptive_image();
                $parent_form.find('[name=cover]').val(res.default);
                $(evt.target).parent().find('.remove_cover').css('display', '');
              }
              else
                location.reload();
            }
          }
          else if( xhr.status==413 ){
            evt.target.value = '';
            alert('檔案太大了');
          }
          else{
            evt.target.value = '';
            alert(xhr.statusText);
          }
        }
      );
    }
  });

  window.load_adaptive_image = function(){
    $('.adaptive-image').each(function(){
      var figure = this;
      console.warn(this);
      function load(){
        if( $(figure).data('loading') )
          $(figure).data('loading', 2);
        else{
          $(figure).data('loading', 1);
          var W = $(figure).data('w') || 0;
          var w = Math.ceil($(figure).width());
          if( w > W ){
            var img = new Image;
            img.onload = function(){
              $(figure).find('img').remove();
              $(figure).prepend(img);
              if( $(figure).data('loading') > 1 )
                load();
              else
                $(figure).data('loading', 0);
            };
            img.onerror = function(){
              if( $(figure).data('loading') > 1 )
                load();
              else
                $(figure).data('loading', 0);
            };
            $(figure).data('w', W = w);
            var h = Math.ceil(w * $(figure).data('ratio'));
            if( h ){
              var minheight = $(figure).data('minheight');
              if( minheight && minheight > h )
                h = minheight;
              if( $(figure).data('cover') )
                img.src = $(figure).data('src') + '?w=' + w + '&h=' + h + '&cover';
              else
                img.src = $(figure).data('src') + '?w=' + w + '&h=' + h;
            }
            else
              img.src = $(figure).data('src') + '?w=' + w;
          }
          else
            $(figure).data('loading', 0);
        }
      }

      load();
    });
  }
  $(window).resize(load_adaptive_image);
  load_adaptive_image();

  $('textarea.ckeditor').each(function(){
    var textarea = this;
    var $textarea = $(this);
    var $parent_form = $textarea.closest('form');
    var id = $parent_form.find('[name=id]').val();
    var config = undefined;
    //console.warn(ClassicEditor.builtinPlugins.map(plugin => plugin.pluginName));
    if( !$(this).data('upload') )
      config = {removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload']};
    ClassicEditor
      .create(textarea, config)
      .then(function(editor){
        $textarea.data('editor', editor);
        var upload_url;
        if( FormData && (upload_url = $textarea.data('upload')) ){
          editor.plugins.get('FileRepository').createUploadAdapter = function(loader){
            var xhr;
            return {
              upload: function(){
                var defer = $.Deferred();
                xhr = upload(
                  upload_url, {id: id, file: loader.file},
                  function(loaded, total){
                    loader.uploadTotal = total;
                    loader.uploaded = loaded;
                  },
                  function(xhr){
                    if( xhr.status==200 ){
                      var res = JSON.parse(xhr.responseText);
                      if( res.reason )
                        defer.rejectWith(null, [res.reason]);
                      else{
                        if( res.id ){
                          $parent_form.find('[name=id]').val(id = res.id);
                          delete res.id;
                        }
                        defer.resolveWith(null, [res]);
                      }
                    }
                    else if( xhr.status==413 )
                      defer.rejectWith(null, ['檔案太大了']);
                    else
                      defer.rejectWith(null, [xhr.statusText]);
                  }
                );
                return defer.promise();
              },

              abort: function(){
                if( xhr )
                  xhr.abort();
              }
            };
          };
        }
      });
  });

  $('.room_set input').click(function(ev){
    $cntr = $(ev.target).closest('.room_set');
    var name = $(ev.target).attr('name');
    if( name === 'r401' )
      $cntr.find('[name^=r401]').prop('checked', $(ev.target).prop('checked'));
    if( name === 'r701' )
      $cntr.find('[name^=r701]').prop('checked', $(ev.target).prop('checked'));
    if( name === 'r702' )
      $cntr.find('[name^=r702]').prop('checked', $(ev.target).prop('checked'));
    if( name === 'r703' )
      $cntr.find('[name^=r703]').prop('checked', $(ev.target).prop('checked'));

    $cntr.find('[name=r401],[name=r701],[name=r702],[name=r703]').prop('checked', true);
    $cntr.find('input').each(function(){
      if( $(this).attr('name').match(/r401./) && !$(this).prop('checked') )
        $cntr.find('[name=r401]').prop('checked', false);
      if( $(this).attr('name').match(/r701./) && !$(this).prop('checked') )
        $cntr.find('[name=r701]').prop('checked', false);
      if( $(this).attr('name').match(/r702./) && !$(this).prop('checked') )
        $cntr.find('[name=r702]').prop('checked', false);
      if( $(this).attr('name').match(/r703./) && !$(this).prop('checked') )
        $cntr.find('[name=r703]').prop('checked', false);
    });

    update_booking_room_calendar();
  });

  $('#update_date').load('update_date.txt');
});
