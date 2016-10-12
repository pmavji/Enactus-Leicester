$(function() {



    $("input,textarea").jqBootstrapValidation({

        preventSubmit: true,

        submitError: function($form, event, errors) {

            // additional error messages or events

        },

        submitSuccess: function($form, event) {

            event.preventDefault(); // prevent default submit behaviour

            // get values from FORM

            var name = $("input#name6").val();

            var email = $("input#email6").val();

            var message = $("textarea#message6").val();

            var firstName = name; // For Success/Failure Message

            // Check for white space in name for Success/Fail message

            if (firstName.indexOf(' ') >= 0) {

                firstName = name.split(' ').slice(0, -1).join(' ');

            }

            $.ajax({

                url: "http://enactusleicester.co.uk/mail/mail6.php",

                type: "POST",

                data: {

                    name6: name,

                    email6: email,

                    message6: message

                },

                cache: false,

                success: function() {

                    // Success message

                    $('#success6').html("<div class='alert alert-success'>");

                    $('#success6 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success6 > .alert-success')

                        .append("<strong>Your message has been sent. </strong>");

                    $('#success6 > .alert-success')

                        .append('</div>');



                    //clear all fields

                    $('#contactForm6').trigger("reset");

                },

                error: function() {

                    // Fail message

                    $('#success6').html("<div class='alert alert-danger'>");

                    $('#success6 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success6 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");

                    $('#success6 > .alert-danger').append('</div>');

                    //clear all fields

                    $('#contactForm6').trigger("reset");

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

$('#name6').focus(function() {

    $('#success6').html('');

});

