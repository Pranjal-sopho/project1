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
        preg_match('/(?<=<title>)(.*),/',$string,$name);
        
        // get year of establishment
        preg_match('/(?<=Established ).*? /',$string,$yoe);
        
        // extracting college address
        preg_match('/(?<="address" : ").*/"?',$string,$address);
        
        // extracting website link
        preg_match('/(?<="url" :")(.*)"/',$string,$website);
        
        // finding courses offered
        $courses = [];
        $course = [];
        $i=0;
        
        // storing all the courses available in $courses
        preg_match_all('/(?<= class="li-dropdown-a").*</',$string,$courses);
        
        // trimming and storing them in $course
        while(true)
        {
          if(preg_match('/(?<=">)(.*)<\//',$courses[0][$i],$temp) == false)
            break;
          $course[i] = $temp[1];
          $i = $i+1;
        }
        
        // extracting college's infrastructural info
        $i=0; 
        preg_match_all('/(?<=<a class=").*/',$string,$ans);
        while(true)
        {
            if(preg_match('/(?<=">).*? /',$ans[0][$i],$infra[$i])== false)
                break;
            $i = $i+1;
        }
        
        // attempting to connect to mysql server
        $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
        if($link === false)
            die("ERROR: Could not connect. " . mysqli_connect_error());
            
        // attempting insert query
        $query = "INSERT INTO college_info (Name, Address,Year of establishment,College's Website) VALUES ($name, $address, $yoe,$website)";
        if(mysqli_query($link, $sql))
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
        
        // get college id
        $query = "SELECT Serial_number FROM college_info WHERE Name = $name";
        $id = mysqli($link,$query);
        
        // inserting the courses and infra fields in respective tables
        $i=0;
        while(true)
        {
            if($course[$i]== NULL)
                break;
            $query = "INSERT INTO courses (serial number,courses_offered) VALUES ($id, $course[$i])";
            mysqli_query($link, $query);
            $i = $i+1;
        }
    
        $i=0;
        while(true)
        {
            if($infra[$i]== NULL)
                break;
            $query = "INSERT INTO infrastructure (serial number,facilities) VALUES ($id, $infra[$i])";
            mysqli_query($link, $query);
            $i = $i+1;   
        }
        
        // closing connection
        mysqli_close($link);
    }
?>