<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use App\Http\Controllers\Controller;
use DB;
//use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    function import_data2(Request $request) {

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);

        if ($validator->fails()) {
            return implode(",",$validator->errors()->all());
        }

        if ($validator->passes()) {
            $file = $request->file('file');
            try {
                $spreadsheet  = IOFactory::load($file->getRealPath());
                $sheet        = $spreadsheet->getActiveSheet();
                $row_limit    = $sheet->getHighestDataRow();
                $column_limit = $sheet->getHighestDataColumn();
                $row_range    = range(2, $row_limit);
                $column_range = range('F', $column_limit);
                $startcount = 2;
                $data = array();
                foreach ($row_range as $row) {
                    $data[] = [
                       'id_number' => $sheet->getCell('A'.$row)->getValue(),
                       'full_name' => $sheet->getCell('B'.$row)->getValue(),
                       'username' => $sheet->getCell('C'.$row)->getValue(),
                       'password' => $sheet->getCell('D'.$row)->getValue(),
                       'section' => $sheet->getCell('E'.$row)->getValue(),
                       'role' => $sheet->getCell('F'.$row)->getValue()
                    ];
                    $startcount++;
                }
                
                $inserted = UserAccounts::insert($data);

                if ($inserted > 0) {
                    return 'success';
                } else {
                    return 'failed';
                }

                /*try {
                    DB::table('tbl1')->insert($data);
                } catch (QueryException $e) {
                    return 'QueryException: '.$e->getMessage();
                }
                return 'success';*/
            } catch (Exception $e) {
                return "There was a problem uploading the file : ".$e->getMessage();
            }
        }
    }
}
