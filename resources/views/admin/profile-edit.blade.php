@extends('admin.layouts.app')

@section('content')

@foreach($anggota as $data)
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Profile</h4>
                    </div>
                    <div class="card-body">
                      <form action="/profile/store" method="post">
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Nama
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: wahyu ade pratama" name="nama" value="{{$data->nama}}">
                                @if ($errors->has('nama'))
                                    <small><i>{{$errors->first('nama')}}</i></small>
                                @endif
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                NIM
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: 1511521024" name="nim" value="{{$data->nim}}">
                                @if ($errors->has('nim'))
                                    <small><i>{{$errors->first('nim')}}</i></small>
                                @endif
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                No. Anggota
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: SI06 AB-001" name="no_anggota" value="{{$data->no_anggota}}">
                                @if ($errors->has('no_anggota'))
                                    <small><i>{{$errors->first('no_anggota')}}</i></small>
                                @endif
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Email
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: saya@hmsiunand.com" name="email" value="{{$data->email}}">
                                @if ($errors->has('email'))
                                    <small><i>{{$errors->first('email')}}</i></small>
                                @endif
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                No. Handphone
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: 08123456789" name="no_handphone" value="{{$data->no_handphone}}">
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                                Alamat
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: sekreteariat HMSI" name="alamat" value="{{$data->alamat}}">
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                                Kutipan
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: 'Hidup itu indah, jadi jalani saja'" name="kutipan" value="{{$data->kutipan}}">
                              </div>
                          </div>
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Now</button>
                            <div class="clearfix"></div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="{{ asset('storage/avatar/'.$data->avatar) }}" alt="...">
                                <h5 class="title">{{$data->nama}}</h5>
                            </a>
                        </div>
                        <form action="/profile/store-password" method="post">
                          New Password : <input type="password" class="form-control" placeholder="new password" name="password">
                          @if ($errors->has('password'))
                              <small><i>{{$errors->first('password')}}</i></small>
                          @endif<br>
                          Confirm Password : <input type="password" class="form-control" placeholder="confirm password" name="password_confirmation"><br>
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger btn-fill pull-right">Change Password</button>
                            <div class="clearfix"></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
