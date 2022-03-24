@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <blockquote>Book Details</blockquote>
            </div>
        </div>
        <div class="col-md-10">
            <div class="col-md-4">
                <div class="title">
                    <a href="{{ $book->url() }}"><h3>{{ $book->title }}</h3></a>
                    <div class="image">
                        <img src="{{ image_path().$book->image->image }}" alt="" width="250px; height:100px;">
                    </div>
                    <div class="author">
                        Author: {{ $book->author->author_name ?? ''}}
                    </div>
                    <div class="author">
                        Publisher: {{ $book->publisher->publisher_name ?? ''}}
                    </div>
                    <div class="author">
                        Category: {{ $book->category->category_name ?? ''}}
                    </div>
                    <div class="author">
                        Soft Copy: <a href="{{ route('download',$book->id) }}"> {{ $book->pdf->pdf ?? ''}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

