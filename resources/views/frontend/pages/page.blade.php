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
    
    <x-frontend.video-bloc/>

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
        <x-frontend.hp-gallery-grid :pages="$page" :images="$images" :titles="$titles" />
    @endif

    <x-frontend.blocdevis/> 

    <x-frontend.instagram-bloc :items="$items" />


@endsection
