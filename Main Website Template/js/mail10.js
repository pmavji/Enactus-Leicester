$(function() {



    $("input,textarea").jqBootstrapValidation({

        preventSubmit: true,

        submitError: function($form, event, errors) {

            // additional error messages or events

        },

        submitSuccess: function($form, event) {

            event.preventDefault(); // prevent default submit behaviour

            // get values from FORM

            var name = $("input#name10").val();

            var email = $("input#email10").val();

            var message = $("textarea#message10").val();

            var firstName = name; // For Success/Failure Message

            // Check for white space in name for Success/Fail message

            if (firstName.indexOf(' ') >= 0) {

                firstName = name.split(' ').slice(0, -1).join(' ');

            }

            $.ajax({

                url: "http://enactusleicester.co.uk/mail/mail10.php",

                type: "POST",

                data: {

                    name10: name,

                    email10: email,

                    message10: message

                },

                cache: false,

                success: function() {

                    // Success message

                    $('#success10').html("<div class='alert alert-success'>");

                    $('#success10 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success10 > .alert-success')

                        .append("<strong>Your message has been sent. </strong>");

                    $('#success10 > .alert-success')

                        .append('</div>');



                    //clear all fields

                    $('#contactForm10').trigger("reset");

                },

                error: function() {

                    // Fail message

                    $('#success10').html("<div class='alert alert-danger'>");

                    $('#success10 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")

                        .append("</button>");

                    $('#success10 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");

                    $('#success10 > .alert-danger').append('</div>');

                    //clear all fields

                    $('#contactForm10').trigger("reset");

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

$('#name10').focus(function() {

    $('#success10').html('');

});

