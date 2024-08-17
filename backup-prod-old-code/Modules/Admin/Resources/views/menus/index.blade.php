@extends('admin::layouts.master')
<?php
use App\Helpers\Auth;

$user = Auth::getUserInfo();
$permissions = Auth::get_permissions($user);
?>
@section('content')
    <div class="form-group">
        {!! Menu::render() !!}
    </div>
@endsection
@section('after_styles')

@stop

@section('after_scripts')
    {!! Menu::scripts() !!}
    <style type="text/css">
        .bootstrap-select {
            margin: 0;
        }
    </style>
    <script type="text/javascript">
        $('#reset-page').click(function (){
            var url = window.location.href;
            window.location = url;
        });
        function queryParams(params) {
            params.keyword = $('#keyword').val();
            params.status = $('#status_filter').val();
            params.date_from = $('#date_from').val();
            params.date_to = $('#date_to').val();
            return params;
        }
        $(document).ready(function() {

            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            init_select2('.select2');
            init_datepicker(".datepicker");

        });

    </script>
@endsection
