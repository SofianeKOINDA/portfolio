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
				<li class="breadcrumb-item"><a href="javascript:;" onclick="openAddModal()" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Ajouter une formation</a></li>
			</ol>

			<h1 class="page-header">Gestion des Formations</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des formations</h4>
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
								<th class="text-nowrap">Diplôme / Titre</th>
								<th class="text-nowrap text-center">Durée</th>
								<th class="text-nowrap">Entreprise / École</th>
								<th class="text-nowrap text-center">État</th>
								<th width="1%" data-orderable="false" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($formations as $formation)
                                <tr class="odd gradeX hover-highlight">
                                    <td class="f-w-600 text-inverse text-center">{{ $loop->iteration }}</td>

                                    <!-- Diplôme -->
                                    <td class="font-weight-bold">
                                        <i class="fa fa-graduation-cap text-primary m-r-5"></i> {{ $formation->diplome }}
                                    </td>

                                    <!-- Durée -->
                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill">
                                            <i class="fa fa-clock m-r-5"></i> {{ $formation->duree }}
                                        </span>
                                    </td>

                                    <!-- Entreprise -->
                                    <td>
                                        <i class="fa fa-building text-muted m-r-5"></i> {{ $formation->entreprise->nom ?? 'N/A' }}
                                    </td>

                                    <!-- État -->
                                    <td class="text-center">
                                        <span class="badge badge-{{ $formation->etat == 'Actif' ? 'success' : 'danger' }} badge-pill">
                                            <i class="fa fa-{{ $formation->etat == 'Actif' ? 'check-circle' : 'times-circle' }}"></i>
                                            {{ $formation->etat }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-warning" title="Modifier"
                                                onclick="openEditModal({{ $formation->id }})"
                                                data-diplome="{{ $formation->diplome }}"
                                                data-duree="{{ $formation->duree }}"
                                                data-entreprise_id="{{ $formation->entreprise_id }}"
                                                data-etat="{{ $formation->etat }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            @if($formation->etat == 'Actif')
                                                <button type="button" class="btn btn-xs btn-danger" title="Désactiver" onclick="confirmDeactivate({{ $formation->id }}, '{{ $formation->diplome }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-xs btn-success" title="Activer" onclick="confirmActivate({{ $formation->id }}, '{{ $formation->diplome }}')">
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
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<!-- Modal d'édition -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white"><i class="fa fa-edit"></i> Modifier la formation</h5>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<form id="editForm" method="POST">
					@csrf
					@method('PUT')
					<div class="modal-body bg-white text-dark">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label">Diplôme / Titre de la formation *</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-primary text-white"><i class="fa fa-graduation-cap"></i></span></div>
										<input type="text" class="form-control" id="edit_diplome" name="diplome" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Durée * (ex: 2 ans, 6 mois)</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-info text-white"><i class="fa fa-clock"></i></span></div>
										<input type="text" class="form-control" id="edit_duree" name="duree" required>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Entreprise / École *</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-warning text-white"><i class="fa fa-building"></i></span></div>
										<select class="form-control" id="edit_entreprise_id" name="entreprise_id" required>
											<option value="">Sélectionnez une entreprise</option>
											@foreach($entreprises as $entreprise)
												<option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">État *</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-primary text-white"><i class="fa fa-toggle-on"></i></span></div>
										<select class="form-control" id="edit_etat" name="etat" required>
											<option value="Actif">Actif</option>
											<option value="Inactif">Inactif</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-dark">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-success" onclick="confirmEdit()">Enregistrer</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal d'ajout -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white"><i class="fa fa-plus"></i> Ajouter une formation</h5>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<form id="addForm" method="POST" action="{{ route('formations.store') }}">
					@csrf
					<div class="modal-body bg-white text-dark">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label">Diplôme / Titre *</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-primary text-white"><i class="fa fa-graduation-cap"></i></span></div>
										<input type="text" class="form-control" name="diplome" placeholder="Ex: Master en Informatique" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Durée *</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-info text-white"><i class="fa fa-clock"></i></span></div>
										<input type="text" class="form-control" name="duree" placeholder="Ex: 2 ans" required>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Entreprise / École *</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text bg-warning text-white"><i class="fa fa-building"></i></span></div>
										<select class="form-control" name="entreprise_id" required>
											<option value="">Sélectionnez</option>
											@foreach($entreprises as $entreprise)
												<option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">État *</label>
									<select class="form-control" name="etat" required>
										<option value="Actif">Actif</option>
										<option value="Inactif">Inactif</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-dark">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
						<button type="submit" class="btn btn-success">Ajouter</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    @include("sections.admin.script")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles CSS identiques au précédent pour la cohérence -->
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

			// Remplissage des champs
			document.getElementById('edit_diplome').value = button.getAttribute('data-diplome');
			document.getElementById('edit_duree').value = button.getAttribute('data-duree');
			document.getElementById('edit_entreprise_id').value = button.getAttribute('data-entreprise_id');
			document.getElementById('edit_etat').value = button.getAttribute('data-etat');

			document.getElementById('editForm').action = '/admin/formations/' + id;
			$('#editModal').modal('show');
		}

		function openAddModal() {
			document.getElementById('addForm').reset();
			$('#addModal').modal('show');
		}

		function confirmDeactivate(id, nom) {
			Swal.fire({
				title: 'Désactiver la formation ?',
				text: `Voulez-vous masquer "${nom}" ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				confirmButtonText: 'Oui, désactiver'
			}).then((result) => {
				if (result.isConfirmed) {
					submitHiddenForm('/admin/formations/' + id, 'DELETE');
				}
			});
		}

		function confirmActivate(id, nom) {
			Swal.fire({
				title: 'Activer la formation ?',
				text: `Voulez-vous rendre "${nom}" visible ?`,
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				confirmButtonText: 'Oui, activer'
			}).then((result) => {
				if (result.isConfirmed) {
					submitHiddenForm('/admin/formations/' + id + '/activate', 'PATCH');
				}
			});
		}

        function confirmEdit() {
            Swal.fire({
                title: 'Confirmer ?',
                text: "Enregistrer les modifications sur cette formation ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Oui, enregistrer'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('editForm').submit();
            });
        }

        // Utilitaire pour soumettre des actions DELETE/PATCH sans créer 1000 formulaires
        function submitHiddenForm(action, method) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = action;
            form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="${method}">`;
            document.body.appendChild(form);
            form.submit();
        }
	</script>
</body>
</html>
