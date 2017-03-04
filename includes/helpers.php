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
    
    function get_college_info($string)
    {
        // extracting college name
        preg_match_all('/(?<=class="tuple-clg-heading">)(.*)<\/a>/',$string,$name);
        
        // extracting college address
        preg_match_all('/(?<=<p>| )(.*)<\/p><\/h2>/',$string,$address);
        
        // extracting infrastructural info
        preg_match_all('/(?<=<h3>)(.*)<\/h3>/',$string,$infrastructure);
        
        // storing number of reviews
        preg_match_all('/(?<= class=<span><b>)(.*)</b></',$string,$reviews);
        
        // attempting to connect to mysql server
        $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
        if($link === false)
            die("ERROR: Could not connect. " . mysqli_connect_error());
        
        // get college id
        $query = "SELECT Serial_number FROM college_info WHERE Name = $name";
        $id = mysqli_query($link,$query);
        
        // inserting the data in the table college_info
        $length1= sizeof($name[1]);
        $i =0;
        
        while($length1--)
        {
            // trimming name and address furthur before storing
            $name[1][$i] =  preg_replace('/<a.*_blank">/',"",$name[1][$i]);
            $address[1][$i] = preg_replace('/\| /',"",$address[1][$i]);
            $query = "INSERT INTO college_info (Name,Address) VALUES ($name[1][$i], $address[1][$i])";
            $bool = mysqli_query($link, $query);
            
            //  Error checking
            if(!$bool)
                echo "ERROR: Could not execute query. " . mysqli_error();
            
            $i++;
        }
        
        $id=1;
        // inserting data in table infrastructure
        $length2 = sizeof($infrastructure[1]);
        
        while ($length2--)
        {
            if($infrastructure[1][$i]=="Labs")
            {
                $id++;
            }
            $query = "INSERT INTO infrastucture (college_id,facilities) VALUES ($id,$infrastructure[1][$i])";
            $bool = mysqli_query($link,$query);
            
            //  Error checking
            if(!$bool)
                echo "ERROR: Could not execute query. " . mysqli_error();
        }
    
        // closing connection
        mysqli_close($link);
    }
?>