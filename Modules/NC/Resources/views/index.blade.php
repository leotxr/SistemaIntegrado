@extends('nc::layouts.master')
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-full">
                    <div>
                        <select name="cars" id="cars">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
