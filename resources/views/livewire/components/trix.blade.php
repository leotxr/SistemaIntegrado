<div wire:ignore class="text-gray-900">
    <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}">
    <trix-editor input="{{ $trixId }}"></trix-editor>

    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-change", function (event) {
            @this.
            set('value', trixEditor.getAttribute('value'))
        })
    </script>
</div>