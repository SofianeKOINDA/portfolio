
	    <!-- section head -->
        @include("sections.auth.head")


<body class="pace-top">


	    <!-- section loader -->
        @include("sections.auth.loader")

        <!-- section background -->
        <div class="login-cover">
            <div class="login-cover-image" style="background-image: url(templates/templateAdmin/assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
            <div class="login-cover-bg"></div>
        </div>

        <!-- section container-->
        <div id="page-container" class="fade">

        <!-- section form -->
        @include("sections.auth.form")

		<!-- background -->
        @include("sections.auth.background")

		<!-- begin theme-panel -->
        @include("sections.auth.config")


		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

	</div>
	<!-- ================== JS ================== -->
        @include("sections.auth.script")
</body>
</html>
