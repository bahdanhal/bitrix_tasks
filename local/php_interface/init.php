<?
	function reportResult($reportId)
	{
		if($reportId){
			return "Ваше мнение учтено, №" . $reportId;
		} else {
			return "Ошибка!";
		}
	}
?>