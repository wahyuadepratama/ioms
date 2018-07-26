@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Inventaris HMSI</h4>
                        <p class="card-category">Daftar Inventaris HMSI</p>
                    </div>
                    <div class="card-header">
                      <a href="/inventaris/create" class="btn btn-info ">Tambah Inventaris</a>
                      <a href="/inventaris/peminjaman" class="btn btn-warning pull-right">Peminjaman Inventaris</a>
                    </div>
                    <div class="card-body">
                      <div class="card-body table-full-width table-responsive">

                          <!-- just for datatable -->
                          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                          <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
                          <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
                          <!-- just for datatable -->

                          <table class="table table-hover table-striped" id="table_id">
                              <thead>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th>Jenis</th>
                                  <th>Status</th>
                                  <th>Kondisi</th>
                                  <th>Jumlah</th>
                                  <th>More</th>
                                  <th>Action</th>

                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($inventaris as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{$data->nama}}</td>
                                      <td>{{$data->nama_jenis}}</td>
                                      <td>{{$data->status}}</td>
                                      <td>{{$data->kondisi}}</td>
                                      <td>{{$data->qty}}</td>
                                      <td>
                                        <a class="btn btn-warning btn-fill" data-toggle="modal" data-target="#view{{$data->id}}" href="#view{{$data->id}}">
                                            view
                                        </a>&nbsp

                                            <!-- Mini Modal -->
                                            <div class="modal fade modal modal-primary" id="view{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card card-user">
                                                            <div class="card-body">
                                                                <p class="description text-center" style="text-align:center;">
                                                                    <ul>
                                                                      <small>Keterangan Jenis : {{$data->keterangan_jenis}}</small>
                                                                    </ul>
                                                                    <ul>
                                                                      <small>Keterangan Inventaris : {{$data->keterangan}}</small>
                                                                    </ul>
                                                                    <ul>
                                                                      <small>Tanggal Input : {{$data->created_at}}</small>
                                                                    </ul>
                                                                    <ul>
                                                                      <small>Tanggal Diubah : {{$data->updated_at}}</small>
                                                                    </ul>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  End Modal -->

                                      </td>
                                      <td>
                                        <a href="/inventaris/delete/{{$data->id}}" class="btn btn-danger pull-right" style="margin-right: 2px;" >Delete</a>
                                        <a href="/inventaris/update/{{$data->id}}" class="btn btn-info">Update</a>
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
