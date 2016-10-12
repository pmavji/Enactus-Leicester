$(function() {



    $("input,textarea").jqBootstrapValidation({

        preventSubmit: true,

        submitError: function($form, event, errors) {

            // additional error messages or events

        },

        submitSuccess: function($form, event) {

            event.preventDefault(); // prevent default submit behaviour

            // get values from FORM

            var name = $("input#name3").val();

            var email = $("input#email3").val();

            var message = $("textarea#message3").val();

            var firstName = name; // For Success/Failure Message

            // Check for white space in name for Success/Fail message

            if (firstName.indexOf(' ') >= 0) {

                firstName = name.split(' ').slice(0, -1).join(' ');

            }

            $.ajax({

                url: "http://enactusleicester.co.uk/mail/mail3.php",

                type: "POST",

                data: {

                    name3: name,

                    email3: email,

                    message3: message

                },

                cache: false,

                success: function() {

                    // Success message

                    $('#success3').html("<div class='alert alert-success'>");

                    $('#success3 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success3 > .alert-success')

                        .append("<strong>Your message has been sent. </strong>");

                    $('#success3 > .alert-success')

                        .append('</div>');



                    //clear all fields

                    $('#contactForm3').trigger("reset");

                },

                error: function() {

                    // Fail message

                    $('#success3').html("<div class='alert alert-danger'>");

                    $('#success3 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success3 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");

                    $('#success3 > .alert-danger').append('</div>');

                    //clear all fields

                    $('#contactForm3').trigger("reset");

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

$('#name3').focus(function() {

    $('#success3').html('');

});

