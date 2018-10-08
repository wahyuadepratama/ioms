@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Daftar Peminjam Inventaris</h4>
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
                                  <th>Peminjam</th>
                                  <th>NIM</th>
                                  <th>Inventaris</th>
                                  <th>Status</th>
                                  <th>Tanggal Pinjam</th>
                                  <th>More</th>

                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($peminjaman as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{$data->nama_peminjam}}</td>
                                      <td>{{$data->nim}}</td>
                                      <td>{{$data->nama}}</td>
                                      <td>
                                        @if($data->active == true)
                                          @php echo "Belum Dikembalikan"; @endphp
                                        @else
                                            @php echo "Sudah Dikembalikan"; @endphp
                                        @endif
                                      </td>
                                      <td>{{$data->tanggal_pinjam}}</td>
                                      <td>
                                        <a class="btn btn-danger btn-fill" data-toggle="modal" data-target="#view{{$data->id_peminjaman}}" href="#view{{$data->id}}">
                                            Show
                                        </a>

                                            <!-- Mini Modal -->
                                            <div class="modal fade modal modal-primary" id="view{{$data->id_peminjaman}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="col-md-12" style="padding-top: 5%;">
                                                    <div class="card">
                                                        <div class="card-header ">
                                                            <h4 class="card-title">More</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="description text-center" style="text-align:center;">
                                                              <table>
                                                                <tr>
                                                                  <td>Tanggal Kembali</td>
                                                                  <td>:</td>
                                                                  <td>{{$data->tanggal_kembali}}</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Durasi</td>
                                                                  <td>:</td>
                                                                  <td>{{$data->durasi}} Hari</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Action</td>
                                                                  <td>:</td>
                                                                  <td>
                                                                    @if($data->active == true)
                                                                      <a href="/peminjaman/pengembalian/{{$data->id}}" class="btn btn-danger" style="margin-right: 2px;">Kembalikan</a>
                                                                    @endif
                                                                  </td>
                                                                </tr>
                                                              </table>
                                                            </p>
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
