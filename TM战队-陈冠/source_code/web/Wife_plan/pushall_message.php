<?php
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = 'HXCg0402.';
	$dbname = 'wife_db';
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(! $con) {
		echo 'Could not connect';
	}
	
//	$sql = "SELECT COUNT(m_id) FROM message";
//	$result = $con->query($sql);
//	$num = mysqli_fetch_Array($result);
//	
	
	$sql = "SELECT * FROM message ORDER BY m_data ASC";
	$result = $con->query($sql);
	$array_content = array();
	$array_header = array();
	$index = 0;
	while($row = mysqli_fetch_Array($result)){
		$array_content[$index] = $row[1];
		$array_header[$index] = "No.".($index+1)." ".$row[2]." 来自".$row[3];
		$index++;
	}
	for($i=0; $i < $index; $i++){
		echo '
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="xxxxx'.$i.'">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#zzzzz'.$i.'" aria-expanded="false" aria-controls="zzzzz'.$i.'">
							'.array_pop($array_header).'
						</a>
					</h4>
				</div>
				<div id="zzzzz'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="xxxxx'.$i.'">
					<div class="panel-body">
						<p>
							'.array_pop($array_content).'  
						</p>
					</div>
				</div>
			</div>
		';	
	}
	mysqli_close($con);	
?>