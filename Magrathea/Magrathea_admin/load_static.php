<?php

require ("admin_load.php");

$staticPath = MagratheaConfig::Instance()->GetConfigFromDefault("site_path")."/Static";
if(!is_dir($staticPath)){
	echo '<div class="alert alert-error"><strong>Directory doesn\'t exists!</strong><br/>Directory: <br/>[<b>'.$staticPath.'</b>]<br/> does not exists. Create it with write permissions, please...</div>';
	return;
}

$action = @$_POST["action"];
if($action == "clear")
	MagratheaController::ClearStatic();


$statics = MagratheaController::GetAllStatic();

?>

<style>
#logResult {
  height: 400px;
  overflow: scroll;
  padding: 5px;
  border: 1px solid #CCC;
  font-family: monospace;
  font-size: 12px;
  color: green;
  background-color: black;
}
.small {
	width: 20px;
}
</style>

<div class="row-fluid">
	<div class="span12 mag_section">
		<header>
			<span class="breadc">Static</span>
		</header>
		<content>
			<p>HTML generated by Magrathea - to improve performance and cache information.</p>
		</content>
	</div>
</div>

<div class="row-fluid">
	<div class="span12 mag_section">
		<header class="hide_opt">
			<h3>Files</h3>
			<span class="arrow toggle" style="display: none;"><a href="#"><i class="fa fa-chevron-down"></i></a></span>
		</header>
		<content>
			<div class='row-fluid'>
				<div class='span12 center'>
				<table class="table table-striped"><tbody>
			<?php
			$even = false;
			foreach($statics as $s){
				?>
				<tr <?=($even ? "class='even'" : "")?>>
					<td style="padding-left: 50px;">
						<a href="javascript: viewCode('<?=$s?>')"><?=$s?></a>
					</td>
					<td>
						<button onClick="removeFile('<?=$s?>');" class="btn">
							<i class="fa fa-trash-o"></i> Remove file
						</button>
						<button onClick="viewCode('<?=$s?>');" class="btn">
							<i class="fa fa-code"></i> View Code
						</button>
					</td>
				</tr>
				<?php
				$even = !$even;
			}
			?>
				</tbody></table>
				</div>
			</div>
		</content>
	</div>
</div>


<div class="row-fluid">
	<div class="span9">&nbsp;</div>
	<div class="span3">
		<button class="btn btn-danger" onclick="clearStatic();">
			<i class="fa fa-trash-o"></i> Remove All Files
		</button>
		
	</div>
</div>

<script type="text/javascript">
function viewCode(file){
	var file = "<?=$staticPath?>/" + file;
	$.ajax({
		url: "?magpage=editor.php",
		type: "POST",
		data: {
			file: file
		},
		success: function(data){
			$("#main_content").html(data);
			scrollToTop();
		}
	});
}

function removeFile(file){
	var file = "<?=$staticPath?>/" + file;
	$.ajax({
		url: "?magpage=editor.php",
		type: "POST",
		data: {
			file: file,
			action: "delete"
		},
		success: function(data){
			$("#main_content").html(data);
			scrollToTop();
		}
	});
}

function clearStatic(){
	$.ajax({
		url: "?magpage=load_static.php",
		type: "POST",
		data: {
			action: "clear"
		},
		success: function(data){
			$("#main_content").html(data);
			scrollToTop();
		}
	});	
}
</script>
