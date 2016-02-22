$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name7").val();
            var email = $("input#email7").val();
            var message = $("textarea#message7").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "https://campus.cs.le.ac.uk/people/amahs1/Main%20Website%20Template/mail/mail7.php",
                type: "POST",
                data: {
                    name7: name,
                    email7: email,
                    message7: message
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success7').html("<div class='alert alert-success'>");
                    $('#success7 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success7 > .alert-success')
                        .append("<strong>Your message has been sent. </strong>");
                    $('#success7 > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm7').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success7').html("<div class='alert alert-danger'>");
                    $('#success7 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success7 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success7 > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm7').trigger("reset");
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
$('#name7').focus(function() {
    $('#success7').html('');
});
