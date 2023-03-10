@extends('layout.master')
@section('title')
    Data Kensa
@endsection

@section('breadcrumb')
    @parent
    <li class="active"> > Kensa > Kensa</li>
@endsection
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produksi Kensa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('content')
    <div class="card-header" style="padding-left: 10px;">
        <div class="row float-right">
            <div class="col-12 col-md-12 col-lg-12">
                <a href="{{ route('kensa.tambah') }}" class="btn btn-icon icon-left btn-info"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>
        </div>
        <form action="{{ route('kensa') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ $date }}">
                </div>
                <div class="col-md-4">
                    <label for="" class="text-white">Filter</label> <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row"
        style="
    padding-bottom: 0px;
    padding-left: 20px;
    padding-right: 0px;
    padding-top: 0px;
">
    </div>


    <div class="card-body mt-3" style="
    padding-top: 0px;
">
        <table id="add-row" class="table table-sm table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="align-middle text-center">#</th>
                    <th rowspan="2" class="align-middle text-center">Tanggal</th>
                    <th rowspan="2" class="align-middle text-center">Part Name</th>
                    <th rowspan="2" class="align-middle text-center">No Bar</th>
                    <th rowspan="2" class="align-middle text-center">Qty Bar</th>
                    <th rowspan="2" class="align-middle text-center">Cycle</th>
                    <th colspan="12" class="align-middle text-center">NG PLATING</th>
                    <th colspan="6" class="align-middle text-center">NG MOLDING</th>
                    <th colspan="5" class="align-middle text-center">Total</th>
                </tr>
                <tr>
                    <th>Nikel</th>
                    <th>Butsu</th>
                    <th>Hadare</th>
                    <th>Hage</th>
                    <th>Moyo</th>
                    <th>Fukure</th>
                    <th>Crack</th>
                    <th>Henkei</th>
                    <th>Hanazaki</th>
                    <th>Kizu</th>
                    <th>Kaburi</th>
                    <th>Other</th>
                    <th>Gores</th>
                    <th>Regas</th>
                    <th>Silver</th>
                    <th>Hike</th>
                    <th>Burry</th>
                    <th>Others</th>
                    <th>Total OK</th>
                    <th>Total NG</th>
                    <th>% Total OK</th>
                    <th>% Total NG</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kensa as $no => $kensha)
                    <tr>
                        <td style="width:1px; white-space:nowrap;">{{ $no + 1 }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ \Carbon\Carbon::parse($kensha->tanggal_k)->format('d-m-Y') }}
                            {{ \Carbon\Carbon::parse($kensha->waktu_k)->format('H:i:s') }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->part_name }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->no_bar }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->qty_bar }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->cycle }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->nikel }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->butsu }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->hadare }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->hage }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->moyo }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->fukure }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->crack }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->henkei }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->hanazaki }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->kizu }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->kaburi }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->other }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->gores }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->regas }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->silver }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->hike }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->burry }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->others }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->total_ok }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->total_ng }}</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->p_total_ok }} %</td>
                        <td style="width:1px; white-space:nowrap;">{{ $kensha->p_total_ng }} %</td>
                        <td style="width:1px; white-space:nowrap;">
                            <a href="{{ route('kensa.edit', $kensha->id) }}" class="btn btn-icon btn-sm btn-warning"><i
                                    class="far fa-edit"></i></a>
                            {{-- <a href="#" data-id="{{ $kensha->id }}"
                                class="btn btn-icon btn-sm btn-danger swal-confirm"><i class="far fa-trash-alt">
                                    </i>
                                <form action="{{ route('kensa.delete', $kensha->id) }}" id="delete{{ $kensha->id }}"
                                    method="POST">
                                    @csrf
                                </form>
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <center> <b> Total </center> </b>
                    </td>
                    <td colspan="2"><b>{{ $sum_qty_bar }}</b> </td>
                    <td><b>{{ $sum_nikel }}</b></td>
                    <td><b>{{ $sum_butsu }}</b></td>
                    <td><b>{{ $sum_hadare }}</b></td>
                    <td><b>{{ $sum_hage }}</b></td>
                    <td><b>{{ $sum_moyo }}</b></td>
                    <td><b>{{ $sum_fukure }}</b></td>
                    <td><b>{{ $sum_crack }}</b></td>
                    <td><b>{{ $sum_henkei }}</b></td>
                    <td><b>{{ $sum_hanazaki }}</b></td>
                    <td><b>{{ $sum_kizu }}</b></td>
                    <td><b>{{ $sum_kaburi }}</b></td>
                    <td><b>{{ $sum_other }}</b></td>
                    <td><b>{{ $sum_gores }}</b></td>
                    <td><b>{{ $sum_regas }}</b></td>
                    <td><b>{{ $sum_silver }}</b></td>
                    <td><b>{{ $sum_hike }}</b></td>
                    <td><b>{{ $sum_burry }}</b></td>
                    <td><b>{{ $sum_others }}</b></td>
                    <td><b>{{ $sum_total_ok }}</b></td>
                    <td><b>{{ $sum_total_ng }}</b></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    {{-- {!! $kensa->links() !!} --}}
    </div>
@endsection

@push('page-script')
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
@endpush

@push('after-script')
    <script>
        $(document).ready(function() {
            $("#add-row").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 75,
                "lengthMenu": [
                    [10, 25, 50, 75, -1],
                    [10, 25, 50, 75, "All"]
                ],
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#add-row_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(".swal-confirm").click(function(e) {
            id = e.target.dataset.id;
            swal({
                    title: 'Hapus data? ',
                    text: 'Setelah dihapus, data tidak dapat dikembalikan',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(`#delete${id}`).submit();
                    } else {}
                });
        });
    </script>
@endpush
