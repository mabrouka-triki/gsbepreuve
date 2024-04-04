@extends ('layouts.master')
@section('content')

    <div class="container">
        <div class="blanc">
            <h1 style="text-align: center">Liste  des Praticiens </h1>
        </div>
<br>


        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th style="width: 25%; text-align:center">ID praticien</th>
                <th style="width: 25%; text-align:center">Nom praticien </th>
                <th style="width: 25%; text-align:center">Prénom de praticien </th>
                <th style="width: 25%; text-align:center">cp praticien </th>
                <th style="width: 25%; text-align:center">Specialite</th>
                <th style="width: 25%; text-align:center">Action </th>


            </tr>
            </thead>
            @foreach ($mesPraticiens as $unPraticiens)
                <tr>
                    <td>{{$unPraticiens->id_praticien}}</td>
                    <td>{{$unPraticiens->nom_praticien}}</td>
                    <td>{{$unPraticiens->prenom_praticien}}</td>
                    <td>{{$unPraticiens->cp_praticien}}</td>
                    <td>{{$unPraticiens->lib_specialite}}</td>

                <td style="text-align: center">
                    <a href="{{ url('/ModifSpePraticien') }}/{{ $unPraticiens->id_praticien }}">
                        <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="modifier"></span>

                <td style="text-align: center">
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="supprimer"
                       onclick="if (confirm('Suppression confirmée ?')) {
                window.location='{{ url('/supprimerSpePraticien') }}/{{ $unPraticiens->id_praticien }}';}">
                    </a>
                </td>

            @endforeach
        </table>
        <div class="col-md-6 col-md-offset-3">
            @include('vues/error')
        </div>
@stop

