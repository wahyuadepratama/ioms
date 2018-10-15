@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">History Piket</h4>
                    </div>
                    <div class="card-body">
                      <div class="card-body table-full-width table-responsive">

                          <!-- just for datatable -->
                          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                          <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
                          <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
                          <!-- just for datatable -->

                          <table class="table table-hover" id="table_id">
                              <thead>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th>Tanggal Piket</th>
                                  <th>Absen Pagi</th>
                                  <th>Absen Sore</th>
                                  <th>Keterangan</th>
                                  <th>Denda</th>
                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($piketHarian as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{ $data->nama }}</td>                                      
                                      <td>{{ $data->created_at->format('D / d M Y') }}</td>
                                      <td>
                                        @if($data->piket_pagi == NULL)
                                          @php echo "-"; @endphp
                                        @endif
                                        @if($data->piket_pagi == "true")
                                          @php echo "ada"; @endphp
                                        @endif
                                      </td>
                                      <td>
                                        @if($data->piket_sore == NULL)
                                          @php echo "-"; @endphp
                                        @endif
                                        @if($data->piket_sore == "true")
                                          @php echo "ada"; @endphp
                                        @endif
                                      </td>
                                      <td>{{ $data->keterangan }}</td>
                                      <td>Rp.{{ $data->denda }}</td>
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
