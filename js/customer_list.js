var previous;

$(document).ready(function() {
    $('.customer-list-set').each(function() {
        $(this).css('cursor', 'pointer');
    });

    $('ul#list-of-customers li').click(function(e) {
        $(previous).css("background-color", "#00000000");
        $(this).css("background-color", "#abb2ff");
        previous = this;
        showDetails($(this).text());
    });
});

function showDetails(str) {
    $.ajax({
        url: 'ajaxLoad/showDetails.php',
        method: 'POST',
        data: {
            email: str
        },
        success: function(data) {
            $("#customer-details").html(data);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function showSuggestions() {
    var x = $("#search-customers").val();
    if(x == "") {
        $(".customer-list-set").each(function(){            
            $(this).attr('hidden', false);
        });
    }
    $(".customer-list-set").each(function(){
        var email = $(this).text();
        if(email.startsWith(x) == false)
            $(this).attr('hidden', true);
        else $(this).attr('hidden', false);
    });
}
