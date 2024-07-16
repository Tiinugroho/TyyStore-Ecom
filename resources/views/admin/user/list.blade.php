@extends('admin.layouts.layout')
@section('title', 'Data User')
@section('page-name', 'Data User')
@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Account</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders"
                                            class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div><!--//col-->
                            <div class="col-auto">
                                <select class="form-select w-auto">
                                    <option selected value="option-1">All</option>
                                    <option value="option-2">This week</option>
                                    <option value="option-3">This month</option>
                                    <option value="option-4">Last 3 months</option>

                                </select>
                            </div>
                            <div class="col-auto">
                                <a href="{{ url('admin/user/create') }}" class="btn app-btn-secondary">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 1a.5.5 0 0 1 .5.5v6h6a.5.5 0 0 1 0 1h-6v6a.5.5 0 0 1-1 0v-6h-6a.5.5 0 0 1 0-1h6v-6A.5.5 0 0 1 8 1z" />
                                    </svg>
                                    Tambah Data
                                </a>
                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="#">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd"
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    Download CSV
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>USERNAME</th>
                                            {{-- <th>PROFILE</th> --}}
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>ADDRESS</th>
                                            <th class="export-exclude">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        use Illuminate\Support\Facades\DB;
                                        $result = DB::table('users')
                                            ->join('tbrole', 'users.role_id', '=', 'tbrole.id') // Melakukan join dengan tabel tbrole
                                            ->where('users.role_id', 2) // Filter berdasarkan role_id = 2
                                            ->orderBy('users.id', 'DESC')
                                            ->get();
                                        $no = 0;
                                        foreach ($result as $key => $value) {
                                            $no++; 
                                        ?>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $value->username }}</td>
                                            {{-- <td><img class="img-fluid" src="{{ asset('image/' . $value->profile) }}" alt="profile" width="100"></td> --}}
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>
                                                <form action="{{ url('admin/user', $value->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                        onclick="return confirm ('Apakah yakin anda ingin menghapus akun ini?')"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
