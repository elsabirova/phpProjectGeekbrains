$(document).ready(function () {
    $(".add-to-card").on('click', function () {
        let idGood = $(this).data("id-good");
        $.ajax({
            url: "/cart/add",
            type: "POST",
            dataType: "json",
            data: {
                id_good: idGood
            },
            error: function (data) {
                console.error('Error', data);
            },
            success: function (data) {
                if(data.id) {
                    alert('Good added to cart.');
                }
                else {
                    alert('Error');
                }
                
            }
        });
    });
    
    $(".cart-delete").on('click', function () {
        let idGood = $(this).data("id-good");
        $.ajax({
            url: "/cart/delete",
            type: "POST",
            dataType: "json",
            context: this,
            data: {
                id_good: idGood
            },
            error: function (data) {
                console.error('Error', data);
            },
            success: function (data) {
                if(data.id) {
                    alert('Good deleted from cart.');
                }
                else {
                    alert('Error');
                }
                $(this).parent().parent().remove();
            }
        });
    });
})
;