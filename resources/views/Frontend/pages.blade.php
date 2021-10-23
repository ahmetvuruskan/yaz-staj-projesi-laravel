@extends('Frontend.layout')
@section('title')
    {!! $page->page_head !!}
@endsection

@section('content')


    <div class="relative full-width">

        <div class="relative container-web">
            <h1> {!! $page->page_head !!}</h1>
            {!! $page->page_content !!}
        </div>
    </div>
@endsection
