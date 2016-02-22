$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name11").val();
            var email = $("input#email11").val();
            var message = $("textarea#message11").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "https://campus.cs.le.ac.uk/people/amahs1/Main%20Website%20Template/mail/mail11.php",
                type: "POST",
                data: {
                    name11: name,
                    email11: email,
                    message11: message
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success11').html("<div class='alert alert-success'>");
                    $('#success11 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success11 > .alert-success')
                        .append("<strong>Your message has been sent. </strong>");
                    $('#success11 > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm11').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success11').html("<div class='alert alert-danger'>");
                    $('#success11 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success11 > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success11 > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm11').trigger("reset");
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
$('#name11').focus(function() {
    $('#success11').html('');
});
