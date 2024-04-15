@extends('layouts.master')
@section('content')
    {!! Form::open(array('route' => array('postmodifierSpecialite', $uneSpecialite->id_praticien), 'method' => 'post')) !!}
    <div>
        <br><br>
        <br><br>
        <div class="container">
            <h1>Modification d'une spécialité à un praticien </h1>
        </div>

        <div class="col-md-12 col-sm-12 well well-md">
            <center><h1> </h1></center>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Nom : </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="text" name="nom_praticien" value="{{$uneSpecialite->nom_praticien ?? ''}}" class="form-control" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Prenom: </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="text" name="prenom_praticien" value="{{$uneSpecialite->prenom_praticien ?? ''}}" class="form-control" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Spécialité à remplacer: </label>
                    <div class="col-md-2 col-sm-2">
                        <select name="id_specialite_a_remplacer" class="form-control" required>
                            <option value="">Sélectionnez une spécialité</option>
                            @foreach($mesSpecialites['specialitesParPraticien'][$uneSpecialite->id_praticien] as $specialite)
                                <option value="{{ $specialite->id_specialite }}">{{ $specialite->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Nouvelle spécialité: </label>
                    <div class="col-md-2 col-sm-2">
                        <select name="id_specialite" class="form-control" required>
                            <option value="">Sélectionnez une spécialité</option>
                            @foreach($mesSpecialites['toutesSpecialites'] as $specialite)
                                <option value="{{ $specialite->id_specialite }}">{{ $specialite->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-ok"></span> Valider
                        </button>
                        <button type="button" class="btn btn-default btn-primary " onclick="javascript:if(confirm('vous êtes sur ?')) window.location='{{url('/')}}';">
                            <span class="glyphicon glyphicon-remove"></span> Annuler

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
