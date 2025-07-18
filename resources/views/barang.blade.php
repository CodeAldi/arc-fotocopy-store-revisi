@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title mt-2 col-8">List Barang</h5>
                    <button class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title mt-2 col-8">List Kategori Barang</h5>
                    <button class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <table class="table" id="tabelBarang">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>nama</th>
                            <th>Kategori</th>
                            <th>jumlah stok</th>
                            <th>harga satuan</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->namaBarang }}</td>
                                <td>{{ $item->kategori->namaKategori }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp.{{ $item->hargaBarang }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}" onclick="modalLihat(this)" data-bs-target="#modalLihatBarang"><i class="bx bx-show me-1"></i> Lihat</button>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}" onclick="modalEdit(this)" data-bs-target="#modalEditBarang"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}" onclick="modalHapus(this)" data-bs-target="#modalHapusBarang"><i class="bx bx-trash me-1"></i> Delete</button>
                                        
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <table class="table" id="tableKategori">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoriBarang as $item)
                            <tr>
                                <td>{{ $item->namaKategori }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}" onclick="modalEditKategori(this)"
                                                data-bs-target="#modalEditKategori"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}" onclick="modalHapusKategori(this)"
                                                data-bs-target="#modalHapusKategori"><i class="bx bx-trash me-1"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTambahKategori" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ Route('kategoriBarang.tambah') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Kategori Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">nama</label>
                        <input type="text" id="nameWithTitle" class="form-control" name="nama" placeholder="masukan nama kategori baru" />
                        <span class="form-text">nama kategori baru tidak boleh sama dengan yang sudah ada</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalHapusKategori" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ Route('kategoriBarang.hapus') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Hapus Kategori Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <h1 for="hapusKategoriId" class="fs-3">Apakah anda yakin ingin menghapus kategori Barang ini?</h1>
                            <input type="text" id="hapusKategoriId" class="form-control" name="id" hidden readonly />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditKategori" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ Route('kategoriBarang.update') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Kategori Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">nama</label>
                        <input type="text" id="editIdKategori" class="form-control" hidden name="id" placeholder="masukan nama kategori baru" />
                        <input type="text" id="editNamaKategori" class="form-control" name="nama" placeholder="masukan nama kategori baru" />
                        <span class="form-text">nama kategori baru tidak boleh sama dengan yang sudah ada</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTambahBarang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ Route('barang.tambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-1">
                        <div class="col">
                            <label for="nameWithTitle" class="form-label">nama</label>
                            <input type="text" id="nameWithTitle" class="form-control" name="nama"
                                placeholder="masukan nama barang" />
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="nameWithTitle" class="form-label">kategori</label>
                            <select name="kategori" id="kategori" class="form-select text-secondary"> 
                                <option value="#">Pilih Kategori Barang</option>
                                @forelse ($kategoriBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="jumlah" class="form-label">jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" min="0" placeholder="0">
                        </div>
                        <div class="col">
                            <label for="jumlah" class="form-label">harga satuan</label>
                            <div class="input-group">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control" id="jumlah" min="0" placeholder="0">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" placeholder="masukan deskripsi singkat barang" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="gambar" class="form-label">Default file input example</label>
                            <input class="form-control" type="file" id="gambar" name="gambar" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLihatBarang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Lihat Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-1">
                        <div class="col">
                            <label for="lihatNama" class="form-label">nama</label>
                            <input type="text" id="lihatNama" class="form-control" name="nama"
                                disabled />
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="lihatKategori" class="form-label">kategori</label>
                            <input name="kategori" id="lihatKategori" class="form-select text-secondary" value="" disabled> 
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="lihatJumlah" class="form-label">jumlah</label>
                            <input type="number" disabled name="jumlah" class="form-control" id="lihatJumlah" min="0" placeholder="0">
                        </div>
                        <div class="col">
                            <label for="lihatHarga" class="form-label">harga satuan</label>
                            <div class="input-group">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" style="background: #eceef1;">Rp</span>
                                    <input disabled type="number" name="harga" class="form-control" id="lihatHarga" min="0" placeholder="0">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="lihatDeskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" disabled placeholder="masukan deskripsi singkat barang" id="lihatDeskripsi" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="gambar" class="form-label">Gambar Barang</label>
                            <img src="{{ asset('') }}" id="lihatGambar" alt="gambar barang" class="img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditBarang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-1">
                        <div class="col">
                            <label for="editNama" class="form-label">nama</label>
                            <input type="text" id="editNama" class="form-control" name="nama"/>
                            <input type="text" id="editId" class="form-control" name="nama" hidden/>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="editKategori" class="form-label">kategori</label>
                            <select name="kategori" id="editKategori" class="form-select text-secondary">
                                <option value="#">Pilih kategori barang</option>
                                @forelse ($kategoriBarang as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                                @empty
                                    
                                @endforelse
                            </select> 
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="editJumlah" class="form-label">jumlah</label>
                            <input type="number"  name="jumlah" class="form-control" id="editJumlah" min="0" placeholder="0">
                        </div>
                        <div class="col">
                            <label for="editHarga" class="form-label">harga satuan</label>
                            <div class="input-group">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Rp</span>
                                    <input  type="number" name="harga" class="form-control" id="editHarga" min="0" placeholder="0">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="editDeskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi"  placeholder="masukan deskripsi singkat barang" id="editDeskripsi" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="gambar" class="form-label">Gambar Barang</label>
                            <img src="" alt="gambar barang" class="img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalHapusBarang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ Route('barang.hapus') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Hapus Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <h1 class="fs-3">Apakah anda yakin ingin menghapus Barang
                                ini?</h1>
                            <input type="text" id="hapusIdBarang" class="form-control" name="id" hidden readonly />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('page-js')
<script type="text/javascript">
    let table = new DataTable('#tabelBarang', {
                // options
                });
            function modalLihat(item) {
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("lihatNama").value = myjson.namaBarang;
                document.getElementById("lihatDeskripsi").value = myjson.deskripsi;
                document.getElementById("lihatJumlah").value = myjson.jumlah;
                document.getElementById("lihatHarga").value = myjson.hargaBarang;
                document.getElementById("lihatKategori").value = myjson.kategori.namaKategori;
                let string1 = document.getElementById("lihatGambar").src;
                let string2 = string1.substring(0,31) + '/' + myjson.gambar;
                document.getElementById("lihatGambar").src = string2;
                console.log(string2);    
            }
            function modalEdit(item) {
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("editId").value = myjson.id;
                document.getElementById("editNama").value = myjson.namaBarang;
                document.getElementById("editDeskripsi").value = myjson.deskripsi;
                document.getElementById("editJumlah").value = myjson.jumlah;
                document.getElementById("editHarga").value = myjson.hargaBarang;   
                var panjangOptionKategori = document.getElementById("editKategori").length;
                for (let index = 0; index < panjangOptionKategori; index++) {
                    if (document.getElementById("editKategori").options[index].value == myjson.kategori_barang_id) {
                        console.log(document.getElementById("editKategori").options[index].value);
                        document.getElementById("editKategori").options[index].selected = true;
                        
                    }
                }
            }
            function modalHapus(item) {
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("hapusIdBarang").value = myjson.id;
            }
            function modalEditKategori(item){
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("editIdKategori").value = myjson.id;
                document.getElementById("editNamaKategori").value = myjson.namaKategori;
            }
            function modalHapusKategori(item) {
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("hapusKategoriId").value = myjson.id;
            }
</script>
@endpush
@endsection