<?php
if($ipt == 1){
	echo '$(\'#ipt_yes\').attr("checked", true);';
	echo '$(\'#ipt_reason\').attr("readonly", true);';
}else{
	echo '$(\'#ipt_no\').attr("checked", true);';
	echo '$(\'#ipt_reason\').attr("readonly", false);';
}
//	STI
if($sti == 1){
	echo '$(\'#sti\').attr("checked", true);';
	echo '$(\'#sti_reason\').val(\'' . $sti_reason . '\').attr("readonly", false);';
}else{
	echo '$(\'#sti\').attr("checked", false);';
	echo '$(\'#sti_reason\').val(\'\').attr("readonly", true);';
}
//	Other
if($others == 1){
	echo '$(\'#others\').attr("checked", true);';
	echo '$(\'#others_reason\').val(\'' . $others_reason . '\').attr("readonly", false);';
}else{
	echo '$(\'#others\').attr("checked", false);';
	echo '$(\'#others_reason\').val(\'\').attr("readonly", true);';
}
//	Drug Resistance
if($drug_resistance_value == 'Other'){
	echo '$(\'#drug_resistance_other\').attr("checked", true);';
	echo '$(\'#drug_resistance_value_specify\').val(\'' . $drug_resistance_value_specify . '\').attr("readonly", false);';
}else{
	echo '$(\'#drug_resistance_other\').attr("checked", false);';
	echo '$(\'#drug_resistance_value_specify\').val(\'\').attr("readonly", true);';
}
//	Treatment Outcome
if($treatment_outcome_value == 'Other'){
	echo '$(\'#treatment_outcome_other\').attr("checked", true);';
	echo '$(\'#treatment_outcome_value_specify\').val(\'' . $treatment_outcome_value_specify . '\').attr("readonly", false);';
}else{
	echo '$(\'#treatment_outcome_other\').attr("checked", false);';
	echo '$(\'#treatment_outcome_value_specify\').val(\'\').attr("readonly", true);';
}
?>