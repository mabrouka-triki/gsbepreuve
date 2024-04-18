@extends('layouts.master')
@section('content')
    <form id="formSupprimerSpecialite" action="{{ route('postSuppressionSpecialite', $uneSpecialite->id_praticien) }}" method="post">
        @csrf <!-- Ajout du token CSRF -->

        <div class="container">
            <h1>Suppression de spécialité</h1>
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
                    <label class="col-md-3 col-sm-3 control-label">Spécialité à supprimer :</label>
                    <div class="col-md-2 col-sm-2">
                        <select name="id_specialite_a_supprimer" class="form-control" required>
                            <option value="">Sélectionnez une spécialité à supprimer</option>
                            @foreach($mesSpecialites['specialites'][$uneSpecialite->id_praticien] as $specialite)
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
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
