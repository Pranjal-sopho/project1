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