@extends('layouts.defaultLogin')
@section('content')  

    <div class="signinpanel">
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
				{{ Form::open(array('url' => url('user/login'), 'autocomplete' => 'off', 'class' =>'login-form', 'id' => 'submit_form')) }}            
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                    @if (!is_null(Session::get('status_error')))
                        <div class="alert alert-danger">
                            <a class="close" data-dismiss="alert" href="#">��</a>
                            <h4 class="alert-heading">Error!</h4>
                            @if (is_array(Session::get('status_error')))
                                <ul>
                                @foreach (Session::get('status_error') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            @else
                                {{ Session::get('status_error')}}
                            @endif
                        </div>
                    @endif
					<div class="form-group">
						<input type="text" class="form-control uname" placeholder="Email" name="email"/>
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<input type="password" class="form-control pword" placeholder="Password" name="password" />
						<span class="help-block"></span>
					</div>
                    <div class="ckbox ckbox-default remember">
                        <div class="col-md-6">
                            <input type="checkbox" value="1" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>               
                        <div class="col-md-6"><a href="request"><small>Forgot Password?</small></a></div>         
                    </div> 
                    <button class="btn btn-success btn-block">Sign In</button>
                    <div style="float:left;">Not a member?</div><div><a href="{{URL::route('user/signup')}}">Sign Up</a></div>
				{{ Form::close() }}
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->    
    </div><!-- signin -->
@endsection

@section('javaScript')
   <script>
        jQuery(document).ready(function(){
           // initiate layout and plugins
           FormValidation.init();        
        });

        var FormValidation = function () {

            var handleValidation1 = function() {
                // for more info visit the official plugin documentation: 
                var form1 = $('#submit_form');
                var error1 = $('.alert-danger', form1);
                //var success1 = $('.alert-success', form1);
                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "",
                    rules: {                    
                        email: {
                            required: true,
                            email: true
                        },      
                        password: {
                            required: true,
                        }, 								
                    },

                    invalidHandler: function (event, validator) { //display error alert on form submit              
                        //success1.hide();
                        error1.show();
                        App.scrollTo(error1, -200);
                    },

                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        label
                            .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },

                    submitHandler: function (form) {
                            error1.hide();
                            form.submit();
                    }
                });
            }
            return {
                //main function to initiate the module
                init: function () {
                    handleValidation1();
                }
            };
        }();    
    </script>
@endsection