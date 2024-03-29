<?php

    // configuration
    require("../includes/helpers.php"); 

    // if user reached page via a GET request
    if ($_SERVER["REQUEST_METHOD"] == "GET")
        render("form.php", ["title" => "Form"]);
        
     else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        // validate submission
        if (empty($_POST["city"]))
            apologize("You must provide a city name");
    
        else
        {
            // convert city name  to lowercase 
            $_POST["city"] = strtolower($_POST["city"]);
            
            // initializing current page and number of pages
            $page = 0;
            $pages = 1;
           
            // scrape data from each page
            while($pages--)
            {
                // next page
                $page++;
                
                // scrape data from shiksha.com
                $string = @file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-{$page}");
        
                if($string === false)
                    apologize("Please enter a valid city name");
                
                if($page === 1)
                {
                    // counting total number of pages
                    preg_match_all('/class=" linkpagination">/',$string,$result);
                    $pages = sizeof($result[0]);
                }
                // passing the string for scraping data  and storing in database
                get_college_info($string,$page);
                
               // wait for 1s before next request
               sleep(1);
            } 
            
            // render(output) 
            render("loaded.php",["title" => "Done!!"]);
        }
    }
?>