<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Models\Tabungan;
use App\Models\Transaksi;
use App\Models\Tagihan;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $q = $request->get('q');
        if($q == null){
            $siswa = Siswa::orderBy('created_at','desc')->paginate(15);
        }else{
            $siswa = Siswa::where('nama','like','%'.$q.'%')->orderBy('created_at','desc')->paginate(15);
        }
        return view('siswa.index', [
            'siswa' => $siswa->appends(Input::except('page'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.form', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|numeric',
            'nama' => 'required|max:255',
            'tempat_lahir' => 'nullable|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable',
        ]);

        $siswa = Siswa::make($request->input());

        if($siswa->save()){
            return redirect()->route('siswa.index')->with([
                'type' => 'success',
                'msg' => 'Mahasiswa ditambahkan'
            ]);
        }else{
            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $input = Tabungan::where('tipe','in')->where('siswa_id',$siswa->id)->sum('jumlah');
        $output = Tabungan::where('tipe','out')->where('siswa_id',$siswa->id)->sum('jumlah');
        $tabungan = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc');
        
        if($tabungan->count() != 0){
            $verify = $tabungan->first()->saldo;
        }else{
            $verify = 0;
        }
        $tabungan = $tabungan->paginate(10, ['*'], 'tabungan');
        
        if(($input - $output) == $verify){
            $saldo = format_idr($input - $output);
        }else{
            $saldo = 'invalid'.format_idr($input - $output);
        }
        
        $tagihan = $this->getTagihan($siswa);

        return view('siswa.show', [
            'siswa' => $siswa,
            'saldo' => $saldo,
            'tabungan' => $tabungan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.form', [
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas_id' => 'required|numeric',
            'nama' => 'required|max:255',
            'tempat_lahir' => 'nullable|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable',
        ]);

        $siswa = $siswa->fill($request->input());

        if($siswa->save()){
            return redirect()->route('siswa.index')->with([
                'type' => 'success',
                'msg' => 'Data Mahasiswa Diubah'
            ]);
        }else{
            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        if($siswa->tabungan->count() == 0){
            if($siswa->delete()){
                return redirect()->route('siswa.index')->with([
                    'type' => 'success',
                    'msg' => 'Data telah dihapus'
                ]);
            }
        }else{
            return redirect()->route('siswa.index')->with([
                'type' => 'danger',
                'msg' => 'tidak dapat menghapus data mahasiswa yang pernah memiliki transaksi'
            ]);
        }
        return redirect()->route('siswa.index')->with([
            'type' => 'danger',
            'msg' => 'Err.., terjadi kesalahan'
        ]);
    }

    //api saldo
    public function getSaldo(Siswa $siswa)
    {
        if($siswa == null){
            return response()->json(['msg' => 'siswa tidak ditemukan'], 404);
        }
        if($siswa->tabungan->count() == 0){
            return response()->json(['saldo' => '0', 'sal' => '0']);
        }

        $input = Tabungan::where('tipe','in')->where('siswa_id',$siswa->id)->sum('jumlah');
        $output = Tabungan::where('tipe','out')->where('siswa_id',$siswa->id)->sum('jumlah');
        $verify = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc')->first()->saldo;
        if(($input - $output) == $verify){
            return response()->json(['saldo' => $input - $output, 'sal' => format_idr($input - $output)]);
        }else{
            return response()->json(['saldo' => '0', 'sal' => 'invalid '.format_idr($input - $output)]);
        }
    }

}
