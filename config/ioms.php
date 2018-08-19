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
      //Untuk EventListenerNotPiket.php ---------------------
      'waktu-piket-terakhir' => '15.00.00',
      'denda-piket-maksimal' => '15000',
        //Untuk PiketHarianController.php ---------------------
      'jam-mulai-piket' => 9, //satuan jam
      'menit-tambahan-mulai-piket' => 15, //satuan menit

      'denda-on-time' => 0, //satuan rupiah
      'denda-satu-jam' => 2000, //satuan rupiah
      'denda-dua-jam' => 4000, //satuan rupiah
      'denda-tiga-jam' => 6000, //satuan rupiah
      'denda-empat-jam' => 8000, //satuan rupiah
      'denda-lima-jam' => 10000, //satuan rupiah
      'denda-enam-jam' => 15000, //satuan rupiah
      'denda-diatas-enam-jam' => 15000 //satuan rupiah
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
