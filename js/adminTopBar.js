function addSalesPerson() {
    if($("#username").val() == "") {
        $("#error").html("Don\'t leave the username blank, we need to identify the seller");
        $("#error").css("display", "table");
    }
    else if($("#password").val() == "") {
        $("#error").html("That's the least secure password. Ever.");
        $("#error").css("display", "table");
    }
    else {
        $.ajax({
            url: "./ajaxLoad/addSalesPerson.php",
            method: "POST",
            data: {
                username: $("#username").val(),
                password: $("#password").val()
            },
            success: function(data) {
                if(data != "true") {
                    $("#error").html(data);
                    $("#error").css("display", "table");
                } else {
                    $('#addSalesPerson').modal('hide');
                    $('#notifyModal').modal('show');
                    var message = $('#username').val();
                    message = message.concat(" was added!");
                    $('#notify-modal-body').html(message);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
}
