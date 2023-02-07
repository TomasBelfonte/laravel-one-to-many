@extends('layouts.app')

@php
    $title = 'Modifica Project #' . $project->id;
@endphp

@section('title', $title)

@section('content')
        <div class="container">
        <div class="card">
        <div class="card-header">{{ $title }}</div>

        <div class="card-body">


        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf()
            @method('PUT')

            <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
            </div>

            <div class="mb-3">
            <label class="form-label">Contenuto</label>
            <textarea name="content" cols="30" rows="5" class="form-control @error('content') is-invalid @enderror">{{ old('content', $project->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
            </div>

            <div class="mb-3">
            <label class="form-label">Immagine di copertina</label>
            <input type="file" class="form-control @error('cover_img') is-invalid @enderror" name="cover_img">
            @error('cover_img')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror

            <img src="{{ asset('storage/' . $project->cover_img) }}" alt="" class="img-thumbnail">
            </div>

            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annulla</a>
            <button class="btn btn-primary">Salva</button>
        </form>

        </div>
    </div>
    </div>

@endsection
