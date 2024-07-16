<!DOCTYPE html>
<html lang="en">

<head>
    <title>Portal TyyStore - @yield('title')</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{ url('tyystore.jpg') }}">

    <!-- FontAwesome JS-->
    <script defer src="{{ url('admin2/assets/plugins/fontawesome/js/all.min.js') }}"></script>


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ url('admin2/assets/css/portal.css') }}">
    <!-- Other meta tags and stylesheets -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .nav-item.active>.nav-link,
        .submenu-item.active>.submenu-link {
            color: #000;
        }

        .submenu.show {
            display: block;
        }

        .nav-item.active .nav-link .nav-icon,
        .nav-item.active .nav-link .nav-link-text,
        .nav-item.active .nav-link .submenu-arrow {
            color: #198754;
        }

        .submenu-item.active .submenu-link {
            color: #198754;
        }

        textarea.form-control {
            width: 100%;
            height: auto;
            min-height: 100px;
        }

        .sortable {
            position: relative;
            white-space: nowrap;
            cursor: pointer;
            padding-right: 5em;
            top: 50%;
        }

        .sort-icon {
            position: relative;
            top: 50%;
            /* right: px; */
            pointer-events: none;
            margin-left: 5px;
        }

        .sort-icon svg {
            width: 1em;
            height: 1em;
        }

        /* Mengatur lebar kolom tertentu */
        th.cell[data-column="1"] {
            width: 50px;
        }

        th.cell[data-column="2"] {
            width: 120px;
        }

        th.cell[data-column="3"] {
            width: 220px;
        }

        th.cell[data-column="4"] {
            width: 100px;
        }

        th.cell[data-column="5"] {
            width: 150px;
        }

        th.cell[data-column="6"] {
            width: 120px;
        }

        th.cell[data-column="7"] {
            width: 180px;
        }

        th.cell[data-column="8"] {
            width: 120px;
        }

        th.cell[data-column="9"] {
            width: 150px;
        }

        th.cell[data-column="10"] {
            width: 180px;
        }

        th.cell[data-column="11"] {
            width: 120px;
        }

        th.cell {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

</head>

<body class="app">
    @include('admin.layouts.header')

    <div class="app-wrapper">

        @yield('content')

    </div><!--//app-wrapper-->


    <!-- Javascript -->
    <script src="{{ url('admin2/assets/plugins/popper.min.js') }}"></script>
    <script src="{{ url('admin2/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Charts JS -->
    <script src="{{ url('admin2/assets/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('admin2/assets/js/index-charts.js') }}"></script>

    <!-- Page Specific JS -->
    <script src="{{ url('admin2/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Check if there is a success message from the session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
            });
        @endif

        // Check if there is an error message from the session
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
            });
        @endif
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('export-csv').addEventListener('click', function() {
            // Ambil semua baris data dari tabel
            var rows = document.querySelectorAll('#dataTable2 tbody tr');

            // Buat array kosong untuk menyimpan data CSV
            var csv = [];

            // Tambahkan header CSV (nama kolom)
            var header = [];
            document.querySelectorAll('#dataTable2 thead th').forEach(function(th) {
                header.push('"' + th.innerText.trim() + '"');
            });
            csv.push(header.join(','));

            // Loop melalui setiap baris data
            rows.forEach(function(row) {
                var csvRow = [];
                row.querySelectorAll('td').forEach(function(cell) {
                    // Gunakan textContent untuk mengambil teks dari sel
                    csvRow.push('"' + cell.textContent.trim() + '"');
                });
                csv.push(csvRow.join(','));
            });

            // Buat blob CSV
            var csvContent = csv.join('\n');
            var blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });

            // Buat URL untuk file CSV
            var url = URL.createObjectURL(blob);

            // Ambil judul halaman dari elemen dengan class "app-page-title"
            var pageTitle = document.querySelector('title').innerText;

            // Buat link untuk mengunduh file CSV
            var link = document.createElement('a');
            link.setAttribute('href', url);
            link.setAttribute('download', pageTitle + '.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headers = document.querySelectorAll('.sortable');
            const table = document.getElementById('dataTable2').querySelector('tbody');

            // Fungsi untuk memuat keadaan sorting dari localStorage
            function loadSortingState() {
                const sortingState = JSON.parse(localStorage.getItem('sortingState'));
                if (sortingState) {
                    const header = document.querySelector(`.sortable[data-column="${sortingState.column}"]`);
                    if (header) {
                        header.dataset.sort = sortingState.sortOrder;
                        const icon = sortingState.sortOrder === 'asc' ? 'fa-sort' : 'fa-sort';
                        header.querySelector('.sort-icon').innerHTML = `<i class="fas ${icon}"></i>`;
                        sortTable(header.dataset.column, sortingState.sortOrder);
                    }
                }
            }

            // Fungsi untuk menyimpan keadaan sorting ke localStorage
            function saveSortingState(column, sortOrder) {
                const sortingState = {
                    column: column,
                    sortOrder: sortOrder
                };
                localStorage.setItem('sortingState', JSON.stringify(sortingState));
            }

            // Fungsi untuk mengurutkan tabel
            function sortTable(column, sortOrder) {
                const rows = Array.from(table.querySelectorAll('tr'));
                rows.sort(function(row1, row2) {
                    const cell1 = row1.querySelector(`td:nth-child(${column})`).innerText.trim();
                    const cell2 = row2.querySelector(`td:nth-child(${column})`).innerText.trim();

                    if (sortOrder === 'asc') {
                        return cell1.localeCompare(cell2);
                    } else {
                        return cell2.localeCompare(cell1);
                    }
                });

                // Tambahkan kembali baris yang telah diurutkan ke tabel
                rows.forEach(function(row) {
                    table.appendChild(row);
                });
            }

            // Event listener untuk header yang bisa disortir
            headers.forEach(function(header) {
                header.addEventListener('click', function() {
                    const column = this.dataset.column;
                    let sortOrder = this.dataset.sort || 'asc';

                    // Toggle urutan pengurutan
                    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                    this.dataset.sort = sortOrder;

                    // // Reset semua ikon pengurutan
                    // headers.forEach(function (header) {
                    //     header.querySelector('.sort-icon').innerHTML = '';
                    // });

                    // Setel ikon pengurutan saat ini
                    const icon = sortOrder === 'asc' ? 'fa-sort' : 'fa-sort';
                    this.querySelector('.sort-icon').innerHTML = `<i class="fas ${icon}"></i>`;

                    // Urutkan baris tabel
                    sortTable(column, sortOrder);

                    // Simpan keadaan sorting ke localStorage
                    saveSortingState(column, sortOrder);
                });
            });

            // Muat keadaan sorting saat halaman dimuat
            loadSortingState();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-orders');
            const table = document.getElementById('dataTable2');
            const rows = table.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();

                rows.forEach(function(row) {
                    const cells = row.querySelectorAll('td');
                    let match = false;

                    cells.forEach(function(cell) {
                        if (cell.innerText.toLowerCase().includes(query)) {
                            match = true;
                        }
                    });

                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>
