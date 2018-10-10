@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            @php if($anggota->id_role == 2){ @endphp
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ubah Jadwal Piket {{$anggota->nama}}</h4>
                    </div>
                    <div class="card-body">
                      <form action="/user-management/config/store" method="post">
                        <input type="hidden" name="id" value="{{$anggota->id}}">
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Jadwal Piket Harian
                              </div>
                              <div class="col-md-8">
                                <select class="form-control" name="jadwal_piket">
                                  <option value="{{$piketHarian->jadwal_piket}}" selected>{{$piketHarian->jadwal_piket}}</option>
                                  <option value="Monday">Monday</option>
                                  <option value="Tuesday">Tuesday</option>
                                  <option value="Wednesday">Wednesday</option>
                                  <option value="Thursday">Thursday</option>
                                  <option value="Friday">Friday</option>
                                  <option value="Saturday">Saturday</option>
                                  <option value="Sunday">Sunday</option>
                                </select>
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Total Tenda
                              </div>
                              <div class="col-md-8">
                                &nbsp;&nbsp; Rp. {{ $akumulasi }}
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Denda Piket Harian
                              </div>
                              <div class="col-md-8">
                                &nbsp;&nbsp; Rp. {{ $piketHarian->total_denda }}
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Denda Lain
                              </div>
                              <div class="col-md-8">
                                <input type="number" name="denda_lain" value="{{ $piketHarian->denda_lain }}" class="form-control">
                                <small><i>*Akumulasikan total denda lama + total denda baru untuk mengisi field ini</i></small>
                              </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3">
                                Sudah Dibayar
                              </div>
                              <div class="col-md-8">
                                <input type="number" name="sudah_dibayar" value="{{ $piketHarian->sudah_dibayar }}" class="form-control">
                              </div>
                          </div>
                            {{csrf_field()}}<br>
                            <button type="submit" class="btn btn-info btn-fill  ">Simpan Perubahan</button>
                            <a class="btn btn-danger btn-fill" href="/user-management/reset-password/{{$anggota->id}}">Reset Password</a>&nbsp;
                            <a class="btn btn-warning btn-fill" href="/user-management">Batal</a>&nbsp;
                            <div class="clearfix"></div>
                        </form>

                    </div>
                </div>
            </div>
            @php }else{ @endphp
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reset Password {{$anggota->nama}}</h4>
                </div>
                <div class="card-body">
                  <a class="btn btn-danger btn-fill" href="/user-management/reset-password/{{$anggota->id}}">Reset Password</a>&nbsp;
                  <a class="btn btn-warning btn-fill" href="/user-management">Batal</a>&nbsp;
                </div>
              </div>
            </div>
            @php } @endphp

            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ganti Role Anggota</h4>
                </div>
                <div class="card-body">
                  <form action="/user-management/change-role/{{$anggota->id}}" method="post">
                    <div class="row">
                      <select class="form-control" name="role" style="margin-left:3%;margin-right:3%;margin-bottom:3%">
                        <option value="none" selected>Pilih Role</option>
                        <option value="2">Pengurus</option>
                        <option value="3">Anggota</option>
                      </select>
                    </div>
                    {{csrf_field()}}
                    <button class="btn btn-danger btn-fill" href="">Ganti Role</button>&nbsp;
                  </form>
                </div>
              </div>
            </div>

        </div>
    </div>
</div>
@endsection
