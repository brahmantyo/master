<?php

Form::macro('loginForm',function ($name, $url, $title = 'Login Form', $btnSubmit = 'Login') {
	$openForm = Form::open(['name'=>$name,'id'=>$name,'url'=>$url,'class'=>'form-horizontal']);
	$closeForm = Form::close();
	$submit = Form::submit($btnSubmit,['class'=>'btn btn-info']);
	$css = asset('/css/form.css');
	$username = '';

    $item = <<<HTML
	<link href="$css" rel="stylesheet" type="text/css" />

    $openForm
    	<fieldset class="col-md-12">
    		<legend>TITLE</legend>
    		$title
    		<div class="form-group">
    			$submit
    		</div>
    	</fieldset>
    $closeForm
HTML;

        return $item;
});

Form::macro('loginUsername',function(){
	$label = Form::label('name','Login Name',['class'=>'control-label required col-md-4']);
	$input = Form::text('name',old('name'),['placeholder'=>'Login Name','class'=>'form-control','required']);
	$errClass = $errors->has('name') ? 'has-error' : '';
	$errPHP = $errors->first('name', '<p class="help-block">:message</p>');

	$item = <<<HTML
	<div class="form-group $errClass required">
		$label
		<div class="col-md-8">
			$input
			$errPHP
		</div>
	</div>
HTML;
	return $item;
});