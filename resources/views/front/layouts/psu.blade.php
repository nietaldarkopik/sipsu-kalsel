@extends('front.master-front')

@section('content')
  <section class="fluid-container main-content">
      <div id="section3" class="container py-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Prasarana, Sarana dan Utilitas</h4>
            </div>
            <div class="card-body">
                <form id="filter-form" class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Cari">
                                <label for="floatingInputGroup1">Cari</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select id="filter-kabupaten" name="kabupaten" class="form-control">
                                <option value="">Semua Kabupaten/Kota</option>
                            </select>
                            <label for="floatingSelect">Kabupaten/Kota</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select id="filter-kecamatan" name="kecamatan" class="form-control">
                                <option value="">Semua Kecamatan</option>
                            </select>
                            <label for="floatingSelect">Kecamatan</label>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                          <div class="form-floating">
                            <select id="filter-kelurahan" name="kelurahan" class="form-control">
                              <option value="">Semua Kelurahan/Desa</option>
                            </select>
                            <label for="floatingSelect">Kelurahan/Desa</label>
                          </div>
                        </div> -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                    <!--
                          <div class="col-md-12">
                            <div class="checkboxes in-row margin-bottom-20">
                              <input id="ba-serah-terima" type="checkbox" name="ba_serah_terima" value="1">
                              <label for="ba-serah-terima">Dengan BAST</label>
        
                              <input id="status-imb" type="checkbox" name="status_imb" value="1">
                              <label for="status-imb">Dengan IMB/PBG</label>
                            </div>
                          </div>
                        -->
                    <hr>
                </form>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    {{ $dataTable->table() }}

                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="{{ asset('vendor/datatables-plugins/scroller/css/scroller.bootstrap4.min.css') }}"/> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css"/> --}}
    {{-- https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" />
@endsection

@section('js')
    {{-- <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'"></script> --}}
    {{-- <script src="//cdn.datatables.net/2.0.8/js/dataTables.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="//cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="//cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
