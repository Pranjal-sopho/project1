<?php

    // enable sessions
    session_start();
    
     require("../includes/helpers.php"); 

    // if user reached page via a GET request
    if ($_SERVER["REQUEST_METHOD"] == "GET")
        render("form.php", ["title" => "Form"]);
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["city"]))
            apologize("You must provide a city name.");
        
        $page = 1;
        
        // scrape data from shikha.com
        $string = file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-$page");
        
        if($string === false)
            apologize("Please enter a valid city name");
    
        else
        {
            while(true)
            {
                if($string === false)
                    break;
                    
                // passing the string for scraping data  and storing in database
                get_college_info($string);
                    
                // change page
                $page = $page +1;
                
                // delay for 2s
                sleep(2);
                
                $string = file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-$page");
            } 
            
            // attempting to connect to mysql server
            $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            
            // selecting data from mysql table
            $query = "SELECT * FROM college_info WHERE 1";
            mysqli_query($link,$query);
            
            // render results
            render("result.php",["title" => "result","query" => $query,"link" => $link]);
        }
    }
?>