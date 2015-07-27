<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-FA_ICON'></i>PAGE_TITLE</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
					<div class="row">
						<a href="">Pendaftaran Konsumen Baru</a>
						{!! Form::loginForm('coba','Ini percobaan macro') !!}
					</div>
					<div class="row">
						Login
						<style type="text/css">
							fieldset.panel > legend:nth-child(1) {
								width: auto; /* Or auto */
							    padding:0 10px; /* To give a bit of padding on the left and right */
							    border-bottom: none;
							    margin-bottom: 5px;
							}
						
							#items input {
								width:100%;
								padding:5px;
								border: none;
							}
							#items input:focus,
							#items input.focus {
							  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
							}
							#items select {
								width:100%;
								padding:5px;
								border: none;
							}
							#items select:focus,
							#items select.focus {
							  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
							}
						
							.form-group.required .control-label:after { 
							    color: #d00;
							    content: "*";
							    position: absolute;
							    margin-left: 8px;
							    top:7px;
							    font-family: 'FontAwesome';
								font-weight: normal;
								font-size: 10px;
								content: "\f069";
							}
						</style>
						{!! Form::open(['url'=>'/auth/login','class'=>'form-horizontal']) !!}
							<fieldset class="col-md-12">
								<legend>Login</legend>
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} required">
									{!! Form::label('name','Login Name',['class'=>'control-label required col-md-4']) !!}
									<div class="col-md-8">
										{!! Form::text('name',old('name'),['placeholder'=>'Login Name','class'=>'form-control','required']) !!}
										{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
									</div>
								</div>
								<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} required">
									{!! Form::label('password','Password',['class'=>'control-label required col-md-4']) !!}
									<div class="col-md-8">
										{!! Form::password('password',old('password'),['placeholder'=>'Password','class'=>'form-control','required']) !!}
										{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
									</div>
								</div>
								<div class="form-group">
									{!! Form::submit('Login',['class'=>'btn btn-info']) !!}
								</div>
							</fieldset>
						{!! Form::close() !!}
					</div>
            </div>
        </div>
    </div>
</div>