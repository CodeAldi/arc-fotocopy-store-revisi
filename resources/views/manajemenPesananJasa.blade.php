@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mt-2 col-8">List Pesanan : Jasa</h4>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table" id="tabelOrderBarang">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>item</th>
                            <th>dokumen</th>
                            <th>jumlah halaman</th>
                            <th>qty</th>
                            <th>total bayar</th>
                            <th>status bayar</th>
                            <th>status pesanan</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>siti</td>
                            <td>print warna A4 75gr</td>
                            <td><button  class="btn btn-sm btn-primary"><i class='bx bxs-file-doc'></i> download dokumen </button></td>
                            <td>30 lembar</td>
                            <td>1</td>
                            <td>Rp.9000</td>
                            <td>paid</td>
                            <td>working</td>
                            <td>
                                <button class="btn btn-md rounded-pill btn-success">Selesaikan pesanan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>aldi</td>
                            <td>print hitam-putih A4 75gr</td>
                            <td>
                                <button  class="btn btn-sm btn-primary"><i class='bx bxs-file-doc'></i> download dokumen </button>
                            </td>
                            <td>50 lembar</td>
                            <td>2</td>
                            <td>Rp.25000</td>
                            <td>paid</td>
                            <td>done</td>
                            <td>
                                <button class="btn btn-md rounded-pill btn-success" disabled>Selesaikan pesanan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('page-js')
<script type="text/javascript">
    let tableOrderBarang = new DataTable('#tabelOrderBarang', {
                // options
                });
            function modalLihat(item) {
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("lihatNama").value = myjson.namaJasa;
                document.getElementById("lihatDeskripsi").value = myjson.deskripsi;
                document.getElementById("lihatHarga").value = myjson.harga;
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
                console.log(document.getElementById("editId").value);
                
                document.getElementById("editNama").value = myjson.namaJasa;
                document.getElementById("editDeskripsi").value = myjson.deskripsi;
                document.getElementById("editHarga").value = myjson.harga;   
                var panjangOptionKategori = document.getElementById("editKategori").length;
                for (let index = 0; index < panjangOptionKategori; index++) {
                    if (document.getElementById("editKategori").options[index].value == myjson.kategori_jasa_id) {
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