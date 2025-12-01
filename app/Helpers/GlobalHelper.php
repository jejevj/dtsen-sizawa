<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class GlobalHelper
{
    /**
     * Get all provinces (provinsi) from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getProvinces()
    {
        return DB::table('m_provinsi')->get();  // Replace 'provinces' with your actual table name
    }

    /**
     * Get cities (kabupaten/kota) by province ID.
     *
     * @param  int  $provinceId
     * @return \Illuminate\Support\Collection
     */
    public static function getCities($provinceId)
    {
        return DB::table('m_kabkota')  // Assuming 'm_kabkota' is the table for cities
            ->where('provinsi_kode', $provinceId)  // Filter cities by the 'provinsi_kode' (province code)
            ->select('kabkota_kode as id', 'kabkota_nama as name')  // Alias 'id' as 'kode' and select 'kabkota_nama' as well
            ->get();
    }

    /**
     * Get sub-districts (kecamatan) by city ID.
     *
     * @param  int  $cityId
     * @return \Illuminate\Support\Collection
     */
    public static function getSubDistricts($cityId)
    {
        return DB::table('m_kecamatan')  // Replace 'sub_districts' with your actual table name
            ->where('kabkota_kode', $cityId)  // Assuming 'city_id' exists in the sub_districts table
            ->select('kecamatan_kode as id', 'kecamatan_nama as name')  // Alias 'id' as 'kode' and select 'kecamatan_nama' as well
            ->get();
    }

    /**
     * Get villages (kelurahan) by sub-district ID.
     *
     * @param  int  $subDistrictId
     * @return \Illuminate\Support\Collection
     */
    public static function getVillages($subDistrictId)
    {
        return DB::table('m_kelurahan')  // Replace 'villages' with your actual table name
            ->where('kecamatan_kode', $subDistrictId)  // Assuming 'sub_district_id' exists in the villages table
            ->select('kelurahan_kode as id', 'kelurahan_nama as name')->get();
    }

    /**
     * Get the list of Laz (name of Laz) based on the selected scale (Skala).
     *
     * @param  int  $skala
     * @return \Illuminate\Support\Collection
     */
    public static function getLazBySkala($skala)
    {
        // Query the t_laz table based on the skala value
        return DB::table('t_laz')
            ->where('skala', $skala)
            ->select('laz_kode as id', 'laz_nama as name')
            ->get(); // Assuming the Laz table has 'id' and 'name' columns
    }

    public static function getAgama()
    {
        // Query the t_laz table based on the skala value
        return DB::table('m_agama')
            ->select('agama_nama as id', 'agama_nama as name')
            ->get(); // Assuming the Laz table has 'id' and 'name' columns
    }
    public static function getBidang()
    {
        // Query the t_laz table based on the skala value
        return DB::table('m_bidang')
            ->select('bidang_kode as id', 'bidang_label as name')
            ->get(); // Assuming the Laz table has 'id' and 'name' columns
    }
}

if (!function_exists('getDataLazHelper')) {
    function getDataLazHelper($skala) {

        return GlobalHelper::getLazBySkala($skala);
    }
}
