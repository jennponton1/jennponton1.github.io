<?php

/************************************************************************************
************************************************************************************
These functions are part of an effort to convert a string into an integer.

It takes a string, converts each char into ASCII and smooshes it into one integer.

This function library also contains functions to take an integer smooshed in
 this way back to a string.
 
Strings may contain any alphanumerics or symbols contained on a standard 101 key
 keyboard. This excludes spaces. Control characters and higher order symbols are
 not supported.
************************************************************************************
************************************************************************************/

/***************************************
USE:

convert string to integer:

$integer = StringToInt($string);

convert integer to string:

$string = IntToString($integer);
****************************************/

//char[] StrToArray(string)
function StrToArray($convert){

   $size = strlen($convert);
   echo $size;
   $ret = array();
   
   for($i=0;$i<$size;$i++){
      
      $ret[$i] = substr($convert,$i,1);
   }   
   
   return $ret;
}//end function StrToArray($convert)

//int[] CharArrayToIntArray(char[])
function CharArrayToIntArray($strArray){

   $intArray = array();

   foreach($strArray as $thisChar){
    
      $intArray[] = ord($thisChar) - 38;
   
   }   
   
   return $intArray;
}//end function CharArrayToIntArray                                   

//int IntArrayToInt(int[])
function IntArrayToInt($intArray){
   
   $ret = "";   

   foreach($intArray as $thisInt){
      $ret .= $thisInt;
   }
   
   return $ret;   

}//end IntArrayToInt

//int[] IntToIntArray(int)
function IntToIntArray($convert){

   $intArray = array();
   
   $intArray = str_split($convert,2);
   
   return $intArray;
   
}//end function IntToIntArray

//char[] IntArrayToCharArray(int[])
function IntArrayToCharArray($intArray){

   $charArray = array();
   
   foreach($intArray as $thisInt){
                                  	
      $charArray[] = chr($thisInt + 38);
      
   }
   
   return $charArray;
   
}//end function IntArrayToCharArray

//string CharArrayToString(char[])
function CharArrayToString($charArray){

   $ret = "";
   
   foreach($charArray as $thisChar){
                                   	
      $ret .= $thisChar;
      
   }                                   	

   return $ret;
   
}//end function CharArrayToString


//////////////////////////////////////////////////////////////////////////////
////////The last two functions encompass the first six ///////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


//int StringToInt(string)

function StringToInt($convert){

   $ret = "";
   
   $temp = StrToArray($convert);
   $tempB = CharArrayToIntArray($temp);
   $tempC = IntArrayToInt($tempB);
   
   $ret = $tempC;
   
   return $ret;
   
}//end function StringToInt

//string IntToString(int)

function IntToString($convert){
                              	
   $ret = "";
   
   $temp = IntToIntArray($convert);
   $tempB = IntArrayToCharArray($temp);
   $tempC = CharArrayToString($tempB);

   $ret = $tempC;
   
   return $ret;
   
}//end function IntToString   








?>
