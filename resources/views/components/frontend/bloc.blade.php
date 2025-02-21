@props(['title'])

@php
    $bloc = \App\Models\Bloc::where('title', $title)->first();
@endphp

@if($bloc)
    <div>
        <h3>{{ $bloc->title }}</h3>
        <p>{{ $bloc->text }}</p>

        @if($bloc->images)
            @foreach(json_decode($bloc->images) as $image)
                <img src="{{ asset('storage/' . $image) }}" width="100">
            @endforeach
        @endif

        @if($bloc->url)
            <a href="{{ $bloc->url }}" target="_blank">More Info</a>
        @endif
    </div>
@endif
