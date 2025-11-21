<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class DetailPenerima extends Model
{
    //

    public static function getDetailMustahik($id)
    {
        try {
            return DB::table('t_mustahik as a')
                ->select(
                    'a.*',
                    'b.laz_nama',
                    'b.skala as skala',
                    'c.program_nama',
                    'mp.provinsi_nama',
                    'kab.kabkota_nama',
                    'mk.kecamatan_nama',
                    'kl.kelurahan_nama'
                )
                ->leftJoin('t_laz as b', 'a.laz_kode', '=', 'b.laz_kode')
                ->leftJoin('t_program as c', 'a.program_kode', '=', 'c.program_kode')
                ->leftJoin('m_provinsi as mp', 'a.provinsi_kode', '=', 'mp.provinsi_kode')
                ->leftJoin('m_kabkota as kab', 'a.kabkota_kode', '=', 'kab.kabkota_kode')
                ->leftJoin('m_kecamatan as mk', 'a.kecamatan_kode', '=', 'mk.kecamatan_kode')
                ->leftJoin('m_kelurahan as kl', 'a.kelurahan_kode', '=', 'kl.kelurahan_kode')
                ->where(DB::raw('MD5(a.nik)'), '=', $id)  // Compare MD5 of nik with the hashed value of $id
                ->where(function ($query) {
                    $query->where('b.laz_status', '=', 'aktif')
                        ->orWhere('b.laz_status', '=', 'daftar_ulang');
                })
                ->orderByDesc('a.created_at')
                ->get();  // Use get() to return multiple results
        } catch (\Exception $e) {
            \Log::error('Error fetching detail mustahik: '.$e->getMessage());

            return null;  // Handle errors gracefully
        }
    }
}
