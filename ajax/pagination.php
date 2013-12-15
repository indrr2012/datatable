<br />
<?php
global $config;
$page_range = $config['page_range']; 
if($pagination == true)
{
	$pgStart = 1;

	if($lastpage < $page_range)
	{
		$page_range = $lastpage;
	}
	$pgPad = floor($page_range/2);
	if($page < $page_range)
	{
		$pgEnd = $page_range;
	}
	else if(($page >= $page_range) and ($page+$page_range) > $lastpage)
	{
		$pgEnd = $lastpage;
	}
	else if(($page >= $page_range) and ($page+$page_range) <= $lastpage)
	{
		$pgEnd = $page+$page_range-$pgPad;
	}
	$pgStart = $pgEnd-$page_range+1;
	?>
    <div class="pull-left" style="margin-right:20px;">Showing page <?php echo $page; ?> of  <?php echo $lastpage; ?></div> 
  <div class="pull-left" >
  	<select name="showPage" id="showPage" onchange="Javascript: showPage(this.value);">
		<option value="">Show page</option>
		<?php
        for($i=1;$i <= $lastpage;$i++)
		{
			echo "<option value=".$i.">";
			echo $i;
			echo "</option>";
		}
		?>
	</select>
  </div>
 <?php } ?>
	<div style="clear:both"></div>
</div>
<?php  ?>