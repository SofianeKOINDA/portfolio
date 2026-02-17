<div class="login login-v2" data-pageload-addclass="animated fadeIn">
				<!-- header -->
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> <b>Bienvenue</b> Sofiane
					<small>Prêt à changer le monde ?</small>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			<!-- formulaire-->
	<div class="login-content">
            <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf

                    <!-- Email -->
                <div class="form-group m-b-20">
                    <input type="email" name="email" :value="old('email')" required class="form-control form-control-lg inverse-mode" placeholder="Entrer votre email" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                    <!-- Password -->
                <div class="form-group m-b-20">
                    <input type="password" name="password" class="form-control form-control-lg inverse-mode" placeholder="Password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                    <!-- Remember Me & Mot de passe oublié -->
                <div class="checkbox checkbox-css m-b-20">
                    <input type="checkbox" id="remember_checkbox" />
                    <label for="remember_checkbox">Remember Me - </label>
                        @if (Route::has('password.request'))
                            <a class="underline text-white" href="{{ route('password.request') }}">Mot de passe oublié?</a> -
                        @endif
                        <a class="underline text-white" href="{{ route('vitrine') }}">Retour vers accueil </a>
                </div>

                    <!-- Soumission -->
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">Se connecter</button>
                </div>
            </form>
    </div>
</div>
