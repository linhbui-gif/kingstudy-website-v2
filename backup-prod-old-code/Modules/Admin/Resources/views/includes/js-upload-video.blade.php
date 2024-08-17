<link rel="stylesheet" href="/assets/plugins/jQuery-File-Upload/css/jquery.fileupload.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/assets/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>

<script type="text/javascript">
	var uploadLoadVideo = function(event,obj) {
        var video = document.getElementById(obj);
        if(!video.src){
            video.innerText = event.target.files[0].name;
        }else{
            video.src = URL.createObjectURL(event.target.files[0]);
        }
    };

    var initUpload = function(obj){
    	var video_location 	= $(obj).data('location');
    	var error 			= $(obj).data('error');
    	var is_change 		= $(obj).data('is-change');
    	var object 			= $(obj).data('object');
        var progress        = $(obj).data('progress');
        if($(obj).data('url')){
            var url = $(obj).data('url');
        }else{
            var url = '<?=route('upload-video')?>';
        }
    	if(object){
    		url += '?object='+object;
    	}

        $(obj).fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                if($(error).length > 0){
                    $(error).html('').hide();
                }
                if(data['result']['error']){
                	if($(error).length > 0){
                		$(error).html(data['result']['error']).show();
                	}
                    $(video_location).val("");
                    return false;
                }
                $.each(data.result.files, function (index, file) {
                    $(video_location).val(file.name);
                    if($(is_change).length > 0){
                		$(is_change).val(1);
                	}
                });
            },
            progressall: function (e, data) {
                if(progress){
                    var x = parseInt(data.loaded / data.total * 100, 10);
                    $(progress).css(
                        'width',
                        x + '%'
                    );
                }
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    }

    var loadVideoMultiple = function(file, video_location, list, error, limit = 5) {
        var src = '{!! url('/') !!}' + '/'+file;
        var span = document.createElement('span');
       if($(`#${list}`).find('span').length < limit){
           span.innerHTML = [
               `
               <video width="200" height="150" controls>
                    <source src="${src}" type="video/*">
                    Your browser does not support the video tag.
                </video>
                <input type="hidden" name="${video_location}[]" value="${file}">

               `
           ].join('');
           span.className = 'video-output';
           span.addEventListener('click', function (e) {
               if (e.offsetX > span.offsetWidth-15) {
                   $(this).remove();
               }
               if($('#list-video span.video-output').length === 0) {
                   $('input[name="products_videos_is_change"]').val(0)
               }
           });
           document.getElementById(list).insertBefore(span, null);
       }else{
           $(error).html('Số video đã vượt quá giới hạn, chỉ có thể lưu ở mức tối đa!').show();
       }
    };

    var loadVideoMultipleFileName = function(file,video_location,list,file_name, error, limit = 5) {
        var src = '{!! url('/') !!}' + '/'+file;
        var span = document.createElement('span');
        if($(`#${list}`).find('span').length < limit){
            span.innerHTML = [
                `
               <video width="200" height="150" controls>
                    <source src="${src}" type="video/*">
                    Your browser does not support the video tag.
                </video>
                <input type="hidden" name="${video_location}[]" value="${file}">

               `
            ].join('');
            span.className = 'video-output';
            span.addEventListener('click', function (e) {
                if (e.offsetX > span.offsetWidth-15) {
                    $(this).remove();
                }
                if($('#list-video span.video-output').length === 0) {
                    $('input[name="products_videos_is_change"]').val(0)
                }
            });
            document.getElementById(list).insertBefore(span, null);
        }else{
            $(error).html('Số video đã vượt quá giới hạn, chỉ có thể lưu ở mức tối đa!').show();
        }
    };

    var initUploadMultipleVideo = function(obj,only_name=false){
        var video_location  = $(obj).data('location');
        var error           = $(obj).data('error');
        var is_change       = $(obj).data('is-change');
        var object          = $(obj).data('object');
        var progress        = $(obj).data('progress');
        var list            = $(obj).data('list');
        var limit            = $(obj).data('limit') ?? 10;
        var url = '<?=route('upload-video')?>';
        if(object){
            url += '?object='+object;
        }
        $(obj).fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                if($(error).length > 0){
                    $(error).html('').hide();
                }
                if(progress){
                    $(progress).css(
                        'width',
                        0 + '%'
                    );
                }
                if(data['result']['error']){
                    if($(error).length > 0){
                        $(error).html(data['result']['error']).show();
                    }
                    return false;
                }
                $.each(data.result.files, function (index, file) {
                    if(only_name){
                        loadVideoMultipleFileName(file.name,video_location,list,file.file_name,error,limit)
                    }else{
                        loadVideoMultiple(file.name,video_location,list,error,limit)
                    }

                    if($(is_change).length > 0){
                        $(is_change).val(1);
                    }
                });
            },
            progressall: function (e, data) {
                if(progress){
                    var x = parseInt(data.loaded / data.total * 100, 10);
                    $(progress).css(
                        'width',
                        x + '%'
                    );
                }

            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    }
</script>
