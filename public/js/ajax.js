$(document).ready(function() {
    $( document ).ready(function() {
        $( "#login" ).submit(function( event ) {
            if(!login_validate())
                event.preventDefault();
        });        
        function login_validate()
        {
            flag = true;
            message="";
            if($('#email').val().trim() == '' || $('#email').val() == null || !isEmail($('#email').val())) {
                $('#email').addClass('input_error');
                message+="The format of Email is not correct.";
                flag = false;
            }
            else  $('#email').removeClass('input_error');

            if($('#password').val().trim() == '' || $('#password').val() == null || $('#password').val().length<5) {
                $('#password').addClass('input_error');
                message+="The length of password should be more than 5 characters.";
                flag = false;
            }
            else  $('#password').removeClass('input_error');
            
            $('#msg').html(message);
            return flag;

        }
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

    });





    $('.filter_box input[type=button]').on('click',function () {
        var dataString = {};
        dataString['color']=colors;
        dataString['name']=$('.filter_box #p_name').val();
        var jsonString = JSON.stringify(dataString);
        //console.log(jsonString);

        $.ajax({
            type: "POST",
            url: "process.php",
            data: {data:jsonString,controller:'products',action:'filter'},
            cache: false,
            success: function(data){
                $('#p_list').html(data);
            },
        });

    })

    $('.p_box input[type=button]').on('click',function () {
        var dataString = {};
        dataString['p_id']=$(this).attr('rel');
        var jsonString = JSON.stringify(dataString);
        //console.log(jsonString);

        $.ajax({
            type: "POST",
            url: "process.php",
            data: {data:jsonString,controller:'basket',action:'addtobasket'},
            cache: false,
            success: function(data){
alert(data);
            },
        });

    })

})