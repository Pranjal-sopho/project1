<?php

    
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
            apologize("You must provide a city name.");
        }
        
        // scrape data from shikha.com
        $string = file_get_contents('http://www.shiksha.com/b-tech/colleges/b-tech-colleges-'.urlencode($_GET["city"]));
        
        if($string === false)
            echo "Please enter a valid city name";
    
        else
        {
            // extract essential data from the scraped data
            $name = preg_match('/(?<=target="_blank")(.*)<\/a>/',$string);
            $address = preg_match();
            $yoe = preg_match();
            $courses = preg_match();
            $infra = preg_match();
            $website = preg_match();
            
            // attempting to connect to mysql server
            $link = mysqli_connect("localhost", "root", "", "demo");
            if($link === false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
                
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
?>