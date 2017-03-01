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
        
        // scrape data from shikha.com
        $string = file_get_contents('http://www.shiksha.com/b-tech/colleges/b-tech-colleges-'.urlencode($_POST["city"]));
        
        if($string === false)
            echo "Please enter a valid city name";
    
        else
        {
            // attempting to connect to mysql server
            $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            if($link === false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
                
            while(true)
            {
                // extract college's link from the scraped data
                preg_match('/(?<=class="tuple-clg-heading")(.*)<\/a>/',$string,$college_link);
                preg_match('/(?<=href=")(.*)" target/',$college_link[1],$college_link);
                
                get_college_info($college_link);
               // preg_match('/(?<=target="_blank">)(.*)/',$name[1],$name);
                
                preg_match('/.*(?=<\/p><\/h2>)/',$string,$address);
                preg_match('/(?<=\\s\\s\\s).*/',$address[0],$address);
                preg_match('/(?<=<p>\| ).*/',$address[0],$aaddress);
                
                $yoe = preg_match();
                $courses = preg_match();
                $infra = preg_match();
                $website = preg_match();
                
                // attempting insert query
                $query = "INSERT INTO college_info (name, address,yoe,courses,infra,website) VALUES ($name, $address, $yoe,$courses,$infra,$website)";
                
                if(mysqli_query($link, $sql))
                {
                    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
                }
                
                // close connection
                mysqli_close($link);
            }
            
        }
    }
?>