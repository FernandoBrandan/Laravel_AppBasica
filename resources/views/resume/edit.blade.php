@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Editar cur</div>

        <div class="card-body">
          <form method="POST" action="{{ route('resume.update', $resume->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
            <!-- ************   -->
            <div class="form-group">
              <label for="title" class="col-md-4 col-form-label text-md-left">Titulo</label>
                <input id="title" 
                        type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        name="title" 
                        value="{{ old('title') ?? $resume->title}} " 
                        required 
                        autocomplete="title" 
                        autofocus>

                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div> 
            
            <!-- ************   -->
            <div class="form-group">
              <label for="name" class="col-md-4 col-form-label text-md-left">Nombre</label>
                <input id="name" 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ old('name') ?? $resume->user->name}}" 
                        required 
                        autocomplete="name" 
                        autofocus>

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div> 
            
            <!-- ************   -->
            <div class="form-group">
              <label for="email" class="col-md-4 col-form-label text-md-left">Email</label>
                <input id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') ?? $resume->email}}" 
                        required 
                        autocomplete="email" 
                        autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div> 
            
            <!-- ************   -->
            <div class="form-group">
              <label for="website" class="col-md-4 col-form-label text-md-left">Website</label>
                <input id="website" 
                        type="text" 
                        class="form-control @error('website') is-invalid @enderror" 
                        name="website" 
                        value="{{ old('website') ?? $resume->website}}"   
                        autocomplete="website" 
                        autofocus>

                @error('website')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div> 
            
            <!-- ************   -->
            <div class="form-group">
              <label for="picture" class="col-md-5 col-form-label text-md-left">Picture</label>
                <input id="picture" 
                        type="file" 
                        class="form-control @error('picture') is-invalid @enderror" 
                        name="picture" 
                        value="{{ old('picture') }}" 
                        autocomplete="picture" 
                        autofocus>

                @error('picture')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div> 
            
            <!-- ************   -->
            <div class="form-group">
              <label for="about" class="col-md-4 col-form-label text-md-left">Sobre mi</label>
                <textarea id="about" cols="10" rows="2 "
                        type="text" 
                        class="form-control @error('about') is-invalid @enderror" 
                        name="about" 
                        value="{{ old('about') ?? $resume->about}}"   
                        autocomplete="about" 
                        autofocus>
                </textarea>

                <example-component />
                
                @error('about')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div> 

            <div class="form-group row mb-0">
                <div class="col-md-10 offset-md-10">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
