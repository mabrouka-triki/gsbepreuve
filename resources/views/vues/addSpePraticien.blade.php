@extends('layouts.master')
@section('content')


    {!! Form::open(['url' => 'ajoutSpecialite']) !!}
    <div class="form-group">
        <label for="specialite_id">Spécialité :</label>
        <select name="specialite_id" class="form-control">
            @foreach($specialites as $specialite)
                <option value="{{ $specialite->id }}">{{ $specialite->nom_specialite }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter Spécialité</button>
    {!! Form::close() !!}
