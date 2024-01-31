<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use App\Http\Controllers\Controller;
use DB;
//use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class ExportController extends Controller
{
    function export_data2 (Request $request, $employee_no = null, $full_name = null) {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%']])->get();
            $data_array [] = array('#', 'ID Number', 'Full Name', 'Username', 'Password', 'Section', 'Role');
            $c = 0;
            foreach ($user_accounts as $row) {
                $c++;
                $data_array [] = array($c, $row->id_number, $row->full_name, $row->username, $row->password, $row->section, strtoupper($row->role));
            }
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($data_array, null, 'A1');
            $this->export_csv($spreadSheet);
            exit();

            /*try {
                $query = "SELECT `col2`, `col3`, `col4` FROM `tbl1`";
                $results = DB::select($query);
                $results = array_map(function ($value) {
                    return (array)$value;
                }, $results);
                $c = 0;
                $index = [];
                foreach ($results as $row) {
                    $c++;
                    array_push($index, $c);
                }
                $index = array_chunk($index, 1);
                $spreadSheet = new Spreadsheet();
                $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
                $spreadSheet->getActiveSheet()->getCell('A1')->setValue('Col1');
                $spreadSheet->getActiveSheet()->getCell('B1')->setValue('Col2');
                $spreadSheet->getActiveSheet()->getCell('C1')->setValue('Col3');
                $spreadSheet->getActiveSheet()->getCell('D1')->setValue('Col4');
                $spreadSheet->getActiveSheet()->fromArray($index, null, 'A2');
                $spreadSheet->getActiveSheet()->fromArray($results, null, 'B2');
                $this->export_csv($spreadSheet);
                exit();
            } catch (QueryException $e) {
                return 'QueryException: '.$e->getMessage();
            }*/
        } catch (Exception $e) {
           return "There was a problem on exporting the data : ".$e->getMessage();
        }
    }

    function export_xls($spreadSheet) {
        $Excel_writer = new Xls($spreadSheet);
        $datenow = date('Y-m-d');
        $filename = "Export Accounts 3 - ".$datenow.".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $Excel_writer->save('php://output');
    }

    function export_xlsx($spreadSheet) {
        $Excel_writer = new Xlsx($spreadSheet);
        $datenow = date('Y-m-d');
        $filename = "Export Accounts 3 - ".$datenow.".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $Excel_writer->save('php://output');
    }

    function export_csv($spreadSheet) {
        $Excel_writer = new Csv($spreadSheet);
        $datenow = date('Y-m-d');
        $filename = "Export Accounts 3 - ".$datenow.".csv";
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $Excel_writer->setUseBOM(true);
        $Excel_writer->save('php://output');
    }
}
