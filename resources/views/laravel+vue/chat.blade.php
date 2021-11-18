<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Box</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        
    </style>
</head>
<body>
    <div id="app">
       <div class="container">
          <div class="row">
                <div class="col-md-6 offset-md-3">
                     <div class="card">
                        <div class="card-header">
                           <h4 align='center'>Chat Message</h4>
                        </div>
                        <div class="card-body">
                                 <span class="badge badge-primary">@{{chat.typing}}</span>
                                 <message-component :user="chat.user[index]" 
                                 subcolor="green" 
                                 :color="chat.color[index]" 
                                 class="success" 
                                 v-for="value,index in chat.message" 
                                 :key="value.index">
                                  @{{value}}
                                 </message-component>
                            
                        </div>
                        <div class="card-footer">
                             <input type="text" class="form-control" v-model='message' @keyup.enter="send">
                        </div>
                     </div>
                </div>
          </div>
       </div>
    </div>
    <script src="{{mix('js/app.js')}}">

    </script>
</body>
</html>