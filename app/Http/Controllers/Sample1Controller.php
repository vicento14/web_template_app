<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class Sample1Controller extends Controller
{
    function load() {
        $user_accounts = UserAccounts::select('id', 'id_number', 'full_name', 'username', 'section', 'role')->get();
        return $user_accounts;
    }

    function search(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = $request->query('full_name');
        $user_type = $request->query('user_type');

        $user_accounts = UserAccounts::select('id', 'id_number', 'full_name', 'username', 'section', 'role')->where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%'], ['role', 'like', $user_type . '%']])->get();
        return $user_accounts;
    }

    function insert(Request $request) {
        $employee_no = trim($request->input('employee_no'));
        $full_name = trim($request->input('full_name'));
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
        $section = trim($request->input('section'));
        $user_type = trim($request->input('user_type'));

        $user_accounts = UserAccounts::where('username', $username)->get();

        if ($user_accounts->isNotEmpty()) {
            echo 'Already Exist';
        } else {
            $inserted = UserAccounts::insert([
                'id_number' => $employee_no,
                'full_name' => $full_name,
                'username' => $username,
                'password' => $password,
                'section' => $section,
                'role' => $user_type
            ]);

            if ($inserted > 0) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

    function update(Request $request) {
        $id = $request->input('id');
        $id_number = trim($request->input('id_number'));
        $username = trim($request->input('username'));
        $full_name = trim($request->input('full_name'));
        $password = trim($request->input('password'));
        $section = trim($request->input('section'));
        $role = trim($request->input('role'));

        $user_accounts = UserAccounts::where([['username', $username], ['id_number', $id_number], ['full_name', $full_name], ['section', $section]])->get();

        if ($user_accounts->isNotEmpty()) {
            echo 'duplicate';
        } else {
            $updated = UserAccounts::where('id', $id)->update([
                'id_number' => $id_number,
                'full_name' => $full_name,
                'username' => $username,
                'password' => $password,
                'section' => $section,
                'role' => $role
            ]);

            if ($updated > 0) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

    function delete(Request $request) {
        $id = $request->input('id');

        $deleted = UserAccounts::where('id', $id)->delete();

        if ($deleted > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    function deleteSelected(Request $request) {
        $id_arr = [];
        $id_arr = $request->input('id_arr');

        // Check if the array is not empty
        if (empty($id_arr)) {
            return response()->json(['message' => 'No IDs provided'], 400);
        }

        // Chunk the IDs to avoid memory issues with large datasets
        $chunks = array_chunk($id_arr, 1000); // Adjust the chunk size as needed

        $deletedCount = 0;
        $isTransactionActive = false;

        try {
            // Begin transaction
            DB::beginTransaction();
            $isTransactionActive = true;

            foreach ($chunks as $chunk) {
                $deleted = UserAccounts::whereIn('id', $chunk)->delete();
                $deletedCount += $deleted;
            }

            // Commit the transaction
            DB::commit();
            $isTransactionActive = false;
            echo 'success';
            // return response()->json(['message' => 'success', 'deleted_count' => $deletedCount]);
        } catch (Exception $e) {
            // Rollback the transaction if something went wrong
            if ($isTransactionActive) {
                DB::rollBack();
                $isTransactionActive = false;
            }
            echo 'error: ' . $e->getMessage();
            // return response()->json(['message' => 'error: ' . $e->getMessage()], 500);
        }
    }

    function removeBomUtf8($s){
        if (substr($s,0,3) == chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))) {
            return substr($s,3);
        } else {
            return $s;
        }
    }

    function checkCsv($file) {

        //READ FILE
        $csv_file = fopen($file,'r');

        // SKIP FIRST LINE
        $first_line = fgets($csv_file);

        // Remove UTF-8 BOM from First Line
        $first_line = $this->removeBomUtf8($first_line);

        $hasError = 0; $hasBlankError = 0; $isExistsOnDb = 0; $isDuplicateOnCsv = 0;
        $hasBlankErrorArr = array();
        $isExistsOnDbArr = array();
        $isDuplicateOnCsvArr = array();
        $dup_temp_arr = array();

        $message = "";
        $check_csv_row = 0;

        $first_line = preg_replace('/[\t\n\r]+/', '', $first_line);
        $valid_first_line1 = '"ID Number","Full Name",Username,Password,Section,Role';
        $valid_first_line2 = "ID Number,Full Name,Username,Password,Section,Role";
        if ($first_line == $valid_first_line1 || $first_line == $valid_first_line2) {
            while (($line = fgetcsv($csv_file)) !== false) {
                // Check if the row is blank or consists only of whitespace
                if (empty(implode('', $line))) {
                    $check_csv_row++;
                    continue; // Skip blank lines
                }

                $check_csv_row++;

                $id_number = $line[0];
                $full_name = $line[1];
                $username = $line[2];
                $password = $line[3];
                $section = $line[4];
                $role = $line[5];

                // CHECK IF BLANK DATA
                if ($id_number == '' || $full_name == '' || $username == '' || $password == '' || $section == '' || $role == '') {
                    // IF BLANK DETECTED ERROR += 1
                    $hasBlankError++;
                    $hasError = 1;
                    array_push($hasBlankErrorArr, $check_csv_row);
                }

                // Joining all row values for checking duplicated rows
                $whole_line = join(',', $line);

                // CHECK ROWS IF IT HAS DUPLICATE ON CSV
                if (isset($dup_temp_arr[$whole_line])) {
                    $isDuplicateOnCsv = 1;
                    $hasError = 1;
                    array_push($isDuplicateOnCsvArr, $check_csv_row);
                } else {
                    $dup_temp_arr[$whole_line] = 1;
                }

                // CHECK ROWS IF EXISTS
                $user_accounts = UserAccounts::select('id')->where([['id_number', $id_number], ['full_name', $full_name], ['username', $username], ['section', $section], ['role', $role]])->get();

                if ($user_accounts->isNotEmpty()) {
                    $isExistsOnDb = 1;
                    $hasError = 1;
                    array_push($isExistsOnDbArr, $check_csv_row);
                }
            }
        } else {
            $message = $message . 'Invalid CSV Table Header. Maybe an incorrect CSV file or incorrect CSV header ';
        }

        fclose($csv_file);

        if ($hasError == 1) {
            if ($isExistsOnDb == 1) {
                $message = $message . 'Data Already Recorded on row/s ' . implode(", ", $isExistsOnDbArr) . '. ';
            }
            if ($hasBlankError >= 1) {
                $message = $message . 'Blank Cell/s Exists on row/s ' . implode(", ", $hasBlankErrorArr) . '. ';
            }
            if ($isDuplicateOnCsv == 1) {
                $message = $message . 'Duplicated Record/s on row/s ' . implode(", ", $isDuplicateOnCsvArr) . '. ';
            }
        }
        return $message;
    }

    function import3(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt'
        ]);

        if ($validator->fails()) {
            return implode(",",$validator->errors()->all());
        }

        if ($validator->passes()) {

            $file = $request->file('file');

            if ($file != null) {

                $chkCsvMsg = $this->checkCsv($file);

                if ($chkCsvMsg == '') {

                    //READ FILE
                    if (($csvFile = fopen($file, "r")) !== false) {

                        // SKIP FIRST LINE
                        fgetcsv($csvFile);

                        $user_accounts = array();

                        while (($line = fgetcsv($csvFile, 1000, ",")) !== false) {
                            // Check if the row is blank or consists only of whitespace
                            if (empty(implode('', $line))) {
                                continue; // Skip blank lines
                            }
                            $id_number = $line[0];
                            $full_name = $line[1];
                            $username = $line[2];
                            $password = $line[3];
                            $section = $line[4];
                            $role = $line[5];

                            $user_accounts[] = array(
                                'id_number' => $id_number,
                                'full_name' => $full_name,
                                'username' => $username,
                                'password' => $password,
                                'section' => $section,
                                'role' => $role
                            );
                        }

                        fclose($csvFile);

                        $user_accounts_chunk = array_chunk($user_accounts, 250);

                        foreach ($user_accounts_chunk as $user_account) {
                            UserAccounts::insert($user_account);
                        }

                    } else {
                        echo 'Reading CSV file Failed! Try Again or Contact IT Personnel if it fails again';
                    }

                } else {
                    echo $chkCsvMsg;
                }

            } else {
                echo 'Please upload a CSV file';
            }
        }
    }
}
