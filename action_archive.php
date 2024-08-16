<?php 
	@include 'include\config.php'; 

	function check_manu($database_table,$manufacturer)
	{
		@include 'include\config.php';

		$sql = "SELECT userid FROM ".$database_table." WHERE manufacturer IN ('".$manufacturer."')";
		$result = mysqli_query($conn, $sql);

		if($result -> num_rows > 0){
			return $result;
		} else {
			return NULL;
		}


	}

	function check_date($database_table,$min, $max, $userid)
	{
		@include 'include\config.php';

		$sql = "SELECT userid FROM ".$database_table." WHERE date >= '".$min."' AND date <= '".$max."' AND userid IN ('".$userid."')";
		$result = mysqli_query($conn, $sql);

		if($result -> num_rows > 0){
			return $result;
		} else {
			return NULL;
		}


	}

	function check_date_no($database_table,$min, $max)
	{
		@include 'include\config.php';

		$sql = "SELECT userid FROM ".$database_table." WHERE date >= '".$min."' AND date <= '".$max."' ";
		$result = mysqli_query($conn, $sql);

		if($result -> num_rows > 0){
			return $result;
		} else {
			return NULL;
		}


	}

	if(isset($_POST['action'])){
		
		$sql = "SELECT * FROM archive INNER JOIN user_login ON archive.userid = user_login.user_login_id WHERE gender != ' '";

		if(isset($_POST['gender'])){
			$gender = implode("','", $_POST['gender']);
			$sql .= " AND gender IN ('".$gender."')";
		}

		if(isset($_POST['roles'])){
			$roles = implode("','", $_POST['roles']);
			$sql .= " AND roles IN ('".$roles."')";
		}

		if(isset($_POST['grade'])){
			$grade = implode("','", $_POST['grade']);
			$sql .= " AND grade IN ('".$grade."')";
		}

		if(isset($_POST['section'])){
			$section = implode("','", $_POST['section']);
			$sql .= " AND section IN ('".$section."')";
		}

		if(isset($_POST['department'])){
			$department = implode("','", $_POST['department']);
			$sql .= " AND department IN ('".$department."')";
		}

		if(isset($_POST['address'])){
			$address = implode("','", $_POST['address']);
			$sql .= " AND address IN ('".$address."')";
		}

		if(isset($_POST['status'])){
			foreach($_POST['status'] as $status){
				if($status == "FV"){
					$sql .= " AND boosterDoseid IS NULL AND firstDoseid IS NOT NULL AND secondDoseid IS NOT NULL";
				}else if($status == "OD"){
					$sql .= " AND boosterDoseid IS NULL AND secondDoseid IS NULL AND firstDoseid IN (SELECT first_dose_id FROM first_dose WHERE manufacturer = 'Jansen')";
				}else if($status == "HV"){
					$sql .= " AND boosterDoseid IS NULL AND secondDoseid IS NULL AND firstDoseid IN (SELECT first_dose_id FROM first_dose WHERE manufacturer != 'Jansen')";
				}else if($status == "FVB"){
					$sql .= " AND boosterDoseid IS NOT NULL AND secondDoseid IS NOT NULL AND firstDoseid IS NOT NULL";
				}else if($status == "NV"){
					$sql .= " AND boosterDoseid IS NULL AND secondDoseid IS NULL AND firstDoseid IS NULL";
				}

			}
		}

		

		if( !isset($_POST['manufacturer'])){

			if( !isset($_POST['start_date']) || !isset($_POST['end_date']) ){

				$result = mysqli_query($conn, $sql);
				$output = '';
				
				if($result -> num_rows > 0){
					while($row = mysqli_fetch_assoc($result)){
						
												$id = $row["archive_id"];
												$userid = $row["userid"];
												$name = $row["name"];
												$gender = $row["gender"];
												$birthday = $row["birthday"];
												$address = $row["address"];
												$contact = $row["contact"];
												$role = $row["roles"];
												$grade = $row["grade"];
												$section = $row["section"];
												$department = $row["department"];
									
												$philHealth = $row["philhealth"];
												$category = $row["category"];
												$cardNumber = $row["vaccineCardNumber"];
												$firstDoseid = $row["firstDoseid"];
												$secondDoseid = $row["secondDoseid"];
												$boosterDoseid = $row["boosterDoseid"];
												$facilityName = $row['facilityName'];
												$facilityContact = $row['facilityContact'];
												$vaccineCard = $row["vaccineCard"];
												$boosterCard = $row["boosterCard"];

												if($firstDoseid != NULL){
													$sql_firstDose = "SELECT * FROM first_dose WHERE userid = $userid";
													$result_first = mysqli_query($conn, $sql_firstDose);
													if($result_first){
														while($row_first = mysqli_fetch_assoc($result_first)){
															$vaccineDateFirst = $row_first["date"];
															$manufacturerFirst = $row_first["manufacturer"];
															$batchFirst = $row_first["batchNumber"];
															$lotFirst = $row_first["lotNumber"];
															$vaccinatorFirst = $row_first["vaccinatorName"];
														}
													}
												}
									
												if($secondDoseid != NULL){
													$sql_secondDose = "SELECT * FROM second_dose WHERE userid = $userid";
													$result_second = mysqli_query($conn, $sql_secondDose);
													if($result_second){
														while($row_second = mysqli_fetch_assoc($result_second)){
															$vaccineDateSecond = $row_second["date"];
															$manufacturerSecond= $row_second["manufacturer"];
															$batchSecond = $row_second["batchNumber"];
															$lotSecond = $row_second["lotNumber"];
															$vaccinatorSecond = $row_second["vaccinatorName"];
														}
													}
												}
									
												if($boosterDoseid != NULL){
													$sql_boosterDose = "SELECT * FROM booster_dose WHERE userid = $userid";
													$result_booster = mysqli_query($conn, $sql_boosterDose);
													if($result_booster){
														while($row_booster = mysqli_fetch_assoc($result_booster)){
															$vaccineDateBooster = $row_booster["date"];
															$manufacturerBooster= $row_booster["manufacturer"];
															$batchBooster = $row_booster["batchNumber"];
															$lotBooster = $row_booster["lotNumber"];
															$vaccinatorBooster = $row_booster["vaccinatorName"];
														}
													}
												}
						$output .='<tr>
										<th scope="row">'.$id.'</th>
										<td>'.$name.'</td>
										<td>'.$address.'</td>
										<td>'.$gender.'</td>
										<td>'.$contact.'</td>
										<td>'.$birthday.'</td>
										<td>'.$role.'</td>
										<td>'.$grade. ' - ' .$section. '</td>
										<td>'.$department.'</td>
										<td>'.$philHealth.'</td>
										<td>'.$category.'</td>
										<td>'.$cardNumber.' </td>';

						if ($firstDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorFirst.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($secondDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorSecond.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($boosterDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorBooster.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						$output .= '	<td>'.$facilityName.'</td>
										<td>'.$facilityContact.'</td>
										<td>
											<a href="imageClick-archive.php?uid='.$userid.'" target="_blank">Click Here</a>
										</td>
										<td>
											<button class="btn btn-danger"><a href="unarchive.php?unarchiveid='.$userid.'" class="text-light">Unarchive</a></button>
											<button class="btn btn-success"><a href="user_history.php?uid='.$userid.'" class="text-light">History</a></button>
										</td>
									</tr>';
										
					}
				} 
				else {
					$output = "<h4 style='color: #024059; text-align: center'> No Data Found! </h4>";
				}
			} else {

				$start_date = implode("','", $_POST['start_date']);
				$end_date = implode("','", $_POST['end_date']);
				$uidTemp = array(); 

				if(check_date_no("first_dose",$start_date, $end_date) != NULL){
					$userid_date = check_date_no("first_dose",$start_date, $end_date );
					
					while($row = mysqli_fetch_assoc($userid_date)){
						array_push($uidTemp, $row['userid']);
					}
				} 

				if(check_date_no("second_dose",$start_date, $end_date) != NULL){
					$userid_date = check_date_no("second_dose",$start_date, $end_date);
					
					while($row = mysqli_fetch_assoc($userid_date)){
						array_push($uidTemp, $row['userid']);
					}
				} 

				if(check_date_no("booster_dose",$start_date, $end_date ) != NULL){
					$userid_date = check_date_no("booster_dose",$start_date, $end_date );
					
					while($row = mysqli_fetch_assoc($userid_date)){
						array_push($uidTemp, $row['userid']);
					}
				}
				
				$uid = implode("','", $uidTemp);
				$sql .= " AND userid IN ('".$uid."')";
				$result = mysqli_query($conn, $sql);
				$output = '';

				if($result -> num_rows > 0){
					while($row = mysqli_fetch_assoc($result)){
						
												$id = $row["archive_id"];
												$userid = $row["userid"];
												$name = $row["name"];
												$gender = $row["gender"];
												$birthday = $row["birthday"];
												$address = $row["address"];
												$contact = $row["contact"];
												$role = $row["roles"];
												$grade = $row["grade"];
												$section = $row["section"];
												$department = $row["department"];
									
												$philHealth = $row["philhealth"];
												$category = $row["category"];
												$cardNumber = $row["vaccineCardNumber"];
												$firstDoseid = $row["firstDoseid"];
												$secondDoseid = $row["secondDoseid"];
												$boosterDoseid = $row["boosterDoseid"];
												$facilityName = $row['facilityName'];
												$facilityContact = $row['facilityContact'];
												$vaccineCard = $row["vaccineCard"];
												$boosterCard = $row["boosterCard"];
	
												if($firstDoseid != NULL){
													$sql_firstDose = "SELECT * FROM first_dose WHERE userid = $userid";
													$result_first = mysqli_query($conn, $sql_firstDose);
													if($result_first){
														while($row_first = mysqli_fetch_assoc($result_first)){
															$vaccineDateFirst = $row_first["date"];
															$manufacturerFirst = $row_first["manufacturer"];
															$batchFirst = $row_first["batchNumber"];
															$lotFirst = $row_first["lotNumber"];
															$vaccinatorFirst = $row_first["vaccinatorName"];
														}
													}
												}
									
												if($secondDoseid != NULL){
													$sql_secondDose = "SELECT * FROM second_dose WHERE userid = $userid";
													$result_second = mysqli_query($conn, $sql_secondDose);
													if($result_second){
														while($row_second = mysqli_fetch_assoc($result_second)){
															$vaccineDateSecond = $row_second["date"];
															$manufacturerSecond= $row_second["manufacturer"];
															$batchSecond = $row_second["batchNumber"];
															$lotSecond = $row_second["lotNumber"];
															$vaccinatorSecond = $row_second["vaccinatorName"];
														}
													}
												}
									
												if($boosterDoseid != NULL){
													$sql_boosterDose = "SELECT * FROM booster_dose WHERE userid = $userid";
													$result_booster = mysqli_query($conn, $sql_boosterDose);
													if($result_booster){
														while($row_booster = mysqli_fetch_assoc($result_booster)){
															$vaccineDateBooster = $row_booster["date"];
															$manufacturerBooster= $row_booster["manufacturer"];
															$batchBooster = $row_booster["batchNumber"];
															$lotBooster = $row_booster["lotNumber"];
															$vaccinatorBooster = $row_booster["vaccinatorName"];
														}
													}
												}
						$output .='<tr>
										<th scope="row">'.$id.'</th>
										<td>'.$name.'</td>
										<td>'.$address.'</td>
										<td>'.$gender.'</td>
										<td>'.$contact.'</td>
										<td>'.$birthday.'</td>
										<td>'.$role.'</td>
										<td>'.$grade. ' - ' .$section. '</td>
										<td>'.$department.'</td>
										<td>'.$philHealth.'</td>
										<td>'.$category.'</td>
										<td>'.$cardNumber.' </td>';
	
						if ($firstDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorFirst.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($secondDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorSecond.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($boosterDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorBooster.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						$output .= '	<td>'.$facilityName.'</td>
										<td>'.$facilityContact.'</td>
										<td>
											<a href="imageClick-archive.php?uid='.$userid.'" target="_blank">Click Here</a>
										</td>
										<td>
											<button class="btn btn-danger"><a href="unarchive.php?unarchiveid='.$userid.'" class="text-light">Unarchive</a></button>
											<button class="btn btn-success"><a href="user_history.php?uid='.$userid.'" class="text-light">History</a></button>
										</td>
									</tr>';
										  
					}
				} 
				else {
					$output = "<h4 style='color: #024059; text-align: center'> No Data Found! </h4>";
				}

			}

	    } else {
			
			if( !isset($_POST['start_date']) || !isset($_POST['end_date']) ){
				
				$manufacturer = implode("','", $_POST['manufacturer']);
				$uidTemp = array(); 

				if(check_manu("first_dose", $manufacturer) != NULL){
					$userid_vaccine = check_manu("first_dose",$manufacturer);
					
					while($row = mysqli_fetch_assoc($userid_vaccine)){
						array_push($uidTemp, $row['userid']);
					}
				} 
				
				if (check_manu("second_dose", $manufacturer) != NULL){
					$userid_vaccine = check_manu("second_dose",$manufacturer);
					
					while($row = mysqli_fetch_assoc($userid_vaccine)){
						array_push($uidTemp, $row['userid']);
					}	
				} 

				if (check_manu("booster_dose", $manufacturer) != NULL){
					$userid_vaccine = check_manu("booster_dose",$manufacturer);
					
					while($row = mysqli_fetch_assoc($userid_vaccine)){
						array_push($uidTemp, $row['userid']);
					}

					
				} 

				$uid = implode("','", $uidTemp);
				$sql .= " AND userid IN ('".$uid."')";
				$result = mysqli_query($conn, $sql);
				$output = '';

				if($result -> num_rows > 0){
					while($row = mysqli_fetch_assoc($result)){
						
												$id = $row["archive_id"];
												$userid = $row["userid"];
												$name = $row["name"];
												$gender = $row["gender"];
												$birthday = $row["birthday"];
												$address = $row["address"];
												$contact = $row["contact"];
												$role = $row["roles"];
												$grade = $row["grade"];
												$section = $row["section"];
												$department = $row["department"];
									
												$philHealth = $row["philhealth"];
												$category = $row["category"];
												$cardNumber = $row["vaccineCardNumber"];
												$firstDoseid = $row["firstDoseid"];
												$secondDoseid = $row["secondDoseid"];
												$boosterDoseid = $row["boosterDoseid"];
												$facilityName = $row['facilityName'];
												$facilityContact = $row['facilityContact'];

												$vaccineCard = $row["vaccineCard"];
												$boosterCard = $row["boosterCard"];

												if($firstDoseid != NULL){
													$sql_firstDose = "SELECT * FROM first_dose WHERE userid = $userid";
													$result_first = mysqli_query($conn, $sql_firstDose);
													if($result_first){
														while($row_first = mysqli_fetch_assoc($result_first)){
															$vaccineDateFirst = $row_first["date"];
															$manufacturerFirst = $row_first["manufacturer"];
															$batchFirst = $row_first["batchNumber"];
															$lotFirst = $row_first["lotNumber"];
															$vaccinatorFirst = $row_first["vaccinatorName"];
														}
													}
												}
									
												if($secondDoseid != NULL){
													$sql_secondDose = "SELECT * FROM second_dose WHERE userid = $userid";
													$result_second = mysqli_query($conn, $sql_secondDose);
													if($result_second){
														while($row_second = mysqli_fetch_assoc($result_second)){
															$vaccineDateSecond = $row_second["date"];
															$manufacturerSecond= $row_second["manufacturer"];
															$batchSecond = $row_second["batchNumber"];
															$lotSecond = $row_second["lotNumber"];
															$vaccinatorSecond = $row_second["vaccinatorName"];
														}
													}
												}
									
												if($boosterDoseid != NULL){
													$sql_boosterDose = "SELECT * FROM booster_dose WHERE userid = $userid";
													$result_booster = mysqli_query($conn, $sql_boosterDose);
													if($result_booster){
														while($row_booster = mysqli_fetch_assoc($result_booster)){
															$vaccineDateBooster = $row_booster["date"];
															$manufacturerBooster= $row_booster["manufacturer"];
															$batchBooster = $row_booster["batchNumber"];
															$lotBooster = $row_booster["lotNumber"];
															$vaccinatorBooster = $row_booster["vaccinatorName"];
														}
													}
												}
						$output .='<tr>
										<th scope="row">'.$id.'</th>
										<td>'.$name.'</td>
										<td>'.$address.'</td>
										<td>'.$gender.'</td>
										<td>'.$contact.'</td>
										<td>'.$birthday.'</td>
										<td>'.$role.'</td>
										<td>'.$grade. ' - ' .$section. '</td>
										<td>'.$department.'</td>
										<td>'.$philHealth.'</td>
										<td>'.$category.'</td>
										<td>'.$cardNumber.' </td>';

						if ($firstDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorFirst.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($secondDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorSecond.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($boosterDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorBooster.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						$output .= '	<td>'.$facilityName.'</td>
										<td>'.$facilityContact.'</td>
										<td>
											<a href="imageClick-archive.php?uid='.$userid.'" target="_blank">Click Here</a>
										</td>
										<td>
											<button class="btn btn-danger"><a href="unarchive.php?unarchiveid='.$userid.'" class="text-light">Unarchive</a></button>
											<button class="btn btn-success"><a href="user_history.php?uid='.$userid.'" class="text-light">History</a></button>
										</td>
									</tr>';
										
					}
				} 
				else {
					$output = "<h4 style='color: #024059; text-align: center'> No Data Found! </h4>";
				}

			} else {
				
				$manufacturer = implode("','", $_POST['manufacturer']);
				$start_date = implode("','", $_POST['start_date']);
				$end_date = implode("','", $_POST['end_date']);
				$uidTemp = array(); 
				$uidTemp2 = array(); 

				if(check_manu("first_dose", $manufacturer) != NULL){
					$userid_vaccine = check_manu("first_dose",$manufacturer);
					
					while($row = mysqli_fetch_assoc($userid_vaccine)){
						array_push($uidTemp, $row['userid']);
					}
				} 
				
				if (check_manu("second_dose", $manufacturer) != NULL){
					$userid_vaccine = check_manu("second_dose",$manufacturer);
					
					while($row = mysqli_fetch_assoc($userid_vaccine)){
						array_push($uidTemp, $row['userid']);
					}	
				} 

				if (check_manu("booster_dose", $manufacturer) != NULL){
					$userid_vaccine = check_manu("booster_dose",$manufacturer);
					
					while($row = mysqli_fetch_assoc($userid_vaccine)){
						array_push($uidTemp, $row['userid']);
					}
				}

				$filterid = implode("','", $uidTemp);

				if(check_date("first_dose",$start_date, $end_date, $filterid) != NULL){
					$userid_date = check_date("first_dose",$start_date, $end_date, $filterid);
					
					while($row = mysqli_fetch_assoc($userid_date)){
						array_push($uidTemp2, $row['userid']);
					}
				} 

				if(check_date("second_dose",$start_date, $end_date, $filterid) != NULL){
					$userid_date = check_date("second_dose",$start_date, $end_date, $filterid);
					
					while($row = mysqli_fetch_assoc($userid_date)){
						array_push($uidTemp2, $row['userid']);
					}
				} 

				if(check_date("booster_dose",$start_date, $end_date, $filterid) != NULL){
					$userid_date = check_date("booster_dose",$start_date, $end_date,$filterid);
					
					while($row = mysqli_fetch_assoc($userid_date)){
						array_push($uidTemp2, $row['userid']);
					}
				}

				$uid = implode("','", $uidTemp2);
				$sql .= " AND userid IN ('".$uid."')";
				$result = mysqli_query($conn, $sql);
				$output = '';

				if($result -> num_rows > 0){
					while($row = mysqli_fetch_assoc($result)){
						
												$id = $row["archive_id"];
												$userid = $row["userid"];
												$name = $row["name"];
												$gender = $row["gender"];
												$birthday = $row["birthday"];
												$address = $row["address"];
												$contact = $row["contact"];
												$role = $row["roles"];
												$grade = $row["grade"];
												$section = $row["section"];
												$department = $row["department"];
									
												$philHealth = $row["philhealth"];
												$category = $row["category"];
												$cardNumber = $row["vaccineCardNumber"];
												$firstDoseid = $row["firstDoseid"];
												$secondDoseid = $row["secondDoseid"];
												$boosterDoseid = $row["boosterDoseid"];
												$facilityName = $row['facilityName'];
												$facilityContact = $row['facilityContact'];

												$vaccineCard = $row["vaccineCard"];
												$boosterCard = $row["boosterCard"];

												if($firstDoseid != NULL){
													$sql_firstDose = "SELECT * FROM first_dose WHERE userid = $userid";
													$result_first = mysqli_query($conn, $sql_firstDose);
													if($result_first){
														while($row_first = mysqli_fetch_assoc($result_first)){
															$vaccineDateFirst = $row_first["date"];
															$manufacturerFirst = $row_first["manufacturer"];
															$batchFirst = $row_first["batchNumber"];
															$lotFirst = $row_first["lotNumber"];
															$vaccinatorFirst = $row_first["vaccinatorName"];
														}
													}
												}
									
												if($secondDoseid != NULL){
													$sql_secondDose = "SELECT * FROM second_dose WHERE userid = $userid";
													$result_second = mysqli_query($conn, $sql_secondDose);
													if($result_second){
														while($row_second = mysqli_fetch_assoc($result_second)){
															$vaccineDateSecond = $row_second["date"];
															$manufacturerSecond= $row_second["manufacturer"];
															$batchSecond = $row_second["batchNumber"];
															$lotSecond = $row_second["lotNumber"];
															$vaccinatorSecond = $row_second["vaccinatorName"];
														}
													}
												}
									
												if($boosterDoseid != NULL){
													$sql_boosterDose = "SELECT * FROM booster_dose WHERE userid = $userid";
													$result_booster = mysqli_query($conn, $sql_boosterDose);
													if($result_booster){
														while($row_booster = mysqli_fetch_assoc($result_booster)){
															$vaccineDateBooster = $row_booster["date"];
															$manufacturerBooster= $row_booster["manufacturer"];
															$batchBooster = $row_booster["batchNumber"];
															$lotBooster = $row_booster["lotNumber"];
															$vaccinatorBooster = $row_booster["vaccinatorName"];
														}
													}
												}
						$output .='<tr>
										<th scope="row">'.$id.'</th>
										<td>'.$name.'</td>
										<td>'.$address.'</td>
										<td>'.$gender.'</td>
										<td>'.$contact.'</td>
										<td>'.$birthday.'</td>
										<td>'.$role.'</td>
										<td>'.$grade. ' - ' .$section. '</td>
										<td>'.$department.'</td>
										<td>'.$philHealth.'</td>
										<td>'.$category.'</td>
										<td>'.$cardNumber.' </td>';

						if ($firstDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotFirst.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorFirst.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($secondDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotSecond.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorSecond.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						
						if ($boosterDoseid!= NULL){
							$output .= '<td class="text-justify">
											<h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotBooster.'</h5> <br>
											<h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorBooster.'</h5> <br>
										</td>';
							} else { 
								$output .= '<td> </td>';
							}
						$output .= '	<td>'.$facilityName.'</td>
										<td>'.$facilityContact.'</td>
										<td>
											<a href="imageClick-archive.php?uid='.$userid.'" target="_blank">Click Here</a>
										</td>
										<td>
											<button class="btn btn-danger"><a href="unarchive.php?unarchiveid='.$userid.'" class="text-light">Unarchive</a></button>
											<button class="btn btn-success"><a href="user_history.php?uid='.$userid.'" class="text-light">History</a></button>
										</td>
									</tr>';
										
					}
				} 
				else {
					$output = "<h4 style='color: #024059; text-align: center'> No Data Found! </h4>";
				}

	    }
	}

        echo $output;

	}
?>

