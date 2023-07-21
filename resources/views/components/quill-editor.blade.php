<div>
    <div class="h-64" x-data x-ref="quillEditor" x-init="
                        quill = new Quill($refs.quillEditor, {
                            theme: 'snow'});
                        quill.on('text-change', function () {
                          $dispatch('input', quill.root.innerHTML);
                        });
                      " wire::model='message'>
        {{$slot}}
    </div>
</div>