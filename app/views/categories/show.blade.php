@extends('layouts.master')

@section('title')
文章分类頁 @parent
@stop

@section('content')
<!-- Blog Entries Column -->
<div class="col-md-8">

    <h1 class="page-header">
        偽 Blog
        <small>文章分类頁</small>
    </h1>

    @if (Auth::check())
    <div class="text-right">
        <a class="btn btn-success" href="{{ route('posts.create') }}">新增文章</a>
    </div>
    @endif
    
    @foreach($posts as $post)
    <h2>
        <a href="{{ route('posts.show', $post->id) }}">{{{ $post->title }}}</a>
    </h2>
    <p class="text-right">
        <span>{{{ $post->category->name }}}</span>
        <span class="glyphicon glyphicon-time"></span> 发表于 {{{ $post->created_at->toDateTimeString() }}}
    </p>
    <hr>
    <p>{{{ $post->content }}}</p>
    
    <div class="text-right">
        <a class="btn btn-info" href="{{ route('posts.show', $post->id) }}">阅读全文</a>
        @if (Auth::check())
        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">编辑</a>
        {{ Form::open(['url' => 'posts/'.$post->id, 'method' => 'DELETE', 'style' => 'display: inline;', 'role' => 'form']) }}
        {{ Form::submit('刪除', ['class' => 'btn btn-danger btn-sm']) }}
        {{ Form::close() }}
        @endif
    </div>

    <hr>
    @endforeach

    <!-- Pager -->
    <div class="text-center">
        {{ $posts->links() }}
    </div>

</div>

@include('partials.sidebar')

@stop