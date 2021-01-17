@extends('layouts.layout')
@section('content')
    @if($franchiseOne->count() <= 0)
        <div>
            <p>No existe la primera fraquicia</p>
        </div>
    @else
        <div>
            <h3>{{ $franchiseOne[0]->name }}</h3>
            <div>
                @foreach($franchiseOneImages as $image)
                    <img src="{{ Config::get('app.url') }}public/uploads/{{ $image->image }}"/>
                @endforeach
            </div>
            <p>Temática: {{ $franchiseOne[0]->getThematicName() }}</p>
            <p>Precio: {{ $franchiseOne[0]->price }}</p>
            <p>Mapa: {{ $franchiseOne[0]->map }}</p>
            <p>Type: {{ $franchiseOne[0]->video_type }}</p>
            <p>Video: {{ $franchiseOne[0]->video }}</p>
            <p>Descripción: {{ $franchiseOne[0]->description }}</p>
        </div>
    @endif

    @if($franchiseTwo->count() <= 0)
        <div>
            <p>No existe la segunda fraquicia</p>
        </div>
    @else
        <div>
            <h3>{{ $franchiseTwo[0]->name }}</h3>
            <div>
                @foreach($franchiseTwoImages as $image)
                    <img src="{{ Config::get('app.url') }}public/uploads/{{ $image->image }}"/>
                @endforeach
            </div>
            <p>Temática: {{ $franchiseTwo[0]->getThematicName() }}</p>
            <p>Precio: {{ $franchiseTwo[0]->price }}</p>
            <p>Mapa: {{ $franchiseTwo[0]->map }}</p>
            <p>Type: {{ $franchiseTwo[0]->video_type }}</p>
            <p>Video: {{ $franchiseTwo[0]->video }}</p>
            <p>Descripción: {{ $franchiseTwo[0]->description }}</p>
        </div>
    @endif
@endsection