<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
    //
    public static function getAgregatPenerimaan()
    {
        // 1. Last year (current year – 1)
        $lastYear = Carbon::now()->subYear()->year;

        // 2. Raw SQL – you can copy‑paste the query you already have
        $sql = <<<'SQL'
            SELECT
                a.provinsi_nama,
                COALESCE(SUM(tp.penerimaan_nominal), 0)          AS total_nominal_numeric,
                IFNULL(SUM(tp.penerimaan_nominal), 'Tidak Ada Data') AS total_nominal_text,
                CASE
                    WHEN SUM(tp.penerimaan_nominal) IS NULL
                        THEN 'Tidak Ada Data'
                    ELSE SUM(tp.penerimaan_nominal)
                END AS total_nominal_case
            FROM
                m_provinsi   AS a
            LEFT JOIN
                t_laz        AS tl ON a.provinsi_kode = tl.provinsi_kode
            LEFT JOIN
                t_penerimaan AS tp
                    ON tp.laz_kode = tl.laz_kode
                    AND tp.penerimaan_tahun = ?
            GROUP BY
                a.provinsi_nama
            ORDER BY
                a.provinsi_nama
        SQL;

        // 3. Execute & return the result
        return DB::select($sql, [$lastYear]);
    }
}
