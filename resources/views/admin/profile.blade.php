@extends('admin.layouts.app')

@section('content')
  @foreach($anggota as $data)
  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Profile</h4>
                      </div>
                      <div class="card-body">
                            <div class="row" style="padding: 1%;">
                                <div class="col-md-3">
                                  Nama
                                </div>
                                <div class="col-md-1">
                                  :
                                </div>
                                <div class="col-md-8">
                                  {{$data->nama}}
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
                                  No. Anggota
                                </div>
                                <div class="col-md-1">
                                  :
                                </div>
                                <div class="col-md-8">
                                  {{$data->no_anggota}}
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
                                  No. Handphone
                                </div>
                                <div class="col-md-1">
                                  :
                                </div>
                                <div class="col-md-8">
                                  {{$data->no_handphone}}
                                </div>
                            </div>

                            <div class="row" style="padding: 1%;">
                                <div class="col-md-3">
                                  Tempat / Tanggal Lahir
                                </div>
                                <div class="col-md-1">
                                  :
                                </div>
                                <div class="col-md-8">
                                  @if($data->tempat_lahir != NULL && $data->tanggal_lahir != NULL)
                                  {{$data->tempat_lahir}} / {{$data->tanggal_lahir}}
                                  @endif
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
                                  {{$data->alamat}}
                                </div>
                            </div>

                          <form action="profile/edit" method="get"><br>
                              <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
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
                                  <img class="avatar border-gray" src="{{ asset('images/avatar/'.$data->avatar) }}" alt="...">
                                  <h5 class="title">{{$data->nama}}</h5>
                              </a>
                          </div>
                          <p class="description text-center">
                            @if($data->kutipan != NULL)
                              <i>"{{$data->kutipan}}"</i>
                            @else
                              <i>Lengkapi Data Kamu!</i>
                            @endif
                          </p>
                      </div>
                      <hr>
                      <div class="button-container mr-auto ml-auto">
                        Status : {{$data->role_name}}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endforeach

@endsection
