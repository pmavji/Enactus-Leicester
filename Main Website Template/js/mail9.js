$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name9").val();
            var email = $("input#email9").val();
            var message = $("textarea#message9").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "https://campus.cs.le.ac.uk/people/amahs1/Main%20Website%20Template/mail/mail9.php",
                type: "POST",
                data: {
                    name9: name,
                    email9: email,
                    message9: message
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success9').html("<div class='alert alert-success'>");
                    $('#success9 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success9 > .alert-success')
                        .append("<strong>Your message has been sent. </strong>");
                    $('#success9 > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm9').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success9').html("<div class='alert alert-danger'>");
                    $('#success9 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success9 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success9 > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm9').trigger("reset");
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
$('#name9').focus(function() {
    $('#success9').html('');
});
