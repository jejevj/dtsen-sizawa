<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        try {
            // Fetch the summary data from the ReportModel
            $summaryData = ReportModel::getSummary();
            $genderData = ReportModel::getDataByGender();  // Get gender-related data
            $penyaluranData = ReportModel::getPenyaluranByGender();  // Get penyaluran by gender
            $programData = ReportModel::getPenyaluranByProgram();  // Get penyaluran by gender
            $bidangData = ReportModel::getPenyaluranByBidang();  // Get penyaluran by gender
            $timeSeriesData = ReportModel::getTimeSeriesData();
            // Prepare the data array
            $data = [
                'penerima_manfaat' => $summaryData->penerima_manfaat ?? 0,
                'penyaluran' => $summaryData->penyaluran ?? 0,
                'male_count' => $genderData->male_count ?? 0,
                'female_count' => $genderData->female_count ?? 0,
                'total' => $genderData->total ?? 0,
                'male_total_penyaluran' => $penyaluranData->male_total_penyaluran ?? 0,
                'female_total_penyaluran' => $penyaluranData->female_total_penyaluran ?? 0,
                'tidak_langsung_total' => $programData->tidak_langsung_total ?? 0,
                'langsung_total' => $programData->langsung_total ?? 0,
                'bidangData' => $bidangData,  // Pass bidang data
                'timeSeriesData' => $timeSeriesData,  // Pass bidang data
            ];

            // If there's an error, pass the error message and data
            if (isset($summaryData['error']) || isset($genderData['error'])) {
                return view('report', [
                    'error_message' => $summaryData['error'] ?? $genderData['error'],
                    'data' => $data,
                ]);
            }

            // Return the view with data
            return view('report', compact('data'));

        } catch (\Exception $e) {
            $errorMessage = 'Terjadi kesalahan pada kontroler.';

            return view('report', ['error_message' => $errorMessage, 'data' => []]);
        }
    }

}
