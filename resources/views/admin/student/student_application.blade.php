<style>
table {width:900px;font-family:calibri;border:solid 2px #222;}
th{font-weight:400px;}
td{padding:15px;border-bottom:dotted 1px gray;text-align:left;text-transform:capitalize;}
strong{text-align:center;font-weight:800;color:maroon;font-size:24px;}
.txt {width:350px; height:24px;line-height:30px;font-size:20px;}
h7{padding:0px;margin:0px;font-size:30px;color:midnightblue;font-family:arial black;}
hr{solid 1px #000;}
.head{color:midnightblue;font-family:arial;border:none;}
	p{text-transform:none;}
</style>
<center>
<table border='0' width="1000" rules='col'>
	<tbody>
		<tr>
			<td class='head' colspan='5'>
				<center>
				<img src="{{ asset('logo.png') }}" height='120px' width='930px' >
				
			
				
			</td>
		</tr>
		<tr><td colspan='5' style='border-top:solid 2px gray;border-bottom:solid 2px gray;'>  <center><h2>  Application Form  </h2></center> </td></tr>
		<tr>
			<td>  </td>
			<td> Name of Candidate </td>
			<td> {{ $data->sl_name }} </td>
			<td rowspan='9'>
				<div style='text-align:right;font-weight:600;width:200px;float:right;'>{{ $data->sl_reg_no }}</div><br>
				<img src='{{ asset('center/student_doc/').'/'.$data->sl_photo }}' alt ='Student Photo Not Available' width ='150' height='180' align='right' valign='top' />
			</td>
			<tr>
				<tr>
					<td>  </td>
					<td> Mother's Name  </td>
					<td> {{ $data->sl_mother_name }}</td>
					<tr>
						<tr>
							<td>  </td>
							<td> Father's Name  </td>
							<td> {{ $data->sl_father_name	 }}</td>
							<tr>
								<tr>
									<td> </td>
									<td> Date of Birth *</td>
									<td>{{ $data->sl_dob }}	</td>
									<tr>
										<tr>
											<td>  </td>
											<td>  Gender </td>
											<td colspan='1'>
											{{ $data->sl_sex }}</td>
										</tr>
										{{-- <tr>
											<td>  </td>
											<td> Nationality </td>
											<td colspan='1'>
												INDIAN
											</td>
										</tr> --}}
										<tr>
											<td> </td>
											<td> Present Address </td>
											<td colspan='2'style=' text-transform:uppercase;'>  {{ $data->sl_address }} </td>
											<tr>
												<tr>
													<td> </td>
													<td> Mobile No. </td>
													<td colspan='2'> {{ $data->sl_mobile_no }} </td>
													<tr>
														<tr>
															<td> </td>
															<td> Email Address </td>
															<td colspan='2'> {{ $data->sl_email }}</td>
															<tr>
																<tr>
																	<td colspan='4'> <h3>Course Details </h3> </td>
																</tr>
															</tbody>
															<tr>
																<td>
																	
																</td>
																<td> Course Name /Code </td>
																
																<td colspan='2'> {{ $data->c_full_name }} ({{ $data->c_short_name }})   </td>
															</tr>
															
															<tr>
																<td> </td>
																<td> Course Duration </td>
																
																<td colspan='2'> {{ $data->c_duration }} Months </td>
															</tr>
															
															<tr>
																<td colspan='4'> <h3>Center Details </h3> </td>
															</tr>
														</tbody>
														<tr>
															<td>
																
															</td>
															<td> Center Code </td>
															
															<td colspan='2'> {{ $data->cl_code }}  </td>
														</tr>
														
														<tr>
															<td> </td>
															<td> Center Name </td>
															
															<td colspan='2'> {{ $data->cl_center_name }}     </td>
														</tr>
														
														<tr>
															<td> </td>
															<td> Center Address </td>
															
															<td colspan='2'> {{ $data->cl_center_address }} </td>
														</tr>
														
														
														<tr>
															<td colspan='4'><b> Decleration </b><p> I hereby declared that all the informations are correct and true to the best of my knowledge and belief.  </p> </td>
															
															
														</tr>
														<tr>
															<td colspan='3'>
																Place:	_______________<br><br>
																Date : 	_______________
																
															</td>
															<td >
																<div style='width:200;height:50px;border:solid 0px gray;text-align:center;padding-top:-20px;float:right;'>
																	<img src='https://methodmedia.in/apprise/temp/upload/80209mayacomputer.png' height='50px' >
																Authorized Signatory </div>  </td>
															</tr>
															<tr> <td colspan='4'>
																<center><input type='button' value=' PRINT ' onClick='this.style.display="none";window.print();' >
															</td></tr>
														</form>
													</tbody>