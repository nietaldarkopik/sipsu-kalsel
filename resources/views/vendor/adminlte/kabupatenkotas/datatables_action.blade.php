<form action="{{ route('admin.kabupaten-kota.destroy', $id) }}" method="post">
	@csrf
	@method('delete')
    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <a href="{{ route('admin.kabupaten-kota.show', $id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalLgId" data-modal-title="Lihat Data">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </a>
        <a href="{{ route('admin.kabupaten-kota.edit', $id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalLgId" data-modal-title="Edit Data">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</form>
