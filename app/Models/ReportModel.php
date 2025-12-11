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
            return self::selectRaw('COUNT(DISTINCT nik) AS penerima_manfaat, SUM(rupiah) AS penyaluran')->first();
        } catch (\Exception $e) {
            Log::error('Error fetching report summary: '.$e->getMessage());

            return [
                'error' => 'Summary gagal diproses. Hubungi pengembang.',
            ];
        }
    }

    public static function getSummaryWithFilter($params)
    {
        if ($params['filter'] == '1') {
            try {
                return self::selectRaw('COUNT(DISTINCT nik) AS penerima_manfaat, SUM(rupiah) AS penyaluran')
                    ->leftJoin('t_laz', 't_mustahik.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('t_mustahik.laz_kode', $params['nama_laz']);
                    })
                    // ->dumpRawSql();
                    ->first();
                // -
            } catch (\Exception $e) {
                Log::error('Error fetching report summary: '.$e->getMessage());

                return [
                    'error' => 'Summary gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return self::selectRaw('COUNT(DISTINCT nik) AS penerima_manfaat, SUM(rupiah) AS penyaluran')
                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    ->first();
            } catch (\Exception $e) {
                Log::error('Error fetching report summary: '.$e->getMessage());

                return [
                    'error' => 'Summary gagal diproses. Hubungi pengembang.',
                ];
            }

        } elseif ($params['filter'] == '3') {
            try {
                return self::selectRaw('COUNT(DISTINCT nik) AS penerima_manfaat, SUM(rupiah) AS penyaluran')
                    ->when(! empty($params['provinsi_domisili']), function ($q) use ($params) {
                        return $q->where('provinsi_kode', $params['provinsi_domisili']);
                    })
                    ->when(! empty($params['kabkota_domisili']), function ($q) use ($params) {
                        return $q->where('kabkota_kode', $params['kabkota_domisili']);
                    })
                    ->when(! empty($params['kecamatan_domisili']), function ($q) use ($params) {
                        return $q->where('kecamatan_kode', $params['kecamatan_domisili']);
                    })
                    ->when(! empty($params['kelurahan_domisili']), function ($q) use ($params) {
                        return $q->where('kelurahan_kode', $params['kelurahan_domisili']);
                    })
                    ->when(! empty($params['alamat_domisili']), function ($q) use ($params) {
                        return $q->where('alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%');
                    })
                    ->first();
            } catch (\Exception $e) {

                Log::error('Error fetching report summary: '.$e->getMessage());

                return [
                    'error' => 'Summary gagal diproses. Hubungi pengembang.',
                ];
            }

        } elseif ($params['filter'] == '4') {
            try {

                $query = self::selectRaw('COUNT(DISTINCT nik) AS penerima_manfaat, SUM(rupiah) AS penyaluran')
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    });

                return $query->first();
            } catch (\Exception $e) {

                Log::error('Error fetching report summary: '.$e->getMessage());

                return [
                    'error' => 'Summary gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '5') {

            try {
                $query = DB::table('t_mustahik as a')
                    ->select(DB::raw('COUNT(DISTINCT a.nik) AS penerima_manfaat'), DB::raw('SUM(a.rupiah) AS penyaluran'))
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    });

                // Debug the query and show the raw SQL with the bindings
                // dd($query->toSql(), $query->getBindings());
                // dump($query->first());

                return $query->first();
                // Execute the query and dump the result

            } catch (\Exception $e) {

                Log::error('Error fetching report summary: '.$e->getMessage());

                return [
                    'error' => 'Summary gagal diproses. Hubungi pengembang.'.$e->getMessage(),
                ];
            }
        }

    }

    public static function getDataByGenderWithFilter($params)
    {
        if ($params['filter'] == '1') {
            try {
                return self::selectRaw('
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "m" THEN nik END) AS male_count,
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "f" THEN nik END) AS female_count,
            COUNT(DISTINCT nik) AS total
        ')
                    ->leftJoin('t_laz', 't_mustahik.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('t_mustahik.laz_kode', $params['nama_laz']);
                    })
                    ->first();
            } catch (\Exception $e) {
                Log::error('Error fetching gender data: '.$e->getMessage());

                return [
                    'error' => 'Data gender gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return self::selectRaw('
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "m" THEN nik END) AS male_count,
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "f" THEN nik END) AS female_count,
            COUNT(DISTINCT nik) AS total
        ')
                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    ->first();
            } catch (\Exception $e) {
                Log::error('Error fetching gender data: '.$e->getMessage());

                return [
                    'error' => 'Data gender gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '3') {
            try {
                return self::selectRaw('
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "m" THEN nik END) AS male_count,
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "f" THEN nik END) AS female_count,
            COUNT(DISTINCT nik) AS total
        ')
                    ->when(! empty($params['provinsi_domisili']), function ($q) use ($params) {
                        return $q->where('provinsi_kode', $params['provinsi_domisili']);
                    })
                    ->when(! empty($params['kabkota_domisili']), function ($q) use ($params) {
                        return $q->where('kabkota_kode', $params['kabkota_domisili']);
                    })
                    ->when(! empty($params['kecamatan_domisili']), function ($q) use ($params) {
                        return $q->where('kecamatan_kode', $params['kecamatan_domisili']);
                    })
                    ->when(! empty($params['kelurahan_domisili']), function ($q) use ($params) {
                        return $q->where('kelurahan_kode', $params['kelurahan_domisili']);
                    })
                    ->when(! empty($params['alamat_domisili']), function ($q) use ($params) {
                        return $q->where('alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%');
                    })
                    ->first();
            } catch (\Exception $e) {
                Log::error('Error fetching gender data: '.$e->getMessage());

                return [
                    'error' => 'Data gender gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '4') {
            try {
                $query = self::selectRaw('
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "m" THEN nik END) AS male_count,
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "f" THEN nik END) AS female_count,
            COUNT(DISTINCT nik) AS total
        ')
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    });

                // $query->ddRawSql();
                // ->first();
                return $query->first();
            } catch (\Exception $e) {
                Log::error('Error fetching gender data: '.$e->getMessage());

                return [
                    'error' => 'Data gender gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '5') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->selectRaw('
        COUNT(DISTINCT CASE WHEN a.jenis_kelamin = "m" THEN a.nik END) AS male_count,
        COUNT(DISTINCT CASE WHEN a.jenis_kelamin = "f" THEN a.nik END) AS female_count,
        COUNT(DISTINCT a.nik) AS total,
        SUM(a.rupiah) AS penyaluran
    ')
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    });
                // dd($query);
                // Execute the query and get the result
                $result = $query->first();

                return $result;
            } catch (\Exception $e) {
                Log::error('Error fetching gender data: '.$e->getMessage());

                return [
                    'error' => 'Data gender gagal diproses. Hubungi pengembang.',
                ];
            }
        }

    }

    public static function getPenyaluranByGenderWithFilter($params)
    {
        if ($params['filter'] == '1') {
            try {
                return self::selectRaw('
                SUM(CASE WHEN jenis_kelamin = "m" THEN rupiah ELSE 0 END) AS male_total_penyaluran,
                SUM(CASE WHEN jenis_kelamin = "f" THEN rupiah ELSE 0 END) AS female_total_penyaluran
            ')
                    ->leftJoin('t_laz', 't_mustahik.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('t_mustahik.laz_kode', $params['nama_laz']);
                    })
                    ->first();
            } catch (\Exception $e) {
                Log::error('Error fetching penyaluran by gender: '.$e->getMessage());

                return [
                    'error' => 'Penyaluran data gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return self::selectRaw('
                SUM(CASE WHEN jenis_kelamin = "m" THEN rupiah ELSE 0 END) AS male_total_penyaluran,
                SUM(CASE WHEN jenis_kelamin = "f" THEN rupiah ELSE 0 END) AS female_total_penyaluran
            ')
                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    ->first();
            } catch (\Exception $e) {
                Log::error('Error fetching penyaluran by gender: '.$e->getMessage());

                return [
                    'error' => 'Penyaluran data gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '3') {
            try {
                return self::selectRaw('
                SUM(CASE WHEN jenis_kelamin = "m" THEN rupiah ELSE 0 END) AS male_total_penyaluran,
                SUM(CASE WHEN jenis_kelamin = "f" THEN rupiah ELSE 0 END) AS female_total_penyaluran
            ')->when(! empty($params['provinsi_domisili']), function ($q) use ($params) {
                    return $q->where('provinsi_kode', $params['provinsi_domisili']);
                })
                    ->when(! empty($params['kabkota_domisili']), function ($q) use ($params) {
                        return $q->where('kabkota_kode', $params['kabkota_domisili']);
                    })
                    ->when(! empty($params['kecamatan_domisili']), function ($q) use ($params) {
                        return $q->where('kecamatan_kode', $params['kecamatan_domisili']);
                    })
                    ->when(! empty($params['kelurahan_domisili']), function ($q) use ($params) {
                        return $q->where('kelurahan_kode', $params['kelurahan_domisili']);
                    })
                    ->when(! empty($params['alamat_domisili']), function ($q) use ($params) {
                        return $q->where('alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%');
                    })
                    ->where('alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%')->first();
            } catch (\Exception $e) {
                Log::error('Error fetching penyaluran by gender: '.$e->getMessage());

                return [
                    'error' => 'Penyaluran data gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '4') {
            try {
                $query = self::selectRaw('
                SUM(CASE WHEN jenis_kelamin = "m" THEN rupiah ELSE 0 END) AS male_total_penyaluran,
                SUM(CASE WHEN jenis_kelamin = "f" THEN rupiah ELSE 0 END) AS female_total_penyaluran
            ')
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    });

                // $query->ddRawSql();
                // ->first();
                return $query->first();
            } catch (\Exception $e) {
                Log::error('Error fetching penyaluran by gender: '.$e->getMessage());

                return [
                    'error' => 'Penyaluran data gagal diproses. Hubungi pengembang.',
                ];
            }
        } elseif ($params['filter'] == '5') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->selectRaw('SUM(CASE WHEN a.jenis_kelamin = "m" THEN rupiah ELSE 0 END) AS male_total_penyaluran,
                SUM(CASE WHEN a.jenis_kelamin = "f" THEN rupiah ELSE 0 END) AS female_total_penyaluran
    ')
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    });

                return $query->first();
            } catch (\Exception $e) {
                Log::error('Error fetching penyaluran by gender: '.$e->getMessage());

                return [
                    'error' => 'Penyaluran data gagal diproses. Hubungi pengembang.'.$e->getMessage(),
                ];
            }

        }

    }

    public static function getPenyaluranByProgramWithFilter($params)
    {

        if ($params['filter'] == '1') {
            try {
                return DB::table('t_mustahik')
                    ->select(
                        DB::raw("SUM(CASE WHEN tipe_penerimaan = 'pml' THEN rupiah ELSE 0 END) AS langsung_total"),
                        DB::raw("SUM(CASE WHEN tipe_penerimaan= 'pmtl' THEN rupiah ELSE 0 END) AS tidak_langsung_total")
                    )
                    ->leftJoin('t_laz', 't_mustahik.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('t_mustahik.laz_kode', $params['nama_laz']);
                    })
                    ->first();
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by program: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return DB::table('t_mustahik')
                    ->select(
                        DB::raw("SUM(CASE WHEN tipe_penerimaan = 'pml' THEN rupiah ELSE 0 END) AS langsung_total"),
                        DB::raw("SUM(CASE WHEN tipe_penerimaan= 'pmtl' THEN rupiah ELSE 0 END) AS tidak_langsung_total")
                    )
                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    // ->first();
                    ->first();
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by program: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '3') {
            try {
                return DB::table('t_mustahik')
                    ->select(
                        DB::raw("SUM(CASE WHEN tipe_penerimaan = 'pml' THEN rupiah ELSE 0 END) AS langsung_total"),
                        DB::raw("SUM(CASE WHEN tipe_penerimaan= 'pmtl' THEN rupiah ELSE 0 END) AS tidak_langsung_total")
                    )
                    ->when(! empty($params['provinsi_domisili']), function ($q) use ($params) {
                        return $q->where('provinsi_kode', $params['provinsi_domisili']);
                    })
                    ->when(! empty($params['kabkota_domisili']), function ($q) use ($params) {
                        return $q->where('kabkota_kode', $params['kabkota_domisili']);
                    })
                    ->when(! empty($params['kecamatan_domisili']), function ($q) use ($params) {
                        return $q->where('kecamatan_kode', $params['kecamatan_domisili']);
                    })
                    ->when(! empty($params['kelurahan_domisili']), function ($q) use ($params) {
                        return $q->where('kelurahan_kode', $params['kelurahan_domisili']);
                    })
                    ->when(! empty($params['alamat_domisili']), function ($q) use ($params) {
                        return $q->where('alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%');
                    })
                    ->first();
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by program: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '4') {
            try {
                $query = DB::table('t_mustahik')
                    ->select(
                        DB::raw("SUM(CASE WHEN tipe_penerimaan = 'pml' THEN rupiah ELSE 0 END) AS langsung_total"),
                        DB::raw("SUM(CASE WHEN tipe_penerimaan= 'pmtl' THEN rupiah ELSE 0 END) AS tidak_langsung_total")
                    )
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    });

                // $query->ddRawSql();
                // ->first();
                return $query->first();
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by program: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '5') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->select(
                        DB::raw("SUM(CASE WHEN a.tipe_penerimaan = 'pml' THEN rupiah ELSE 0 END) AS langsung_total"),
                        DB::raw("SUM(CASE WHEN a.tipe_penerimaan= 'pmtl' THEN rupiah ELSE 0 END) AS tidak_langsung_total")
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    });

                // $query->ddRawSql();
                // ->first();
                return $query->first();
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by program: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data. Please try again later.',
                ];
            }
        }

    }

    public static function getPenyaluranByBidangWithFilter($params)
    {
        if ($params['filter'] == '1') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->select(
                        'mb.bidang_label',
                        DB::raw('SUM(a.rupiah) AS total_penyaluran')
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->leftJoin('t_laz', 'a.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('a.laz_kode', $params['nama_laz']);
                    })
                    ->groupBy('mb.bidang_label');

                return $query->get();
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by bidang: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data by bidang. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return DB::table('t_mustahik as a')
                    ->select(
                        'mb.bidang_label',
                        DB::raw('SUM(a.rupiah) AS total_penyaluran')
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->groupBy('mb.bidang_label')

                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    ->get(); // Use get() to return all results
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by bidang: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data by bidang. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '3') {
            try {
                return DB::table('t_mustahik as a')
                    ->select(
                        'mb.bidang_label',
                        DB::raw('SUM(a.rupiah) AS total_penyaluran')
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->groupBy('mb.bidang_label')

                    ->where('a.provinsi_kode', $params['provinsi_domisili'])  // Adding the WHERE clause
                    ->where('a.kabkota_kode', $params['kabkota_domisili'])  // Adding the WHERE clause
                    ->where('a.kecamatan_kode', $params['kecamatan_domisili'])  // Adding the WHERE clause
                    ->where('a.kelurahan_kode', $params['kelurahan_domisili'])  // Adding the WHERE clause
                    ->where('a.alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%')
                    ->get(); // Use get() to return all results
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by bidang: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data by bidang. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '4') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->select(
                        'mb.bidang_label',
                        DB::raw('SUM(a.rupiah) AS total_penyaluran')
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->groupBy('mb.bidang_label')
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    });

                return $query->get(); // Use get() to return all results
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by bidang: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data by bidang. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '5') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->select(
                        'mb.bidang_label',
                        DB::raw('SUM(a.rupiah) AS total_penyaluran')
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->groupBy('mb.bidang_label')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    });

                return $query->get(); // Use get() to return all results
            } catch (\Exception $e) {
                // Log the exception and return a custom error message or null
                \Log::error('Error fetching penyaluran data by bidang: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the penyaluran data by bidang. Please try again later.',
                ];
            }
        }

    }

    public static function getTimeSeriesDataWithFilter($params)
    {
        if ($params['filter'] == '1') {
            try {
                return DB::table('t_mustahik as a')
                    ->select(
                        DB::raw('YEAR(a.created_at) AS tahun'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pml" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Langsung'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pmtl" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Tidak_Langsung')
                    )
                    ->leftJoin('t_program as p', 'a.program_kode', '=', 'p.program_kode')
                    ->leftJoin('t_laz', 'a.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('a.laz_kode', $params['nama_laz']);
                    })
                    ->groupBy(DB::raw('YEAR(a.created_at)'))
                    ->orderBy('tahun')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Error fetching time series data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the time series data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return DB::table('t_mustahik as a')
                    ->select(
                        DB::raw('YEAR(a.created_at) AS tahun'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pml" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Langsung'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pmtl" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Tidak_Langsung')
                    )
                    ->leftJoin('t_program as p', 'a.program_kode', '=', 'p.program_kode')
                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('a.ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    ->groupBy(DB::raw('YEAR(a.created_at)'))
                    ->orderBy('tahun')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Error fetching time series data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the time series data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '3') {
            try {
                return DB::table('t_mustahik as a')
                    ->select(
                        DB::raw('YEAR(a.created_at) AS tahun'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pml" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Langsung'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pmtl" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Tidak_Langsung')
                    )
                    ->leftJoin('t_program as p', 'a.program_kode', '=', 'p.program_kode')
                    ->when(! empty($params['provinsi_domisili']), function ($q) use ($params) {
                        return $q->where('a.provinsi_kode', $params['provinsi_domisili']);
                    })
                    ->when(! empty($params['kabkota_domisili']), function ($q) use ($params) {
                        return $q->where('a.kabkota_kode', $params['kabkota_domisili']);
                    })
                    ->when(! empty($params['kecamatan_domisili']), function ($q) use ($params) {
                        return $q->where('a.kecamatan_kode', $params['kecamatan_domisili']);
                    })
                    ->when(! empty($params['kelurahan_domisili']), function ($q) use ($params) {
                        return $q->where('a.kelurahan_kode', $params['kelurahan_domisili']);
                    })
                    ->when(! empty($params['alamat_domisili']), function ($q) use ($params) {
                        return $q->where('a.alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%');
                    })
                    ->groupBy(DB::raw('YEAR(a.created_at)'))
                    ->orderBy('tahun')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Error fetching time series data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the time series data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '4') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->select(
                        DB::raw('YEAR(a.created_at) AS tahun'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pml" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Langsung'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pmtl" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Tidak_Langsung')
                    )
                    ->leftJoin('t_program as p', 'a.program_kode', '=', 'p.program_kode')
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    })
                    ->groupBy(DB::raw('YEAR(a.created_at)'))
                    ->orderBy('tahun');

                return $query->get();
            } catch (\Exception $e) {
                \Log::error('Error fetching time series data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the time series data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '5') {
            try {
                $query = DB::table('t_mustahik as a')
                    ->select(
                        DB::raw('YEAR(a.created_at) AS tahun'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pml" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Langsung'),
                        DB::raw('COALESCE(SUM(CASE WHEN a.tipe_penerimaan = "pmtl" THEN a.rupiah ELSE 0 END), 0) AS Bantuan_Tidak_Langsung')
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    })
                    ->groupBy(DB::raw('YEAR(a.created_at)'))
                    ->orderBy('tahun');

                return $query->get();
            } catch (\Exception $e) {
                \Log::error('Error fetching time series data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the time series data. Please try again later.',
                ];
            }
        }
    }

    public static function getTabulateDataWithFilter($params)
    {
        if ($params['filter'] == '1') {
            try {
                return DB::table('t_mustahik')
                    ->select(
                        DB::raw('MD5(nik) as nik_hashed'),
                        DB::raw('MAX(nik) as nik'),
                        DB::raw('MAX(nama_lengkap) as nama_pm'),
                        DB::raw('MAX(jenis_kelamin) as jenis_kelamin'),
                        DB::raw('MAX(alamat_domisili) as domisili'),
                        DB::raw('MAX(ktp_alamat) as alamat_ktp'),
                        DB::raw('SUM(rupiah) as nominal')
                    )
                    ->leftJoin('t_laz', 't_mustahik.laz_kode', '=', 't_laz.laz_kode')
                    ->when(! empty($params['skala']), function ($q) use ($params) {
                        return $q->where('t_laz.skala', $params['skala']);
                    })
                    ->when(! empty($params['nama_laz']), function ($q) use ($params) {
                        return $q->where('t_mustahik.laz_kode', $params['nama_laz']);
                    })
                    ->groupBy('nik')
                    ->get();

            } catch (\Exception $e) {
                \Log::error('Error fetching tabulate data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the tabulate data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '2') {
            try {
                return DB::table('t_mustahik')
                    ->select(
                        DB::raw('MD5(nik) as nik_hashed'),
                        DB::raw('MAX(nik) as nik'),
                        DB::raw('MAX(nama_lengkap) as nama_pm'),
                        DB::raw('MAX(jenis_kelamin) as jenis_kelamin'),
                        DB::raw('MAX(alamat_domisili) as domisili'),
                        DB::raw('MAX(ktp_alamat) as alamat_ktp'),
                        DB::raw('SUM(rupiah) as nominal')
                    )
                    ->when(! empty($params['provinsi_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_provinsi_kode', $params['provinsi_ktp']);
                    })
                    ->when(! empty($params['kabupaten_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kabkota_kode', $params['kabupaten_ktp']);
                    })
                    ->when(! empty($params['kecamatan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kecamatan_kode', $params['kecamatan_ktp']);
                    })
                    ->when(! empty($params['kelurahan_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_kelurahan_kode', $params['kelurahan_ktp']);
                    })
                    ->when(! empty($params['alamat_ktp']), function ($q) use ($params) {
                        return $q->where('ktp_alamat', 'LIKE', '%'.$params['alamat_ktp'].'%');
                    })
                    ->groupBy('nik')
                    ->get();

            } catch (\Exception $e) {
                \Log::error('Error fetching tabulate data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the tabulate data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '3') {
            try {
                return DB::table('t_mustahik')
                    ->select(
                        DB::raw('MD5(nik) as nik_hashed'),
                        DB::raw('MAX(nik) as nik'),
                        DB::raw('MAX(nama_lengkap) as nama_pm'),
                        DB::raw('MAX(jenis_kelamin) as jenis_kelamin'),
                        DB::raw('MAX(alamat_domisili) as domisili'),
                        DB::raw('MAX(ktp_alamat) as alamat_ktp'),
                        DB::raw('SUM(rupiah) as nominal')
                    )
                    ->when(! empty($params['provinsi_domisili']), function ($q) use ($params) {
                        return $q->where('provinsi_kode', $params['provinsi_domisili']);
                    })
                    ->when(! empty($params['kabkota_domisili']), function ($q) use ($params) {
                        return $q->where('kabkota_kode', $params['kabkota_domisili']);
                    })
                    ->when(! empty($params['kecamatan_domisili']), function ($q) use ($params) {
                        return $q->where('kecamatan_kode', $params['kecamatan_domisili']);
                    })
                    ->when(! empty($params['kelurahan_domisili']), function ($q) use ($params) {
                        return $q->where('kelurahan_kode', $params['kelurahan_domisili']);
                    })
                    ->when(! empty($params['alamat_domisili']), function ($q) use ($params) {
                        return $q->where('alamat_domisili', 'LIKE', '%'.$params['alamat_domisili'].'%');
                    })
                    ->groupBy('nik')
                    ->get();

            } catch (\Exception $e) {
                \Log::error('Error fetching tabulate data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the tabulate data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '4') {
            try {

                $query = DB::table('t_mustahik')
                    ->select(
                        DB::raw('MD5(nik) as nik_hashed'),
                        DB::raw('MAX(nik) as nik'),
                        DB::raw('MAX(nama_lengkap) as nama_pm'),
                        DB::raw('MAX(jenis_kelamin) as jenis_kelamin'),
                        DB::raw('MAX(alamat_domisili) as domisili'),
                        DB::raw('MAX(ktp_alamat) as alamat_ktp'),
                        DB::raw('SUM(rupiah) as nominal')

                    )
                    ->when(! empty($params['nik']), function ($q) use ($params) {
                        return $q->where('nik', (int) $params['nik']);
                    })
                    ->when(! empty($params['nama']), function ($q) use ($params) {
                        return $q->where('nama_lengkap', $params['nama']);
                    })
                    ->when(! empty($params['agama']), function ($q) use ($params) {
                        return $q->where('agama', $params['agama']);
                    })
                    ->when(! empty($params['tgl_lahir_start']), function ($q) use ($params) {
                        return $q->whereBetween('lahir_tanggal', [$params['tgl_lahir_start'], $params['tgl_lahir_end']]);
                    })
                    
                    ->when(! empty($params['jenis_kelamin']), function ($q) use ($params) {
                        return $q->where('jenis_kelamin', $params['jenis_kelamin']);
                    })
                    ->when(! empty($params['dokumen_ktp']), function ($q) use ($params) {
                        if ($params['dokumen_ktp'] == 1) {
                            return $q->whereNotNull('ktp_berkas');
                        }
                    });

                // $query->ddRawSql();

                $result = $query->groupBy('nik')->get();

                return $result;

            } catch (\Exception $e) {
                \Log::error('Error fetching tabulate data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the tabulate data. Please try again later.',
                ];
            }
        } elseif ($params['filter'] == '5') {
            try {

                $query = DB::table('t_mustahik as a')
                    ->select(
                        DB::raw('MD5(a.nik) as nik_hashed'),  // Apply MD5 to the 'nik' column
                        'a.nik as nik',
                        'a.nama_lengkap as nama_pm',
                        'a.jenis_kelamin',
                        'a.alamat_domisili as domisili',
                        'a.ktp_alamat as alamat_ktp',
                        'a.rupiah as nominal'
                    )
                    ->leftJoin('t_program as t', 'a.program_kode', '=', 't.program_kode')
                    ->leftJoin('m_bidang as mb', 't.bidang_kode', '=', 'mb.bidang_kode')
                    ->when(! empty($params['bidang_kode']), function ($q) use ($params) {
                        return $q->where('mb.bidang_kode', $params['bidang_kode']);
                    })
                    ->when(! empty($params['nama_program']), function ($q) use ($params) {
                        return $q->where('t.program_nama', 'LIKE', '%'.$params['nama_program'].'%');
                    })
                    ->when(! empty($params['tipe_program']), function ($q) use ($params) {
                        return $q->where('a.tipe_penerimaan', $params['tipe_program']);
                    })
                    ->when(! empty($params['waktu_start']), function ($q) use ($params) {
                        return $q->whereBetween('a.tanggal_terima', [$params['waktu_start'], $params['waktu_end']]);
                    })
                    ->when(! empty($params['valueMax']), function ($q) use ($params) {
                        return $q->whereBetween('a.rupiah', [$params['valueMin'], $params['valueMax']]);
                    });

                $result = $query->groupBy('nik')->get();

                return $result;

            } catch (\Exception $e) {
                \Log::error('Error fetching tabulate data: '.$e->getMessage());

                return [
                    'error' => 'There was an issue fetching the tabulate data. Please try again later.',
                ];
            }
        }
    }

    public static function getDataByGender()
    {
        try {
            return self::selectRaw('
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "m" THEN nik END) AS male_count,
            COUNT(DISTINCT CASE WHEN jenis_kelamin = "f" THEN nik END) AS female_count,
            COUNT(DISTINCT nik) AS total
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
                    DB::raw('MD5(nik) as nik_hashed'),
                    DB::raw('MAX(nik) as nik'),
                    DB::raw('MAX(nama_lengkap) as nama_pm'),
                    DB::raw('MAX(jenis_kelamin) as jenis_kelamin'),
                    DB::raw('MAX(alamat_domisili) as domisili'),
                    DB::raw('MAX(ktp_alamat) as alamat_ktp'),
                    DB::raw('SUM(rupiah) as nominal')
                )
                ->groupBy('nik')
                ->get();

        } catch (\Exception $e) {
            \Log::error('Error fetching tabulate data: '.$e->getMessage());

            return [
                'error' => 'There was an issue fetching the tabulate data. Please try again later.',
            ];
        }
    }
}
