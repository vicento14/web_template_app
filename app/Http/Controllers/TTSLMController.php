<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TT1;
use App\Models\TT2;

class TTSLMController extends Controller
{
    function countTT1Data(Request $request) {
        return TT1::all()->count();
    }

    function countTT2Data(Request $request, $c1 = null) {
        if (empty($c1)) {
            $c1 = $request->query('c1');
        }
        return TT2::where('c1', $c1)->count();
    }

    function lastPageTT1Data(Request $request) {
        $results_per_page = 10;

        $number_of_result = $this->countTT1Data($request);

        //determine the total number of pages available
        $number_of_page = ceil($number_of_result / $results_per_page);

        return $number_of_page;
    }

    function lastPageTT2Data(Request $request) {
        $c1 = $request->query('c1');

        $results_per_page = 10;

        $number_of_result = $this->countTT2Data($request, $c1);

        //determine the total number of pages available
        $number_of_page = ceil($number_of_result / $results_per_page);

        return $number_of_page;
    }

    function loadTT1Data(Request $request) {
        $current_page = intval($request->query('current_page'));
        $c = 0;

        $results_per_page = 10;

        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($current_page-1) * $results_per_page;

        $c = $page_first_result;

        $tt1 = TT1::all()->skip($page_first_result)->take($results_per_page);

        if ($tt1->isNotEmpty()) {
            foreach ($tt1 as $row) {
                $c++;

                echo '<tr style="cursor:pointer;" class="modal-trigger" onclick="load_t_t2(&quot;'.$row->id.'~!~'.$row->c1.'&quot;)">';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->c1.'</td>';
                    echo '<td>'.$row->c2.'</td>';
                    echo '<td>'.$row->c3.'</td>';
                    echo '<td>'.$row->c4.'</td>';
                    echo '<td>'.$row->updated_at.'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }
    }

    function loadTT2Data(Request $request) {
        $current_page = intval($request->query('current_page'));
        $c1 = $request->query('c1');

        $c = 0;

        $results_per_page = 10;

        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($current_page-1) * $results_per_page;

        $c = $page_first_result;

        $tt2 = TT2::where('c1', $c1)->skip($page_first_result)->take($results_per_page)->get();

        if ($tt2->isNotEmpty()) {
            foreach ($tt2 as $row) {
                $c++;

                echo '<tr>';
                    echo '<td>'.$c.'</td>';
                    echo '<td>'.$row->c1.'</td>';
                    echo '<td>'.$row->d1.'</td>';
                    echo '<td>'.$row->d2.'</td>';
                    echo '<td>'.$row->d3.'</td>';
                    echo '<td>'.$row->updated_at.'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
                echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }
    }
}
