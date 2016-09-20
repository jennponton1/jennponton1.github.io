

$(document).ready(function() {
    
    $.ajax({
        url: 'empfile.csv',
        dataType: 'text',
    }).done(successFunction);
    
//    $.ajax({
//        type: "GET",
//        url: "employee_data.php",
//        success: function($csvcontens) {
//            alert($csvcontents);
//        }
//        
//    });
    
//    //function processData(csv) {
//        csv = "empfile.csv";
//        var allTextLines = csv.split(/\r\n|\n/);
//        var lines = [];
//        for (var i=0; i<allTextLines.length; i++) {
//            var data = allTextLines[i].split(';');
//                var tarr = [];
//                for (var j=0; j<data.length; j++) {
//                    tarr.push(data[j]);
//                }
//                lines.push(tarr);
//        }
//      console.log(lines);
//    }
    
} );

function successFunction(data) {
  var allRows = data.split(/\r?\n|\r/);
  var empform = '<form action="employee_add_data.js'
  var table = '<table>';
  for (var singleRow = 0; singleRow < allRows.length; singleRow++) {
    if (singleRow === 0) {
      table += '<thead>';
      table += '<tr>';
    } else {
      table += '<tr>';
    }
    var rowCells = allRows[singleRow].split(',');
    for (var rowCell = 0; rowCell < rowCells.length; rowCell++) {
      if (singleRow === 0) {
        table += '<th>';
        table += rowCells[rowCell];
        table += '</th>';
      } else {
        table += '<td>';
        table += rowCells[rowCell];
        table += '</td>';
      }
    }
    if (singleRow === 0) {
      table += '</tr>';
      table += '</thead>';
      table += '<tbody>';
    } else {
      table += '</tr>';
    }
  } 
  table += '</tbody>';
  table += '</table>';
  $('body').append(table);
}

var addEmpForm = {
    init: function() {
        
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
        //this.gridNode = evt.target.parentNode;
        //this.gridData = employees.table.fnGetData(this.gridNode);
        $("body").append("<div id='adddlg'></div>");
        this.panel = $("adddlg").dialog({
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
        alert('Will save');
        //addEmpDlg.saveRecToFile();
    }
}






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


