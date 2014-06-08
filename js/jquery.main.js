$(function() {
    //original field values
    var field_values = {
        //id        :  value
        'UserName': 'UserName',
        'Password': 'Password',
        'cpassword': 'password',
        'Email': 'yourname@yourdomain.com',
        'Role': 'Your Role',
        'FirstName': 'First Name',
        'MiddleName': 'Middle Name',
        'LastName': 'Last Name',
        'Gender': 'Gender',
        'Image': 'Your Picture',
        'Parameter1': 'Building',
        'Parameter2': 'Factory / Floor',
        'Parameter3': 'Department / Unit',
        'Parameter4': 'Other',
        'Parameter5': 'Other',
        'IsActive': 'Is Active'
    };

    //inputfocus
    $('input#UserName').inputfocus({value: field_values['UserName']});
    $('input#Password').inputfocus({value: field_values['Password']});
    $('input#cpassword').inputfocus({value: field_values['Password']});
    $('input#Email').inputfocus({value: field_values['Email']});
    $('input#Role').inputfocus({value: field_values['Role']});
    $('input#FirstName').inputfocus({value: field_values['FirstName']});
    $('input#MiddleName').inputfocus({value: field_values['MiddleName']});
    $('input#LastName').inputfocus({value: field_values['LastName']});
    $('input#Gender').inputfocus({value: field_values['Gender']});
    $('input#Image').inputfocus({value: field_values['Image']});
    $('input#Parameter1').inputfocus({value: field_values['Parameter1']});
    $('input#Parameter2').inputfocus({value: field_values['Parameter2']});
    $('input#Parameter3').inputfocus({value: field_values['Parameter3']});
    $('input#Parameter4').inputfocus({value: field_values['Parameter4']});
    $('input#Parameter5').inputfocus({value: field_values['Parameter5']});
    $('input#IsActive').inputfocus({value: field_values['IsActive']});

    //reset progress bar
    $('#progress').css('width', '0');
    $('#progress_text').html('0% Complete');

    //first_step
    $('form').submit(function() {
        return false;
    });
    $('#submit_first').click(function() {
        //remove classes
        $('#first_step input').removeClass('error').removeClass('valid');

        //ckeck if inputs aren't empty
        var fields = $('#first_step input[type=text]');
        var error = 0;
        
        fields.each(function() {
           
            var value = $(this).val();
            if (value.length < 4 || value == field_values[$(this).attr('id')]) {
                $(this).addClass('error');
                $(this).effect("shake", {times: 3}, 50);

                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if (!error) {
//            if ($('#password').val() != $('#cpassword').val()) {
//                $('#first_step input[type=password]').each(function() {
//                    $(this).removeClass('valid').addClass('error');
//                    $(this).effect("shake", {times: 3}, 50);
//                });
//
//                return false;
//            } else {
                //update progress bar
                $('#progress_text').html('33% Complete');
                $('#progress').css('width', '113px');

                //slide steps
                $('#first_step').slideUp();
                $('#second_step').slideDown();
//            }
        } else
            return false;
    });
    $('#submit_second').click(function() {
        //remove classes
        $('#second_step input').removeClass('error').removeClass('valid');

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var fields = $('#second_step input[type=text], #second_step input[type=password]');
        var error = 0;
        fields.each(function() {
            var value = $(this).val();
            if (value.length < 1 || value == field_values[$(this).attr('id')] || ($(this).attr('id') == 'email' && !emailPattern.test(value))) {
                $(this).addClass('error');
                $(this).effect("shake", {times: 3}, 50);
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if (!error) {
            if ($('#Password').val() != $('#cpassword').val()) {
                $('#second_step input[type=password]').each(function() {
                    $(this).removeClass('valid').addClass('error');
                    $(this).effect("shake", {times: 3}, 50);
                });

                return false;
            } else {          
                //update progress bar
                $('#progress_text').html('66% Complete');
                $('#progress').css('width','226px');
                
                //slide steps
                $('#second_step').slideUp();
                $('#third_step').slideDown();
            }
        } else
            return false;
    });


    $('#submit_third').click(function() {
        //update progress bar
        $('#progress_text').html('100% Complete');
        $('#progress').css('width', '339px');

        //prepare the fourth step        
        var fields = new Array(
                $('#FirstName').val() + ' ' + $('#MiddleName').val() + ' ' +$('#LastName').val(),
                $('#UserName').val(),
                $('#Email').val(),                
                $('#Role').val()
                );
        var tr = $('#fourth_step tr');
        tr.each(function() {
            //alert( fields[$(this).index()] )
            $(this).children('td:nth-child(2)').html(fields[$(this).index()]);
        });
        //slide steps
        $('#third_step').slideUp();
        $('#fourth_step').slideDown();
    });


    $('#submit_fourth').click(function() {      
        
        var UserName = $("#UserName").val();
        var Password = $("#Password").val();
        var cpassword = $("#cpassword").val();
        var Email = $("#Email").val();
        var Role = $("#Role").val();
        var FirstName = $("#FirstName").val();
        var MiddleName = $("#MiddleName").val();
        var LastName = $("#LastName").val();        
        var Gender = $("#Gender").val();
        var Image = $("#Image").val();
        var Parameter1 = $("#Parameter1").val();
        var Parameter2 = $("#Parameter2").val();
        var Parameter3 = $("#Parameter3").val();
        var Parameter5 = $("#Parameter5").val();
        var IsActive = $("#IsActive").val();
        $('form').unbind('submit').submit();

      
    });    
});



