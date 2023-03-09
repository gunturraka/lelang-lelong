<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\lelang;
use App\Models\barang;
use Illuminate\Support\Facades\auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(history $history, lelang $lelang, barang $barang)
    {
        $lelangs = lelang::find($lelang->id);
        $histories = history::orderBy('harga_penawaran', 'desc')->get()->where('lelangs_id', $lelang->id);
        return view('masyarakat.penawaran', compact('lelangs', 'histories'));
    }
    
    public function historypenawaran(history $history, lelang $lelang)
    {
        $lelangs = lelang::find($lelang->id);
        $histories = history::orderBy('harga_penawaran', 'desc')->get()->where('lelang_id', $lelang->id);
        return view('lelang.historylelang', compact('lelangs', 'histories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,history $historyLelang, lelang $lelang, barang $barang)
    {
        //
        // ddd($request);
        $validatedData = $request->validate([
            'harga_penawaran' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($lelang) {
                    if ($value <= $lelang->barang->harga_awal) {
                        $message = "Harga penawaran harus lebih besar dari harga awal yaitu " . "Rp " . number_format($lelang->barang->harga_awal, 0, ',', '.');
                        return $fail($message);
                    }
                },
            ],
        ], 
        [
            'harga_penawaran.required' => "Harga penawaran harus diisi",
            'harga_penawaran.numeric' => "Harga penawaran harus berupa angka",
        ]);

        $historyLelang = new history();
        $historyLelang->lelangs_id = $lelang->id;
        $historyLelang->barangs_id = $lelang->barang->id;
        $historyLelang->users_id = Auth::user()->id;
        $historyLelang->harga_penawaran = $request->harga_penawaran;
        $historyLelang->status = 'pending';
        $historyLelang->save();

        return redirect()->route('lelangin.create', $lelang->id)->with('success', 'Anda Berhasil Menawar Barang Ini')->with('ucapan','');
    }

    public function setPemenang(Lelang $lelang, $id)
    {
    // Mengambil data history lelang berdasarkan id
    $historyLelang = history::findOrFail($id);

    // Mengubah status pada history lelang menjadi 'pemenang'
    $historyLelang->status = 'pemenang';
    $historyLelang->save();
    history::where('lelangs_id', $historyLelang->lelangs_id)
    ->where('status', 'pending')
    ->where('id', '<>', $historyLelang->id)
    ->update(['status' => 'gugur']);

    // Mengambil data lelang berdasarkan history lelang
    $lelang = $historyLelang->lelang;

    // Mengubah status pada lelang menjadi 'ditutup'
    $lelang->status = 'ditutup';
    $lelang->harga_akhir = $historyLelang->harga_penawaran;
    $lelang->save();

    return redirect()->back()->with('success', 'Pemenang berhasil dipilih!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function show(history $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(history $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, history $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(history $history)
    {
        //
    }
}
