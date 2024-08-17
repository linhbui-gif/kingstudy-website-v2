<link rel="stylesheet" href="/assets/plugins/jQuery-File-Upload/css/jquery.fileupload.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/assets/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>

<script type="text/javascript">
	var uploadLoadFile = function(event,obj) {
        var image = document.getElementById(obj);
        if(!image.src){
            image.innerText = event.target.files[0].name;
        }else{
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    };

    var initUpload = function(obj){
    	var image_location 	= $(obj).data('location');
    	var error 			= $(obj).data('error');
    	var is_change 		= $(obj).data('is-change');
    	var object 			= $(obj).data('object');
        var progress        = $(obj).data('progress');
        if($(obj).data('url')){
            var url = $(obj).data('url');
        }else{
            var url = '<?=route('upload-temp')?>';
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
                    $(image_location).val("");
                    return false;
                }
                $.each(data.result.files, function (index, file) {
                    $(image_location).val(file.name);
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

    var loadFileMultiple = function(file, image_location, list, error, limit = 10) {
        var src = '/'+file;
        var span = document.createElement('span');
       if($(`#${list}`).find('span').length < limit){
           span.innerHTML = [
               '<img style="height: 80px; border: 1px solid #2bc5f8; margin: 7px" src="',
               src,
               '" title="',
               '"/>,<input type="hidden" name="',
               image_location
               ,'[]" value="',
               file,'">'
           ].join('');
           if(list === 'list') {
               span.className = 'image-output';
           } else {
               span.className = 'legal-output';
           }

           span.addEventListener('click', function (e) {
               if (e.offsetX > span.offsetWidth-15) {
                   $(this).remove();
                   if($('#list span.image-output').length === 0) {
                       $('input[name="products_images_is_change"]').val(0)
                   }
                   if($('#list2 span.legal-output').length === 0) {
                       $('input[name="products_images2_is_change"]').val(0)
                   }
               }
           });
           document.getElementById(list).insertBefore(span, null);
       }else{
           $(error).html('Số hình đã vượt quá giới hạn, chỉ có thể lưu ở mức tối đa!').show();
       }
    };

    var loadFileMultipleFileName = function(file,image_location,list,file_name, error, limit = 10) {
        var span = document.createElement('span');
        if($(`#${list}`).find('span').length < limit){
            span.innerHTML = [
                file_name,
                '<input type="hidden" name="',
                image_location
                ,'[]" value="',
                file,'">'
            ].join('');

            if(list === 'list') {
                span.className = 'image-output';
            } else {
                span.className = 'legal-output';
            }

            span.addEventListener('click', function (e) {
                if (e.offsetX > span.offsetWidth-15) {
                    $(this).remove();
                    if($('#list span.image-output').length === 0) {
                        $('input[name="products_images_is_change"]').val(0)
                    }
                    if($('#list2 span.legal-output').length === 0) {
                        $('input[name="products_images2_is_change"]').val(0)
                    }
                }
            });
            document.getElementById(list).insertBefore(span, null);
        }else{
            $(error).html('Số hình đã vượt quá giới hạn, chỉ có thể lưu ở mức tối đa!').show();
        }
    };

    var initUploadMultiple = function(obj,only_name=false){
        var image_location  = $(obj).data('location');
        var error           = $(obj).data('error');
        var is_change       = $(obj).data('is-change');
        var object          = $(obj).data('object');
        var progress        = $(obj).data('progress');
        var list            = $(obj).data('list');
        var limit            = $(obj).data('limit') ?? 10;
        var url = '<?=route('upload-temp')?>';
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
                        loadFileMultipleFileName(file.name,image_location,list,file.file_name,error,limit)
                    }else{
                        loadFileMultiple(file.name,image_location,list,error,limit)
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
