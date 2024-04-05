@extends('layouts/master')

@section('content')
    @extends('layouts.master')
    @section('content')
        <div class="container">
            <h1>Modifier la spécialité du praticien {{$praticien->nom_praticien}} {{$praticien->prenom_praticien}}</h1>
            <form method="POST" action="{{ route('postmodifierSpe', $praticien->id_praticien) }}">                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="specialite">Spécialité :</label>
                    <select name="specialite" class="form-control">
                        @foreach($specialitesDisponibles as $specialite)
                            <option value="{{ $specialite }}" {{ $praticien->specialite === $specialite ? 'selected' : '' }}>{{ $specialite }}</option>
                        @endforeach
                    </select>
                    @error('specialite')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    @endsection
