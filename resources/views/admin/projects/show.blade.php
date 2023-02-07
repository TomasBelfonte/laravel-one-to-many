@extends('layouts.app')

@php
    $title = 'Project #' . $project->id;
@endphp

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <img src="{{ asset('storage/' . $project->cover_img) }}" alt="" class="w-100">

    @if (session('status') === 'success')
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="card">

    @if ($project->cover_img)
        <img src="{{ $project->cover_img }}" alt="" class="card-img-top">
    @endif

    <div class="card-body">
        <div class="card-title">{{ $project->title }}</div>
        <div class="card-title">Autore: {{ $project->author }}</div>
        <p class="card-text">Contenuto: {{ $project->content }}</p>
        <div><strong>Stato:</strong> {{ $post->status }} </div>
    </div>
    </div>
@endsection

