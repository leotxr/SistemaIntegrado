@extends('triagem::layouts.master')

@section('content')
    <div class="hero min-h-screen">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">Módulo Triagem</h1>
                <p class="py-6">Selecione uma modalidade de exame para ter acesso à fila.</p>
                <div class="dropdown">
                    <label tabindex="0" class="btn m-1">Selecionar fila de exames</label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ url('triagem/filas/ressonancia') }}">Ressonância</a></li>
                        <li><a href="{{ url('triagem/filas/tomografia') }}">Tomografia</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
@endsection
