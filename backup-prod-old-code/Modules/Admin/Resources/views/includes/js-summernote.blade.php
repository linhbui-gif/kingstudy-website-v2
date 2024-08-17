<?php
$js_version = \App\Helpers\General::get_version_js();
?>
<script type="text/javascript" src="{{ asset("assets/plugins/summernote/summernote.js") }}?v=<?=$js_version?>"></script>
<link rel="stylesheet" href="{{ asset("assets/plugins/summernote/summernote.css") }}">
<script>
    $('.summernote').summernote({
        height: 150,
        tooltip: true,
        callbacks: {
            onImageUpload: function (files) {
                sendFile(files, '.summernote',$(this).attr("name"))
            }
        }
    });
    function sendFile(A, t = "#summernote", e) {
        let n = '',
            i = new FormData;
        $.each(A, function(A, t) { i.append("files[" + A + "]", t) }), $.ajax({
            url: n + "/summer-note-file-upload",
            type: "post",
            data: i,
            processData: !1,
            contentType: !1,
            dataType: "JSON",
            success: function(A) {
                let n;
                n = e ? $(t + "[name='" + e + "']") : $(t), $.each(A, function(A, t) { n.summernote("insertImage", t) })
            },
            error: function(A) {
                if (404 === A.status) return void alert("What you are looking is not found", "Opps!");
                if (500 === A.status) return void alert("Something went wrong. If you are seeing this message multiple times, please contact administrator.", "Opps");
                if (200 === A.status) return void alert("Something is not right", "Error");
                let t = $.parseJSON(A.responseText),
                    e = t.errors;
                if (e) {
                    let A = 0;
                    $.each(e, function(t, n) {
                        let i = Object.keys(e)[A],
                            s = $("#" + i);
                        s.length > 0 && s.parsley().addError("ajax", { message: n, updateClass: !0 }), toastr.error(n, "Validation Error"), A++
                    })
                } else alert(t.message, "Opps!")
            }
        })
    }
</script>
