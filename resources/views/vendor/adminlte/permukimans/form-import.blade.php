<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.permukiman.import') }}"
                method="POST" enctype="multipart/form-data">
                <div class="card text-left card-primary card-ourline border border-primary card-psu-list">
                    <div class="card-header">
                        <h4 class="card-title">Upload File untuk diimport</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="document-dropzone-import">Upload File</label>
                                    <div class="needsclick dropzone dropzone-document dropzonePsu"
                                        id="document-dropzone-import">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- psupermukiman.storeFromPermukiman
['permukiman' => $permukimanpsupermukiman.updateFromPermukiman
psupermukiman.destroyFromPermukiman --}}

<script>

    var uploadedDocumentDokumen = {}
    $(".dropzone-document").dropzone({
        url: '{{ route('admin.permukiman.import') }}',
        maxFilesize: 512, // MB
        dataType: "json",
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        sending: function(file, xhr, formData) {
            //console.log(file, xhr, formData, $(this));
            var form = $(this)[0].clickableElements[0];
            formData.append("id_permukiman", $(form).find('.input-id_permukiman').val());
        },
        success: function(file, response) {
            var form = $(this)[0].clickableElements[0];
            $(form).append('<input type="hidden" name="document[]" value="' + response.nama_file + '">');
            uploadedDocumentDokumen[file.name] = response.nama_file;
            this.removeFile(file);
            addFileToListDokumen(file,$(this)[0].clickableElements,response);
        },
        queuecomplete: function () {
            // Event ini dipanggil ketika semua file dalam antrian selesai diupload
            // Optional: Membersihkan semua preview (ini mencakup file yang gagal diupload)
            this.removeAllFiles(true);
        },
        error: function(file, response) {
            var form = $(this)[0].clickableElements[0];
            $(form).append('<input type="hidden" name="document[]" value="' + response.name + '">')
            //uploadedDocumentDokumen[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentDokumen[file.name]
            }
            var form = $(this)[0].clickableElements[0];
            $(form).find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function(e) {
            var clickableElements = $(this)[0].clickableElements;
            /* this.on("success", function (file, response) {
                // Setelah upload berhasil, tambahkan file ke daftar
            }); */
            //console.log(clickableElements);
            {{-- @if (isset($psupermukiman) && $psupermukiman?->document)
                var files =
                    {!! json_encode($psupermukiman) !!};
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    var form = $(this)[0].clickableElements[0];
                    $(form).append('<input type="hidden" name="document[]" value="' + file.file_name +
                        '">')
                }
            @endif --}}
        }
    });

</script>