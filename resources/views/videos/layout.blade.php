<!DOCTYPE html>

<html lang="en" style="height: 100%">

<head>

   <meta charset="UTF-8">

   <title>AppHentai</title>

   <meta http-equiv="cache-control" content="no-cache" />

  <meta http-equiv="cache-control" content="no-store" />

  <meta http-equiv="cache-control" content="must-revalidate" />

  <meta http-equiv="expires" content="0" />

  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />

  <meta http-equiv="pragma" content="no-cache" />

  <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

   <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8" async defer></script>

   <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>

   <style type="text/css" media="screen">
       .nav > li > a{
           padding: 5px !important;
           font-size: 1rem;
       }
       .tab-pane,.tab-pane iframe{
           width: 100%;
           height: 100%;
       }
       .skip{
           background: #3097D1;
           color: white;
           padding: 8px;
          border-radius: 3px;
       }

       .skip:hover{
           text-decoration: none;
           color: white;        }

       .d-none{
           display: none;
       }

       #danner{
           width: 100%;
       }
   </style>

</head>

<body style="height: 100%;">                
  <div id="option2" class="tab-pane fade">

                   <?php echo $zurl;?>

  </div> 
  <script  type="text/javascript" charset="utf-8">

                window.onload = function(){

                    $(".skip").click(function(){

                        //$("#banner").addClass("d-none");

                        $( "#banner" ).remove();

                    });

                }
  </script>
</body>
</html>