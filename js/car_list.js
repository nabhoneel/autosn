function changeCompany() {
    var id = $('.car_companies').children(":selected").attr("id");
    alert(id);
}
$(document).ready(function() {
    $("#carCompanies").on('change',function(){
        var getValue=$(this).val();
        if(getValue == "all") $(".list-of-models").each(function(){
            $(this).attr('hidden', false);
        });
        else {
            $(".list-of-models").each(function(){
                $(this).attr('hidden', true);
            });
            $(".".concat(getValue)).each(function(){
                $(this).attr('hidden', false);
            });
        }
    });
});

function showCarDetails(car) {
    $.ajax({
        url: 'ajaxLoad/fetch_car_details.php',
        method: "POST",
        data: {
            car_model: car
        },
        success: function(data) {
            $("#car-list").html(data);
        },
        error: function(data) {
            console.log(data);
        }
    });
}
