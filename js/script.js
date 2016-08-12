$(document).ready(function(){
    
    $('#commentbtn').click(function(){
        comment_post_btn_click();
    });
    add_delete_handlers();
    
});

function add_delete_handlers(){
    $('.delete-btn').each(function(){
        var btn = this;
        $(btn).click(function(){
            comment_delete(btn.id);
        });
    });
}

function comment_delete(_comment_id){
   
    $.post("../ajax/comment_delete.php" ,
              {
                task : "comment_delete",
                comment_id : _comment_id
              },
              function(data){
                $('#' + _comment_id).detach();
              });
}

function comment_post_btn_click(){
    var _comment = $('#comment-post-text').val();
        var _userid = $('#userid').val();
        var _username = $('#username').val();
        if(_comment.length > 0 && _userid != null){
            //proceed
            $('.comment-insert-container').css('border' , '1px solid #e1e1e1');
           
            $.post("../ajax/comment_insert.php" ,
                {
                    task : "comment_insert",
                    userid : _userid,
                    comment : _comment
                },
                function(data){
                    comment_insert(jQuery.parseJSON(data));
                    console.log("responseText: " + data);
                }
            );
            
            
            console.log(_comment + " " + _username + " userid: " + _userid);
        } else{
            $('.comment-insert-container').css('border' , '1px solid #ff0000');
            console.log("text area was empty");
        }
        
        //remove text from comment area
        $('#comment-post-text').val("");
}

function comment_insert(data){
    var t = '';
    t += '<li class="comments-holder" id="_'+data.comment.comment_id+'">';
    t += '<div class="user-img">';
    t += '<img src="'+data.user.profile_img+'" alt="userimg" class="user-img-pic">';
    t += '</div>';   
    t += '<div class="comment-body">';
    t += '<h3 class="username-field">'+data.user.username+'</h3>';
    t += '<div class="comment-text">'+data.comment.comment+'</div>';
    t += '</div>'; 
    t += '<div class="comment-buttons-holder">';
    t += '<ul>';
    t += '<li id = "'+data.comment.comment_id+'" class="delete-btn">X</li>';
    t += '</ul>';
    t += '</div>';
    t += '</li>';
    
    $('.comments-holder-ul').prepend(t);
    add_delete_handlers();
}