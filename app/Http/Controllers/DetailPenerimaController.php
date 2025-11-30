<?php

namespace App\Http\Controllers;

use App\Models\DetailPenerima;
use Illuminate\Http\Request;

class DetailPenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return view('detail_penerima');

    // }
    public function index(Request $request)
    {
        $id = $request->input('id');
        $detailPenerima = DetailPenerima::getDetailMustahik($id);
        $detailPenerimaMain = DetailPenerima::getReallyDetaiMustahik($id);
        // dd($detailPenerimaMain);
        $firstDetail = $detailPenerima->first();

        $data = [
            'detailPenerima' => $detailPenerima,
            'firstDetail' => $firstDetail,
            'dataDetail' => $detailPenerimaMain
        ];

        // dump($id);
        return view('detail_penerima', compact('data'));
    }

    public function index2(Request $request)
    {
        $id = $request->input('id');
        $detailPenerima = DetailPenerima::getDetailMustahik($id);
        $firstDetail = $detailPenerima->first();

        $data = [
            'detailPenerima' => $detailPenerima,
            'firstDetail' => $firstDetail,
        ];

        // dump($id);
        return view('detail_penerima', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
