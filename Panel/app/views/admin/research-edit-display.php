<?php if (!Auth::userCan('manage_projects')) page_restricted();
$results = array(
   		'error' => true,
   		'msg' => 'Error: DESCONOCIDO.',
		);
		
if (empty($_GET['id']) || !is_numeric($_GET['id']))  {
	$results = array(
   		'error' => true,
   		'msg' => 'Error: Id incorrecto.',
		);
}
elseif(!is_numeric($_GET['display']))
{
		$results = array(
   		'error' => true,
   		'msg' => 'Error: Display incorrecto: *'+empty($_GET['display']+'*'),
		);
}
elseif(empty($_GET['type'])  ){
$results = array(
   		'error' => true,
   		'msg' => 'Error: No hay tipo (researcharea o project).',
		);
}
else
{
	if($_GET['type']=="project")
	{
			DB::table('projects')
        	->where('id', '=', $_GET['id'])
        	->update(array('display' => $_GET['display']));
			
			$results = array(
			'error' => false,
			'msg' => 'OK: Actualización completa',
			);

	}
	elseif($_GET['type']=="researcharea")
	{
			DB::table('researchareas')
        	->where('id', '=', $_GET['id'])
        	->update(array('display' => $_GET['display']));
			
			$results = array(
			'error' => false,
			'msg' => 'OK: Actualización completa',
			);
	}
	else
	{
		$results = array(
   		'error' => true,
   		'msg' => 'Error: Parámetro irreconocible',
		);
	}

}
header('Content-type: application/json');
echo json_encode($results);
?>

