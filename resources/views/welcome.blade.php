@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <blockquote>Book List</blockquote>
                @php 
                    $book = json_encode($books);
                    $book = json_decode($book);
                @endphp
                <p>Total Books: {{ $book->total }}</p>
            </div>
        </div>
        <div class="col-md-10">
            <input type="text" id="search" name="search" placeholder="Search here.." class="form-control">
            <div id="list"></div>
            @forelse ($books as $item)
            <div class="col-md-4">
                <div class="title">
                    <a href="{{ $item->url() }}"><h3>{{ $item->title }}</h3></a>
                    <div class="image">
                        <img src="{{ image_path().$item->image->image }}" alt="" width="250px; height:100px;">
                    </div>
                    <div class="author">
                        Author: {{ $item->author->author_name ?? ''}}
                    </div>
                </div>
            </div>
            @empty
                <p>No books found</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ url('search') }}";
    $('#search').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                data ? $('#list').html(data.output) : $('#list').html('');
            });
        }
    });
</script> 
@endpush
