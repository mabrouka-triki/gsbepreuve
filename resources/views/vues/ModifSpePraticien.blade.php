@extends('layouts.master')

@section('content')
    <div class="col-md-12 col-sm-12 well well-md">
        <center><h1>Modification de la spécialité d'un praticien</h1></center>
        <form class="form-horizontal" method="post" action="{{ route('postmodifierSpe') }}">
            @csrf
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Praticien :</label>
                <div class="col-md-6 col-sm-6">
                    <p>{{ $praticien->nom }} {{ $praticien->prenom }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Spécialité :</label>
                <div class="col-md-6 col-sm-6">
                    <select name="id_specialite" class="form-control" required>
                        <option value="">Sélectionner une spécialité</option>
                        @foreach($specialites as $specialite)
                            <option value="{{ $specialite->id }}">{{ $specialite->lib_specialite }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider </button>
                    &nbsp;
                    <a href="{{ route('annulerAction') }}" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-remove"></span> Annuler</a>
                </div>
            </div>
        </form>
    </div>

@endsection
