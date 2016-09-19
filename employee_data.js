

$(document).ready(function() {
    
    $.ajax({
        type: "GET",
        url: "employee_data.php",
        success: function() {
            alert('Yay');
        }
        
    });
} );





//
//
////window.document.location.href = 'employee_data.php';
//var vendid = $("#vendid").val();
//        var invcnbr = $("#invnbr").val();
//        $.ajax({
//            type: "GET",
//            url: "?do=checkinvcnbr&vendid="+vendid+"&invcnbr="+invcnbr,
//            dataType: "json",
//            //async: false,
//            success: function(head) {
//                var JSON = head;
//                if (JSON.invexists == "Y") {
//                    var r=confirm("Invoice Number already exists for Vendor.\nPress OK to override or CANCEL to change the Invoice Number.");
//                    if (r==false) {
//                        document.getElementById('invnbr').focus();
//                    }
//                }
//            }
//        });
//$.ajax({
//    type: "POST",
//    url: "?do=main"
//});


