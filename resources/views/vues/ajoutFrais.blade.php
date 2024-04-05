@extends('layouts/master')
@section('content')

    {!! Form::open(['url' => 'postajoutFrais']) !!}
    <div class="col-md-12  col-sm-12 well well-md">
        <center><h1>Ajouter une fiche de Frais </h1></center>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Date : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="anneemois" value="" class="form-control" placeholder="AAAAMM" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Nb justificatif : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="number" name="nbjustificatif" value="" class="form-control" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <a href=" "><button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>

                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = '';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

