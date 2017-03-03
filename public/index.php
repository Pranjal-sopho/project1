<?php

    // enable sessions
    session_start();
    
     require("../includes/helpers.php"); 

    // if user reached page via GET a get request
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render form
        render("form.php", ["title" => "form"]);
    }
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["city"]))
        {
            echo "You must provide a city name.";
        }
        
        $page = 1;
        
        // scrape data from shikha.com
        $string = file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-$page");
        
        if($string === false)
            echo "Please enter a valid city name";
    
        else
        {
            while(true)
            {
                if($string === false)
                    break;
                // extract links of all colleges on a page
                preg_match_all('/(?<=class="tuple-clg-heading")(.*)<\/a>/',$string,$temp);
                
                while(true)
                {
                    if($temp[1][$i]== NULL)
                        break;
                    
                    // trimming each string to get exact link   
                    preg_match('/(?<=href=")(.*)" target/',$temp[1][$i],$college_link);
                    
                    // passing the college link for scraping data furthur and storing in database
                    get_college_info($college_link);
                    
                    $i++;
                }
                
                // change page
                $page = $page +1;
                
                // delay for 2s
                //sleep(2);
                
                $string = file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-$page");
            } 
            
            // attempting to connect to mysql server
            $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            
            // selecting data from mysql table
            $query = "SELECT * FROM college_info WHERE 1";
            $rows = mysqli_query($link,$query);
            
            if($rows === false )
            {
                echo "ERROR: Could not execute $query. " . mysqli_error($link);
            }
            
            // render results
            render("result.php",["title" => "result","rows" => $rows]);
        }
    }
?>