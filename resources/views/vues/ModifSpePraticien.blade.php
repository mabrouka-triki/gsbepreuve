@extends('layouts/master')

@section('content')
    <form action="{{ url('updateSpecialite') }}" method="POST">
        @csrf
        <div class="col-md-12 col-sm-12 well well-md">
            <center><h1>Modifier Spécialité</h1></center>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Spécialité</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $unPraticien->nom_praticien }}</td>
                        <td>{{ $unPraticien->prenom_praticien }}</td>
                        <td>{{ $unPraticien->specialites }}</td>


                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="button" class="btn btn-primary" onclick="if(confirm('Êtes-vous sûr ?')) window.location='{{ url('/') }}';">Annuler</button>
            </div>
        </div>
    </form>
@endsection
