<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <title>My Ecommerce Site Exchange</title>
    
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" 
    integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" 
    integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
  <?php 
  $context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);
$data=json_decode(file_get_contents('http://forex.cbm.gov.mm/api/latest', false, $context));
  ?>
    <div id="ecouser">
      <ecommerceheaderuser-component></ecommerceheaderuser-component>
      <div style="padding-top:100px;">
        <div class="container">
          <div class="row">
             <div class="col-md-6 offset-md-3"> 
                 <h2 align='center'>Today Exchange</h2>
             </div>
          </div>
            <div class="row">
               <div class="col-md-6 offset-md-3">
                  <table class="table table-striped">
                     <tr>
                       <td>Currency</td>
                       <td>MMK</td>
                     </tr>
                     <tr>
                       <td>USD</td>
                       <td>{{$data->rates->USD}}</td>
                     </tr>
                     <tr>
                       <td>JPY</td>
                       <td>{{$data->rates->JPY}}</td>
                     </tr>
                     <tr>
                       <td>SGD</td>
                       <td>{{$data->rates->SGD}}</td>
                     </tr>
                     <tr>
                       <td>EUR</td>
                       <td>{{$data->rates->EUR}}</td>
                     </tr>
                    </table>
               </div>
            </div>
        </div>
      </div>
      
    </div>
<script src="{{mix('js/app.js')}}">

</script>
</body>
</html>