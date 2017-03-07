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
    
    // keeping count of serial numbers (due to problems in auto increment) 
    $GLOBALS["number"] = 0;
    
    // implementing apologize
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
    }
    
    // scrapes data for a college and stores it in database
    function get_college_info($string,$page)
    {
        // extracting college name
        preg_match_all('/(?<=class="tuple-clg-heading">)(.*)<\/a>/',$string,$name);
        
        // extracting college address
        preg_match_all('/(?<=<p>| )(.*)<\/p><\/h2>/',$string,$address);
        
        // extracting infrastructural info
        preg_match_all('/(?<=<h3>)(.*)<\/h3>/',$string,$infrastructure);
        
        // storing number of reviews
        preg_match_all('/(?<= class=<span><b>)(.*)<\/b></',$string,$reviews);
        
        // attempting to connect to mysql server
        $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
        
        if($link === false)
            die("ERROR: Could not connect. " . mysqli_connect_error());
            
         // deleting data previously stored in tables college_info and infrastructure(if any), but only if it's a different city
        if($page == 1)
        {
            $query = "DELETE FROM college_info WHERE Serial_number !=0 ";
            $bool = mysqli_query($link,$query);
            
            if(!$bool)
                apologize("ERROR: Could not execute query. " . mysqli_error($link));
            
            $query = "DELETE FROM infrastructure WHERE college_id !=0";
            $bool = mysqli_query($link,$query);
            
            if(!$bool)
                apologize("ERROR: Could not execute query. " . mysqli_error($link));
        }
            
        // inserting the data in the table college_info
        $length1= sizeof($name[1]);
        $i =0;

        while($i < $length1)
        {
            $GLOBALS["number"]++;
            
            // trimming name and address furthur before storing
            $name[1][$i] =  preg_replace('/<a.*_blank">/',"",$name[1][$i]);
            $address[1][$i] = preg_replace('/\| /',"",$address[1][$i]);
            
            // now storing in database
            $query = "INSERT INTO college_info (Serial_number,Name,Address) VALUES (\"".$GLOBALS["number"]."\",\"".htmlspecialchars($name[1][$i])."\",\"".$address[1][$i]."\")";
            $bool = mysqli_query($link, $query);
            
            if(!$bool)
                apologize("ERROR: Could not execute query. " . mysqli_error($link));
            
            $i++;
        }
        
        $id=0;
        
        // inserting data in table infrastructure
        $length2 = sizeof($infrastructure[1]);
        $i=0;
        
        while ($length2--)
        {
             if($infrastructure[1][$i]=="Library")
                $id++;
                
            $query = "INSERT INTO infrastructure (college_id,facilities) VALUES (\"".$id."\",\"".$infrastructure[1][$i]."\")";
            $bool = mysqli_query($link,$query);
            
            $i++;
        }
        
        // closing connection
        mysqli_close($link);
    }
?>