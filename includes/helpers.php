<?php
    /* this file contains all necessary functions for working of the app */
    
    // implementing render
    function render($view, $values = [])
    {
        // extract variables into local scope
        extract($values);

        // render view with header and footer
        require("../views/header.php");
        require("../views/{$view}");
        require("../views/footer.php");
        exit;
    }
    
    // keeping count of serial numbers (due to problems in auto increment) 
    $GLOBALS["id1"] = 0;
    $GLOBALS["id2"] =0;
    
    // implementing apologize
    function apologize($message)
    {
        render("apology.php", ["message" => $message,"title" => "Sorry!"]);
    }
    
    // query database for insertion, selection and deletion
    function query($query)
    {
        // attempting to connect to mysql server
        $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            
        if($link === false)
            apologize("ERROR: Could not execute query. 1" . mysqli_error($link));
            
        // checking if the query is one of insert, update or delete
        preg_match('/.*? /',$query,$match);
        
        // querying database
        $result = mysqli_query($link,$query);
        
        if($result === false )
            apologize("ERROR: Could not execute query.2 " . mysqli_error($link));
        
        // if query is select, fetch the resultant object and store in a array
        if($match[0] === "SELECT ")
        {
            $i=0;    
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
                // iterating through each row and storing it in rows[]
                $rows[$i++] = $row;
            }
            
            // freeing result set
            mysqli_free_result($result);
            
            // close connection and return the numeric array thus formed
            mysqli_close($link);
            
            return $rows;
        }
        
        // close connection
        mysqli_close($link);
        return true;
    }
    
    // scrapes data for a college and stores it in database
    function get_college_info($string,$page)
    {
        // extracting college name
        preg_match_all('/(?<=class="tuple-clg-heading">)(.*)<\/a>/',$string,$name);
        
        // extracting college address
        preg_match_all('/(?<=<p>| )(.*)<\/p><\/h2>/',$string,$address);
        
        // extracting infrastructural info
        preg_match_all('/class="tuple-clg-heading.*?(?=class="tpl-curse-dtls")/s',$string,$infrastructure);
        
        // extracting number of reviews
        preg_match_all('/ class="tpl-course-name".*?(?=class="tupl-options")/s',$string,$reviews);
        
            
        // deleting data previously stored in tables college_info and infrastructure(if any), but only if it's a different city
        if($page === 1)
        {
            // creating and executing query for both tables
            query("DELETE FROM college_info ");
            query("DELETE FROM infrastructure");
        }
            
        // inserting the data in the table college_info
        
        $length1= sizeof($name[1]);
        $i =0;

        while($i < $length1)
        {
            $GLOBALS["id1"]++;
            
            // trimming name,reviews and address furthur before storing
            $name[1][$i] =  preg_replace('/<a.*_blank">/',"",$name[1][$i]);
            $address[1][$i] = preg_replace('/\| /',"",$address[1][$i]);
            preg_match('/<b>(.+)(?=<\/b><a target="_blank" type="reviews")/',$reviews[0][$i],$ans[$i]);
            
            $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            
            // now creating query and storing in database
            $sql = sprintf("INSERT INTO college_info (Serial_number,Name,Address,Reviews) VALUES ('%s','%s','%s','%s')",
                     $GLOBALS["id1"],mysqli_real_escape_string($link,html_entity_decode($name[1][$i])),$address[1][$i],$ans[$i][1]);
            
            query($sql);
            $i++;
        }
        
        // inserting data in table infrastructure
        
        $length2 = sizeof($infrastructure[0]);
        $i=0;
        
        while($length2--)
        {
            $GLOBALS["id2"]++;
            
            // furthur trimming the string and storing in $infra
            preg_match_all('/(?<=<h3>)(.*)<\/h3>/',$infrastructure[0][$i++],$infra);
            
            $length3 = sizeof($infra[1]);
            $j =0;
            
            // if facilities aren't available store "---"
            if($length3 == 0)
            {
                $sql = sprintf("INSERT INTO infrastructure (college_id,facilities) VALUES ('%s','%s')",$GLOBALS["id2"],"---");
                query($sql);
            }
            
            // else prepare query and execute query (for 1 college at a time)
            while( $j <$length3)
            {
                $sql = sprintf("INSERT INTO infrastructure (college_id,facilities) VALUES ('%s','%s')",$GLOBALS["id2"],$infra[1][$j++]);
                query($sql);
            }
        }
        
       
    }
?>