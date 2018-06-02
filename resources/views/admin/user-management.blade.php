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
                          <table class="table table-hover table-striped">
                              <thead>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Username</th>
                                  <th>Action</th>

                              </thead>
                              <tbody>
                                @foreach($users as $data)
                                  <tr>
                                      <td>{{$data->id}}</td>
                                      <td>{{$data->name}}</td>
                                      <td>{{$data->username}}</td>
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
                                                                        <h5 class="title">{{$data->name}}</h5>
                                                                    </a>
                                                                    <p class="description">
                                                                        {{$data->email}}
                                                                    </p>
                                                                </div>
                                                                <p class="description text-center">
                                                                    <ul>
                                                                      Account Created : {{$data->created_at}}
                                                                    </ul>
                                                                    <ul>
                                                                      Account Updated : {{$data->updated_at}}
                                                                    </ul>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  End Modal -->

                                        <a href="#"><button type="submit" class="btn btn-info btn-fill pull-right "><li class="fa fa-edit"></li></button></a>&nbsp;
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
                                                      <p>Apakah anda yakin user ini akan dihapus?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form action="/admin/user-management/delete/{{$data->id}}" method="post">
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
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">User Deleted</h4>
                        <p class="card-category">Daftar user yang telah dihapus</p>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-striped">
                          <thead>
                              <th>Username</th>
                              <th>Action</th>
                          </thead>
                          <tbody>
                            @foreach($deletedUsers as $data)
                              <tr>
                                <td>{{$data->username}}</td>
                                <td>
                                  <form action="/admin/user-management/restore/{{$data->id}}" method="post">
                                    <button type="submit" class="btn btn-primary btn-fill" name="button">restore</button>
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
