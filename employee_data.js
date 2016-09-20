

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


