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
    
    // implementing apologize
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
    }
    
    // scrapes data for a college and stores it in database
    function get_college_info($string)
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
        
        // inserting the data in the table college_info
        $length1= sizeof($name[1]);
        $i =0;
        
        while($length1--)
        {
            // trimming name and address furthur before storing
            $name[1][$i] =  preg_replace('/<a.*_blank">/',"",$name[1][$i]);
            $address[1][$i] = preg_replace('/\| /',"",$address[1][$i]);
            $query = "INSERT INTO college_info (Name,Address) VALUES (\"".$name[1][$i]."\",\"".$address[1][$i]."\")";
            $bool = mysqli_query($link, $query);
            
            //  Error checking
            if(!$bool)
                apologize("ERROR: Could not execute query. " . mysqli_error());
            
            $i++;
        }
        
        $id=1;
        // inserting data in table infrastructure
        $length2 = sizeof($infrastructure[1]);
        
        while ($length2--)
        {
            $query = "INSERT INTO infrastucture (college_id,facilities) VALUES (\"".$id."\",\"".$infrastructure[1][$i]."\")";
            $bool = mysqli_query($link,$query);
            
            //  Error checking
            if(!$bool)
                apologize("ERROR: Could not execute query. " . mysqli_error());
                
             if($infrastructure[1][$i]=="Labs")
                $id++;
                
            $i++;
        }
    
        // closing connection
        mysqli_close($link);
    }
?>