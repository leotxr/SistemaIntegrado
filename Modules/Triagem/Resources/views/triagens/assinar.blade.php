@extends('triagem::layouts.master')
@section('content')
<div class="flex p-2">

    <div>
        <form action="{{route('store.term-signature', ['id' => $term->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="signature_file" />
            <button type="submit">Enviar</button>
        </form>

    </div>

</div>

@endsection