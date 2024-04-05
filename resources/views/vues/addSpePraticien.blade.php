@extends ('layouts.master')
@section ('content')

    {!! Form::open (['url' => 'postSpecialite']) !!}
    <div class="col-md-12 col-sm-12 well well-md">
        <center><h1> add spécialité  </h1></center>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Praticien: </label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::select('id_praticien', $mesSpecialites['praticiens']->pluck('full_name', 'id_praticien'), null, ['class' => 'form-control', 'placeholder' => 'Sélectionnez un praticien', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Spécialité : </label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::select('id_specialite', $mesSpecialites['specialites']->pluck('full_name', 'id_specialite'), $uneSpecialite->id_specialite ?? null, ['class' => 'form-control', 'placeholder' => 'Sélectionnez une spécialité', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Diplôme : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="diplome" value="" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Coef_prescription: </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="coef_prescription" value="" class="form-control" required>
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
