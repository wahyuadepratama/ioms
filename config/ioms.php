<?php

return[
  //Untuk halaman app.blade.php ---------------------
  'role' => [
    '1' => 'Admin HMSI',
    '2' => 'Pengurus HMSI',
    '3' => 'Anggota HMSI'
  ],
  'piket' => [
    'harian' => [
      // //Untuk EventListenerNotPiket.php ---------------------
      'waktu-absen-sore' => '18.00.00',
      'waktu-absen-pagi' => '12.00.00',

      'denda-pagi' => 5000,
      'denda-sore' => 5000,
      'denda-pagi-sore' => 15000
    ]
  ],
  'dashboard' => [
    'nim' => [
      'angkatanTertua' => 2010,
      'angkatanTermuda'  => 2025
    ]
  ],

];


?>
