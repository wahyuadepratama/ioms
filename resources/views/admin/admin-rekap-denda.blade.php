@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Rekap Denda</h4>
                    </div>
                    <div class="card-body">
                      <div class="card-body table-full-width table-responsive">

                          <!-- just for datatable -->
                          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                          <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
                          <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
                          <!-- just for datatable -->

                          <table class="table table-hover" >
                              <thead>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th>Jadwal Piket</th>
                                  <th>Total Denda IOMS</th>
                                  <th>Total Denda Lainnya</th>
                                  <th>Keseluruhan</th>
                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($rekap as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{ $data->nama }}</td>
                                      <td>{{ $data->jadwal_piket }}</td>
                                      <td>Rp {{number_format(($data->total_denda),0,',','.')}}</td>
                                      <td>Rp {{number_format(($data->denda_lain),0,',','.')}}</td>
                                      <td>Rp {{number_format(($data->total_denda + $data->denda_lain),0,',','.')}}</td>                                      
                                  </tr>
                                  @php $no++; @endphp
                                @endforeach
                              </tbody>
                          </table>
                          <script type="text/javascript">
                            $(document).ready( function () {
                              $('#table_id').DataTable();
                            } );
                          </script>
                      </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
