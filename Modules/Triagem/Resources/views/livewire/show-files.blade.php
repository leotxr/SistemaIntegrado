<div>
    @isset($photos)
        <div class="grid grid-cols-5 gap-4">
            @foreach ($photos as $photo)
                <div>
                    <img class="mask mask-squircle" src="{{ URL::asset($photo->url) }}" />
                </div>
            @endforeach
        </div>
    @endisset
    @empty($photos)
        <p>Não existem arquivos da triagem atual...</p>
    @endempty
</div>
