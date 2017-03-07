<?php

    // enable sessions
    session_start();
    
    // configuration
    require("../includes/helpers.php"); 

    // if user reached page via a GET request
    if ($_SERVER["REQUEST_METHOD"] == "GET")
        render("form.php", ["title" => "Form"]);
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["city"]))
            apologize("You must provide a city name.");
    
        else
        {
            // initializing current page and number of pages
            $page = 0;
            $pages = 1;
        
            // convert city name  to lowercase
            $_POST["city"] = htmlspecialchars(strtolower($_POST["city"]));
            
            // scrape data from each page
            while($pages--)
            {
                // change page
                $page++;
                
                // scrape data from shikha.com
                $string = file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-{$page}");
        
                if($string === false)
                    apologize("Please enter a valid city name");
                
                if($page == 1)
                {
                    // counting toal number of pages
                    preg_match_all('/class=" linkpagination">/',$string,$result);
                    $pages = sizeof($result[0]);
                }

                // passing the string for scraping data  and storing in database
                get_college_info($string,$page);
                
                // delay for 2s
                sleep(2);
            } 
            
            // attempting to connect to mysql server
            $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            
            // selecting data from mysql table
            $query = "SELECT * FROM college_info WHERE 1";
            
            // render results
            render("result.php",["title" => "result","query" => $query,"link" => $link]);
        }
    }
?>