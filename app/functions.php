<?php

  // Validation Function:
  function validation_notice($msg, $type){
    return '<p class="alert alert-'.$type.'">'.$msg.' <button class="close" data-dismiss="alert"> &times; </button> </p>';
  }


  // Value Check:
  function val_check($tbl, $col, $val){
  	global $connection;

  	$sql = "SELECT $col FROM $tbl WHERE $col ='$val' ";
  	$val_check = $connection -> query($sql);

  	return $val_check -> num_rows;
  }


?>