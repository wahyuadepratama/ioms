@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Peminjaman Inventaris</h4>
                    </div>
                    <div class="card-body">
                      <form action="/inventaris/peminjaman/store" method="post">

                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Nama Peminjam
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
                              NIM Peminjam
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="nim">
                              @if ($errors->has('nim'))
                                  <small><i>{{$errors->first('nim')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Durasi
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-2">
                              <input type="number" class="form-control" name="durasi">
                              @if ($errors->has('durasi'))
                                  <small><i>{{$errors->first('durasi')}}</i></small>
                              @endif
                            </div>
                            <div class="col-md-2">
                              Hari
                            </div>
                        </div>

                        <div class="row" style="padding: 1%;">
                            <div class="col-md-3">
                              Phone
                            </div>
                            <div class="col-md-1">
                              :
                            </div>
                            <div class="col-md-4">
                              <input type="text" class="form-control" name="contact">
                              @if ($errors->has('contact'))
                                  <small><i>{{$errors->first('contact')}}</i></small>
                              @endif
                            </div>
                        </div>

                        <!-- <link href="{{ URL::asset('datepicker/dcalendar.picker.css')}}" rel="stylesheet">
                        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                        <script src="{{ URL::asset('datepicker/dcalendar.picker.js')}}"></script>
                        <script>
                          $('#demo').dcalendarpicker();
                          $('#calendar-demo').dcalendar(); //creates the calendar
                        </script> -->

                        {{csrf_field()}}<br>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Pinjam Inventaris</button>
                      </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
