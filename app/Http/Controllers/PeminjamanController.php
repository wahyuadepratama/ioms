<?php

namespace App\Http\Controllers;

use App\Peminjam;
use Carbon\Carbon;
use App\Inventaris;
use App\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
  public function __construct(){ // -------------------------------------------- construct()
      $this->middleware('auth');
      $this->middleware('admin-pengurus');
  }

  public function index($id){ // -------------------------------------------- index($id)
    return view('admin.peminjaman-add')->with('id',$id);
  }

  public function showAll(){ // -------------------------------------------- showAll()
    $peminjaman = Peminjaman::join('peminjam','peminjaman.id_peminjam','=','peminjam.id')
              ->join('inventaris','peminjaman.id_inventaris','=','inventaris.id')
              ->select('peminjaman.*','peminjaman.id as id_peminjaman','peminjam.*','peminjam.nama as nama_peminjam','inventaris.*')
              ->get();
    return view('admin.peminjaman',['peminjaman'=>$peminjaman]);
  }

  public function validator(array $data){ // -------------------------------------------- validator($data)
      return Validator::make($data, [
          'nama' => 'required|string|max:191',
          'nim' => 'required|digits:10',
          'durasi' => 'required|numeric',
          'tanggal_pinjam' => 'required',
      ]);
  }

  public function store(Request $request){ // -------------------------------------------- store($request)
    $this->validator($request->all())->validate();
    $time = $request->tanggal_pinjam;
    $date = Carbon::createFromFormat('d/m/Y', $time);
    $peminjam = Peminjam::create([
        'nama' => $request->nama,
        'nim' => $request->nim,
        'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
    ]);
    Peminjaman::create([
      'id_peminjam' => $peminjam->id,
      'id_inventaris' => $request->id,
      'durasi' => $request->durasi,
      'active' => true,
      'tanggal_pinjam' => $date,
      'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
    ]);
    $inventaris = Inventaris::find($request->id);
    $inventaris->status = 'Dipinjamkan';
    $inventaris->updated_at = Carbon::now()->setTimezone('Asia/Jakarta');
    $inventaris->save();
    return redirect('inventaris')->with('success','Peminjam baru berhasil ditambahkan!');
  }

  public function updatePengembalian($id){ // -------------------------------------------- updatePengembalian()
    $peminjaman = Peminjaman::find($id);
    $peminjaman->active = false;
    $peminjaman->tanggal_kembali = Carbon::now()->setTimezone('Asia/Jakarta');
    $peminjaman->updated_at = Carbon::now()->setTimezone('Asia/Jakarta');
    $peminjaman->save();
    return redirect('peminjaman')->with('success','Inventaris telah dikembalikan');
  }

}
