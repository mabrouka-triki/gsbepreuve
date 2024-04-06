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
                <th style="width: 25%; text-align:center">Specialite</th>
                <th style="width: 25%; text-align:center">Action </th>


            </tr>
            </thead>
            @foreach($mesPraticiens as $unePraticien)
                <tr>
                    <td>{{$unePraticien->id_praticien}}</td>
                    <td>{{$unePraticien->nom_praticien}}</td>
                    <td>{{$unePraticien->prenom_praticien}}</td>
                    <td>{{$unePraticien->specialites}}</td>
                    <td style="text-align: center;">
                        <a href="{{ url('/ModifSpePraticien') }}/{{$unePraticien->id_praticien}}">
                            <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier">{{$unePraticien->id_praticien}}</span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="col-md-6 col-md-offset-3">
            @include('vues/error')
        </div>
@stop

