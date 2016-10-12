$(function() {



    $("input,textarea").jqBootstrapValidation({

        preventSubmit: true,

        submitError: function($form, event, errors) {

            // additional error messages or events

        },

        submitSuccess: function($form, event) {

            event.preventDefault(); // prevent default submit behaviour

            // get values from FORM

            var name = $("input#name4").val();

            var email = $("input#email4").val();

            var message = $("textarea#message4").val();

            var firstName = name; // For Success/Failure Message

            // Check for white space in name for Success/Fail message

            if (firstName.indexOf(' ') >= 0) {

                firstName = name.split(' ').slice(0, -1).join(' ');

            }

            $.ajax({

                url: "http://enactusleicester.co.uk/mail/mail4.php",

                type: "POST",

                data: {

                    name4: name,

                    email4: email,

                    message4: message

                },

                cache: false,

                success: function() {

                    // Success message

                    $('#success4').html("<div class='alert alert-success'>");

                    $('#success4 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success4 > .alert-success')

                        .append("<strong>Your message has been sent. </strong>");

                    $('#success4 > .alert-success')

                        .append('</div>');



                    //clear all fields

                    $('#contactForm4').trigger("reset");

                },

                error: function() {

                    // Fail message

                    $('#success4').html("<div class='alert alert-danger'>");

                    $('#success4 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success4 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");

                    $('#success4 > .alert-danger').append('</div>');

                    //clear all fields

                    $('#contactForm4').trigger("reset");

                },

            })

        },

        filter: function() {

            return $(this).is(":visible");

        },

    });



    $("a[data-toggle=\"tab\"]").click(function(e) {

        e.preventDefault();

        $(this).tab("show");

    });

});





/*When clicking on Full hide fail/success boxes */

$('#name4').focus(function() {

    $('#success4').html('');

});

