<!--   Core JS Files   -->
<script src="{{URL::asset('admin-panel/assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('admin-panel/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('admin-panel/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{URL::asset('admin-panel/assets/js/plugins/bootstrap-switch.js')}}"></script>

<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

<!--  Chartist Plugin  -->
<script src="{{URL::asset('admin-panel/assets/js/plugins/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{URL::asset('admin-panel/assets/js/plugins/bootstrap-notify.js')}}"></script>

<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{URL::asset('admin-panel/assets/js/light-bootstrap-dashboard.js?v=2.0.1')}}" type="text/javascript"></script>

<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{URL::asset('admin-panel/assets/js/demo.js')}}"></script>

<!-- untuk datatable -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>

<script type="text/javascript">

  demo.initDashboardPageCharts();

  function message(){
    @if($message = Session::get('success'))
      demo.showNotification('top','right','{{ $message }}');
    @elseif($errors->first())
      demo.showNotification('top','right','Error ! Sepertinya ada sesuatu yang salah..');
    @else
      var x = Math.floor((Math.random() * 5) + 1);

      if(x == 1){
        demo.showNotification('top','right','Welcome {{Auth::user()->nama}}')
      }else if(x == 2){
        demo.showNotification('top','right','Jangan lupa lengkapi profile kamu {{Auth::user()->nama}}');
      }else if(x == 3){
        demo.showNotification('top','right','Selamat Datang di IOMS HMSI');
      }else if(x == 4){
        demo.showNotification('top','right','Untuk peminjaman inventaris jangan lupa hubungi pengurus HMSI');
      }else if(x == 5){
        demo.showNotification('top','right','Profile digunakan untuk melengkapi pendataan anggota HMSI');
      }

    @endif
  }
</script>
