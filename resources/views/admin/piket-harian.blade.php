@extends('admin.layouts.app')

@section('content')

  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Piket Harian Pengurus HMSI</h4>
                      </div>

                      @if($status == "sudah piket")
                      <div class="card-body">
                            <div class="row" style="padding-left: 3%;">
                                Terima kasih ^_^ anda sudah mengambil absensi piket hari ini!
                            </div>
                      </div>
                      @endif

                      @if($status == "tidak piket")
                      <div class="card-body">
                            <div class="row" style="padding-left: 3%;">
                                Anda tidak piket hari ini!
                            </div>
                      </div>
                      @endif

                      @if($status == "piket")
                      <form action="/piket-harian/piket/{{$denda}}/{{$pengurus_piket}}" method="post">
                        <div class="card-body">
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Status </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> Anda piket, silahkan kerjakan tanggung jawab anda! </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Denda Hari Ini </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> Rp. {{$denda}} </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Keterangan</div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> <textarea name="keterangan" placeholder="ex: saya terlambat karena kuliah x dan kuliah y..." rows="5" cols="30"></textarea> </div>
                          </div>
                          {{csrf_field()}}
                          <button type="submit" class="btn btn-danger btn-fill pull-right">Saya sudah piket</button>
                          <div class="clearfix"></div>
                        </div>
                      </form>
                      @endif
                  </div>
              </div>
              <div class="col-md-6">
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Hari Piket</th>
                            <th>Nama Pengurus</th>
                            <th>Total Denda</th>
                        </thead>
                        <tbody>
                          @php
                            $count = count($senin);
                            $stop = false;
                          @endphp
                          @foreach($data as $data)
                            <tr>
                              @if($stop == false)
                                <td rowspan="{{$count}}">Senin</td>
                                @php $stop = true @endphp
                              @endif
                              @if($data->jadwal_piket == "Monday")
                                <td>{{$senin->nama}}</td>
                                <td>{{$senin->denda}}</td>
                              @endif
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>

          </div>
      </div>
  </div>

@endsection
