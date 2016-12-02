@extends('layouts.app')
	@section('content')
		<section class="container col-md-12">      
      {!! Form::open(['route' => 'add', 'method' => 'post','id' => 'form']) !!}        
        <input type="hidden" id="token" value="{{ csrf_token() }}">
        <section class="header">
          <h2>Practice your operations!</h2>
        </section>
        
           
        <section class="controls">  
        	{!! Form::label('numberOne', 'First Number', ['class' => 'title-number']) !!}
        	{!! Form::text('numberOne',null, ['class' => 'form-control', 'placeholder' => 'Ej: one','id' => 'numberOne']) !!}

          {!! Form::label('numberTwo', 'Second Numer', ['class' => 'title-number']) !!}
          {!! Form::text('numberTwo',null, ['class' => 'form-control', 'placeholder' => 'Ej: two','id' => 'numberTwo']) !!}
          <section class="submitContainer">
            {!! Form::submit('Go',['class' => 'btn btn-success','id' => 'submit']) !!} 
          </section>
        	
        </section>                   
      {!! Form::close() !!}		
    </section>
    <section class="container col-md-12 header" id="resultContainer" hidden>
        <h2>Result:</h2>
        <spam class="col-md-12 controls" id="result" >   
        </spam> 
           
    </section>
	@endsection