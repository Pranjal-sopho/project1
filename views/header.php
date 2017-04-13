<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet"  type="text/css" href="/css/style.css">
<title><?= $title ?></title>
<script type="text/javascript">
   document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
         document.getElementById('contents').style.visibility="visible";
      },1000);
  }
}

  // an XMLHttpRequest
  var xhr = null;
  function scrape()
  {
        // instantiate XMLHttpRequest object
        try
        {
            xhr = new XMLHttpRequest();
        }
        catch (e)
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        // handle old browsers
        if (xhr == null)
        {
            alert("Ajax not supported by your browser!");
            return;
        }
           
            
        // get city
        var city = document.getElementById("city").value;
        // construct URL
        var url = "scrape_data.php?city=" + city ;

        // get quote
        xhr.onreadystatechange =
        function()
        {
            // only handle loaded requests
            if (xhr.readyState == 4)
            {
                if (xhr.status == 200)
                {
                        // insert link into DOM
                        var a = document.createElement('a');
                        var linkText = document.createTextNode("my title text");
                        a.appendChild(linkText);
                        a.title = "my title text";
                        a.href = "results.php";
                        document.body.appendChild(a); 
                }
                else
                    alert("Error with Ajax call!");
            }
        }
            
        xhr.open("GET", url, true);
        xhr.send(null);
    }
</script>
</head>
<body>
    <div id="load"></div>
     <div id = "logo">
                    <a href="/"><img alt="The College Finder" src="/images/logo.jpg"/></a>
                </div>
    <div id="contents">
    <div class="content">
       
    </div>