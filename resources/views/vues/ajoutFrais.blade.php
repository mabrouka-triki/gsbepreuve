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

    public function listeSpecialites()
    {
    try {
    $monErreur = Session::get('monErreur');
    Session::forget('monErreur');
    $uneSpecialite = new ServiceSpecialites();
    $mesSpecialites = $uneSpecialite->listerSpecialites();
    return view('vues/listeSpecialites', compact('mesSpecialites', 'monErreur'));
    } catch (MonException $e) {
    $monErreur = $e->getMessage();
    return view('vues/error', compact('monErreur'));
    } catch (Exception $e) {
    $monErreur = $e->getMessage();
    return view('vues/error', compact('monErreur'));


    }
    }

    public function insertSpecialite()
    {

    try {
    $diplome = Request::input("diplome");
    $id_specialite = Request::input("id_specialite");
    $id_praticien = Request::input("id_praticien");
    $coef_prescription = Request::input("coef_prescription");
    $uneSpecialiteService = new ServiceSpecialites();
    $uneSpecialiteService->insertSpecialites($diplome, $coef_prescription, $id_praticien, $id_specialite);
    return view("home");
    } catch (MonException $e) {
    $monErreur = $e->getMessage();
    return view('vues/error', compact('monErreur'));
    } catch (Exception $e) {
    $monErreur = $e->getMessage();
    return view('vues/error', compact('monErreur'));
    }

    }
    public function insertSpecialites($diplome,$coef_prescription, $id_praticien, $id_specialite )
    {
    try {
    DB::table('posseder')->insert(
    ['diplome' => $diplome,
    'coef_prescription' => $coef_prescription,
    'id_praticien'=> $id_praticien,
    'id_specialite'=> $id_specialite,
    ]
    );
    } catch (QueryException $e) {
    throw new MonException($e->getMessage(), 5);
    }
    }
    @extends ('layouts.master')
    @section ('content')
        {!! Form::open (['url' => 'postSpecialite']) !!}
        <div class="col-md-12 col-sm-12 well well-md">
            <center><h1> </h1></center>
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
        Route::get('/formAjouterSpecialite', [\App\Http\Controllers\SpecialitesControleur::class, 'insertSpecialite']);


