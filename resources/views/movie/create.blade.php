@extends('layout.main')
@section('content')
<!-- Main content -->
  <section class="content">
      <div class="container">
          {!! Form::open(array('id'=>'movie','route'=>'create','method'=>'POST','files'=>true)) !!}
          @include('movie.form')
          {!! Form::close() !!}
          @include('movie.movielist')
      </div>
  </section>
  
@endsection
@section('customjs')  
<script src="{{asset('/js/movie.js')}}"></script>

@endsection        