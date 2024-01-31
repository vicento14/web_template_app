<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TT1;
use App\Models\TT2;

class TTSController extends Controller
{
    function loadTT1() {
        $c = 0;

        echo '<thead style="text-align: center;">
            <tr>
              <th> # </th>
              <th> C1 </th>
              <th> C2 </th>
              <th> C3 </th>
              <th> C4 </th>
              <th> Date Updated </th>
            </tr>
          </thead>
          <tbody id="t_t1_data" style="text-align: center;">';

        if (TT1::all()->isNotEmpty()) {
            foreach (TT1::all() as $row) {
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

        echo '</tbody>';
    }

    function loadTT2(Request $request) {
        $c1 = $request->query('c1');

        $c = 0;

        echo '<thead style="text-align: center;">
            <tr>
              <th> # </th>
              <th> C1 </th>
              <th> D1 </th>
              <th> D2 </th>
              <th> D3 </th>
              <th> Date Updated </th>
            </tr>
          </thead>
          <tbody id="t_t2_data" style="text-align: center;">';

        $tt2 = TT2::where('c1', $c1)->get();

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

        echo '</tbody>';
    }
}
