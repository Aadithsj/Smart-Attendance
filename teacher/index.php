<?php 
include('header.php');

?>
<body>
<div class="container">
<br>
<br>
<form action="edit.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<div class="alert alert-success">
			<h2 style="text-align:center; font-family:cursive;">Edit Multiple Rows in PHP/MySQL with Checkbox</h2>
		</div>
		<thead>
			<tr>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">FirstName</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">LastName</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">MiddleName</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Address</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Email</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$query=mysql_query("select * from member")or die(mysql_error());
		while($row=mysql_fetch_array($query)){
		$id=$row['member_id'];
		?>
			<tr>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['firstname'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['lastname'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['middlename'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['address'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['email'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;">
					<input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
				</td>
			</tr>
		<?php  } ?>						 
		</tbody>
	</table>
	<br />				
	<button class="btn btn-success pull-right" style="font-family:cursive;" name="submit_mult" type="submit">
		Update Data
	</button>
</form>



</div>
</body>
</html>