@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Inventaris</h4>
                    </div>
                    <div class="card-body">
                      <form action="/inventaris/store" method="post">

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Nama
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="nama">
                              @if ($errors->has('nama'))
                                  <small><i>{{$errors->first('nama')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Jenis Inventaris
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-8">
                              <select class="form-control" name="id_jenis">
                                @foreach($jenis as $data)
                                <option value="{{$data->id_jenis}}">{{$data->nama_jenis}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Kondisi
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-8">
                              <select class="form-control" name="kondisi">
                                <option value="Baik" selected>Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Sedang">Rusak Sedang</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                              </select>
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Jumlah Inventaris
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-8">
                              <input type="number" class="form-control" name="qty">
                              @if ($errors->has('qty'))
                                  <small><i>{{$errors->first('qty')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Keterangan
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="keterangan">
                              @if ($errors->has('keterangan'))
                                  <small><i>{{$errors->first('keterangan')}}</i></small>
                              @endif
                            </div>
                        </div>

                        {{csrf_field()}}<br>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Tambah Inventaris</button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jenis Inventaris</h4>
                    </div>
                    <div class="card-body">

                      <form action="/jenis-inventaris/store" method="post">
                        <div class="row" style="padding: 1%;">
                            <div class="col-md-4">
                              Nama
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-7">
                              <input type="text" class="form-control" name="nama_jenis">
                              @if ($errors->has('nama_jenis'))
                                  <small><i>{{$errors->first('nama_jenis')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-4">
                              Keterangan
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-7">
                              <input type="text" class="form-control" name="keterangan_jenis">
                              @if ($errors->has('keterangan'))
                                  <small><i>{{$errors->first('keterangan')}}</i></small>
                              @endif
                            </div>
                        </div>

                        {{csrf_field()}}<br>
                        <button type="submit" class="btn btn-warning btn pull-right">Tambah Jenis Inventaris</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-7">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Jenis Inventaris</h4>
                  </div>
                  <div class="card-body">

                      <table class="table table-hover table-striped" id="table_id">
                          <thead>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                          </thead>
                          <tbody>
                            @foreach($jenis as $data)
                            <tr>
                              <td>{{$data->nama_jenis}}</td>
                              <td>{{$data->keterangan_jenis}}</td>
                              <td> <a href="/jenis-inventaris/delete/{{$data->id_jenis}}" class="btn btn-danger">Delete</a> </td>
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
