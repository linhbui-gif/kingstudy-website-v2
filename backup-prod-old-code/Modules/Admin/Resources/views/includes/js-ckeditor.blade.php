<?php
$js_version = \App\Helpers\General::get_version_js();
?>
<script type="text/javascript" src="{{url('/assets/plugins/ckeditor/ckeditor.js')}}?v=<?=$js_version?>"></script>
<script type="text/javascript" src="{{url('/assets/plugins/ckfinder/ckfinder.js')}}?v=<?=$js_version?>"></script>
<script type="text/javascript" src="{{url('/assets/plugins/ckeditor/adapters/jquery.js')}}?v=<?=$js_version?>"></script>
<script type="text/javascript" src="{{url('/assets/plugins/ckeditor/config.js')}}?v=<?=$js_version?>"></script>

<link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css')}}" rel="stylesheet">
<script type="text/javascript" src="{{url('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js')}}?v=<?=$js_version?>"></script>
