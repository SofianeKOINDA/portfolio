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
				<li class="breadcrumb-item"><a href="javascript:;" onclick="openAddModal()" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Ajouter une expérience</a></li>
			</ol>

			<h1 class="page-header">Gestion des Expériences</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des expériences professionnelles</h4>
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
								<th class="text-nowrap">Poste</th>
								<th class="text-nowrap">Entreprise</th>
								<th class="text-nowrap text-center">Durée</th>
								<th class="text-nowrap">Missions / Tâches</th>
								<th class="text-nowrap text-center">État</th>
								<th width="1%" data-orderable="false" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($experiences as $experience)
                                <tr class="odd gradeX hover-highlight">
                                    <td class="f-w-600 text-inverse text-center">{{ $loop->iteration }}</td>

                                    <!-- Poste -->
                                    <td class="font-weight-bold">
                                        <i class="fa fa-briefcase text-primary m-r-5"></i> {{ $experience->poste }}
                                    </td>

                                    <!-- Entreprise -->
                                    <td>
                                        <i class="fa fa-building text-muted m-r-5"></i> {{ $experience->entreprise->nom ?? 'N/A' }}
                                    </td>

                                    <!-- Durée -->
                                    <td class="text-center">
                                        <span class="badge badge-info">
                                            <i class="fa fa-calendar-alt m-r-5"></i> {{ $experience->duree }}
                                        </span>
                                    </td>

                                    <!-- Tâches (Protection contre l'erreur de type array/string) -->
                                    <td>
                                        <small class="text-muted">
                                            @php
                                                $tachesText = is_array($experience->tache)
                                                    ? implode(', ', $experience->tache)
                                                    : $experience->tache;
                                            @endphp
                                            {{ Str::limit($tachesText, 60) }}
                                        </small>
                                    </td>

                                    <!-- État -->
                                    <td class="text-center">
                                        <span class="badge badge-{{ $experience->etat == 'Actif' ? 'success' : 'danger' }} badge-pill">
                                            {{ $experience->etat }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-warning" title="Modifier"
                                                onclick="openEditModal({{ $experience->id }})"
                                                data-poste="{{ $experience->poste }}"
                                                data-duree="{{ $experience->duree }}"
                                                data-tache="{{ $tachesText }}"
                                                data-entreprise_id="{{ $experience->entreprise_id }}"
                                                data-etat="{{ $experience->etat }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-xs btn-{{ $experience->etat == 'Actif' ? 'danger' : 'success' }}"
                                                onclick="toggleStatus({{ $experience->id }}, '{{ $experience->poste }}', '{{ $experience->etat }}')">
                                                <i class="fa fa-{{ $experience->etat == 'Actif' ? 'trash' : 'check' }}"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

        @include("sections.admin.config")
	</div>

	<!-- Modal d'édition -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header bg-black border-secondary">
					<h5 class="modal-title text-white"><i class="fa fa-edit"></i> Modifier l'expérience</h5>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<form id="editForm" method="POST">
					@csrf
					@method('PUT')
					<div class="modal-body bg-white text-dark">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Poste occupé *</label>
									<input type="text" class="form-control" id="edit_poste" name="poste" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Entreprise *</label>
									<select class="form-control" id="edit_entreprise_id" name="entreprise_id" required>
										<option value="">Sélectionnez l'entreprise</option>
										@foreach($entreprises as $ent)
											<option value="{{ $ent->id }}">{{ $ent->nom }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Durée * (ex: 2020 - 2022)</label>
									<input type="text" class="form-control" id="edit_duree" name="duree" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">État *</label>
									<select class="form-control" id="edit_etat" name="etat" required>
										<option value="Actif">Actif</option>
										<option value="Inactif">Inactif</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Tâches et Missions (une par ligne ou séparées par virgules)</label>
							<textarea class="form-control" id="edit_tache" name="tache" rows="4" placeholder="Décrivez vos missions..."></textarea>
						</div>
					</div>
					<div class="modal-footer bg-dark">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
						<button type="submit" class="btn btn-success">Enregistrer les modifications</button>
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
					<h5 class="modal-title text-white"><i class="fa fa-plus"></i> Ajouter une expérience</h5>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<form action="{{ route('experiences.store') }}" method="POST">
					@csrf
					<div class="modal-body bg-white text-dark">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Poste occupé *</label>
									<input type="text" class="form-control" name="poste" placeholder="Ex: Développeur Fullstack" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Entreprise *</label>
									<select class="form-control" name="entreprise_id" required>
										<option value="">Sélectionnez l'entreprise</option>
										@foreach($entreprises as $ent)
											<option value="{{ $ent->id }}">{{ $ent->nom }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Durée *</label>
									<input type="text" class="form-control" name="duree" placeholder="Ex: CDD 6 mois ou 2019 - Présent" required>
								</div>
							</div>
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
						<div class="form-group">
							<label class="form-label">Tâches et Missions</label>
							<textarea class="form-control" name="tache" rows="4" placeholder="Décrivez vos missions..."></textarea>
						</div>
					</div>
					<div class="modal-footer bg-dark">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
						<button type="submit" class="btn btn-primary">Créer l'expérience</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    @include("sections.admin.script")
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

			document.getElementById('edit_poste').value = button.getAttribute('data-poste');
			document.getElementById('edit_duree').value = button.getAttribute('data-duree');
			document.getElementById('edit_tache').value = button.getAttribute('data-tache');
			document.getElementById('edit_entreprise_id').value = button.getAttribute('data-entreprise_id');
			document.getElementById('edit_etat').value = button.getAttribute('data-etat');

			document.getElementById('editForm').action = '/admin/experiences/' + id;
			$('#editModal').modal('show');
		}

		function openAddModal() {
			$('#addModal').modal('show');
		}

		function toggleStatus(id, poste, currentStatus) {
			const action = currentStatus === 'Actif' ? 'désactiver' : 'activer';
			Swal.fire({
				title: 'Confirmation',
				text: `Voulez-vous ${action} l'expérience de "${poste}" ?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Oui, confirmer'
			}).then((result) => {
				if (result.isConfirmed) {
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = currentStatus === 'Actif' ? '/admin/experiences/' + id : '/admin/experiences/' + id + '/activate';
					form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="${currentStatus === 'Actif' ? 'DELETE' : 'PATCH'}">`;
					document.body.appendChild(form);
					form.submit();
				}
			});
		}
	</script>
</body>
</html>
