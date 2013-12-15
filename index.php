<?php include("include/config.php"); 
session_start();
$_SESSION['records_perpage'] = (isset($_SESSION['records_perpage']) ? $_SESSION['records_perpage'] : $config['default_perpage']);
$page = (isset($_POST['page'])  ? $_POST['page']  : "1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap_custom.css" />
<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap-responsive.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/validate-custom.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/action.js"></script>
<title>Data Table</title>
</head>
<body>
<center><h1>Data Table</h1></center>
<div style="padding-right:50px;" align="right"><b>Records Per Page</b></div>
<div style="padding-right:50px;" align="right">
<select name="perpage" id="perpage" class="span1" onchange="Javascript: changePerPage(this.value);">
<?php foreach($config['arr_perpage'] as $value) { 
	echo "<option value=".$value;
	if($value == $_SESSION['records_perpage'])
	{
		echo " selected=selected";
	}
	echo ">";
	echo $value;
	echo "</option>";
}
?>
</select>
</div>
<br />
<div id="data_table">
</div>
<div id="modalEditTable" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="title"></h3>
    </div>
 <div class="modal-body">
		<div id="errCtype" class="error"></div>
		<form name="frm-data-table" id="frm-data-table" method="post" class="">
			<div class="control-group">
				<label class="control-label" for="producer">Producer</label>
				<div class="controls">
					<input type="text" name="producer" id="producer" class="input-block-level" value="" placeholder="please enter producer" />
				</div>
			</div>
            <div class="control-group">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="" class="input-block-level" placeholder="please enter name" />
				</div>
			</div>
            <div class="control-group">
				<label class="control-label" for="producer">Region</label>
				<div class="controls">
					<input type="text" name="region" id="region" value="" class="input-block-level" placeholder="please enter region" />
				</div>
			</div>
            <div class="control-group">
				<label class="control-label" for="producer">Cuvee</label>
				<div class="controls">
					<input type="text" name="cuvee" id="cuvee" value="" class="input-block-level" placeholder="please enter cuvee" />
				</div>
			</div>
            <div class="control-group">
				<label class="control-label" for="color">Color</label>
				<div class="controls">
					<input type="text" name="color" id="color" value="" placeholder="please enter color" />
				</div>
			</div>
			<input type="hidden" name="cur_id" id="cur_id" value="" />
		</form>
    </div>
     
 <div class="modal-footer">
        <a href="#" class="btn closebutton">Close</a>
		<button type="button" id="btn-save" class="btn btn-success">Save Record</button>
    </div>
</div>
<input type="hidden" name="page" id="page" value= <?php  echo $page; ?> >
</body>
</html>
