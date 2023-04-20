@extends('triagem::layouts.master')

@section('content')
    <div class="hero">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 place-items-center">

                    @livewire('triagem::cards.card-exames', ['path' => "storage/icons/RM.png", 'label' => 'Ressonância', 'link' => 'filas.ressonancia'])
                    @livewire('triagem::cards.card-exames', ['path' => "storage/icons/TC.png", 'label' => 'Tomografia', 'link' => 'filas.tomografia'])

                    

                </div>

            </div>
        </div>
    </div>
@endsection
