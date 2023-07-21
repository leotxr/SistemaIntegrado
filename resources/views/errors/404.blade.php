@extends('errors::minimal')

@section('title', __('Página não encontrada'))
@section('icon')
<x-icon name='emoji-sad' class="w-12 h-12"></x-icon>
@endsection
@section('code', '404')
@section('message', __('Página não encontrada'))
