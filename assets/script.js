$(function () {
    var shipper = $('#shipper');
    var product = $('#product');

    shipper.on('change', function () {
        var shippercom = $(this).val();

        product.html('<option value="">--------------------SELECT PRODUCT--------------------</option>');

        $.get('./get_product.php?shipper=' + shippercom, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (index, item) {
                product.append(
                    $('<option></option>').val(item.basename).html(item.basename)
                );
            })
        })
    });

})