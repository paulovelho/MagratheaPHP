<?php

require_once ("admin_load.php");

$databaseName = MagratheaConfig::Instance()->GetConfigFromDefault("db_name");

$tables = getAllTables($databaseName, false);
//$allTables = getAllTables(@$configSection["db_name"], true);
//p_r($tables);
$objects = getAllObjects();

?>

  <ul class="nav nav-list bs-docs-sidenav menu">
  	<li class="menu-header">
  		Environment: <?php echo MagratheaConfig::Instance()->GetEnvironment(); ?> <br/>
  		Database: <?php echo $databaseName; ?> 
  	</li>
	<li><a onClick="loadConfig();" id="menu_config"><i class="fa fa-cogs"></i> Configuration</a></li>
    <li class="submenu"><a href="#"><i class="fa fa-table"></i> Tables <span class="number"><?=count($tables)?></span></a>
    	<ul class="nav nav-list menu_sublist" style="display: none;">
		<?php
		if(is_array($tables)){
			foreach($tables as $tb){
				$tablename = $tb['table_name'];
				echo '<li><a onClick="loadTable(\''.$tablename.'\');" id="menu_table'.$tablename.'"><i class="fa fa-chevron-right icon_light"></i> '.$tablename.'</a></li>';
			}
		}
		?>
    	</ul>
    </li>
    <li class="submenu"><a href="#"><i class="fa fa-list"></i> Table Data <span class="number"><?=count($tables)?></span></a>
    	<ul class="nav nav-list menu_sublist" style="display: none;">
		<?php
		if(is_array($tables)){
			foreach($tables as $tb){
				echo '<li><a onClick="loadTableData(\''.$tb['table_name'].'\');" id="menu_tabledata'.$tb['table_name'].'"><i class="fa fa-chevron-right icon_light"></i> '.$tb['table_name'].'</a></li>';
			}
		}
		?>
    	</ul>
    </li>
    <li class="submenu"><a href="#"><i class="fa fa-inbox"></i> Objects <span class="number"><?=count($objects)?></span></a>
			<ul class="nav nav-list menu_sublist" style="display: none;">
		<?php
		if(is_array($objects)){
			foreach($objects as $obj => $details){
				echo '<li><a onClick="loadObject(\''.$obj.'\');" id="menu_obj'.$obj.'"><i class="fa fa-chevron-right icon_light"></i> '.$obj.'</a></li>';
			}
		}
		?>
			</ul>
    </li>
    <li><a onClick="loadCoder();" id="menu_coder"><i class="fa fa-pencil"></i> Generate Code</a></li>
    <li><a onClick="loadPlugins();" id="menu_plugins"><i class="fa fa-thumb-tack"></i> Plugins</a></li>
	<li><a onClick="loadDatabaseManager();" id="menu_migration"><i class="fa fa-database"></i> Database</a></li>
	<li><a onClick="loadStatic();" id="menu_static"><i class="fa fa-file-code-o"></i> Static Generated</a></li>
	<li><a onClick="loadLogs();" id="menu_logs"><i class="fa fa-files-o"></i> Logs</a></li>
	<li><a onClick="loadValidate();" id="menu_validate"><i class="fa fa-sitemap"></i> Validate Structure</a></li>
	<li class="submenu"><a onClick="loadTests();" id="menu_tests"><i class="fa fa-flask"></i> Tests</a>
		<div id="tests_response"></div>
	</li>
	<li class="submenu"><a onClick="loadCustom();" id="menu_custom"><i class="fa fa-dashboard"></i> Custom admin</a>
		<div id="admin_response"></div>
	</li>
    <li><a onClick="loadPhpInfo();" id="menu_info"><i class="fa fa-info-circle"></i> PHP info</a></li>
  </ul>

