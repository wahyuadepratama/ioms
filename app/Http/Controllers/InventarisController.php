<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Inventaris;
use App\JenisInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventarisController extends Controller
{
  public function __construct(){ //-------------------------------------------------------------------- construct()
      $this->middleware('auth');
      $this->middleware('admin-pengurus');
  }

  public function index(){ // -------------------------------------------------------------------- index()
    $inventaris = Inventaris::join('jenis_inventaris','jenis_inventaris.id_jenis','=','inventaris.id_jenis')
              ->select('inventaris.*','jenis_inventaris.*')
              ->get();
    return view('admin.inventaris',['inventaris'=>$inventaris]);
  }

  public function validator(array $data){ // -------------------------------------------------------------------- validator($data)
      return Validator::make($data, [
          'nama' => 'required|string|max:191',
          'kode' => 'required|unique:inventaris',
          'kondisi' => 'required|string',
          'qty' => 'required|integer',
      ]);
  }

  public function create(){ // -------------------------------------------------------------------- create()
    $jenis = JenisInventaris::all();
    return view('admin.inventaris-add',['jenis'=>$jenis]);
  }

  public function store(Request $request){ // -------------------------------------------------------------------- store($request)
    $this->validator($request->all())->validate();
    Inventaris::create([
        'nama' => $request->nama,
        'id_jenis' => $request->id_jenis,
        'status' => 'Tersedia',
        'kondisi' => $request->kondisi,
        'keterangan' => $request->keterangan,
        'qty' => $request->qty,
        'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
        'kode' => $request->kode,
    ]);
    return redirect('inventaris')->with('success','Inventaris Berhasil Ditambah!');
  }

  public function update($id){ // -------------------------------------------------------------------- update($id)
    $data = Inventaris::find($id);
    $jenis = JenisInventaris::all();
    return view('admin.inventaris-update',['data'=>$data, 'jenis'=>$jenis]);
  }

  public function validatorUpdate(array $data){ // -------------------------------------------------------------------- validator($data)
      return Validator::make($data, [
          'nama' => 'required|string|max:191',
          'kondisi' => 'required|string',
          'qty' => 'required|integer',
      ]);
  }

  public function storeUpdate(Request $request){ //-------------------------------------------------------------------- storeUpdate($request)
    $this->validatorUpdate($request->all())->validate();
    $inventaris = Inventaris::find($request->id);
    $inventaris->nama = $request->nama;
    $inventaris->id_jenis = $request->id_jenis;
    $inventaris->keterangan = $request->keterangan;
    $inventaris->qty = $request->qty;
    $inventaris->updated_at = Carbon::now()->setTimezone('Asia/Jakarta');
    $inventaris->save();
    return redirect('inventaris')->with('success','Inventaris Berhasil Diubah!');
  }

  public function delete($id){ // -------------------------------------------------------------------- delete($id)
    $inventaris = Inventaris::find($id);
    $inventaris->delete();
    return redirect('inventaris')->with('success','Inventaris Berhasil Dihapus!');
  }

  public function storeJenis(Request $request){ //-------------------------------------------------------------------- storeJenis($request)
    JenisInventaris::create([
        'nama_jenis' => $request->nama_jenis,
        'keterangan_jenis' => $request->keterangan_jenis,
        'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
    ]);
    return redirect('inventaris/create')->with('success','Jenis Inventaris Berhasil Ditambah!');
  }

  public function deleteJenis($id){ //-------------------------------------------------------------------- deleteJenis($id)
    $jenis = JenisInventaris::where('id_jenis',$id);
    $jenis->delete();
    return redirect('inventaris/create')->with('success','Jenis Inventaris Berhasil Dihapus!');
  }

}
