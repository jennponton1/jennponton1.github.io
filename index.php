<?php

echo 'this sucks';

//$row = 1;
//if (($handle = fopen("empfile.csv", "r")) !== FALSE) {
//    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//        $num = count($data);
//        echo "<p> $num fields in line $row: <br /></p>\n";
//        $row++;
//        for ($c=0; $c < $num; $c++) {
//            echo $data[$c] . "<br />\n";
//        }
//    }
//    fclose($handle);
//}

//$filename = empfile.csv;
//$header = true;
//$handle = fopen($filename);
//
//echo '<table>';
//
//if ($header) {
//    $csvcontents = fgetcsv($handle);
//    echo '<tr>';
//    foreach ($csvcontents as $headercolumn) {
//        echo "<th>$headercolumn</th>";
//    }
//    echo '</tr>';
//}
//
//while ($csvcontents = fgetcsv($handle)) {
//    echo '<tr>';
//    foreach ($csvcontents as $column) {
//        echo "<td>$column</td>";
//    }
//    echo '</tr>';
//}
//echo '</table>';
//fclose($handle);


//function jj_readcsv($filename, $header=false) {
//$handle = fopen($filename, "r");
//echo '<table>';
////display header row if true
//if ($header) {
//    $csvcontents = fgetcsv($handle);
//    echo '<tr>';
//    foreach ($csvcontents as $headercolumn) {
//        echo "<th>$headercolumn</th>";
//    }
//    echo '</tr>';
//}
//// displaying contents
//while ($csvcontents = fgetcsv($handle)) {
//    echo '<tr>';
//    foreach ($csvcontents as $column) {
//        echo "<td>$column</td>";
//    }
//    echo '</tr>';
//}
//echo '</table>';
//fclose($handle);
//}

////echo "got to here";
//    $row = 1;
//    if (($handle = fopen("empfile.csv", "r")) !== FALSE) {
//        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//            $num = count($data);
//            //echo "<p> $num fields in line $row: <br /></p>\n";
//            $row++;
//            for ($c=0; $c < $num; $c++) {
//                
//                echo $data[$c] . "<br />\n";
//            }
//        }
//        fclose($handle);
//    }
//
////    $list = array (
////        array('Fred', 'Flintstone', 'E45000', '237 Rock Drive', 'Bedrock', 'GA'),
////        array('Betty', 'Rubble', 'E45002', '235 Rock Drive', 'Bedrock', 'GA'),
////        array('Wilma', 'Flintstone', 'E46000', '237 Rock Drive', 'Bedrock', 'GA'),
////        array('Barney', 'Rubble', 'E45003', '235 Rock Drive', 'Bedrock', 'GA'),
////        array('Jennifer', 'Ponton', 'E47000', '123 Somewhere On A Beach Drive', 'Beach City', 'GA')
////    );
////
////    $fp = fopen('empfile.csv', 'x+');
////
////    foreach ($list as $fields) {
////        fputcsv($fp, $fields);
////    }
////
////    fclose($fp);
//    
//    
//
////include 'htwapp.class.php';
////require_once 'htframework.inc.php';
////
////function main() {
////    global $htwApp;
////    $tpl = $htwApp->createSmarty();
////    $empfname = 'Jennifer';
////    $tpl->assign('empfname', $empfname);
////    $tpl->display(dirname(__FILE__) . "employee_data.html");
////}
////
////$htwApp->addControllerElement('main', 'main');
////$htwApp->dispatch();
//
//
//
