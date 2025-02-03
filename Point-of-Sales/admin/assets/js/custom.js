$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-right');

    $(document).on('click', '.increment', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }

    });

    $(document).on('click', '.decrement', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue) && currentValue > 1) {
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }

    });

    function quantityIncDec(prodId, qty) {

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty
            },
            success: function (response) {
                var res = JSON.parse(response);
                console.log(res);

                if (res.status == 200) {
                    $('#productArea').load(' #productContent')
                    alertify.success(res.message);
                } else {
                    $('#productArea').load(' #productContent')
                    alertify.error(res.message);
                }
            }
        });
    }

    // Tombol Konfirmasi Ketika di-Klik
    $(document).on('click', '.confirmOrder', function () {

        console.log('confirmOrder');

        var customer_name = $('#customer_name').val();
        var payment_method = $('#payment_method').val();

        if (payment_method == '') {
            swal("Pilih Metode Pembayaran!", "", "warning");
            return false;
        }

        if (customer_name == '') {
            swal("Isi nama pelanggan!", "", "warning");
            return false;
        }

        var data = {
            'confirmOrderBtn': true,
            'customer_name': customer_name,
            'payment_method': payment_method,
        };

        console.log("Mengirim data:", data); // Debugging sebelum AJAX
          
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: data,
            success: function (response) {
                console.log("Response dari server:", response);
                try {
                    var res = JSON.parse(response);
                    console.log("Parsed JSON:", res);
                    if (res.status == 200) {
                        window.location.href = "order-summary.php";
                    } else {
                        swal(res.message, "", res.status_type);
                    }
                } catch (error) {
                    console.error("JSON Parsing Error:", error);
                    swal("Terjadi kesalahan dalam proses!", "", "error");
                }
            },
        });

    });

    $(document).on('click', '#saveOrder', function () {

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'saveOrder': true
            },
            success: function (response) {
                var res = JSON.parse(response)
                if (res.status == 200) {
                    swal(res.message, "", res.status_type);
                    $('#orderPlaceSuccesMessage').text(res.message);
                    $('#orderSuccessModal').modal('show');
                } else {
                    swal(res.message, "", res.status_type);
                }
            }

        });

    });

});

// function printInvoiceArea(){
//     var divContents = document.getElementById('invoiceArea').innerHTML;
//     var a = window.open('', '');
//     a.document.write('<html><title>KARAT : Kasir Akurat</title>');
//     a.document.write('<body style="font-family: fangsong;">');
//     a.document.write(divContents);
//     a.document.write('</body></html>');
//     a.document.close();
//     a.print();
// }

function printInvoiceArea() {
    var originalContents = document.body.innerHTML;
    var printContents = document.getElementById('invoiceArea').innerHTML;

    document.body.innerHTML = printContents;
    window.print();

    // Kembalikan konten asli setelah print
    document.body.innerHTML = originalContents;

    // Refresh untuk memastikan elemen kembali normal
    location.reload(); 
}

window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF(); 

function downloadPDF(invoiceNo){

    var elementHTML = document.querySelector("#invoiceArea");
    docPDF.html( elementHTML, {
        callback: function() {
            docPDF.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650
    });

}