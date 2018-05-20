@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('departments')]) !!}
     <div class="form-group">
        {!! Form::label('name','Title') !!}
        {!! Form::text('title',old('title'),['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('description','Description') !!}
        {!! Form::textarea('description',old('description'),['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('fixed_salary','fixed_salary') !!}
        {!! Form::number('fixed_salary',0.0,['class'=>'form-control']) !!}
     </div>
     {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection