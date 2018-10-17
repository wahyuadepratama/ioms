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
                                  <th>More</th>
                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($piketHarian as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{ $data->nama }}</td>
                                      <td>{{ date("D / d M Y", strtotime($data->tanggal_piket)) }}</td>
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
                                      <td>
                                        <a class="btn btn-warning btn-fill" data-toggle="modal" data-target="#view{{$data->id_piket_harian}}" href="#view{{$data->id_piket_harian}}">
                                            Show
                                        </a>

                                            <!-- Mini Modal -->
                                            <div class="modal fade modal modal-primary" id="view{{$data->id_piket_harian}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                                <div class="modal-dialog">
                                                  <div class="col-md-12" style="padding-top: 5%;">
                                                    <div class="card" >
                                                        <div class="card-header ">
                                                            <h4 class="card-title">Update Data</h4>
                                                        </div>
                                                        <div class="card-body">
                                                          <form action="/admin/history-piket/update" method="post" style="margin-top:2%">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $data->id_piket_harian }}">
                                                            <table>
                                                              <tr>
                                                                <td><input type="text" height="200px" width="100%" name="keterangan" placeholder="Keterangan" value="{{ $data->keterangan }}" style="margin-top:1%" class="form-control"></td>
                                                              </tr>
                                                              <tr>
                                                                <td><input type="number" name="denda" value="{{$data->denda}}" style="margin-top:1%" class="form-control"></td>
                                                              </tr>
                                                              <tr>
                                                                <td><input type="submit" value="Update" class="btn btn-info" style="margin-top:1%"></td>
                                                              </tr>
                                                            </table>



                                                          </form>
                                                        </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <!--  End Modal -->
                                      </td>
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
