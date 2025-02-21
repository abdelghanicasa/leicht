@extends('frontend.layouts.app')

@php
    $categories = App\Models\Category::with('images')->get();
@endphp

@section('content')

    <!-- Use the ContentBlock component -->
    <x-frontend.content-block 
        :title="$page->title" 
        :content="$page->content" 
    />
    

    @if($page->text_block_title && !$page->text_block_content)
        <x-frontend.page-title :title="$page->text_block_title" />
    @else
        <x-frontend.content-block 
            :title="$page->text_block_title" 
            :content="$page->text_block_content" 
        />
    @endif 


    @if($page->images && count($page->images) > 0)
        <!-- If images are present, show the gallery -->
        <x-frontend.hp-gallery-grid :images="$images" :titles="$titles" />
    @endif

    <!-- @if($page->isGallery)
        <x-frontend.gallery-cuisines />
    @endif    -->
    <x-frontend.blocdevis/>

    @if($page->images)
        <x-image-gallery :images="$page->images" />
    @endif
@endsection
