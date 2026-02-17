<!-- Section Head -->
@include("sections.admin.head")
<body>
	<!-- Section Loader -->
	@include("sections.admin.loader")
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- Section Menu Haut -->
		@include("sections.admin.menu-haut")

		<!-- Section Menu Gauche -->
        @include("sections.admin.menu-gauche")

		<!-- Section Content -->
        <div id="content" class="content">

			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;" onclick="openAddModal()">Ajout</a></li>
			</ol>

			<h1 class="page-header">Gestion des Entreprises</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des entreprises</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-hover table-td-valign-middle">
						<thead class="bg-dark text-white">
							<tr>
								<th width="1%" class="text-center">#</th>
								<th class="text-nowrap">Nom</th>
								<th class="text-nowrap text-center">Type</th>
								<th class="text-nowrap">Adresse</th>
								<th class="text-nowrap text-center">Téléphones</th>
								<th class="text-nowrap text-center">Site</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Associations</th>
								<th width="1%" data-orderable="false" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($entreprises as $entreprise)
                                <tr class="odd gradeX hover-highlight">
                                    <td width="1%" class="f-w-600 text-inverse text-center">{{ $loop->iteration }}</td>

                                    <td class="font-weight-bold">{{ $entreprise->nom }}</td>

                                    <td class="text-center">
                                        <span class="badge badge-{{ $entreprise->type == 'Entreprise' ? 'primary' : ($entreprise->type == 'Ecole' ? 'info' : 'success') }} badge-pill">
                                            {{ $entreprise->type }}
                                        </span>
                                    </td>

                                    <td>{{ Str::limit($entreprise->adresse, 40) ?? 'Non renseigné' }}</td>

                                    <td class="text-center text-muted">
                                        {{ $entreprise->tel1 }}@if($entreprise->tel2) <br>{{ $entreprise->tel2 }}@endif
                                    </td>

                                    <td class="text-center">
                                        @if($entreprise->site)
                                            <a href="{{ $entreprise->site }}" target="_blank" class="text-primary">{{ Str::limit($entreprise->site, 25) }}</a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($entreprise->email)
                                            <a href="mailto:{{ $entreprise->email }}">{{ Str::limit($entreprise->email, 25) }}</a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill">
                                            <i class="fa fa-layer-group"></i> {{ $entreprise->experiences_count + $entreprise->formations_count }}
                                        </span>
                                    </td>

                                    <td width="1%" class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-warning" title="Modifier"
                                                onclick="openEditModal({{ $entreprise->id }})"
                                                data-nom="{{ $entreprise->nom }}"
                                                data-type="{{ $entreprise->type }}"
                                                data-adresse="{{ $entreprise->adresse }}"
                                                data-tel1="{{ $entreprise->tel1 }}"
                                                data-tel2="{{ $entreprise->tel2 }}"
                                                data-site="{{ $entreprise->site }}"
                                                data-email="{{ $entreprise->email }}"
                                                data-etat="{{ $entreprise->etat }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            @if($entreprise->etat == 'Actif')
                                                <button type="button" class="btn btn-xs btn-danger" title="Désactiver" onclick="confirmDeactivate({{ $entreprise->id }}, '{{ $entreprise->nom }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-xs btn-success" title="Activer" onclick="confirmActivate({{ $entreprise->id }}, '{{ $entreprise->nom }}')">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Section Config -->
        @include("sections.admin.config")

		<!-- Section scroll to top  -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<!-- Modal d'édition -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white" id="editModalLabel">
						<i class="fa fa-edit"></i> Modifier l'entreprise
					</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="editForm" method="POST">
					@csrf
					@method('PUT')
					<div class="modal-body bg-white">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_nom" class="form-label text-dark">
										<i class="fa fa-building text-primary"></i> Nom *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white">
												<i class="fa fa-building"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="edit_nom" name="nom" placeholder="Nom de l'entreprise" required>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_type" class="form-label text-dark">
										<i class="fa fa-tags text-info"></i> Type *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-info text-white">
												<i class="fa fa-tags"></i>
											</span>
										</div>
										<select class="form-control" id="edit_type" name="type" required>
											<option value="">Sélectionnez le type</option>
											<option value="Entreprise">Entreprise</option>
											<option value="Ecole">Ecole</option>
											<option value="Client">Client</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_adresse" class="form-label text-dark">
										<i class="fa fa-map-marker-alt text-warning"></i> Adresse
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-warning text-white">
												<i class="fa fa-map-marker-alt"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="edit_adresse" name="adresse" placeholder="Adresse complète">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_tel1" class="form-label text-dark">
										<i class="fa fa-phone text-success"></i> Téléphone principal
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-success text-white">
												<i class="fa fa-phone"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="edit_tel1" name="tel1" placeholder="Téléphone">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_tel2" class="form-label text-dark">
										<i class="fa fa-phone text-secondary"></i> Téléphone secondaire
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-secondary text-white">
												<i class="fa fa-phone"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="edit_tel2" name="tel2" placeholder="Téléphone secondaire">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_site" class="form-label text-dark">
										<i class="fa fa-globe text-info"></i> Site web
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-info text-white">
												<i class="fa fa-globe"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="edit_site" name="site" placeholder="https://...">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_email" class="form-label text-dark">
										<i class="fa fa-envelope text-danger"></i> Email
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-danger text-white">
												<i class="fa fa-envelope"></i>
											</span>
										</div>
										<input type="email" class="form-control" id="edit_email" name="email" placeholder="contact@exemple.com">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_etat" class="form-label text-dark">
										<i class="fa fa-toggle-on text-primary"></i> État *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white">
												<i class="fa fa-toggle-on"></i>
											</span>
										</div>
										<select class="form-control" id="edit_etat" name="etat" required>
											<option value="">Sélectionnez l'état</option>
											<option value="Actif">Actif</option>
											<option value="Inactif">Inactif</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-dark border-secondary">
						<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">
							<i class="fa fa-times-circle"></i> Annuler
						</button>
						<button type="button" class="btn btn-success btn-lg" onclick="confirmEdit()">
							<i class="fa fa-save"></i> Enregistrer les modifications
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal d'ajout -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white" id="addModalLabel">
						<i class="fa fa-plus"></i> Ajouter une nouvelle entreprise
					</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="addForm" method="POST" action="{{ route('entreprises.store') }}">
					@csrf
					<div class="modal-body bg-white">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="add_nom" class="form-label text-dark">
										<i class="fa fa-building text-primary"></i> Nom *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white">
												<i class="fa fa-building"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="add_nom" name="nom" placeholder="Nom de l'entreprise" required>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="add_type" class="form-label text-dark">
										<i class="fa fa-tags text-info"></i> Type *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-info text-white">
												<i class="fa fa-tags"></i>
											</span>
										</div>
										<select class="form-control" id="add_type" name="type" required>
											<option value="">Sélectionnez le type</option>
											<option value="Entreprise">Entreprise</option>
											<option value="Ecole">Ecole</option>
											<option value="Client">Client</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="add_adresse" class="form-label text-dark">
										<i class="fa fa-map-marker-alt text-warning"></i> Adresse
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-warning text-white">
												<i class="fa fa-map-marker-alt"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="add_adresse" name="adresse" placeholder="Adresse complète">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="add_tel1" class="form-label text-dark">
										<i class="fa fa-phone text-success"></i> Téléphone principal
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-success text-white">
												<i class="fa fa-phone"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="add_tel1" name="tel1" placeholder="Téléphone">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="add_tel2" class="form-label text-dark">
										<i class="fa fa-phone text-secondary"></i> Téléphone secondaire
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-secondary text-white">
												<i class="fa fa-phone"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="add_tel2" name="tel2" placeholder="Téléphone secondaire">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="add_site" class="form-label text-dark">
										<i class="fa fa-globe text-info"></i> Site web
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-info text-white">
												<i class="fa fa-globe"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="add_site" name="site" placeholder="https://...">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="add_email" class="form-label text-dark">
										<i class="fa fa-envelope text-danger"></i> Email
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-danger text-white">
												<i class="fa fa-envelope"></i>
											</span>
										</div>
										<input type="email" class="form-control" id="add_email" name="email" placeholder="contact@exemple.com">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="add_etat" class="form-label text-dark">
										<i class="fa fa-toggle-on text-primary"></i> État *
									</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white">
												<i class="fa fa-toggle-on"></i>
											</span>
										</div>
										<select class="form-control" id="add_etat" name="etat" required>
											<option value="">Sélectionnez l'état</option>
											<option value="Actif">Actif</option>
											<option value="Inactif">Inactif</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-dark border-secondary">
						<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">
							<i class="fa fa-times-circle"></i> Annuler
						</button>
						<button type="submit" class="btn btn-success btn-lg">
							<i class="fa fa-plus"></i> Ajouter l'entreprise
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Section Script -->
    @include("sections.admin.script")

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		/* Améliorations du design du tableau */
		.table-hover tbody tr:hover {
			background-color: #f8f9fa !important;
			transform: scale(1.01);
			transition: all 0.2s ease;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
		}

		.badge-pill {
			border-radius: 50rem;
			padding: 0.5em 1em;
		}

		.table thead th {
			border-bottom: 2px solid #dee2e6;
			font-weight: 600;
			text-align: center;
			font-size: 0.9rem;
			letter-spacing: 0.3px;
		}

		.table tbody td {
			vertical-align: middle;
			padding: 1rem 0.75rem;
		}

		.btn-group .btn {
			margin: 0 2px;
			border-radius: 4px;
		}

		.text-muted {
			color: #6c757d !important;
		}

		.font-weight-bold {
			font-weight: 600 !important;
		}

		/* Animation pour les badges */
		.badge {
			transition: all 0.3s ease;
		}

		.badge:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
		}

		/* Améliorations du modal */
		.modal-content {
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.3);
		}

		.modal-header {
			border-radius: 15px 15px 0 0;
		}

		.modal-footer {
			border-radius: 0 0 15px 15px;
		}

		.input-group-text {
			border: none;
			font-weight: 600;
		}

		.form-control {
			border-left: none;
			border-radius: 0 5px 5px 0;
		}

		.form-control:focus {
			border-color: #80bdff;
			box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
		}

		.input-group-prepend .input-group-text {
			border-radius: 5px 0 0 5px;
		}

		.btn-lg {
			padding: 12px 24px;
			font-size: 16px;
			border-radius: 8px;
		}

		.form-label {
			font-weight: 600;
			margin-bottom: 8px;
		}

		.form-label i {
			margin-right: 8px;
		}

		/* Animation pour les champs */
		.form-control {
			transition: all 0.3s ease;
		}

		.form-control:focus {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.15);
		}

		/* Style pour la barre de progression */
		.progress {
			background-color: #e9ecef;
			border-radius: 10px;
		}

		.progress-bar {
			font-weight: bold;
			font-size: 12px;
			line-height: 25px;
		}
	</style>

	<script>
		function openEditModal(id) {
			var button = event.target.closest('button');

			// read data attributes
			var nom = button.getAttribute('data-nom');
			var type = button.getAttribute('data-type');
			var adresse = button.getAttribute('data-adresse');
			var tel1 = button.getAttribute('data-tel1');
			var tel2 = button.getAttribute('data-tel2');
			var site = button.getAttribute('data-site');
			var email = button.getAttribute('data-email');
			var etat = button.getAttribute('data-etat');

			// populate form
			document.getElementById('edit_nom').value = nom || '';
			document.getElementById('edit_type').value = type || '';
			document.getElementById('edit_adresse').value = adresse || '';
			document.getElementById('edit_tel1').value = tel1 || '';
			document.getElementById('edit_tel2').value = tel2 || '';
			document.getElementById('edit_site').value = site || '';
			document.getElementById('edit_email').value = email || '';
			document.getElementById('edit_etat').value = etat || '';

			// set form action
			document.getElementById('editForm').action = '/admin/entreprises/' + id;

			$('#editModal').modal('show');
		}

		function openAddModal() {
			document.getElementById('addForm').reset();
			$('#addModal').modal('show');
		}

		function confirmDeactivate(id, nom) {
			Swal.fire({
				title: 'Êtes-vous sûr ?',
				text: `Voulez-vous vraiment désactiver l'entreprise "${nom}" ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Oui, désactiver !',
				cancelButtonText: 'Annuler'
			}).then((result) => {
				if (result.isConfirmed) {
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = '/admin/entreprises/' + id;

					var csrfToken = document.createElement('input');
					csrfToken.type = 'hidden';
					csrfToken.name = '_token';
					csrfToken.value = '{{ csrf_token() }}';

					var methodField = document.createElement('input');
					methodField.type = 'hidden';
					methodField.name = '_method';
					methodField.value = 'DELETE';

					form.appendChild(csrfToken);
					form.appendChild(methodField);
					document.body.appendChild(form);
					form.submit();
				}
			});
		}

		function confirmActivate(id, nom) {
			Swal.fire({
				title: 'Activer l\'entreprise',
				text: `Voulez-vous activer l'entreprise "${nom}" ?`,
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Oui, activer !',
				cancelButtonText: 'Annuler'
			}).then((result) => {
				if (result.isConfirmed) {
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = '/admin/entreprises/' + id + '/activate';

					var csrfToken = document.createElement('input');
					csrfToken.type = 'hidden';
					csrfToken.name = '_token';
					csrfToken.value = '{{ csrf_token() }}';

					var methodField = document.createElement('input');
					methodField.type = 'hidden';
					methodField.name = '_method';
					methodField.value = 'PATCH';

					form.appendChild(csrfToken);
					form.appendChild(methodField);
					document.body.appendChild(form);
					form.submit();
				}
			});
		}

		function confirmEdit() {
			var nom = document.getElementById('edit_nom').value;
			Swal.fire({
				title: 'Confirmer la modification',
				text: `Voulez-vous enregistrer les modifications pour l'entreprise "${nom}" ?`,
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Oui, enregistrer !',
				cancelButtonText: 'Annuler'
			}).then((result) => {
				if (result.isConfirmed) {
					document.getElementById('editForm').submit();
				}
			});
		}
	</script>
</body>
</html>

