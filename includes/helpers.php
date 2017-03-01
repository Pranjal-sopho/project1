<?php
    // implementing render
    function render($view, $values = [])
    {
        // extract variables into local scope
        extract($values);

        // render view 
        require("../views/{$view}");
        exit;
    }
    
    function get_college_info($college_link)
    {
        $string = file_get_contents($college_link);
        
        // extracting college name
        preg_match('/(?<=class="head-3 right-head">)(.*)<s/',$string,$address);
        
        // get year of establishment
        preg_match('/(?<=Established ).*? /',$string,$yoe);
        
        // extracting college address
        preg_match('/(?<="address" : ").*/"?',$string,$address);
        
        // extracting website link
        preg_match('/(?<="url" :")(.*)"/',$string,$website);
        
        // finding courses offered
        $courses = [];
        $i=0;
        preg_match_all('/(?<= class="li-dropdown-a").*</',$string,$courses);
        while(true)
        {
          preg_match('/(?<=">)(.*),/',$courses[$i][0],$course);
          $courses[i] = $course[1];
          $i = $i+1;
           
        }
        
    }
?>