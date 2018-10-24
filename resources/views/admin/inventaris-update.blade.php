@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Inventaris</h4>
                    </div>
                    <div class="card-body">
                      <form action="/inventaris/update" method="post">

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Kode
                            </div>
                            <div class="col-md-8">
                              <input type="text" class="form-control" value="{{$data->kode}}" disabled>                              
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Nama
                            </div>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
                              <input type="hidden" name="id" value="{{$data->id}}">
                              @if ($errors->has('nama'))
                                  <small><i>{{$errors->first('nama')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Jenis Inventaris
                            </div>
                            <div class="col-md-8">
                              <select class="form-control" name="id_jenis">
                                @foreach($jenis as $isi)
                                <option value="{{$isi->id_jenis}}">{{$isi->nama_jenis}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Kondisi
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
                            <div class="col-md-8">
                              <input type="number" class="form-control" name="qty" value="{{$data->qty}}">
                              @if ($errors->has('qty'))
                                  <small><i>{{$errors->first('qty')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Keterangan
                            </div>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="keterangan" value="{{$data->keterangan}}">
                              @if ($errors->has('keterangan'))
                                  <small><i>{{$errors->first('keterangan')}}</i></small>
                              @endif
                            </div>
                        </div>

                        {{csrf_field()}}<br>
                        <button type="submit" class="btn btn-info pull-right">Update Inventaris</button>
                        <a href="/inventaris" class="btn btn-danger btn-fill">Back</a>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
