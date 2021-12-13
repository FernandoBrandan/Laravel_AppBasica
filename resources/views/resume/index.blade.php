@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
            {{ session('alert')['message'] }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <table class="table table-striped">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
        </thead>
        <tbody>
            @foreach ($resumes as $resume)
            <tr>
                <td>{{ $resume->id }}</td>
                <td>
                  <a href="{{ route('resume.show', $resume->id) }}">
                    {{ $resume->title }}
                  </a>  
                </td>
                <td>
                    <div class="d-flex justify-content-end">
                        <div>
                            <a href="{{ route('resume.edit', $resume->id) }}" class="btn btn-primary">
                                Editar
                            </a>
                        
                            <form method="POST" action="{{ route('resume.destroy', $resume->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Borrar
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
