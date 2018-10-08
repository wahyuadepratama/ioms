@extends('admin.layouts.app')

@section('content')

  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Piket Harian Pengurus HMSI</h4>
                      </div>

                      @if($status == "sudah piket")
                      <div class="card-body" >
                        <div class="row alert alert-warning" style="margin:1%;">
                            Terima kasih ^_^ kamu sudah mengambil absensi piket hari ini!
                        </div>
                      </div>
                      @endif

                      @if($status == "tidak piket")
                      <div class="card-body">
                        <div class="row alert alert-danger" style="margin:1%;">
                            Kamu tidak piket hari ini!
                        </div>
                      </div>
                      @endif

                      @if($status == "piket")
                      @php $bin=$denda; @endphp
                      <form id="form" action="/piket-harian/piket/{{$denda}}/{{$pengurus_piket}}" method="post">
                        <div class="card-body">
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Waktu </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> @php $now = Carbon\Carbon::now()->setTimezone('Asia/Jakarta'); echo $now->toTimeString();@endphp </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Status </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> Kamu piket, silahkan kerjakan tanggung jawabmu </div>
                          </div>
                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Denda Hari Ini </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8" id="denda"> Rp. {{$denda}} </div>
                          </div>

                          @if($denda != 0)
                          <div class="row" style="padding: 1%;">
                            <div class="col-md-3"> Izin Piket</div>
                            <div class="col-md-1"> : </div>
                            <table>
                              <tr>
                                <td>
                                  <div class="form-check">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="checkbox" onchange="handleChange(this);">
                                          <span class="form-check-sign"></span>
                                      </label>
                                  </div>
                                </td>
                                <td>Izin Terlambat</td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="form-check">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="checkbox" onchange="handleChange(this);">
                                          <span class="form-check-sign"></span>
                                      </label>
                                  </div>
                                </td>
                                <td>Izin Tidak Hadir</td>
                              </tr>
                            </table>
                          </div>
                          @endif

                          <script type="text/javascript">
                          function handleChange(checkbox) {
                            if(checkbox.checked == true){
                                @php $denda = 0; @endphp
                                document.getElementById("denda").innerHTML = "Rp. "+{{$denda}};
                                document.getElementById('form').action= "/piket-harian/piket/{{$denda}}/{{$pengurus_piket}}";
                            }else{
                                @php $denda = $bin; @endphp
                                document.getElementById("denda").innerHTML = "Rp. "+{{$denda}};
                                document.getElementById('form').action= "/piket-harian/piket/{{$denda}}/{{$pengurus_piket}}";
                           }
                          }
                          </script>

                          <div class="row" style="padding: 1%;">
                              <div class="col-md-3"> Keterangan</div>
                              <div class="col-md-1"> : </div>
                              <textarea class="col-md-7" style="border-radius:2%" name="keterangan" placeholder="Tulis keterangan izin disini.." rows="5" cols="30"></textarea>
                          </div><br>
                          {{csrf_field()}}
                          <button type="submit" class="btn btn-info btn-fill pull-right">Saya sudah piket</button>
                          <div class="clearfix"></div>
                        </div>
                      </form>
                      @endif
                  </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">
                      Ketentuan Piket Harian
                    </div>
                    <div class="card-body">
                      <small>
                        <style media="screen">table{border-collapse: collapse;}tr{border-bottom: 1pt solid #3333331c;}</style>
                        <table>
                          <tr>
                            <td> <li></li> </td>
                            <td>Absen piket diambil <b>paling lambat</b> jam 09.15 pagi</td>
                          </tr>
                          <tr>
                            <td><li></li></td>
                            <td>Pengurus yang terlambat mengambil absen akan di denda <b>Rp.2000/jam nya</b></td>
                          </tr>
                          <tr>
                            <td><li></li></td>
                            <td>Jika pengurus tidak mengambil absen sampai pada jam 15.00 maka dianggap tidak piket</td>
                          </tr>
                          <tr>
                            <td><li></li></td>
                            <td>Jumlah denda jika tidak piket adalah Rp.15.000</td>
                          </tr>
                          <tr>
                            <td><li></li></td>
                            <td><b>Tidak ambil absen</b> meskipun piket maka akan dianggap tidak piket</td>
                          </tr>
                          <tr>
                            <td><li></li></td>
                            <td>Jika pengurus yang piket <b>terlambat</b> karena kuliah maka tidak di denda, namun <b>harus</b> buatkan dengan jelas alasan kenapa terlambat di kolom keterangan</td>
                          </tr>
                          <tr>
                            <td><li></li></td>
                            <td>Jika pengurus yang piket berhalangan hadir ke kampus karena <b>sakit atau hal urgent lainnya</b> maka bisa di izinkan lewat PJ RTK, namun tetap harus mengambil absen dan dibuatkan keterangan izinnya agar denda tidak terhitung</td>
                          </tr>
                        </table>
                      </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Hari Piket</th>
                            <th>Nama Pengurus</th>
                            <th>Total Denda</th>
                        </thead>
                        <tbody>

                          @php
                            $count = count($data);
                            $stop = false;
                          @endphp
                          @foreach($data as $senin)
                            <tr>
                              @if($stop == false)
                                <td rowspan="{{$count}}">Senin</td>
                                @php $stop = true @endphp
                              @endif
                              @if($senin->jadwal_piket == "Monday")
                                <td>{{$senin->nama}}</td>
                                <td>{{$senin->total_denda}}</td>
                              @endif
                            </tr>
                          @endforeach

                          @php
                            $count = count($data);
                            $stop = false;
                          @endphp
                          @foreach($data as $selasa)
                            <tr>
                              @if($stop == false)
                                <td rowspan="{{$count}}">Selasa</td>
                                @php $stop = true @endphp
                              @endif
                              @if($selasa->jadwal_piket == "Tuesday")
                                <td>{{$selasa->nama}}</td>
                                <td>{{$selasa->total_denda}}</td>
                              @endif
                            </tr>
                          @endforeach

                          @php
                            $count = count($data);
                            $stop = false;
                          @endphp
                          @foreach($data as $rabu)
                            <tr>
                              @if($stop == false)
                                <td rowspan="{{$count}}">Rabu</td>
                                @php $stop = true @endphp
                              @endif
                              @if($rabu->jadwal_piket == "Wednesday")
                                <td>{{$rabu->nama}}</td>
                                <td>{{$rabu->total_denda}}</td>
                              @endif
                            </tr>
                          @endforeach

                          @php
                            $count = count($data);
                            $stop = false;
                          @endphp
                          @foreach($data as $kamis)
                            <tr>
                              @if($stop == false)
                                <td rowspan="{{$count}}">Kamis</td>
                                @php $stop = true @endphp
                              @endif
                              @if($kamis->jadwal_piket == "Thursday")
                                <td>{{$kamis->nama}}</td>
                                <td>{{$kamis->total_denda}}</td>
                              @endif
                            </tr>
                          @endforeach

                          @php
                            $count = count($data);
                            $stop = false;
                          @endphp
                          @foreach($data as $jumat)
                            <tr>
                              @if($stop == false)
                                <td rowspan="{{$count}}">Jumat</td>
                                @php $stop = true @endphp
                              @endif
                              @if($jumat->jadwal_piket == "Friday")
                                <td>{{$jumat->nama}}</td>
                                <td>{{$jumat->total_denda}}</td>
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
