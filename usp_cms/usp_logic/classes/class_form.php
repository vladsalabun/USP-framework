<?php
    
    // версія 1.1 (23 вересня 2018)
    
    class formGenerator
    {
        //print_r(configuration::FORM);
        
        public function formStart($array = null)
        {
            if (isset($array['enctype']) == 'multipart/form-data') {
                $enctype = 'enctype="multipart/form-data"';
            }
            if (isset($array['method'])) { 
                $method = $array['method'];
            } else {
                $method = 'post';
            }
            if (isset($array['autocomplete'])) {
                $autocomplete = $array['autocomplete'];
            } else {
                $autocomplete = 'off';
            }
            if (isset($array['id'])) {
                $formID = 'id="'.$array['id'].'"';
            } else {
                $formID = '';
            }
            
            if (isset($array['class'])) {
                $formClass = 'class="'.$array['class'].'"';
            } else {
                $formClass = '';
            }
            
            if ($array == null) {
                return '<!--- FORM ---><form method="post" action="" autocomplete="off">';
            } else {
                return '<!--- FORM ---><form method="'.$method.'" '.$enctype.' action="'.$array['action'].'" autocomplete="'.$autocomplete.'" '.$formID.' '.$formClass.'>';
            }
        }
        
        public function formEnd($array = null)
        {
            return '</form><!--- /FORM --->';
        }
        
        public function hidden($array = null)
        {
            return '<input type="hidden" name="'.$array['name'].'" value="'.$array['value'].'">';
        }
        
        public function text($array = null)
        {
            if (isset($array['class'])) {
                $class = 'class="'.$array['class'].'"';
            }
            return '<input type="text" name="'.$array['name'].'" value="'.$array['value'].'" placeholder="'.$array['placeholder'].'" '.$class.'>';
        }

        public function textarea($array = null)
        {
            if (isset($array['class'])) {
                $class = 'class="'.$array['class'].'"';
            }
            return '<textarea name="'.$array['name'].'" '.$class.'>'.$array['value'].'</textarea>';
        }
        
        public function uploadFile($array = null)
        {
            if (isset($array['name'])) {
                $name = $array['name'];
            } else {
                $name = 'file';
            }
            return '<input name="'.$name.'" type="file">';
        } 

        public function select($array = null, $selected = null)
        {
            $sting = '<select name="'.$array['name'].'[]">';
            
            foreach ($array['value'] as $key => $value) {
                if ($key == $selected) {
                    $select = ' selected ';
                } else {
                    $select = '';
                }
                $sting .= '<option value="'.$key.'"'.$select.'>'.$value.'</option>';
            }
            
            $sting .= '</select>';
            return $sting;
        }       
 
        public function datetime($array = null)
        {
            return '<input type="datetime-local" name="'.$array['name'].'" value="'.$array['value'].'">';
        }
 
        public function submit($array = null) 
        {
            if ($array == null) {
                return '<input type="submit" name="submit" value="Submit">';
            } else {
                return '<input type="submit" name="'.$array['name'].'" value="'.$array['value'].'" class="'.$array['class'].'">';
            }
        }
        

        public function button($array = null) 
        {
            return '<button type="button" class="'.$array['class'].'">'.$array['anchor'].'</button>';
        }
        
        public function checkbox($array = null) 
        {

            $i = 1;
            
            foreach ($array['value'][0] as $key => $value) {
                
                if($value == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                
                $string .= '
                    <fieldset>
                            <input class="form-check-input" type="checkbox" name="'.$key.'" value="'.$value.'" id="'.$array['name'].'_'.$key.$i.'" '.$checked.'>
                            <label class="form-check-label" for="'.$array['name'].'_'.$key.$i.'">'.$key.' '.$value.'</label>
                    </fieldset>
                ';
                
                $i++;
            }
      
            return $string; 
        
        }

        
 
    }