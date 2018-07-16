@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Anggota HMSI</h4>
                        <p class="card-category">Daftar Anggota HMSI</p>
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
                                  <th>NIM</th>
                                  <th>Nama</th>
                                  <th>No Handphone</th>
                                  <th>Email</th>
                                  <th>More</th>

                              </thead>
                              <tbody>
                                @php $no=1; @endphp
                                @foreach($users as $data)
                                  <tr>
                                      <td>{{$no}}</td>
                                      <td>{{$data->nim}}</td>
                                      <td>{{$data->nama}}</td>
                                      <td>{{$data->no_handphone}}</td>
                                      <td>{{$data->email}}</td>
                                      <td>
                                        <a class="btn btn-warning btn-fill" data-toggle="modal" data-target="#view{{$data->id}}" href="#view{{$data->id}}">
                                            view
                                        </a>&nbsp;

                                            <!-- Mini Modal -->
                                            <div class="modal fade modal modal-primary" id="view{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card card-user">
                                                            <div class="card-body">
                                                                <div class="author">
                                                                    <a href="#">
                                                                        <img class="avatar border-gray" src="/storage/avatar/{{$data->avatar}}" alt="...">
                                                                        <h5 class="title">{{$data->no_anggota}}</h5>
                                                                    </a>
                                                                    <p class="description">
                                                                        {{$data->alamat}}
                                                                    </p>
                                                                    <p><i>{{$data->kutipan}}</i></p>
                                                                </div>
                                                                <p class="description text-center" style="text-align:center;">
                                                                    <ul>
                                                                      <small>Account Created : {{$data->created_at}}</small>
                                                                    </ul>
                                                                    <ul>
                                                                      <small>Account Updated : {{$data->updated_at}}</small>
                                                                    </ul>
                                                                </p>
                                                            </div>
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
