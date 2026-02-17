<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">

				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="templates/templateAdmin/img/user/user-13.jpg" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>Sean Ngu
								<small>Front end developer</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
							<li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
						</ul>
					</li>
				</ul>

				<ul class="nav"><li class="nav-header">Navigation</li>

			             <!-- Mes Compétences -->
                    <li>
						<a href="{{route('competences.liste')}}">
                            <i class="fa fa-book"></i>
							<span>Mes Compétences</span>
						</a>
					</li>
                         <!-- Mes Formations -->
                    <li>
						 <a href="{{route('formations.liste')}}">
                            <i class="fa fa-chart-line"></i>
							<span>Mes Formations</span>
						</a>
					</li>
                         <!-- Mes projets -->
                    <li>
						<a href="{{route('projets.liste')}}">
                            <i class="fa fa-check-square"></i>
							<span>Mes projets</span>
						</a>
					</li>
                         <!-- Mes Entreprises -->
                    <li>
						<a href="{{route('entreprises.liste')}}">
                            <i class="fa fa-home"></i>
							<span>Mes Entreprises</span>
						</a>
					</li>
                         <!-- Catégories -->
                    <li>
						<a href="{{route('categories.liste')}}">
                            <i class="fa fa-server"></i>
							<span>Catégories</span>
						</a>
					</li>
                         <!-- Contact -->
                    <li>
						<a href="{{route('contacts.liste')}}">
                            <i class="fa fa-phone"></i>
							<span>Contact</span>
						</a>
					</li>
                         <!-- Déconnexion -->
                    <li class="mt-2">
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <a class="ml-3 text-gray" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <i class="fa fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </a>
                        </form>
                    </li>

					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				</ul>
			</div>
		</div>
