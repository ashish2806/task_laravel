
<div id="alert"></div>
<meta name="_token" content="{{ csrf_token() }}"/>
{!! Form::text('id', null, array('placeholder' => 'id','id'=>'id','class' => 'd-none')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Title','id'=>'title','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2">
        <div class="form-group">
            <strong>Year:</strong>
            {!! Form::select('year', $years,null  ,array('class' => 'form-control' )) !!}
        </div>
    </div>
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
        </div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8">
        <div class="form-group">
            <strong>Image:</strong>
            <input type="file" name="image" id="image" class="form-control"/>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
    <img id="uploaded_image" src="#" alt="your image"  class="d-none" />
        
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Submit',array('class'=>'btn btn-primary'));  !!}
    </div>
</div>
