<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from responsiweb.com/themes/preview/ace/1.4/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Jun 2016 16:14:47 GMT -->
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - <?php echo $company_details['company_admin']; ?></title>
                
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css" />

		<!-- text fonts -->

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="./dist/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="./dist/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="./components/html5shiv/dist/html5shiv.min.js"></script>
		<script src="./components/respond/dest/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red"><?php echo $company_details['company_application']; ?></span>
									<span class="white" id="id-text2">Application</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; <?php echo $company_details['company_name']; ?></h4>
							</div>

							<div class="space-6"></div>
                                                        <input type="hidden" id ="baseUrl" value="<?php echo site_url(); ?>">
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>
                                                                                        
											<form name="form_login" id="form_login">
                                                                                            <div class = "error_show"></div>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control mandatory-field" placeholder="Username" id="username" name="username"/>
															<i class="ace-icon fa fa-user"></i>
                                                                                                                        <span class="help-inline">
                                                                                                                            <span class="middle input-text-error" id="username_errorlabel"></span>
                                                                                                                        </span>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control mandatory-field" placeholder="Password" id="password" name="password" />
															<i class="ace-icon fa fa-lock"></i>
                                                                                                                        <span class="help-inline">
                                                                                                                            <span class="middle input-text-error" id="password_errorlabel"></span>
                                                                                                                        </span>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110" >Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<!-- </div>

											<div class="space-6"></div>

											<div class="social-login center">
												<a class="btn btn-primary">
													<i class="ace-icon fa fa-facebook"></i>
												</a>

												<a class="btn btn-info">
													<i class="ace-icon fa fa-twitter"></i>
												</a>

												<a class="btn btn-danger">
													<i class="ace-icon fa fa-google-plus"></i>
												</a>
											</div> -->
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form id="reset_password" name="reset_password">
                                                                                            <div class = "error_show"></div>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control mandatory-field" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
                                                                                    
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form id = "register_user_login" name = "register_user_login">
                                                                                            <div class = "error_show"></div>
												<fieldset>
                                                                                                    
                                                                                                    <label class="block clearfix">
                                                                                                            <span class="block input-icon input-icon-right">
                                                                                                                    <input type="text" class="form-control mandatory-field" placeholder="Full Name" id="fullname" name="fullname"/>
                                                                                                                    <i class="ace-icon fa fa-user"></i>
                                                                                                                    <span class="help-inline">
                                                                                                                        <span class="middle input-text-error" id="fullname_errorlabel"></span>
                                                                                                                    </span> 
                                                                                                            </span>
                                                                                                    </label>
                                                                                                        
                                                                                                    <label class="block clearfix">
                                                                                                            <span class="block input-icon input-icon-right">
                                                                                                                    <input type="text" class="form-control mandatory-field" placeholder="Username" id="resusername" name="resusername"/>
                                                                                                                    <i class="ace-icon fa fa-user"></i>
                                                                                                                    <span class="help-inline">
                                                                                                                        <span class="middle input-text-error" id="resusername_errorlabel"></span>
                                                                                                                    </span> 
                                                                                                            </span>
                                                                                                    </label>

                                                                                                    <label class="block clearfix">
                                                                                                            <span class="block input-icon input-icon-right">
                                                                                                                    <input type="password" class="form-control mandatory-field" placeholder="Password" id="passward" name="passward"/>
                                                                                                                    <i class="ace-icon fa fa-lock"></i>
                                                                                                                    <span class="help-inline">
                                                                                                                        <span class="middle input-text-error" id="passward_errorlabel"></span>
                                                                                                                    </span> 
                                                                                                            </span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <label class="block clearfix">
                                                                                                            <span class="block input-icon input-icon-right">
                                                                                                                    <input type="password" class="form-control mandatory-field" placeholder="Repeat password" id="repeat_passward" name="repeat_passward"/>
                                                                                                                    <i class="ace-icon fa fa-retweet"></i>
                                                                                                                    <span class="help-inline">
                                                                                                                        <span class="middle input-text-error" id="repeat_passward_errorlabel"></span>
                                                                                                                    </span> 
                                                                                                            </span>
                                                                                                    </label>
                                                                                                        
                                                                                                    <label class="block clearfix">
                                                                                                            <span class="block input-icon input-icon-right">
                                                                                                                    <input type="email" class="form-control mandatory-field" placeholder="Email"  id="email_id" name="email_id"/>
                                                                                                                    <i class="ace-icon fa fa-envelope"></i>
                                                                                                                    <span class="help-inline">
                                                                                                                        <span class="middle input-text-error" id="email_id_errorlabel"></span>
                                                                                                                    </span> 
                                                                                                            </span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <label class="block clearfix">
                                                                                                            <span class="block input-icon input-icon-right">
                                                                                                                    <input type="mobile" class="form-control mandatory-field" placeholder="Mobile number" id="phone_number" name="phone_number"/>
                                                                                                                    <i class="ace-icon fa fa-phone"></i>
                                                                                                                    <span class="help-inline">
                                                                                                                        <span class="middle input-text-error" id="phone_number_errorlabel"></span>
                                                                                                                    </span> 
                                                                                                            </span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <div class="space-12"></div>

                                                                                                    <div class="clearfix">
                                                                                                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                                                                                                    <i class="ace-icon fa fa-refresh"></i>
                                                                                                                    <span class="bigger-110">Reset</span>
                                                                                                            </button>

                                                                                                            <button  type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                                                                                                    <span class="bigger-110">Register</span>

                                                                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                                                                            </button>
                                                                                                    </div>
                                                                                            </fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
                <script src="<?php echo base_url(); ?>js/custom.js"></script>
                <script src="<?php echo base_url(); ?>js/form-validation.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>components/_mod/jquery.mobile.custom/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	</body>

<!-- Mirrored from responsiweb.com/themes/preview/ace/1.4/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Jun 2016 16:14:47 GMT -->
</html>
