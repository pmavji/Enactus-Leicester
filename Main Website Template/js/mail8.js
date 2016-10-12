$(function() {



    $("input,textarea").jqBootstrapValidation({

        preventSubmit: true,

        submitError: function($form, event, errors) {

            // additional error messages or events

        },

        submitSuccess: function($form, event) {

            event.preventDefault(); // prevent default submit behaviour

            // get values from FORM

            var name = $("input#name8").val();

            var email = $("input#email8").val();

            var message = $("textarea#message8").val();

            var firstName = name; // For Success/Failure Message

            // Check for white space in name for Success/Fail message

            if (firstName.indexOf(' ') >= 0) {

                firstName = name.split(' ').slice(0, -1).join(' ');

            }

            $.ajax({

                url: "http://enactusleicester.co.uk/mail/mail8.php",

                type: "POST",

                data: {

                    name8: name,

                    email8: email,

                    message8: message

                },

                cache: false,

                success: function() {

                    // Success message

                    $('#success8').html("<div class='alert alert-success'>");

                    $('#success8 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success8 > .alert-success')

                        .append("<strong>Your message has been sent. </strong>");

                    $('#success8 > .alert-success')

                        .append('</div>');



                    //clear all fields

                    $('#contactForm8').trigger("reset");

                },

                error: function() {

                    // Fail message

                    $('#success8').html("<div class='alert alert-danger'>");

                    $('#success8 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success8 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");

                    $('#success8 > .alert-danger').append('</div>');

                    //clear all fields

                    $('#contactForm8').trigger("reset");

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

$('#name8').focus(function() {

    $('#success8').html('');

});

