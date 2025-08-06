@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mt-2 col-8">List Pesanan : Barang</h4>
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
                            <th>jumlah</th>
                            <th>catatan</th>
                            <th>total bayar</th>
                            <th>status bayar</th>
                            <th>status pesanan</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                @foreach ($item->orderDetails as $itemDetails)
                                    {{ $itemDetails->barang->namaBarang }}<hr><br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($item->orderDetails as $itemDetails)
                                {{ $itemDetails->jumlah }}<hr><br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($item->orderDetails as $itemDetails)
                                @if (is_null($itemDetails->catatan) )
                                    tidak ada catatan <hr><br>
                                @else
                                    {{ $itemDetails->catatan }}<hr><br>
                                @endif
                                @endforeach
                            </td>
                            <td>Rp{{ number_format($item->total_bayar,0,'','.') }}</td>
                            <td>{{ $item->status_pembayaran }}</td>
                            <td>{{ $item->status_order }}</td>
                            <td>
                                @if ($item->status_order == 'done')
                                    <button class="btn btn-sm rounded-pill btn-primary" disabled type="button">Pesanan selesai</button>
                                @elseif ($item->status_order == 'waiting for payment')
                                    <button class="btn btn-sm rounded-pill btn-primary" disabled type="button">Menunggu Pembayaran</button>
                                @elseif ($item->status_order == 'being prepared')
                                    <form action="{{ route('manajemenPesanan.menungguDiambil',['id'=>$item->id]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-sm rounded-pill bg-warning text-white">Pesanan dapat diambil</button>
                                    </form>
                                @elseif ($item->status_order == 'waiting to be picked up')
                                    <form action="{{ route('manajemenPesanan.selesaikan',['id'=>$item->id]) }}" method="post">
                                        @csrf
                                        {{-- <button class="btn btn-sm rounded-pill btn-success">Hubungi pelanggan <i class='bx bxl-whatsapp'></i></button> --}}
                                        <button class="btn btn-sm rounded-pill btn-primary">Pesanan selesai</button>
                                    </form>
                                @endif
                            </td>
                            {{-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}"
                                            onclick="modalEditKategori(this)" data-bs-target="#modalEditKategori"><i
                                                class="bx bx-check-double me-1"></i>Selesai</button>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-index="{{ $item }}"
                                            onclick="modalHapusKategori(this)" data-bs-target="#modalHapusKategori"><i
                                                class="bx bx-trash me-1"></i> Delete</button>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                        @empty
                
                        @endforelse
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