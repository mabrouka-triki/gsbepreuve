@extends('layouts.master')

@section('content')
    <form id="formSupprimerSpecialite" action="{{ route('supprimerSpecialitePraticien', $unePraticien->id_praticien) }}" method="post">
        @csrf <!-- Ajout du token CSRF -->
        @method('DELETE') <!-- Utilisation de la méthode DELETE -->

        <div class="container">
            <h1>Suppression d'une spécialité</h1>
        </div>

        <div class="col-md-12 col-sm-12 well well-md">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Choisissez la spécialité à supprimer :</label>
                    <div class="col-md-2 col-sm-2">
                        <select name="id_specialite_a_supprimer" class="form-control" required>
                            <option value="">Sélectionnez une spécialité</option>
                            @foreach($mesSpecialites['specialites'][$unePraticien->id_praticien] as $specialite)
                                <option value="{{ $specialite->id_specialite }}">{{ $specialite->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <button id="validerBtn" type="submit" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-trash"></span> Supprimer
                        </button>
                        <a href="{{ url('/') }}" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-remove"></span> Annuler
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <!-- Ajoutez ici vos scripts JavaScript si nécessaire -->
@endsection
