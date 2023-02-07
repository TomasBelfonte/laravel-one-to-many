@extends('layouts.app')

@section('title', 'Lista Projects')

@section('content')
    <div class="container">
        <div class="nav justify-content-center">
        <div class="nav-link">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-link">Aggiungi</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Lista Projects</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cover_img</th>
                            <th>User_Id</th>
                            <th>Autore</th>
                            <th>Titolo</th>
                            <th>Contenuto</th>
                            <th>Stato</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><img src="{{ $project->cover_img }}" alt="" style="width: 60px"></td>
                                <td>{{ $project->user_id }}</td>
                                <td>{{ $project->author }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->content }}</td>
                                <td>{{ $project->status }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary"><i
                                        class="fas fa-pencil"></i>E</a>
                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info"><i
                                        class="fas fa-eye"></i>S</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
