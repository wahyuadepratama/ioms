@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Daftar Inventaris HMSI</h4>
                    </div>
                    @if(Auth::user()->id_role == 1)
                    <div class="card-header">
                      <a href="/inventaris/create" class="btn btn-info pull-right">Tambah Inventaris</a>
                    </div>
                    @endif
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
                                  <th>Kode</th>
                                  <th>Nama</th>
                                  <th>Jenis</th>
                                  <th>Status</th>
                                  <th>Kondisi</th>
                                  <th>Jumlah</th>
                                  <th>More</th>
                                  <th>Peminjaman</th>

                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($inventaris as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{ $data->kode }}</td>
                                      <td>{{$data->nama}}</td>
                                      <td>{{$data->nama_jenis}}</td>
                                      <td>{{$data->status}}</td>
                                      <td>{{$data->kondisi}}</td>
                                      <td>{{$data->qty}}</td>
                                      <td>
                                        <a class="btn btn-warning btn-fill" data-toggle="modal" data-target="#view{{$data->id}}" href="#view{{$data->id}}">
                                            Show
                                        </a>

                                            <!-- Mini Modal -->
                                            <div class="modal fade modal modal-primary" id="view{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                  <td>Keterangan</td>
                                                                  <td>:</td>
                                                                  <td>{{$data->keterangan}}</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Tanggal Input</td>
                                                                  <td>:</td>
                                                                  <td>{{$data->created_at}}</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Tanggal Diubah</td>
                                                                  <td>:</td>
                                                                  <td>{{$data->updated_at}}</td>
                                                                </tr>
                                                                @if(Auth::user()->id_role == 1)
                                                                <tr>
                                                                  <td>Action</td>
                                                                  <td>:</td>
                                                                  <td>
                                                                    <a href="/inventaris/delete/{{$data->id}}" class="btn btn-danger" style="margin-right: 2px;" >Delete</a>
                                                                    <a href="/inventaris/update/{{$data->id}}" class="btn btn-info" style="margin-right: 2px;">Update</a>
                                                                  </td>
                                                                </tr>
                                                                @endif
                                                              </table>
                                                            </p>
                                                        </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <!--  End Modal -->
                                      </td>
                                      <td><a href="/inventaris/peminjaman/{{$data->id}}" class="btn btn-danger">Pinjam</a></td>
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
