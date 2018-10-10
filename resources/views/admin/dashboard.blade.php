@extends('admin.layouts.app')

@section('content')

<script>
      window.onload = function () {
      //pengguna ioms
      var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      // title:{
      // text: "Data Keanggotaan HMSI",
      // horizontalAlign: "left"
      // },
      data: [{
      type: "doughnut",
      startAngle: 300,
      //innerRadius: 60,
      indexLabelFontSize: 14,
      indexLabel: "{label} - {jumlah} orang",
      toolTipContent: "<b>{label}:</b> #percent% ",
      dataPoints: [
        { y: {{$_admin}}, label: "Admin", jumlah: {{$admin}} },
        { y: {{$_pengurus}}, label: "Pengurus", jumlah: {{$pengurus}} },
        { y: {{$_anggota}}, label: "Anggota", jumlah: {{$anggota}} }
      ]
      }]
      });
      chart.render();

      //pengurus tidak piket
      var chart = new CanvasJS.Chart("chartContainer1", {
      animationEnabled: true,
      axisY: {
    		title: "Rupiah",
    		titleFontSize: 18
    	},
      data: [{
      type: "column",
      //innerRadius: 60,
      indexLabelFontSize: 14,
      dataPoints: [
        @php $x=1; @endphp
        @foreach($piketHarian as $data)
  			{ x: {{$x}}, y: @php $akumulasi = ($data->total_denda + $data->denda_lain) - $data->sudah_dibayar; echo $akumulasi; @endphp, label:"{{$data->nama}}"},
        @php $x++; @endphp
        @endforeach
  		]
      }]
      });
      chart.render();

    }
</script>

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                  <h4 style="margin-left:5%;"><strong>Pengguna Terdaftar</strong></h4>
                  <div style="margin:5%">
                      <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </div>
                </div>
            </div>

            <div class="col-md-6">
              <div class="card ">
                <h4 style="margin-left:5%;"><strong>Total Anggota</strong></h4>
                <div style="margin:5%">
                  <div class="card card-tasks">
                    <div class="card-body ">
                      <div>
                        <table>
                          <tbody>
                            @php
                            for($x = intval(substr(\Config::get('ioms.dashboard.nim.angkatanTermuda'),2,3));$x >= intval(substr(\Config::get('ioms.dashboard.nim.angkatanTertua'),2,3));$x--){
                              if($nim[$x]!=0){
                                echo '
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Angkatan 20'.$x.' = '.$nim[$x].' orang</td>
                                </tr>
                                ';
                              }
                            }
                            @endphp
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                  <h4 style="margin-left:5%;"><strong>Denda Pengurus Piket</strong></h4>
                  <div style="margin:5%">
                      <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
