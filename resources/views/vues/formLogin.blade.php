@extends('layouts/master')
@section('content')
    {!! Form::open(['url' =>'login']) !!}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="well well-md">
                <h1 class="text-center">Authentification</h1>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Identifiant : </label>
                        <div class="col-md-6">
                            <input type="text" name="login" class="form-control" placeholder="Votre identifiant" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mot de passe : </label>
                        <div class="col-md-6">
                            <input type="password" name="pwd" class="form-control" placeholder="Votre mot de passe" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3">
        @include('Vues/error')
    </div>
@stop
