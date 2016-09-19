var employees = {
    init: function() {
        
        $.ajax({
            type: "GET",
            url: "empfile.csv",
            dataType: "text",
            success: function(data){
                processData(data);
            }
        });
        
        
    },
    getEmps: function() {
        $.ajax({
            type: "GET",
            url: "empfile.csv",
            dataType: "text",
            success: function(data) {processData(data);}
         });
        //    $.ajax({
        //        type: "GET",
        //        url: "employee_data.php",
        //        success: function() {
        //            
        //        }
        //    });
    },

    processData: function(allText) {
        var allTextLines = allText.split(/\r\n|\n/);
//        var headers = allTextLines[0].split(',');
        var lines = [];

        for (var i=1; i<allTextLines.length; i++) {
            var data = allTextLines[i].split(',');
//            if (data.length == headers.length) {

                var tarr = [];
                for (var j=0; j<data.length; j++) {
                    tarr.push(data[j]);
                    //tarr.push(headers[j]+":"+data[j]);
                }
                lines.push(tarr);
//            }
        }
         alert(lines);
    }
}



$(document).ready(function() {
    
    employees.init();
    
//    $('#emp_tbl').DataTable( {
//        data: dataSet,
//        columns: [
//            { title: "Name" },
//            { title: "Position" },
//            { title: "Office" },
//            { title: "Extn." },
//            { title: "Start date" },
//            { title: "Salary" }
//        ]
//    } );
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


