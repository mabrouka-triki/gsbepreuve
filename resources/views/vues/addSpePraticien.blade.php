@extends('layouts/master')
@section('content')


    <div class="col-md-12 col-sm-12 well well-md">
        <center><h1>Ajouter une spécialité pour un praticien</h1></center>
        <form class="form-horizontal" method="post" action="/addSpePraticien">
            @csrf
            <div class="form-group">
                <label for="id_praticien">Praticien :</label>
                <select name="id_praticien" class="form-control" required>
                    <option value="">Sélectionner un praticien</option>
                    <!-- Boucle pour afficher les options des praticiens -->
                    @foreach ($praticiens as $praticien)
                        <option value="{{ $praticien->id }}">{{ $praticien->nom }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="id_specialite">Spécialité :</label>
                <select name="id_specialite" class="form-control" required>
                    <option value="">Sélectionner une spécialité</option>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id_specialite }}">{{ $specialite->lib_specialite }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="diplome">Diplôme :</label>
                <input type="text" name="diplome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="coef_prescription">Coefficient de prescription :</label>
                <input type="text" name="coef_prescription" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
