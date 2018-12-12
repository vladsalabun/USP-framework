<?php

    // версія 1.1 (12 грудня 2018)

    class tableGenerator
    {
        public function tableStart($array = null)
        {
            if ($array == null) {
              return '
                  <!--- TABLE ---><table class="table table-striped">
              ';
            } else {
              $string .= '
                  <!--- TABLE ---><table class="'.$array['class'].'">
                  <thead>
                      <tr>';
              foreach ($array['th'] as $value){
                 $string .= '<th scope="col">'.$value.'</th>';
              }
              $string .= '</tr>
                  </thead>
                  <tbody>
              ';
              return $string;
            }
        }

        public function tableEnd($array = null)
        {
            return '</tbody></table><!--- /TABLE --->';
        }

        public function tr($array = null)
        {
            $string .= '<tr>';
            foreach ($array as $value) {
                if (is_array($value)) {
                        $string .= '<td colspan="'.$value[0].'">'.$value[1].'</td>';
                } else {
                    $string .= '<td>'.$value.'</td>';
                }
            }
            $string .= '</tr>';
            return $string;
        }

        /******* AUTOGENERATOR **********/

        public function fullPageDataSheet($trArray)
        {
            $string .= $this->tableStart();
            foreach ($trArray as $tdArray) {
                $string .= $this->tr($tdArray);
            }
            $string .= $this->tableEnd();

            return $string;
        }


    }
