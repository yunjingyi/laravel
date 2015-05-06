@extends('layouts.master')

@section('title')
编辑分类 @parent
@stop

@section('content')
<!-- Blog Post Content Column -->
<div class="col-lg-8">

    <!-- Blog Post -->
    <h1>编辑分类</h1>
    
    @include('partials.notifications')
    
    {{ Form::model($editing_category, ['route' => ['categories.update', $editing_category->id], 'method' => 'PATCH', 'class' => 'horizontal-form', 'role' => 'form']) }}
    
    <!-- Name -->
    <div class="form-group{{ $errors->first('name', ' has-error') }}">
        {{ Form::label('name', '分类名称：') }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '请输入文章标题', 'required']) }}
    </div>
    
    <!-- Buttons -->
    <div class="form-group text-right">
        <a href="{{ route('categories.index') }}" class="btn btn-link"> &#171; 返回</a>
        {{ Form::submit('更新', ['class' => 'btn btn-success']) }}
    </div>

    {{ Form::close() }}
    
</div>

@include('partials.sidebar')

@stop
