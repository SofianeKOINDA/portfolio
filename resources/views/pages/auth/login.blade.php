<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== Section STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="templates/templateAdmin/assets/css/default/app.min.css" rel="stylesheet" />

</head>
<body class="pace-top">


	<!-- section loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>

	<!-- section background -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>

	<!-- section container-->
	<div id="page-container" class="fade">
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
				<!-- header -->
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> <b>Color</b> Admin
					<small>responsive bootstrap 4 admin template</small>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>


			<!-- formulaire-->
			<div class="login-content">
				<x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('login') }}">
                    @csrf

                        <!-- Email -->
					<div class="form-group m-b-20">
						<input type="text" name= "email" class="form-control form-control-lg"  :value="old('email')" placeholder="Email Address" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

					</div>

                        <!-- password -->
					<div class="form-group m-b-20">
						<input type="password" name="password" class="form-control form-control-lg" :value="old('password')" placeholder="Password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

					</div>


					<div class="checkbox checkbox-css m-b-20">
						<input type="checkbox" id="remember_checkbox" />
						<label for="remember_checkbox">
							Remember Me
						</label>
					</div>

                     @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif

					<div class="login-buttons">
						<button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
					</div>


					<div class="m-t-20">
						Not a member yet? Click <a href="javascript:;">here</a> to register.
					</div>


				</form>
			</div>
		</div>

		<!-- background -->
		<ul class="login-bg-list clearfix">
			<li class="active"><a href="javascript:;" data-click="change-bg" data-img="templates/templateAdmin/assets/img/login-bg/login-bg-17.jpg" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-17.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="templates/templateAdmin/assets/img/login-bg/login-bg-16.jpg" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-16.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="templates/templateAdmin/assets/img/login-bg/login-bg-15.jpg" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-15.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="templates/templateAdmin/assets/img/login-bg/login-bg-14.jpg" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-14.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="templates/templateAdmin/assets/img/login-bg/login-bg-13.jpg" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-13.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="templates/templateAdmin/assets/img/login-bg/login-bg-12.jpg" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-12.jpg)"></a></li>
		</ul>

		<!-- begin theme-panel -->
		<div class="theme-panel theme-panel-lg">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content">
				<h5>App Settings</h5><ul class="theme-list clearfix">
					<li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="templates/templateAdmin/assets/css/default/theme/red.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-pink" data-theme="pink" data-theme-file="templates/templateAdmin/assets/css/default/theme/pink.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pink">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="templates/templateAdmin/assets/css/default/theme/orange.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-yellow" data-theme="yellow" data-theme-file="templates/templateAdmin/assets/css/default/theme/yellow.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Yellow">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-lime" data-theme="lime" data-theme-file="templates/templateAdmin/assets/css/default/theme/lime.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Lime">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-green" data-theme="green" data-theme-file="templates/templateAdmin/assets/css/default/theme/green.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
					<li class="active"><a href="javascript:;" class="bg-teal" data-theme="default" data-theme-file="" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-aqua" data-theme="aqua" data-theme-file="templates/templateAdmin/assets/css/default/theme/aqua.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Aqua">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="templates/templateAdmin/assets/css/default/theme/blue.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="templates/templateAdmin/assets/css/default/theme/purple.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-indigo" data-theme="indigo" data-theme-file="templates/templateAdmin/assets/css/default/theme/indigo.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Indigo">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="templates/templateAdmin/assets/css/default/theme/black.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
				</ul>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Header Fixed</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="header-fixed" id="headerFixed" value="1" checked />
							<label class="custom-control-label" for="headerFixed">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Header Inverse</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="header-inverse" id="headerInverse" value="1" />
							<label class="custom-control-label" for="headerInverse">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Sidebar Fixed</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="sidebar-fixed" id="sidebarFixed" value="1" checked />
							<label class="custom-control-label" for="sidebarFixed">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Sidebar Grid</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="sidebar-grid" id="sidebarGrid" value="1" />
							<label class="custom-control-label" for="sidebarGrid">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar Gradient</div>
					<div class="col-md-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="sidebar-gradient" id="sidebarGradient" value="1" />
							<label class="custom-control-label" for="sidebarGradient">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="divider"></div>
				<h5>Admin Design (5)</h5>
				<div class="theme-version">
					<a href="../template_html/index_v2.html" class="active">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/default.jpg);"></span>
					</a>
					<a href="../template_transparent/index_v2.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/transparent.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../template_apple/index_v2.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/apple.jpg);"></span>
					</a>
					<a href="../template_material/index_v2.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/material.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../template_facebook/index_v2.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/facebook.jpg);"></span>
					</a>
					<a href="../template_google/index_v2.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/google.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>
				<h5>Language Version (7)</h5>
				<div class="theme-version">
					<a href="../template_html/index.html" class="active">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/html.jpg);"></span>
					</a>
					<a href="../template_ajax/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/ajax.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../template_angularjs/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/angular1x.jpg);"></span>
					</a>
					<a href="../template_angularjs10/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/angular10x.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="javascript:alert('Laravel Version only available in downloaded version.');">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/laravel.jpg);"></span>
					</a>
					<a href="../template_vuejs/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/vuejs.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../template_reactjs/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/reactjs.jpg);"></span>
					</a>
					<a href="javascript:alert('.NET Core 3.1 MVC Version only available in downloaded version.');">
						<span style="background-image: url(templates/templateAdmin/assets/img/version/dotnet.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>
				<h5>Frontend Design (4)</h5>
				<div class="theme-version">
					<a href="../../../frontend/template/template_one_page_parallax/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/one-page-parallax.jpg);"></span>
					</a>
					<a href="../../../frontend/template/template_e_commerce/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/e-commerce.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../../../frontend/template/template_blog/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/blog.jpg);"></span>
					</a>
					<a href="../../../frontend/template/template_forum/index.html">
						<span style="background-image: url(templates/templateAdmin/assets/img/theme/forum.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-md-12">
						<a href="https://seantheme.com/color-admin/documentation/" class="btn btn-inverse btn-block btn-rounded" target="_blank"><b>Documentation</b></a>
						<a href="javascript:;" class="btn btn-default btn-block btn-rounded" data-click="reset-local-storage"><b>Reset Local Storage</b></a>
					</div>
				</div>
			</div>
		</div>


		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="templates/templateAdmin/assets/js/app.min.js"></script>
	<script src="templates/templateAdmin/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="templates/templateAdmin/assets/js/demo/login-v2.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
</body>
</html>
