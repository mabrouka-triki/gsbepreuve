@extends('layouts.master')

@section('content')
    <form id="formModifierSpecialite" action="{{ route('postmodifierSpecialite', $uneSpecialite->id_praticien) }}" method="post">
        @csrf <!-- Ajout du token CSRF -->

        <div class="container">
            <h1>Modification</h1>
        </div>

        <div class="col-md-12 col-sm-12 well well-md">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Nom : </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="text" name="nom_praticien" value="{{ $uneSpecialite->nom_praticien ?? '' }}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Prénom: </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="text" name="prenom_praticien" value="{{ $uneSpecialite->prenom_praticien ?? '' }}" class="form-control" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Choisissez une spécialité que vous voulez modifier :</label>
                    <div class="col-md-2 col-sm-2">
                        <select name="id_specialite_a_remplacer" class="form-control" required>
                            <option value="">Sélectionnez une spécialité</option>
                            @foreach($mesSpecialites['specialites'][$uneSpecialite->id_praticien] as $specialite)
                                <option value="{{ $specialite->id_specialite }}">{{ $specialite->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Nouvelle spécialité :</label>
                    <div class="col-md-2 col-sm-2">
                        <select name="nouvelspe" class="form-control" required>
                            <option value="">Sélectionnez une spécialité</option>
                            @foreach($mesSpecialites['toutesSpecialites'] as $specialite)
                                <option value="{{ $specialite->id_specialite }}">{{ $specialite->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <button id="validerBtn" type="submit" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-ok"></span> Valider
                        </button>
                        <button type="button" class="btn btn-default btn-primary" onclick="javascript:if(confirm('Êtes-vous sûr ?')) window.location='{{ url('/') }}';">
                            <span class="glyphicon glyphicon-remove"></span> Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('formModifierSpecialite').addEventListener('submit', function(event) {
            // Empêcher la soumission du formulaire par défaut
            event.preventDefault();

            // Récupérer les valeurs des champs
            var id_specialite_a_remplacer = document.getElementsByName('id_specialite_a_remplacer')[0].value;
            var nouvelspe = document.getElementsByName('nouvelspe')[0].value;

            // Construction de l'URL pour l'action du formulaire
            var formAction = "{{ route('postmodifierSpecialite', $uneSpecialite->id_praticien) }}";
            formAction = formAction + '?id_specialite=' + id_specialite_a_remplacer + '&nouvelspe=' + nouvelspe;

            // Mettre à jour l'action du formulaire
            this.action = formAction;

            // Soumettre le formulaire
            this.submit();
        });
    </script>
@endsection
