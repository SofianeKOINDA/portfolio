
	<!-- section head -->
    @include('sections.admin.head')


<body>
	<!-- section loader -->
    @include('sections.admin.loader')


	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

		<!-- section menu haut -->
        @include('sections.admin.menu-haut')


		<!-- section menu gauche -->
        @include('sections.admin.menu-gauche')
		<div class="sidebar-bg"></div>


		<!-- section base-content -->
        @include('sections.admin.base-content')



		<!-- section config-->
        @include('sections.admin.config')



		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>


    </div>

	<!-- ================== Section script ================== -->
         @include('sections.admin.script')
