
<?php
require_once 'app/init.php';
include 'src/array_column.php';


	$checkboxesAdscription="<div id='target-adscriptions'></div>";
	$buttonsBibtex="<div id='target-bibtexbuttons'></div>";
	
	$personaldata= array(
		
		'prefix' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<h2>Generales</h2><div class="form-group">',
			'content_after'  => '</div>',
			'assignment' => array('admin', 'user')
		),
		
		'first_name' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'assignment' => array('admin', 'user')
		),
	
	
		'last_name' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'assignment' => array( 'admin', 'user')
		),
	
	
		'gender' => array(
			'type' => 'select',
			'validation' => 'required|in:X,F,M',
			'attributes' => array(
				'class' => 'form-control', 
				'options' => array(
					array('value' => 'X'),
					array('value' => 'F'),
					array('value' => 'M')
				),
			),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'assignment' => array('user')
		),
	
	  );
	
	$researchinfo=array(
	
		'display' => array(
			'type' => 'checkbox',
			'validation' => 'in:1',
			'attributes' => array('value' => '1'),
			'content_before' => '<div class="checkbox">',
			'content_after'  => '</div>',
			'assignment' => array('admin')
		),
	
		'researchertype' => array(
			'type'        => 'select',
			'attributes'  => array(
				'class'   => 'form-control', 
				'options' => array(
					array('value' => 'T', 'text' => 'Investigador Titular'),
					array('value' => 'I', 'text' => 'Investigador Invitado'),
					array('value' => 'TA', 'text' => 'Investigador Técnico Académico'),
					array('value' => 'O', 'text' => 'Estudiante de Posgrado')
				),
			),
			'content_before' => '<h2>Investigación</h2><div class="form-group">',
			'content_after'  => '</div>',
			'assignment'     => array('admin', 'user')
		),
		
		'researchareas' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>'.$checkboxesAdscription,
			'assignment' => array('admin', 'user')
		),
		
	);  
	  
	$contactinfo=array(
	
		'laboratory' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<h2>Contacto</h2><div class="form-group">',
			'content_after'  => '</div>',
			'assignment' => array('admin', 'user')
		),
	   
	   'phone' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'assignment' => array('admin', 'user')
		),
		
	   'url' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'validation' => 'url',
			'assignment' => array('admin', 'user')
		),
		
		'researchgate' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'validation' => 'url',
			'assignment' => array('admin', 'user')
		),
		
		'gscholar' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'validation' => 'url',
			'assignment' => array('admin', 'user')
		),
		
		'linkedin' => array(
			'type' => 'text',
			'attributes' => array('class' => 'form-control'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '</div>',
			'validation' => 'url',
			'assignment' => array('admin', 'user')
		),
	
		
	);
	
	 
	$cha_lang_academic='<ul class="nav nav-tabs">'.
							'<li role="presentation" class="active"><a href="#">Español</a></li>'.
	  						'<li role="presentation"><a href="#">Inglés</a></li>'.
						'</ul>';
	 
	$moredata= array(
	
		'academic' => array(
			'type' => 'textarea',
			'attributes' => array('class' => 'form-control hide'),
			'content_before' => '<h2>Carrera</h2><div class="form-group">',
			'content_after'  => '<textarea id="editorT-academic"></textarea></div>',
			'assignment' => array('admin', 'user')
		),
		
		'professional' => array(
			'type' => 'textarea',
			'attributes' => array('class' => 'form-control hide'),
			'content_before' => '<div class="form-group ">',
			'content_after'  => '<textarea id="editorT-professional"></textarea></div>',
			'assignment' => array('admin', 'user')
		),
		
		'researchlines' => array(
			'type' => 'textarea',
			'attributes' => array('class' => 'form-control hide'),
			'content_before' => '<div class="form-group ">',
			'content_after'  => '<textarea id="editorT-researchlines"></textarea></div>',
			'assignment' => array('admin', 'user')
		),
		
		'awards' => array(
			'type' => 'textarea',
			'attributes' => array('class' => 'form-control hide'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '<textarea id="editorT-awards"></textarea></div>',
			'assignment' => array('admin', 'user')
		),
		
		'students' => array(
			'type' => 'textarea',
			'attributes' => array('class' => 'form-control hide'),
			'content_before' => '<div class="form-group">',
			'content_after'  => '<textarea id="editorT-students"></textarea></div>',
			'assignment' => array('admin', 'user')
		),
		
		'publications' => array(
			'type' => 'textarea',
			'attributes' => array('class' => 'form-control hide'),
			'content_before' => '<div class="form-group">',
			'content_after'  => $buttonsBibtex.'<textarea id="editorT-publications"></textarea></div>',
			'assignment' => array('admin', 'user')
		),
	
	
	
	);
	
	$userfields = array_merge( $personaldata, $researchinfo, $contactinfo, $moredata);

return $userfields; 
	

    
