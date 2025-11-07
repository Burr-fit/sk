<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
    <h3 class="mb-0">Mulai Buat Silsilah Keluarga</h3>
</div>

<div class="row align-items-center mb-2">
    <div class="col-md-4">
        <div class="btn-group align-items-center gap-2" role="group" aria-label="Toolbar Actions">
            <div class="input-container" id="inputnamakeluarga">
                <input placeholder="Nama Keluarga" class="input-field" type="text" id="nama_keluarga">
                <label for="input-field" class="input-label">Nama Keluarga</label>
                <span class="input-highlight"></span>
            </div>

        </div>
    </div>

    <div class="col-md-8 text-end">
        <div class="btn-group" role="group" aria-label="Toolbar Actions">

            <!-- Share Dropdown -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-share-nodes"></i> Share
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li>
                        <a class="dropdown-item" href="#" id="shareEditor">
                            <i class="fa-solid fa-user-gear text-success me-2"></i>
                            Share as <b>Editor</b>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" id="shareViewer">
                            <i class="fa-solid fa-eye text-primary me-2"></i>
                            Share as <b>Viewer</b>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Export SVG -->
            <button class="btn btn-outline-success" id="btnSVG">
                <i class="fa-regular fa-file-code"></i> Export SVG
            </button>

            <!-- Export PDF -->
            <button class="btn btn-outline-danger" id="btnPDF">
                <i class="fa-regular fa-file-pdf"></i> Export PDF
            </button>
        </div>
    </div>
</div>


<div class="row mb-2" style="height:100vh;">
    <div id="paper" data-family='@json($familyData)'></div>
</div>

<div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <!-- Header -->
            <div class="modal-header text-white">
                <h5 class="modal-title" id="modalCreateUserLabel">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Data
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Form -->
            <form id="formCreateUser" enctype="multipart/form-data" method="POST" action="{{ url('Admin/addOrang') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row g-3">
                        <!-- Kiri -->
                        <div class="col-md-6">
                            <input type="hidden" name="namaKeluarga" id="namakel" readonly
                                class="form-control-plaintext text-muted">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Orang" required>
                                <label for="nama">Nama Orang</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    placeholder="Tempat Lahir">
                                <label for="tempat_lahir">Tempat Lahir</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    placeholder="Tanggal Lahir">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="no_telp" name="no_telp"
                                    placeholder="No. Telepon">
                                <label for="no_telp">No. Telepon</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="url" class="form-control" id="link_maps_tinggal"
                                    name="link_maps_tinggal" placeholder="Link Google Maps Lokasi Tinggal">
                                <label for="link_maps_tinggal">Link Maps Lokasi Tinggal</label>
                            </div>

                        </div>

                        <!-- Kanan -->
                        <div class="col-md-6">

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="tanggal_wafat" name="tanggal_wafat"
                                    placeholder="Tanggal Wafat">
                                <label for="tanggal_wafat">Tanggal Wafat</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="url" class="form-control" id="link_maps_pemakaman"
                                    name="link_maps_pemakaman" placeholder="Link Maps Lokasi Pemakaman">
                                <label for="link_maps_pemakaman">Link Maps Lokasi Pemakaman</label>
                            </div>

                            <!-- Upload Foto -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Foto</label>
                                <div id="uploadBox" style="height: 200px"
                                    class="border rounded-3 text-center p-2 position-relative bg-light cursor-pointer">
                                    <label class="d-block w-100 h-100" for="foto" style="cursor:pointer;">
                                        <div id="uploadPlaceholder"
                                            class="d-flex flex-column justify-content-center align-items-center h-100">
                                            <i
                                                class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-2 text-primary fs-4"></i>
                                            <span class="d-block mt-2 text-muted">
                                                Drag & drop foto atau
                                                <span class="text-primary text-decoration-underline">Browse</span>
                                            </span>
                                        </div>
                                        <img id="previewFoto" class="img-fluid rounded-3 shadow-sm d-none"
                                            style="max-height: 100%; object-fit:cover;">
                                        <input type="file" class="d-none" id="foto" name="foto"
                                            accept="image/*">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
