@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">User Management</h4>
                        <p class="card-category">Daftar user yang ada beserta profile nya</p>
                    </div>
                    <div class="card-body">
                      <div class="card-body table-full-width table-responsive">

                          <!-- just for datatable -->
                          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                          <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
                          <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
                          <!-- just for datatable -->

                          <table class="table table-hover table-striped" id="table_id2">
                              <thead>
                                  <th>ID</th>
                                  <th>NIM</th>
                                  <th>Nama</th>
                                  <th>Roles</th>
                                  <th>Action</th>

                              </thead>
                              <tbody>
                                @foreach($users as $data)
                                  <tr>
                                      <td>{{$data->id}}</td>
                                      <td>{{$data->nim}}</td>
                                      <td>{{$data->nama}}</td>
                                      <td>{{$data->role_name}}</td>
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
                                                                        {{$data->email}}
                                                                    </p>
                                                                    <p class="description">
                                                                        {{$data->no_handphone}}
                                                                    </p>
                                                                    <p class="description">
                                                                      {{$data->alamat}}
                                                                    </p>
                                                                    <p class="description">
                                                                      <i>{{$data->kutipan}}</i>
                                                                    </p>
                                                                </div>
                                                                <p class="description text-center">
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
                                        <a class="btn btn-fill" href="/user-management/config/{{$data->id}}"><li class="fa fa-cogs"></li></a>&nbsp;
                                        <a class="btn btn-danger btn-fill" data-toggle="modal" data-target="#delete{{$data->id}}" href="#delete{{$data->id}}"><li class="fa fa-times"></li></a>&nbsp;

                                        <div class="modal fade modal modal-primary" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header justify-content-center">
                                                      <div class="modal-profile">
                                                          <i class="nc-icon nc-bulb-63"></i>
                                                      </div>
                                                  </div>
                                                  <div class="modal-body text-center">
                                                      <p>Apakah anda yakin user ini akan diblokir?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form action="/user-management/delete/{{$data->id}}" method="post">
                                                      <button type="submit" class="btn btn-link btn-simple">Ya</button>
                                                      <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
                                                      {{csrf_field()}}
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                      </td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                          <script type="text/javascript">
                            $(document).ready( function () {
                              $('#table_id2').DataTable();
                            } );
                          </script>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">User Blokir</h4>
                        <p class="card-category">Daftar user yang telah diblokir</p>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-striped">
                          <thead>
                              <th>Nama</th>
                              <th>Action</th>
                          </thead>
                          <tbody>
                            @foreach($deletedUsers as $data)
                              <tr>
                                <td>{{$data->nama}}</td>
                                <td>
                                  <form action="/user-management/restore/{{$data->id}}" method="post">
                                    <button type="submit" class="btn btn-primary btn-fill" name="button">Buka Blokir</button>
                                    {{csrf_field()}}
                                  </form>
                                </td>
                                <td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>

        </div>
    </div>
</div>
@endsection
