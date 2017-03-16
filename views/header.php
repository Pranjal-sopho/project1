<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?= $title ?></title>
<link rel="stylesheet" href="/css/style.css">
<script type="text/javascript" ></script>
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
</script>
</head>
<body>
    <div id="load"></div>
    <div id="contents">

    <div class="content">
        <h1>
        	The College Finder
        </h1>
    </div>