<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

        <script src="/js/app.js"></script>

<style>
#message_list { margin:15px 0; list-style:none; padding:0px; width:100%; float:left;}
.chat-body { height:100vh; position:relative; }
.message-form { position: absolute;
    width: 100%;
    bottom: 0;
    left: 0;}
.left-chat { float:left;  border-radius: 0 7px 0 7px;}
.right-chat { float:right;     border-radius: 7px 0 7px 0;}
.chat-box {     border: solid 1px #7cdfdd;
    padding: 5px 9px;
    background: #cce4e7;
    display: block;
    clear: both;
    margin-bottom: 5px;}


</style>

    </head>
    <body>
    <div class="chat-body">
    <div class="message-form">
        <div class="container">
      
            <div class="row justify-content-center">
                <div class="col-md-8"> 
                    <div id="message_list">

                    </div>
                </div>
            </div>


            <div class="row justify-content-center ">
                <div class="col-md-8"> 
                    <form id="chat_send_frm">

                    <div class="input-group mb-3">
                             <input type="text" class="form-control" id="msg_textarea" placeholder="Message...">
                             <button class="btn btn-outline-info" type="submit" id="button-addon2">Send</button>
                    </div>

                         <!-- <textarea rows="4" cols="50" id="msg_textarea" class="form-control mb-3"></textarea>
                        <input type="submit" value="Send" id="send_btn" class="btn btn-info"> -->
                    </form>
                <div> 
            </div>
            </div>
        </div>
        </div>
           
      

        

        <div class="modal" tabindex="-1" role="dialog" id="message_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="new_msg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
$(document).ready(function(){
    window.Echo.channel(`public`).listen('Message',(e) => {
        $("#new_msg").html(e.text);
        $("#message_modal").modal();

        $("#message_list").append("<div class='left-chat chat-box'>"+e.text+"</div>");
    });
});


$("#chat_send_frm").submit(function(e){
    e.preventDefault();

    const text = $("#msg_textarea").val();
    $("#message_list").append("<div class='right-chat chat-box'>"+text+"</div>");

    $("#msg_textarea").val("");

    $.ajax({
        method: "POST",
        url: "/api/chat",
        data: { "text": text }
    });
})
</script>