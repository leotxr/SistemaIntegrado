@extends('errors::minimal')

@section('title', __('Serviço Indisponível'))
@section('icon')
<x-icon name='x' class="w-12 h-12"></x-icon>
@endsection
@section('code', '503')
@section('message', __('Serviço Indisponível'))
