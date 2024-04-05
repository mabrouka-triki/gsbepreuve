@extends('layouts.master')

@section('content')
    <form action="{{ url('updateSpecialite') }}" method="POST">
        @csrf
        <div class="col-md-12 col-sm-12 well well-md">
            <center><h1>Modifier Spécialité</h1></center>
            <div class="form-group">
                <label>Sélectionnez un praticien:</label>
                <select name="id_praticien" class="form-control" required>
                    <option value="" selected disabled>Sélectionnez un praticien</option>
                    @foreach($praticiens as $praticien)
                        <option value="{{ $praticien->id_praticien }}">{{ $praticien->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Sélectionnez une spécialité:</label>
                <select name="id_specialite" class="form-control" required>
                    <option value="" selected disabled>Sélectionnez une spécialité</option>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id_specialite }}">{{ $specialite->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="button" class="btn btn-primary" onclick="if(confirm('Êtes-vous sûr ?')) window.location='{{ url('/') }}';">Annuler</button>
            </div>
        </div>
    </form>
@endsection
@endsection
