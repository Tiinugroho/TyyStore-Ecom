@extends('admin.layouts.layout')
@section('title', 'Pembelian Restock Barang')
@section('page-name', 'Pembelian Restock Barang')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Pembelian Restock Barang</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-md-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form action="{{ url('admin/restock/store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode">No Bukti</label>
                                            <input type="text" id="kode" name="kode" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Beli</label>
                                            <input type="datetime-local" id="tanggal" name="tanggal" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pemasok">Pemasok</label>
                                            <select class="form-control" name="id_vendor" id="id_vendor" required>
                                                <option value="" selected disabled>Pilih Vendor</option>
                                                @foreach (App\Models\tbpemasok::all() as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Keterangan</label>
                                            <textarea id="desc" name="desc" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="app-card app-card-settings shadow-sm p-4 mt-4">
                                    <div class="app-card-body">
                                        <h2>Detail Pembelian</h2>
                                        <table class="table" id="detailPembelian">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Baris dummy -->
                                                {{-- <tr>
                                                    <td colspan="5" class="text-center">Tidak ada barang yang ditambahkan
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                        <button type="button" id="addProduct" class="btn app-btn-secondary mt-3">Add
                                            Product</button>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="total">Total</label>
                                    <input type="number" id="total" name="total" class="form-control" readonly>
                                </div>
                                <button type="submit" class="btn app-btn-primary mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate and set No Bukti
            var noBukti = 'TYSFI' + new Date().toISOString().replace(/[^0-9]/g, "").slice(0, 14);
            document.getElementById('kode').value = noBukti;

            // Set Tanggal Beli to current date and time
            var now = new Date();
            var year = now.getFullYear();
            var month = ('0' + (now.getMonth() + 1)).slice(-2);
            var day = ('0' + now.getDate()).slice(-2);
            var hours = ('0' + now.getHours()).slice(-2);
            var minutes = ('0' + now.getMinutes()).slice(-2);
            var datetime = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('tanggal').value = datetime;

            // Function to add new row
            function addProductRow() {
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
            <td>
                <select class="form-control id_barang" name="id_barang[]" required>
                    <option value="" selected disabled>Pilih Barang</option>
                    @foreach (App\Models\tbstok::all() as $data)
                        <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" class="form-control quantity" name="quantity[]" required></td>
            <td><input type="number" class="form-control harga" name="harga[]" readonly></td>
            <td><input type="number" class="form-control subtotal" name="subtotal[]" readonly></td>
            <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
        `;
                document.querySelector('#detailPembelian tbody').appendChild(newRow);
                attachEventListeners(newRow);
            }

            // Function to remove row
            function removeRow(event) {
                event.target.closest('tr').remove();
                calculateTotal();
            }

            // Function to fetch harga and calculate subtotal
            function fetchHarga(event) {
                var idBarang = event.target.value;
                var hargaInput = event.target.closest('tr').querySelector('.harga');
                if (idBarang) {
                    fetch('/admin/get-harga/' + idBarang)
                        .then(response => response.json())
                        .then(data => {
                            hargaInput.value = data.harga;
                            calculateSubtotal(event);
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    hargaInput.value = '';
                }
            }

            // Function to calculate subtotal
            function calculateSubtotal(event) {
                var row = event.target.closest('tr');
                var quantity = row.querySelector('.quantity').value;
                var harga = row.querySelector('.harga').value;
                var subtotal = row.querySelector('.subtotal');
                subtotal.value = quantity * harga;
                calculateTotal();
            }

            // Function to calculate total
            function calculateTotal() {
                var subtotals = document.querySelectorAll('.subtotal');
                var total = 0;
                subtotals.forEach(function(subtotal) {
                    total += parseFloat(subtotal.value) || 0;
                });
                document.getElementById('total').value = total;
            }

            // Attach event listeners to a row
            function attachEventListeners(row) {
                row.querySelector('.id_barang').addEventListener('change', fetchHarga);
                row.querySelector('.quantity').addEventListener('input', calculateSubtotal);
                row.querySelector('.remove-row').addEventListener('click', removeRow);
            }

            // Initial event listener for Add Product button
            document.getElementById('addProduct').addEventListener('click', addProductRow);

            // Attach event listeners to initial rows
            document.querySelectorAll('#detailPembelian tbody tr').forEach(function(row) {
                attachEventListeners(row);
            });
        });
    </script>

    <!-- Modal -->
    {{-- @foreach ($stok as $item)
        <div class="modal fade" id="returnModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="returnModalLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.restock.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="returnModalLabel-{{ $item->id }}">Konfirmasi Return</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin return pembelian untuk barang
                                <strong>{{ $item->namabarang }}</strong>?</p>
                            <div class="mb-3">
                                <label for="kode-{{ $item->id }}" class="form-label">Kode:</label>
                                <input type="text" class="form-control" id="kode-{{ $item->id }}" name="kode"
                                    value="{{ $item->kode }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal-{{ $item->id }}" class="form-label">Tanggal Pembelian:</label>
                                <input type="datetime-local" class="form-control" id="tanggal-{{ $item->id }}"
                                    name="tanggal" value="{{ $item->tanggal }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah-{{ $item->id }}" class="form-label">Jumlah Return:</label>
                                <input type="number" class="form-control" id="jumlah-{{ $item->id }}" name="jumlah"
                                    value="{{ $item->jumlah }}" disabled>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger text-white">Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}


@endsection
