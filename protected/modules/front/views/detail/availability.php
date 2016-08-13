<?php
$date1 =explode('-',$date);
$month = date('F', strtotime($date));
Yii::app()->session['choose_date'] = $date;


				$criteria1 = new CDbCriteria();
				$condition1 ='';
				$condition1 .= 'user_id ="'.$user_id.'" ' ;
				$condition1 .= 'and book_date >= "'.date('Y-m-d').'"' ;
				$condition1 .= 'and iyer_status = "yes"' ;
				$criteria1->condition =  $condition1;
				$booked_details = BookedTable::model()->findAll($criteria1);
				$booked_array = array();
				$datesexist ='';
				if(count($booked_details)>0)
				{
				for($i=0;$i<count($booked_details);$i++)
				{
				$datesexist .= '"'.$booked_details[$i]->book_date.'",'; 
				array_push($booked_array,$booked_details[$i]->book_date);
				}
				}
	if($_POST['type']=='guide')
	{
	$iyermoredetails = Guide::model()->find('user_id=:user_id',array(':user_id'=>$user_id));		
	}
	else
	{
	$iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$user_id));		
	}			
				
		
	$available  = explode(',',$iyermoredetails->availability_dates);		

	

	if(in_array($date,$booked_array))
	{
	Yii::app()->session['with_givendate'] = "Not available";
	}
	else if(in_array($date,$available))
	{
	Yii::app()->session['with_givendate'] ='available';
	}
	else
	{
	Yii::app()->session['with_givendate'] = "Not available";
	}
?>
<hr / style=" border:1px solid #cccccc;">
<div  style=" height:50px; margin-top:23px;border-bottom:1px solid #cccccc;">
<div style="float:left;">Date : </div><div>&nbsp&nbsp;<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/option_calendar_icon.png" onclick="$('#first_old').show();$('#check_date').hide();"  style=" cursor:pointer" />&nbsp;&nbsp;<strong><?php echo  $month;?> <?php echo $date1[2].'th'; ?>, <?php echo $date1[0]; ?> </strong><span onclick="$('#first_old').show();$('#check_date').hide();" style=" cursor:pointer;">(Change date)</span></div>
</div>
