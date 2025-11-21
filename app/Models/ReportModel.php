<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportModel extends Model
{
    protected $table = 't_mustahik';

    public static function getSummary()
    {
        try {

            return self::selectRaw('COUNT(*) AS penerima_manfaat, SUM(rupiah) AS penyaluran')->first();
        } catch (\Exception $e) {

            Log::error('Error fetching report summary: '.$e->getMessage());

            return [
                'error' => 'Summary gagal diproses. Hubungi pengembang.',
            ];
        }
    }

    public static function getDataByGender()
    {
        try {
            return self::selectRaw('
                SUM(jenis_kelamin = "m") AS male_count,
                SUM(jenis_kelamin = "f") AS female_count,
                COUNT(*) AS total
            ')->first();
        } catch (\Exception $e) {
            Log::error('Error fetching gender data: '.$e->getMessage());

            return [
                'error' => 'Data gender gagal diproses. Hubungi pengembang.',
            ];
        }
    }

    public static function getPenyaluranByGender()
    {
        try {
            return self::selectRaw('
                SUM(CASE WHEN jenis_kelamin = "m" THEN rupiah ELSE 0 END) AS male_total_penyaluran,
                SUM(CASE WHEN jenis_kelamin = "f" THEN rupiah ELSE 0 END) AS female_total_penyaluran
            ')->first();
        } catch (\Exception $e) {
            Log::error('Error fetching penyaluran by gender: '.$e->getMessage());

            return [
                'error' => 'Penyaluran data gagal diproses. Hubungi pengembang.',
            ];
        }
    }

    public static function getPenyaluranByProgram()
    {
        try {
            return DB::table('t_mustahik')
                ->select(
                    DB::raw("SUM(CASE WHEN tipe_penerimaan = 'pml' THEN rupiah ELSE 0 END) AS langsung_total"),
                    DB::raw("SUM(CASE WHEN tipe_penerimaan= 'pmtl' THEN rupiah ELSE 0 END) AS tidak_langsung_total")
                )
                ->first();
        } catch (\Exception $e) {
            // Log the exception and return a custom error message or null
            \Log::error('Error fetching penyaluran data by program: '.$e->getMessage());

            return [
                'error' => 'There was an issue fetching the penyaluran data. Please try again later.',
            ];
        }
    }

    // Method to run the custom query and return the results for Penyaluran by Bidang
    public static function getPenyaluranByBidang()
    {
        try {
            return DB::table('t_mustahik as a')
                ->select(
                    'mb.bidang_label',
                    DB::raw('SUM(a.rupiah) AS total_penyaluran')
                )
                ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                ->groupBy('mb.bidang_label')
                ->get(); // Use get() to return all results
        } catch (\Exception $e) {
            // Log the exception and return a custom error message or null
            \Log::error('Error fetching penyaluran data by bidang: '.$e->getMessage());

            return [
                'error' => 'There was an issue fetching the penyaluran data by bidang. Please try again later.',
            ];
        }
    }

    public static function getTimeSeriesData()
    {
        try {
            return DB::table('t_mustahik as a')
                ->select(
                    DB::raw('YEAR(a.created_at) AS tahun'),
                    DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pml" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Langsung'),
                    DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pmtl" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Tidak_Langsung')
                )
                ->leftJoin('t_program as p', 'a.program_kode', '=', 'p.program_kode')
                ->groupBy(DB::raw('YEAR(a.created_at)'))
                ->orderBy('tahun')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Error fetching time series data: '.$e->getMessage());

            return [
                'error' => 'There was an issue fetching the time series data. Please try again later.',
            ];
        }
    }

    public static function getTabulateData()
    {
        try {
            return DB::table('t_mustahik')
                ->select(
                    'nik',
                    'nama_lengkap as nama_pm',
                    'jenis_kelamin',
                    'alamat_domisili as domisili',
                    'ktp_alamat as alamat_ktp',
                    'rupiah as nominal'
                )
                ->get();
        } catch (\Exception $e) {
            \Log::error('Error fetching tabulate data: '.$e->getMessage());

            return [
                'error' => 'There was an issue fetching the tabulate data. Please try again later.',
            ];
        }
    }
}
