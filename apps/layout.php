<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="product/product_style.css">
  <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous">
  </script>
  <script> 
  $(function(){
    $("#header").load("header.html"); 
    $("#breadcrumbs").load("product/breadcrumbs.html");  
    $("#contentBody").load("product/danh-sach.html")
    $("#footer").load("footer.html"); 
  });
  </script>  
  </head>
<style>
#header {
  width: 100%;
  height: 7%;
  position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    transition: 1s ease-in-out;
}
#breadcrumbs{
  width: 100%;
  height: 5%;
  position: relative;
  background-color: red;
}
#contentBody {
    width: 100%;
    height:auto;
    margin-top: 5em;
}
#footer {
  margin-top: 1em;
    height: 40%;
    position: relative;
}
</style>
<body>
    <div id="header"></div>
    <div id="contentBody"></div>
    <div id="footer"></div>
</body>
</html>