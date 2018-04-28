@extends('admin/layouts/app')
@section('content') 

<link href="{{ asset('theme/uplon-admin/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<page>

    <pagetitlebox size='12' title="{{$var['title']}}"></pagetitlebox>

    <panel size="12">
      
        {{$var['html']}}

    </panel>
    
</page>

<!-- Modal-Effect -->
<script src="{{ asset('theme/uplon-admin/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ asset('theme/uplon-admin/plugins/custombox/js/legacy.min.js') }}"></script>

@endsection