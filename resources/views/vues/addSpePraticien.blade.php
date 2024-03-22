@extends('layouts/master')

@section('content')

    <div class="col-md-12 col-sm-12 well well-md">
        <center><h1>Ajouter une spécialité pour un praticien</h1></center>
        <form class="form-horizontal" method="post" action="/ajoutspecialite">
            @csrf
            <div class="form-group">
                <div class="col-md-3 col-sm-3">
                    <label for="praticien_id">Praticien :</label>
                    <select name="id_praticien" class="form-control" required>
                        <option value="">Sélectionner un praticien</option>
                        @foreach($praticiens as $praticien)
                            <option value="{{ $praticien->id_praticien }}">{{ $praticien->nom_praticien }} {{ $praticien->prenom_praticien }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label for="specialite_id">Spécialité :</label>
                    <select name="id_specialite" class="form-control" required>
                        <option value="">Sélectionner une spécialité</option>
                        @foreach($specialites as $specialite)
                            <option value="{{ $specialite->id_specialite }}">{{ $specialite->lib_specialite }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2">
                    <label for="diplome">Diplôme :</label>
                    <input type="text" name="diplome" class="form-control" required>
                </div>
                <div class="col-md-2 col-sm-2">
                    <label for="coef_prescription">Coefficient de prescription :</label>
                    <input type="text" name="coef_prescription" class="form-control" required>
                </div>
                <div class="col-md-2 col-sm-2">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
@endsection
