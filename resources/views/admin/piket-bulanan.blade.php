@extends('admin.layouts.app')

@section('content')

  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Piket Blog Pengurus HMSI</h4>
                      </div>

                      @if($status == "didenda")
                      <div class="card-body">
                        <div class="row alert alert-danger" style="margin:1%;">
                            Kamu terlambat melakukan postingan, kamu sudah terkena denda!
                        </div>
                      </div>
                      @endif

                      @if($status == "sudah piket")
                      <div class="card-body">
                        <div class="row alert alert-warning" style="margin:1%;">
                            Kamu sudah melakukan postingan Blog, terima kasih ^_^
                        </div>
                      </div>
                      @endif

                      @if($status == "tidak piket")
                      <div class="card-body">
                        <div class="row alert alert-danger" style="margin:1%;">
                            Kamu tidak piket pada bulan ini, silahkan cek jadwal piket di bawah
                        </div>
                      </div>
                      @endif

                      @if($status == "piket")

                      <form action="/piket-blog/piket" method="post">
                        <div class="card-body">
                          <div class="row">
                              <div class="col-md-3"> Status </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> Belum Piket </div>
                          </div>
                          <div class="row">
                              <div class="col-md-3"> Keterangan </div>
                              <div class="col-md-1"> : </div>
                              <div class="col-md-8"> Silahkan lakukan postingan di <a href="http://blog.hmsiunand.com">Blog HMSI</a> </div>
                          </div>
                          <div class="row">
                            <div style="color:red;padding-left:2%;padding-right:2%;">
                              <i><small><span>Notes: Pastikan kamu mengambil absensi piket blog <b>setelah melakukan postingan</b>, jika tidak maka status denda akan menjadi <b>2x lipat !</b></span></small></i>
                            </div>
                          </div>
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
                      Ketentuan Piket Blog HMSI
                    </div>
                    <div class="card-body">
                      <style media="screen">table{border-collapse: collapse;}tr{border-bottom: 1pt solid #3333331c;}</style>
                        <small>
                          <table>
                            <tbody>
                              <tr>
                                <td><li></li></td>
                                <td>Buatlah sebuah postingan pada <a href="http://blog.hmsiunand.com">blog HMSI</a> sebelum melakukan absensi piket blog </td>
                              </tr>
                              <tr>
                                <td> <li></li> </td>
                                <td>Jika kamu belum pernah melakukan postingan sebelumnya, lakukan registrasi terlebih dahulu pada website HMSI dengan membuka link: <a href="http://blog.hmsiunand.com/index.php/register/">registrasi</a> </td>
                              </tr>
                              <tr>
                                <td><li></li></td>
                                <td>Jika sudah melakukan registrasi, sampaikan kepada salah satu anggota divisi IT agar akun di approve</td>
                              </tr>
                              <tr>
                                <td><li></li></td>
                                <td>Postingan yang dibuat dapat berupa informasi IT, tutorial, berita ataupun informasi mengenai HMSI dan divisi di kepengurusan</td>
                              </tr>
                              <tr>
                                <td><li></li></td>
                                <td>Denda bagi pengurus yang tidak melakukan piket blog akan disepakati oleh forum</td>
                              </tr>
                            </tbody>
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
                            <th>Bulan Piket</th>
                            <th>Nama Pengurus</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                          @foreach($data as $isi)
                          <tr>
                            <td>{{$isi->jadwal_posting}}</td>
                            <td>{{$isi->nama}}</td>
                            <td>{{$isi->status}}</td>
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
