


<style> 
table {width:900px;font-family:calibri;border:solid 0px #222;}
th{font-weight:400px;}
td{padding:10px;border-bottom:dotted 1px gray;text-transform:capitalize;}
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
	<img src='assets/img/banner.jpg' height='80px' width='650px' > 
	</td>
</tr>

<tr><td colspan='4'>  <center><h2>  Payment Receipt  </h2></center> </td></tr>

<tr>
	<td> Receipt No. </td>
	<td> {{ $print_receipt-> }} </td>
	<td align='right' >Reg. No.: 911076010001  </td>
	<td align='right' > Receipt Date : 13-Apr-2024  </td>
	<!--<td align='right' > Receipt Date : 13-Apr-2024 08:47 PM  </td>-->
</tr>
	
<tr>
	
	<td colspan='2'> Payment Received From : </td>
	<td colspan='3'> Vijay Kumar </td>
	
<tr>
<tr>
	<td colspan='2'> Amount : </td>
	<td colspan='3'> 300.00 </td>
<tr>
<tr>
	<td colspan='2'> Current Dues : </td>
	<td colspan='3'> -600.00 </td>
<tr>

<tr>
	
	<td colspan='2'> Course  : </td>
<td colspan='3'> Advance Diploma in Computer Application[ADCA] </td>
	<tr>
		<td colspan='2'> Center Code </td>
		<td colspan='3'> 91107601  </td>
	</tr>
	
	<tr>
		<td colspan='2'> Center Name </td>
		<td colspan='3'> Maya Computer Center    , Siswar Phulparas </td>
	</tr>
	
	<tr>
		<td colspan='2'> <tt>Fees Amount </tt></td>
		<td colspan='3'>
		<div style='width:200;height:50px;border:solid 0px gray;text-align:center;padding-top:-20px;float:right;'>
		<img src='temp/upload/80209mayacomputer.png' height='50px' >
		Authorized Signatory </div>  
		</td>
	</tr>
	</tbody>
	
</table>
<center><input type='button' value=' PRINT ' onClick='this.style.display="none";window.print();' ></center>
