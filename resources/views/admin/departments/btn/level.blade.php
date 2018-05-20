
<span class="label
{{ $level == 'user'?'label-info':'' }}
{{ $level == 'business'?'label-success':'' }}
">

{{ trans('admin.'.$level) }}
</span>