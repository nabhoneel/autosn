function showResult(str) {
    if (str.length==0) {
        $("#showids").html("");
        $("#showids").css("border", "0px");
        $("#detailsbutton").prop("disabled", true);
        return;
    }
    $.ajax({
        url: "./ajaxLoad/accounts.php",
        method: "POST",
        data: {
            email: str
        },
        success: function(data) {
            $("#showids").html(data);
            $("#showids").css("border", "1px dotted #A5ACB2");
            $("#detailsbutton").prop("disabled", false);
        }
    });
}
function writeToTextArea(str) {
    if(str.length > 0) {
        $("#emailid").val(str);
        getDetails();
    }
    $("#showids").html("");
    $("#showids").css("border", "0px");
}
function getDetails() {
    $.ajax({
        url: "./ajaxLoad/fetchDetails.php",
        method: "POST",
        data: {
            email: $("#emailid").val()
        },
        success: function(data) {
            $("#oldFormBody").html(data);
        }
    });
}
function makeEditable(x) {
    if(x === 1) {
        $("#oldname").attr('readonly', false);
        $("#oldaddress").attr('readonly', false);
        $("#oldcontact").attr('readonly', false);
        $("#olddob").attr('readonly', false);
        $("#saveOld").prop('disabled', false);
    }
    else {
        $("#oldname").attr('readonly', true);
        $("#oldaddress").attr('readonly', true);
        $("#oldcontact").attr('readonly', true);
        $("#olddob").attr('readonly', true);
        $("#saveOld").prop('disabled', true);
    }
}
function saveOld() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("alertSuccess").innerHTML = this.responseText;
            if(document.getElementById("queryStatus").value=="success") makeEditable(0);
        }
    };
    var details = [];
    details.push(0);
    details.push(document.getElementById("emailid").value);
    details.push(document.getElementById("oldname").value);
    details.push(document.getElementById("oldaddress").value);
    details.push(document.getElementById("oldcontact").value);
    details.push(document.getElementById("olddob").value);

    xmlhttp.open("POST", "ajaxLoad/save.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.send(JSON.stringify(details));
}
function saveNew() {//the only function with a manual AJAX call
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("alertSuccessNew").innerHTML = this.responseText;
        }
    };
    var details = [];
    details.push(1);
    details.push(document.getElementById("emailnew").value);
    details.push(document.getElementById("namenew").value);
    details.push(document.getElementById("addressnew").value);
    details.push(document.getElementById("contactnew").value);
    details.push(document.getElementById("dobnew").value);

    xmlhttp.open("POST", "ajaxLoad/save.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.send(JSON.stringify(details));
}
function proceed() {
    $('#confirmDialog').modal('hide');
    $('#paymentDialog').modal('show');
}
function finishOrder(which) {
    var details = [];
    if($('.nav-tabs .active').text() == "Returning customer") {
        details.push($("#emailid").val());
        details.push($("#oldname").val());
        details.push($("#olddob").val());
        details.push($("#oldcontact").val());
        details.push($("#oldaddress").val());
        for(var i=0; i<details.length; i++) {
            if(details[i].length == 0) {

                $(".returning-customer-alert").show();
                $('.returning-customer-alert').css('opacity', '1');
                window.setTimeout(function() {
                    $(".returning-customer-alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).hide();
                    });
                }, 4000);
                return;
            }
        }
    }
    else {
        details.push(document.getElementById("emailnew").value);
        details.push(document.getElementById("namenew").value);
        details.push(document.getElementById("dobnew").value);
        details.push(document.getElementById("contactnew").value);
        details.push(document.getElementById("addressnew").value);
        for(var i=0; i<details.length; i++) {
            if(details[i].length == 0) {

                $(".new-customer-alert").show();
                $('.new-customer-alert').css('opacity', '1');
                window.setTimeout(function() {
                    $(".new-customer-alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).hide();
                    });
                }, 4000);
                return;
            }
        }
    }
    details.push(document.getElementById('vin').value);
    if(which != "Pay") $('#confirmDialog').modal('show');
    else {
        var d = new Date();
        if($("#creditCardNumber").val().length < 19)
            setAlert(".paymentAlert", "Enter a valid credit card number");
        else if(($("#month").val()-1) <= d.getMonth() && $("#year").val()==d.getFullYear())
            setAlert(".paymentAlert", "Enter a valid expiry date");
        else if($("#cvv").val().length < 3)
            setAlert(".paymentAlert", "Enter a valid CVV");
        else {
            $.ajax({
                type: "POST",
                url: 'ajaxLoad/makeTransaction.php',
                data: {
                    email: details[0],
                    name: details[1],
                    dob: details[2],
                    contact: details[3],
                    address: details[4],
                    vehicle_index: details[5],
                    totalCost: document.getElementById("totalCost").value,
                    creditcard: document.getElementById("creditCardNumber").value,
                    expiryMonth: document.getElementById("month").value,
                    expiryYear: document.getElementById("year").value,
                    cvv: document.getElementById("cvv").value
                },
                success: function(data) {
                    $('#paymentDialog').modal('hide');
                    $('#successBox').modal('show');
                }
            });
        }
    }
}
function setAlert(str, htmlText) {
    $(str).show();
    $(str).html(htmlText);
    $(str).css('opacity', '1');
    window.setTimeout(function() {
        $(str).fadeTo(500, 0).slideUp(500, function(){
            $(this).hide();
        });
    }, 4000);
}
