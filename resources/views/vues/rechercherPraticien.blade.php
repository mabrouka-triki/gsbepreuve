@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="blanc">
            <h1 style="text-align: center">Résultats de la recherche</h1>
        </div>

        <form method="GET" action="{{ route('rechercherPraticien') }}">
            <center>
                <input type="text" name="nom_praticien" placeholder="Nom du praticien">
                <button type="submit">Rechercher</button>
            </center>
            <br>
        </form>

        <br>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th style="width: 25%; text-align:center">Nom praticien</th>
                <th style="width: 25%; text-align:center">Prénom praticien</th>
                <th style="width: 25%; text-align:center">Spécialité</th>
            </tr>
            </thead>
            <tbody>
            @isset($praticiens)
            @foreach ($praticiens as $praticien)
                <tr>
                    <td>{{ $praticien->nom_praticien }}</td>
                    <td>{{ $praticien->prenom_praticien }}</td>
                    <td>{{ $praticien->lib_specialite }}</td>
                </tr>
            @endforeach
            @endisset
            </tbody>
        </table>
    </div>
@endsection
