$("#loginBtn").on("click", function() {


    var email = $('#email').val();
    var password = $('#password').val();

   alert(email + " " + password);

    $.ajax({
        url: "../backend/db/logic/userLogin.php",
        type: "POST",
        dataType:"text",  
        data:{
            email:email,
            password:password
           },
        success: function(res) {                                
           // console.log(res); // debug print
            alert("You are logged in!");

            window.location.href="/index.php";
            
            
        },
        error: function(e) {
            alert("Check your email or password!");
          
           // $('.modal-content').append('<p style="color:red; text-align: center;"> there was an error </p>');
        } 
    });
});