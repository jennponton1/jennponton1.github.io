var employees = {
    init: function() {
        
        $.ajax({
            type: "GET",
            url: "empfile.csv",
            dataType: "text",
            success: function(data){
                employees.processData(data);
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
        var allTextLinesLength = allTextLines.length - 1;
        for (var i=0; i<allTextLinesLength; i++) {
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
         //alert(lines);
        $('#emp_tbl').DataTable( {
            data: lines,
            columns: [
                { title: "First Name" },
                { title: "Last Name" },
                { title: "Employee Number" },
                { title: "Street Address" },
                { title: "City" },
                { title: "State" }
            ]
        } );
    }
}

var addEmpDlg = {
    panel : '',
    gridNode : '',
    gridData : '',
    state : '',
    init: function(evt) {
        if (this.panel != '') {
            return;
        }            
        this.state = '';
        this.gridNode = evt.target.parentNode;
        this.gridData = employees.table.fnGetData(this.gridNode);
        $("body").append("<div id='adddlg'></div>");
        this.panel = $("#adddlg").dialog({
            close: function() {
                addEmpDlg.panel = '';
            }
        });
        
        $("#adddlg").html(
            "<table>"+
            "<tr>"+
            "<td><label for='fname'>First Name:</label></td><td><input id='fname'></td>"+
            "</tr>"+
            "<tr>"+
            "<td><label for='lname'>Last Name:</label></td><td><input id='lname'></td>"+
            "</tr>"+
            "<tr>"+
            "<td><label for='empnum'>Employee Number:</label></td><td><input id='empnum'></td>"+
            "</tr>"+
            "<tr>"+
            "<td><label for='staddr'>Street Address:</label></td><td><input id='staddr'></td>"+
            "</tr>"+
            "<tr>"+
            "<td><label for='city'>City:</label></td><td><input id='city'></td>"+
            "</tr>"+
            "<tr>"+
            "<td><label for='state'>State:</label></td><td><input id='state'></td>"+
            "</tr></table>"+
            "<button onclick=javascript:formAddEmpValidation();'>Save</button>"
        );
    },
    
};

function formAddEmpValidation(errorflag) {
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var empnum = $("#empnum").val();
    var staddr = $("#staddr").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var errorflag = 0;
    if(fname == '') {
        alert('First Name is required.');
        document.getElementById('fname').focus();
        errorflag = 1;
    }
    if(lname == '') {
        alert('Last Name is required.');
        document.getElementById('lname').focus();
        errorflag = 1;
    }
    if(empnum == '') {
        alert('Employee Number is required.');
        document.getElementById('empnum').focus();
        errorflag = 1;
    }
    if(staddr == '') {
        alert('Street Address is required.');
        document.getElementById('staddr').focus();
        errorflag = 1;
    }
    if(city == '') {
        alert('City is required.');
        document.getElementById('city').focus();
        errorflag = 1;
    }
    if(state == '') {
        alert('State is required.');
        document.getElementById('state').focus();
        errorflag = 1;
    }
    if(errorflag == 0) {
        addEmpDlg.saveRecToFile();
    }
}



$(document).ready(function() {
    
    employees.init();
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


