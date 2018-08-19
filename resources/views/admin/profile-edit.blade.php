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
                      <form action="/profile/store" method="post" enctype="multipart/form-data">
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
                                {{$data->nim}}
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
                                {{$data->email}}
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                No. Anggota
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="ex: SI06 AB-001" name="no_anggota" value="{{$data->no_anggota}}">
                                @if ($errors->has('no_anggota'))
                                    <small><i>{{$errors->first('no_anggota')}}</i></small>
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
                              <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="ex: 08123456789" name="no_handphone" value="{{$data->no_handphone}}">
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Tempat Lahir
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="ex: wahyu ade pratama" name="tempat_lahir" value="{{$data->tempat_lahir}}">
                                @if ($errors->has('tempat_lahir'))
                                    <small><i>{{$errors->first('tempat_lahir')}}</i></small>
                                @endif
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Tanggal Lahir
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-4">
                                <input type="text" id="demo" class="form-control" placeholder="ex: wahyu ade pratama" name="tanggal_lahir">
                                @if ($errors->has('tanggal_lahir'))
                                    <small><i>{{$errors->first('tanggal_lahir')}}</i></small>
                                @endif
                              </div>
                          </div>
                                        <link href="{{ URL::asset('datepicker/dcalendar.picker.css')}}" rel="stylesheet">
                                        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                                        <script src="{{ URL::asset('datepicker/dcalendar.picker.js')}}"></script>
                                        <script>
                                          $('#demo').dcalendarpicker();
                                          $('#calendar-demo').dcalendar(); //creates the calendar
                                        </script>

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
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Avatar
                              </div>
                              <div class="col-md-1">
                                :
                              </div>
                              <div class="col-md-8">
                                <input type="file" name="avatar" ><br>
                                @if ($errors->has('avatar'))
                                    <small><i>{{$errors->first('avatar')}}</i></small>
                                @endif
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
