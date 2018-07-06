<!--Connect to database-->
<?php include_once 'inc/php/config.php'; ?>

<html>
  <head>
    <title>
      Noah Nam
    </title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../bigtext.js"></script>
    <script type = "text/javascript">

      // The first thing thing this page does
      getWorks();
      getDetailed(0,"option-0");

      function getWorks(){
        $.ajax( { type : 'POST',
          data : {functionName : 'getWorks'},
          url  : '../inc/php/functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
            document.getElementById('menu').innerHTML = data;               // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            alert( "error" );
          }
        });
      }
      
      function getDetailed(work_id,element){
        details = new Array();
        $.ajax( { type : 'POST',
          data : {functionName : 'getDetailed', work_id : work_id},
          url  : '../inc/php/functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
            document.getElementById('title').innerHTML = data[0];
            document.getElementById('company').innerHTML = data[1];
            document.getElementById('text').innerHTML = data[2];
            document.getElementById('link').outerHTML = data[3];
            //document.getElementById('image').innerHTML = data[4];
            document.getElementById('background').outerHTML = data[5];
            document.getElementById('youtube').innerHTML = data[6];
            $("#title").bigtext({maxfontsize: 100});
            var list = document.getElementsByClassName("portfolio-menu-option");
            for (var i = 0; i < list.length; i++) {
                list[i].classList.remove("selected");
            }
            document.getElementById(element).classList.add("selected");
            document.getElementById('main').scrollTop =0;
          },
          error: function ( xhr ) {
            alert( "error" );
          },
          dataType:"json"
        });
      }
    </script>
  </head>
	

<div class="header">
  <span class="yellowtext">
    <a href='../'>Home</a>
  </span>
  <span class="yellowtext">
    <a href='./'>Portfolio</a>
  </span>
  <span class="yellowtext">
    <a href='../resume'>Resume</a>
  </span>
</div>

<div id="menu" class="portfolio-menu"></div>
 
<div id="main" class="portfolio-main">
  <!--Blurred Background Div-->
  <div id="background" class="portfolio-main-background-wrapper"></div>
  <div id="title" class="portfolio-main-title"></div>
  <div id="company" class="portfolio-main-title" style="font-size:36px"></div>
  <div class="portfolio-main-below-title">
    <div id="text" class="portfolio-main-text">
    </div>
    <div class="portfolio-main-right-rail">
      <a id="link" href='/'><div class="portfolio-main-link">Visit Project Website</div></a>
      <div id="youtube" class="portfolio-youtube"></div>
      <!--<div id="image" class="portfolio-main-image"></div>-->
    </div>
  </div>
</div>
</html>