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
            preg_match('/(?<=class="tuple-clg-heading")(.*)<\/a>/',$string,$college_link);
            
            while(true)
            {
                // extract college's link from the scraped data
               
                preg_match('/(?<=href=")(.*)" target/',$college_link[1],$college_link);
                
                // passing the college link for scraping data furthur and storing in database
                get_college_info($college_link);
                
            }
            
        }
    }
?>