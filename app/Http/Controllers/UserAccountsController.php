<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Validator;

class UserAccountsController extends Controller
{
    function load() {
        $c = 0;

        if (UserAccounts::all()->isNotEmpty()) {
            foreach (UserAccounts::all() as $row) {
                $c++;
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$row->id.'~!~'.$row->id_number.'~!~'.$row->username.'~!~'.$row->full_name.'~!~'.$row->password.'~!~'.$row->section.'~!~'.$row->role.'&quot;)">';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->id_number.'</td>';
                    echo '<td>'.$row->username.'</td>';
                    echo '<td>'.$row->full_name.'</td>';
                    echo '<td>'.$row->section.'</td>';
                    echo '<td>'.strtoupper($row->role).'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }

        /*$user_accounts = UserAccounts::all();
        return $user_accounts;*/
    }

    function count(Request $request, $employee_no = null, $full_name = null, $role = null) {
        if (empty($employee_no)) {
            $employee_no = $request->query('employee_no');
        }
        if (empty($full_name)) {
            $full_name = $request->query('full_name');
        }
        if (empty($role)) {
            $role = $request->query('user_type');
        }
        return UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%'], ['role', 'like', $role . '%']])->count();
    }

    function search(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = $request->query('full_name');
        $user_type = $request->query('user_type');

        $c = 0;

        $user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%'], ['role', 'like', $user_type . '%']])->get();

        if ($user_accounts->isNotEmpty()) {
            foreach ($user_accounts as $row) {
                $c++;
                echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$row->id.'~!~'.$row->id_number.'~!~'.$row->username.'~!~'.$row->full_name.'~!~'.$row->password.'~!~'.$row->section.'~!~'.$row->role.'&quot;)">';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->id_number.'</td>';
                    echo '<td>'.$row->username.'</td>';
                    echo '<td>'.$row->full_name.'</td>';
                    echo '<td>'.$row->section.'</td>';
                    echo '<td>'.strtoupper($row->role).'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }

        /*$user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%'], ['role', 'like', $user_type . '%']])->get();
        return $user_accounts;*/
    }

    function searchPageP(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = $request->query('full_name');
        $user_type = $request->query('user_type');
        $current_page = intval($request->query('current_page'));
        $order_by_code = intval($request->query('order_by_code'));
        $c = 0;

        $number_of_result = $this->count($request, $employee_no, $full_name, $user_type);

        $results_per_page = 10;

        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($current_page-1) * $results_per_page;

        // Table Header Sort Behavior
        switch ($order_by_code) {
            case 0:
            case 2:
            case 4:
            case 6:
            case 8:
            case 10:
                $c = $page_first_result;
                break;
            case 1:
            case 3:
            case 5:
            case 7:
            case 9:
            case 11:
                $c = ($number_of_result - $page_first_result) + 1;
                break;
            default:
        }

        $user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%'], ['role', 'like', $user_type . '%']])
                            ->when($order_by_code, function ($query, $order_by_code) {
                                // Table Header Sort Behavior
                                switch ($order_by_code) {
                                    case 0:
                                        return $query->orderBy('id', 'asc');
                                        break;
                                    case 1:
                                        return $query->orderBy('id', 'desc');
                                        break;
                                    case 2:
                                        return $query->orderBy('id_number', 'asc');
                                        break;
                                    case 3:
                                        return $query->orderBy('id_number', 'desc');
                                        break;
                                    case 4:
                                        return $query->orderBy('username', 'asc');
                                        break;
                                    case 5:
                                        return $query->orderBy('username', 'desc');
                                        break;
                                    case 6:
                                        return $query->orderBy('full_name', 'asc');
                                        break;
                                    case 7:
                                        return $query->orderBy('full_name', 'desc');
                                        break;
                                    case 8:
                                        return $query->orderBy('section', 'asc');
                                        break;
                                    case 9:
                                        return $query->orderBy('section', 'desc');
                                        break;
                                    case 10:
                                        return $query->orderBy('role', 'asc');
                                        break;
                                    case 11:
                                        return $query->orderBy('role', 'desc');
                                        break;
                                    default:
                                }
                            })
                            ->skip($page_first_result)->take($results_per_page)->get();

        if ($user_accounts->isNotEmpty()) {
            foreach ($user_accounts as $row) {
                // Table Header Sort Behavior
                switch ($order_by_code) {
                    case 0:
                    case 2:
                    case 4:
                    case 6:
                    case 8:
                    case 10:
                        $c++;
                        break;
                    case 1:
                    case 3:
                    case 5:
                    case 7:
                    case 9:
                    case 11:
                        $c--;
                        break;
                    default:
                }

                echo '<tr>';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->id_number.'</td>';
                    echo '<td>'.$row->username.'</td>';
                    echo '<td>'.$row->full_name.'</td>';
                    echo '<td>'.$row->section.'</td>';
                    echo '<td>'.strtoupper($row->role).'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }
    }

    function searchPageL(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = $request->query('full_name');
        $user_type = $request->query('user_type');
        $current_page = intval($request->query('current_page'));
        $c = 0;

        $results_per_page = 10;

        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($current_page-1) * $results_per_page;

        $c = $page_first_result;

        $user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%'], ['role', 'like', $user_type . '%']])->skip($page_first_result)->take($results_per_page)->get();

        if ($user_accounts->isNotEmpty()) {
            foreach ($user_accounts as $row) {
                $c++;

                echo '<tr>';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->id_number.'</td>';
                    echo '<td>'.$row->username.'</td>';
                    echo '<td>'.$row->full_name.'</td>';
                    echo '<td>'.$row->section.'</td>';
                    echo '<td>'.strtoupper($row->role).'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }
    }

    function searchPageK(Request $request) {
        $employee_no = $request->query('employee_no');
        $current_page = intval($request->query('current_page'));
        $c = 0;

        $results_per_page = 10;

        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($current_page-1) * $results_per_page;

        $c = $page_first_result;

        $user_accounts = UserAccounts::where('id_number', 'like', $employee_no . '%')->skip($page_first_result)->take($results_per_page)->get();

        if ($user_accounts->isNotEmpty()) {
            foreach ($user_accounts as $row) {
                $c++;

                echo '<tr>';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->id_number.'</td>';
                    echo '<td>'.$row->username.'</td>';
                    echo '<td>'.$row->full_name.'</td>';
                    echo '<td>'.$row->section.'</td>';
                    echo '<td>'.strtoupper($row->role).'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }
    }

    function searchPaginationPageP(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = $request->query('full_name');
        $user_type = $request->query('user_type');

        $results_per_page = 10;

        $number_of_result = $this->count($request, $employee_no, $full_name, $user_type);

        //determine the total number of pages available  
        $number_of_page = ceil($number_of_result / $results_per_page);

        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<option value="'.$page.'">'.$page.'</option>';
        }
    }

    function searchLastPageL(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = $request->query('full_name');
        $user_type = $request->query('user_type');

        $results_per_page = 10;

        $number_of_result = $this->count($request, $employee_no, $full_name, $user_type);

        //determine the total number of pages available  
        $number_of_page = ceil($number_of_result / $results_per_page);

        return $number_of_page;
    }

    function searchLastPageK(Request $request) {
        $employee_no = $request->query('employee_no');
        $full_name = '';
        $user_type = '';

        $results_per_page = 10;

        $number_of_result = $this->count($request, $employee_no, $full_name, $user_type);

        //determine the total number of pages available  
        $number_of_page = ceil($number_of_result / $results_per_page);

        return $number_of_page;
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

    function export(Request $request, $employee_no = null, $full_name = null) {
        $c = 0;

        $datenow = date('Y-m-d');
        $filename = "Export Accounts 3 - ".$datenow.".xls";

        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 

        // UTF-8 BOM for special character compatibility
        fputs($f, "\xEF\xBB\xBF");

        // Set column headers 
        $fields = array('#', 'ID Number', 'Full Name', 'Username', 'Password', 'Section', 'Role'); 
        fputcsv($f, $fields);

        $user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%']])->get();

        if ($user_accounts->isNotEmpty()) {
            foreach ($user_accounts as $row) {
                $c++;
                $lineData = array($c, $row->id_number, $row->full_name, $row->username, $row->password, $row->section, strtoupper($row->role)); 
                fputcsv($f, $lineData); 
            }
        }

        // Move back to beginning of file 
        fseek($f, 0); 
         
        // Set headers to download file rather than displayed 
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";'); 
         
        //output all remaining data on a file pointer 
        fpassthru($f);
    }

    function export3(Request $request, $employee_no = null, $full_name = null) {
        $c = 0;

        $delimiter = ","; 
        $datenow = date('Y-m-d');
        $filename = "Export Accounts 3 - ".$datenow.".csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 

        // UTF-8 BOM for special character compatibility
        fputs($f, "\xEF\xBB\xBF");

        // Set column headers 
        $fields = array('#', 'ID Number', 'Full Name', 'Username', 'Password', 'Section', 'Role'); 
        fputcsv($f, $fields, $delimiter);

        $user_accounts = UserAccounts::where([['id_number', 'like', $employee_no . '%'], ['full_name', 'like', $full_name . '%']])->get();

        if ($user_accounts->isNotEmpty()) {
            foreach ($user_accounts as $row) {
                $c++;
                $lineData = array($c, $row->id_number, $row->full_name, $row->username, $row->password, $row->section, strtoupper($row->role)); 
                fputcsv($f, $lineData, $delimiter); 
            }
        }

        // Move back to beginning of file 
        fseek($f, 0); 
         
        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";'); 
         
        //output all remaining data on a file pointer 
        fpassthru($f);
    }

    function import(Request $request) {
        if ($request->filled('download_template')) {
            return redirect(asset('/template/accounts_template.csv'));
        } else if ($request->filled('upload')) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:csv,txt'
            ]);

            if ($validator->fails()) {
                //route('admin/accounts', [], false) // relative path
                //route('admin/accounts') // absolute path
                echo '<script>
                    var x = confirm("'.implode(",",$validator->errors()->all()).'");
                    if(x == true){
                        location.href = "'.route('admin/accounts').'";
                    }else{
                        location.href = "'.route('admin/accounts').'";
                    }
                </script>';
            }

            if ($validator->passes()) {
                $file = $request->file('file');
                if ($file != null) {
                    //READ FILE
                    $csvFile = fopen($file,'r');
                    // SKIP FIRST LINE
                    fgetcsv($csvFile);
                    // PARSE
                    $error = 0;
                    while (($line = fgetcsv($csvFile)) !== false) {
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
                        // CHECK IF BLANK DATA
                        if ($id_number == '' || $full_name == '' || $username == '' || $password == '' || $section == '' || $role == '') {
                            // IF BLANK DETECTED ERROR += 1
                            $error++;
                        } else {
                            $user_accounts = UserAccounts::where([['id_number', $id_number], ['username', $username]])->get();

                            if ($user_accounts->isNotEmpty()) {
                                foreach ($user_accounts as $row) {
                                    $id = $row->id;
                                }

                                $updated = UserAccounts::where('id', $id)->update([
                                    'id_number' => $id_number,
                                    'full_name' => $full_name,
                                    'username' => $username,
                                    'password' => $password,
                                    'section' => $section,
                                    'role' => $role
                                ]);

                                if ($updated > 0) {
                                    $error = 0;
                                } else {
                                    $error++;
                                }
                            } else {
                                $inserted = UserAccounts::insert([
                                    'id_number' => $id_number,
                                    'full_name' => $full_name,
                                    'username' => $username,
                                    'password' => $password,
                                    'section' => $section,
                                    'role' => $role
                                ]);

                                if ($inserted > 0) {
                                    $error = 0;
                                } else {
                                    $error++;
                                }
                            }
                        }
                    }
                    
                    fclose($csvFile);

                    if ($error > 0) {
                        echo '<script>
                            var x = confirm("WITH ERROR! # OF ERRORS '.$error.'");
                            if(x == true){
                                location.href = "'.route('admin/accounts').'";
                            }else{
                                location.href = "'.route('admin/accounts').'";
                            }
                        </script>';
                    } else {
                        echo '<script>
                            var x = confirm("SUCCESS");
                            if(x == true){
                                location.href = "'.route('admin/accounts').'";
                            }else{
                                location.href = "'.route('admin/accounts').'";
                            }
                        </script>';
                    }
                } else {
                    echo '<script>
                        var x = confirm("Please Upload File");
                        if(x == true){
                            location.href = "'.route('admin/accounts').'";
                        }else{
                            location.href = "'.route('admin/accounts').'";
                        }
                    </script>';
                }
            }
        }
    }

    function import2(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt'
        ]);

        if ($validator->fails()) {
            return implode(",",$validator->errors()->all());
        }

        if ($validator->passes()) {
            $file = $request->file('file');
            if ($file != null) {
                //READ FILE
                $csvFile = fopen($file,'r');
                // SKIP FIRST LINE
                fgetcsv($csvFile);
                // PARSE
                $error = 0;
                while (($line = fgetcsv($csvFile)) !== false) {
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
                    // CHECK IF BLANK DATA
                    if ($id_number == '' || $full_name == '' || $username == '' || $password == '' || $section == '' || $role == '') {
                        // IF BLANK DETECTED ERROR += 1
                        $error++;
                    } else {
                        $user_accounts = UserAccounts::where([['id_number', $id_number], ['username', $username]])->get();

                        if ($user_accounts->isNotEmpty()) {
                            foreach ($user_accounts as $row) {
                                $id = $row->id;
                            }

                            $updated = UserAccounts::where('id', $id)->update([
                                'id_number' => $id_number,
                                'full_name' => $full_name,
                                'username' => $username,
                                'password' => $password,
                                'section' => $section,
                                'role' => $role
                            ]);

                            if ($updated > 0) {
                                $error = 0;
                            } else {
                                $error++;
                            }
                        } else {
                            $inserted = UserAccounts::insert([
                                'id_number' => $id_number,
                                'full_name' => $full_name,
                                'username' => $username,
                                'password' => $password,
                                'section' => $section,
                                'role' => $role
                            ]);

                            if ($inserted > 0) {
                                $error = 0;
                            } else {
                                $error++;
                            }
                        }
                    }
                }
                
                fclose($csvFile);

                if ($error > 0) {
                    echo 'WITH ERROR! # OF ERRORS '.$error.' '; 
                }
            } else {
                echo 'Please Upload File';
            }
        }
    }
}
