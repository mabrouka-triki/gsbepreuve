@extends ('layouts.master')
@section('content')

    <div class="container">
        <div class="blanc">
            <h1 style="text-align: center">Liste  des Praticiens </h1>
        </div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th style="width: 25%; text-align:center">ID praticien</th>
                <th style="width: 25%; text-align:center">Nom praticien </th>
                <th style="width: 25%; text-align:center">Prénom de praticien </th>
                <th style="width: 25%; text-align:center">cp praticien </th>
                <th style="width: 25%; text-align:center">Specialite</th>


            </tr>
            </thead>
            @foreach ($mesPraticiens as $unPraticiens)
                <tr>
                    <td>{{$unPraticiens->id_praticien}}</td>
                    <td>{{$unPraticiens->nom_praticien}}</td>
                    <td>{{$unPraticiens->prenom_praticien}}</td>
                    <td>{{$unPraticiens->cp_praticien}}</td>
                    <td>{{$unPraticiens->lib_specialite}}</td>

                </tr>

            @endforeach
        </table>
        <div class="col-md-6 col-md-offset-3">
            @include('vues/error')
        </div>
@stop

