@extends('triagem::layouts.master')

@section('content')
    <div class="hero">
        <div class="text-center hero-content">
            <div class="max-w-md">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 place-items-center">
                    <!-- Card 1 -->
                    @livewire('triagem::cards.card-exames', [
                        'path' => 'storage/icons/RM.png',
                        'label' => 'RM Terreo',
                        'link' => 'filas.ressonancia',
                    ])

                    <!-- Card 2 -->
                    @livewire('triagem::cards.card-exames', [
                        'path' => 'storage/icons/RM.png',
                        'label' => 'RM Subsolo',
                        'link' => 'filas.ressonanciaSub',
                    ])

                    <!-- Card 3 -->
                    @livewire('triagem::cards.card-exames', [
                        'path' => 'storage/icons/TC.png',
                        'label' => 'TC',
                        'link' => 'filas.tomografia',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
