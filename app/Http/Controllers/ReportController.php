<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\ReportModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    /**
     * Handle errors and return them as a message
     */
    private function handleError(\Exception $e)
    {
        // Log the error if needed
        \Log::error($e->getMessage()); // Logging the error message

        // Return the error message as a string or in an array format
        return 'Error: '.$e->getMessage();
    }

    public function getTabulateData(Request $request)
    {
        // Get the data from the model
        $tabulateData = ReportModel::getTabulateData();

        // Return data in the format that DataTables can process
        return DataTables::of($tabulateData)
            ->make(true);  // This will return the data in the proper JSON format
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $is_filter = $request->input('is_filter');
        $filter = $request->input('filter', null);

        try {
            // Get list of provinces, agama, and bidang (initial default data)
            $provinsiList = GlobalHelper::getProvinces();
            $agamaList = GlobalHelper::getAgama();
            $bidangList = GlobalHelper::getBidang();

            // Default data fetching without filter
            $summaryData = ReportModel::getSummary();
            $genderData = ReportModel::getDataByGender();
            $penyaluranData = ReportModel::getPenyaluranByGender();
            $programData = ReportModel::getPenyaluranByProgram();
            $bidangData = ReportModel::getPenyaluranByBidang();
            $timeSeriesData = ReportModel::getTimeSeriesData();
            $tabulateData = ReportModel::getTabulateData();

            // Ensure values are set, using fallback values in case of null
            $data = [
                'penerima_manfaat' => $summaryData->penerima_manfaat ?? 0, // Default to 0 if null
                'penyaluran' => $summaryData->penyaluran ?? 0, // Default to 0 if null
                'male_count' => $genderData->male_count ?? 0,
                'female_count' => $genderData->female_count ?? 0,
                'total' => $genderData->total ?? 0,
                'male_total_penyaluran' => $penyaluranData->male_total_penyaluran ?? 0,
                'female_total_penyaluran' => $penyaluranData->female_total_penyaluran ?? 0,
                'tidak_langsung_total' => $programData->tidak_langsung_total ?? 0,
                'langsung_total' => $programData->langsung_total ?? 0,
                'bidangData' => $bidangData,
                'timeSeriesData' => $timeSeriesData,
                'provinsiList' => $provinsiList,  // Ensure it's always set here
                'agamaList' => $agamaList,  // Ensure it's always set here
                'bidangList' => $bidangList,  // Ensure it's always set here
                'table' => $tabulateData,
            ];

            // If filter is applied
            if (! empty($filter)) {
                $params = $request->all();

                // Check if params are valid, otherwise set default values or error message
                if (isset($params['error'])) {
                    // If error occurs, return the error message and data
                    $data['error_message'] = $params['error']; // Set error message

                    // Always include the lists even in case of error
                    $data['provinsiList'] = $provinsiList;
                    $data['agamaList'] = $agamaList;
                    $data['bidangList'] = $bidangList;

                    // Return the view with error message
                    return view('report', ['error_message' => $data['error_message'], 'data' => $data]);
                }

                // If params are valid, fetch filtered data
                if ($params) {
                    $summaryData = ReportModel::getSummaryWithFilter($params);
                    $genderData = ReportModel::getDataByGenderWithFilter($params);
                    $penyaluranData = ReportModel::getPenyaluranByGenderWithFilter($params);
                    $programData = ReportModel::getPenyaluranByProgramWithFilter($params);
                    $bidangData = ReportModel::getPenyaluranByBidangWithFilter($params);
                    $timeSeriesData = ReportModel::getTimeSeriesDataWithFilter($params);
                    $tabulateData = ReportModel::getTabulateDataWithFilter($params);
                    // dd($genderData);
                    // dd($timeSeriesData);

                    // Update data array with filtered values
                    $data = [
                        'penerima_manfaat' => $summaryData->penerima_manfaat ?? 0, // Default to 0 if null
                        'penyaluran' => $summaryData->penyaluran ?? 0, // Default to 0 if null
                        'male_count' => $genderData->male_count ?? 0,
                        'female_count' => $genderData->female_count ?? 0,
                        'total' => $genderData->total ?? 0,
                        'male_total_penyaluran' => $penyaluranData->male_total_penyaluran ?? 0,
                        'female_total_penyaluran' => $penyaluranData->female_total_penyaluran ?? 0,
                        'tidak_langsung_total' => $programData->tidak_langsung_total ?? 0,
                        'langsung_total' => $programData->langsung_total ?? 0,
                        'bidangData' => $bidangData,
                        'timeSeriesData' => $timeSeriesData,
                        'provinsiList' => $provinsiList,  // Ensure it's always set here
                        'agamaList' => $agamaList,  // Ensure it's always set here
                        'bidangList' => $bidangList,  // Ensure it's always set here
                        'table' => $tabulateData,
                    ];
                }
            }

            // Return the view with the processed data (whether filter is applied or not)
            return view('report', compact('data'));

        } catch (\Exception $e) {
            // If there's an exception, catch it and return an error message
            $errorMessage = 'Terjadi kesalahan pada kontroler.'.$e;

            // Always include the lists even in case of error
            return view('report', ['error_message' => $errorMessage, 'data' => $data]);
        }
    }

    public function getValidParams($params)
    {
        if ($params['filter'] == 1) {
            // Cek parameter yang kosong
            if (empty($params['skala'])) {
                return ['error' => 'Parameter skala kosong'];
            }
            if (empty($params['nama_laz'])) {
                return ['error' => 'Parameter nama_laz kosong'];
            }

            return [
                'filter' => $params['filter'],  // Default value is 0 if no filter is selected
                'skala' => $params['skala'], // "skala" parameter (optional)
                'laz_kode' => $params['nama_laz'], // "nama_laz" parameter (optional)
            ];
        } elseif ($params['filter'] == 2) {
            // Cek parameter yang kosong
            if (empty($params['provinsi_ktp'])) {
                return ['error' => 'Parameter provinsi_ktp kosong'];
            }
            if (empty($params['kabupaten_ktp'])) {
                return ['error' => 'Parameter kabupaten_ktp kosong'];
            }
            if (empty($params['kecamatan_ktp'])) {
                return ['error' => 'Parameter kecamatan_ktp kosong'];
            }
            if (empty($params['kelurahan_ktp'])) {
                return ['error' => 'Parameter kelurahan_ktp kosong'];
            }
            if (empty($params['alamat_ktp'])) {
                return ['error' => 'Parameter alamat_ktp kosong'];
            }

            return [
                'filter' => $params['filter'],  // Default value is 0 if no filter is selected
                'provinsi_ktp' => $params['provinsi_ktp'], // "skala" parameter (optional)
                'kabkota_ktp' => $params['kabupaten_ktp'], // "nama_laz" parameter (optional)
                'kecamatan_ktp' => $params['kecamatan_ktp'], // "nama_laz" parameter (optional)
                'kelurahan_ktp' => $params['kelurahan_ktp'], // "nama_laz" parameter (optional)
                'alamat_ktp' => $params['alamat_ktp'], // "nama_laz" parameter (optional)
            ];
        } elseif ($params['filter'] == 3) {
            // Cek parameter yang kosong
            if (empty($params['provinsi_domisili'])) {
                return ['error' => 'Parameter provinsi_domisili kosong'];
            }
            if (empty($params['kabupaten_domisili'])) {
                return ['error' => 'Parameter kabupaten_domisili kosong'];
            }
            if (empty($params['kecamatan_domisili'])) {
                return ['error' => 'Parameter kecamatan_domisili kosong'];
            }
            if (empty($params['kelurahan_domisili'])) {
                return ['error' => 'Parameter kelurahan_domisili kosong'];
            }
            if (empty($params['alamat_domisili'])) {
                return ['error' => 'Parameter alamat_domisili kosong'];
            }

            return [
                'filter' => $params['filter'],  // Default value is 0 if no filter is selected
                'provinsi_domisili' => $params['provinsi_domisili'], // "skala" parameter (optional)
                'kabkota_domisili' => $params['kabupaten_domisili'], // "nama_laz" parameter (optional)
                'kecamatan_domisili' => $params['kecamatan_domisili'], // "nama_laz" parameter (optional)
                'kelurahan_domisili' => $params['kelurahan_domisili'], // "nama_laz" parameter (optional)
                'alamat_domisili' => $params['alamat_domisili'], // "nama_laz" parameter (optional)
            ];
        } elseif ($params['filter'] == 4) {
            // Cek parameter yang kosong
            // if (empty($params['kk'])) {
            //     return ['error' => 'Parameter kk kosong'];
            // }
            if (empty($params['nik'])) {
                return ['error' => 'Parameter nik kosong'];
            }
            if (empty($params['nama'])) {
                return ['error' => 'Parameter nama kosong'];
            }
            if (empty($params['tgl_lahir_end'])) {
                return ['error' => 'Parameter tgl_lahir_end kosong'];
            }
            if (empty($params['tgl_lahir_start'])) {
                return ['error' => 'Parameter tgl_lahir_start kosong'];
            }
            if (empty($params['dokumen_ktp'])) {
                return ['error' => 'Parameter dokumen_ktp kosong'];
            }
            if (empty($params['agama'])) {
                return ['error' => 'Parameter agama kosong'];
            }
            if (empty($params['jenis_kelamin'])) {
                return ['error' => 'Parameter jenis_kelamin kosong'];
            }

            return [
                'filter' => $params['filter'],  // Default value is 0 if no filter is selected
                'kk' => $params['kk'], // "skala" parameter (optional)
                'nik' => $params['nik'], // "nama_laz" parameter (optional)
                'nama' => $params['nama'], // "nama_laz" parameter (optional)
                'tgl_lahir_end' => $params['tgl_lahir_end'], // "nama_laz" parameter (optional)
                'tgl_lahir_start' => $params['tgl_lahir_start'], // "nama_laz" parameter (optional)
                'dokumen_ktp' => $params['dokumen_ktp'], // "nama_laz" parameter (optional)
                'agama' => $params['agama'], // "nama_laz" parameter (optional)
                'jenis_kelamin' => $params['jenis_kelamin'], // "nama_laz" parameter (optional)
            ];
        } elseif ($params['filter'] == 5) {
            // Cek parameter yang kosong
            if (empty($params['kategori_program'])) {
                return ['error' => 'Parameter kategori_program kosong'];
            }
            if (empty($params['tipe_program'])) {
                return ['error' => 'Parameter tipe_program kosong'];
            }
            if (empty($params['nama_program'])) {
                return ['error' => 'Parameter nama_program kosong'];
            }
            if (empty($params['waktu_start'])) {
                return ['error' => 'Parameter awal waktu diberikan kosong'];
            }
            if (empty($params['waktu_end'])) {
                return ['error' => 'Parameter batas akhir waktu diberikan kosong'];
            }
            if (empty($params['valueMin'])) {
                return ['error' => 'Nilai Minimum Belum Ditentukan'];
            }
            if (empty($params['valueMax'])) {
                return ['error' => 'Nilai Maksimum Belum Ditentukan'];
            }

            return [
                'filter' => $params['filter'],  // Default value is 0 if no filter is selected
                'bidang_kode' => $params['kategori_program'], // "skala" parameter (optional)
                'nama_program' => $params['nama_program'], // "skala" parameter (optional)
                'tipe_program' => $params['tipe_program'], // "nama_laz" parameter (optional)
                'valueMin' => $params['valueMin'], // "nama_laz" parameter (optional)
                'valueMax' => $params['valueMax'], // "nama_laz" parameter (optional)
                'waktu_start' => $params['waktu_start'], // "nama_laz" parameter (optional)
                'waktu_end' => $params['waktu_end'], // "nama_laz" parameter (optional)
            ];
        }

    }
}
