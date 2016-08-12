$(document).ready(function(){
    $('#commentbtn').click(function(){
        var text = $('#comment-post-text').val();
        var userid = $('#userid').val();
        var username = $('#username').val();
        if(text.length > 0 && userid != null){
            //proceed
            $('.comment-insert-container').css('border' , '1px solid #e1e1e1');
            $.post("/ajax/comment")
            console.log(text + " " + username + " userid: " + userid);
        } else{
            $('.comment-insert-container').css('border' , '1px solid #ff0000');
            console.log("text area was empty");
        }
        
        //remove text from comment area
        $('#comment-post-text').val("");
    });
});