<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"         => "El/La :attribute debe ser aceptado.",
	"active_url"       => "El/La :attribute no es una URL valida.",
	"after"            => "El/La :attribute debe ser una fecha despues de :date.",
	"alpha"            => "El/La :attribute solo puede contener letras.",
	"alpha_dash"       => "El/La :attribute solo puede contener letras, números, y barras.",
	"alpha_num"        => "El/La :attribute solo puede contener letras y números.",
	"array"            => "El/La :attribute debe ser un arreglo.",
	"before"           => "El/La :attribute debe ser una fecha antes de :date.",
	"between"          => array(
		"numeric" => "El/La :attribute debe estar entre :min y :max.",
		"file"    => "El/La :attribute debe tener entre :min y :max kilobytes.",
		"string"  => "El/La :attribute debe tener entre :min y :max caracteres.",
		"array"   => "El/La :attribute debe tener entre :min y :max elementos.",
	),
	"boolean"          => "El/La campo :attribute debe ser verdadero o falso",
	"confirmed"        => "El/La :attribute confirmación no concuerda.",
	"date"             => "El/La :attribute no es una fecha válida.",
	"date_format"      => "El/La :attribute no concuerda con el formato :format.",
	"different"        => "El/La :attribute y :other deben ser diferentes.",
	"digits"           => "El/La :attribute debe tener :digits digitos.",
	"digits_between"   => "El/La :attribute debe tener entre :min y :max digitos.",
	"email"            => "El/La :attribute tiene formato no valido.",
	"exists"           => "El/La :attribute seleccionado no es valido.",
	"image"            => "El/La :attribute debe ser una imagen.",
	"in"               => "El/La :attribute seleccionado no es valido.",
	"integer"          => "El/La :attribute debe ser un entero.",
	"ip"               => "El/La :attribute debe ser una dirección IP valida.",
	"max"              => array(
		"numeric" => "El/La :attribute no puede ser mayor a :max.",
		"file"    => "El/La :attribute no puede ser mayor a :max kilobytes.",
		"string"  => "El/La :attribute no puede ser mayor a :max caracteres.",
		"array"   => "El/La :attribute no puede tener mas de :max elementos.",
	),
	"mimes"            => "El/La :attribute deber ser un archivo de tipo: :values.",
	"min"              => array(
		"numeric" => "El/La :attribute debe tener al menos :min.",
		"file"    => "El/La :attribute debe tener al menos :min kilobytes.",
		"string"  => "El/La :attribute debe tener al menos :min caracteres.",
		"array"   => "El/La :attribute debe tener al menos :min elementos.",
	),
	"not_in"           => "El/La :attribute seleccionado no es valido.",
	"numeric"          => "El/La :attribute debe ser un numero.",
	"regex"            => "El fomato de :attribute no es valido.",
	"required"         => "El campo :attribute es requerido.",
	"required_if"      => "El campo :attribute es requerido cuando :other es :value.",
	"required_with"    => "El campo :attribute es requerido cuando :values está presente.",
	"required_without" => "El campo :attribute es requerido cuando :values no está presente.",
	"same"             => "El/La :attribute y :other deben coincidir.",
	"size"             => array(
		"numeric" => "El/La :attribute debe ser :size.",
		"file"    => "El/La :attribute debe tener :size kilobytes.",
		"string"  => "El/La :attribute debe tener :size caracteres.",
		"array"   => "El/La :attribute debe contener :size elementos.",
	),
	"unique"           => "El/La :attribute ha sido tomado.",
	"url"              => "El formato de :attribute es invalido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'new_password'     => array('required' => 'Usted debe introducir un nuevo password con el fin de cambiarlo.'),
		'current_password' => array('required' => 'Usted debe introducir su password actual con el fin de cambiarlo.'),
		'reminder_email'   => array('exists' => 'No se encontró ninguna cuenta con esta direccion de email.'),
		'reminder' => array(
			'required' => 'La liga de recuperación no es valida. Por favor genere una nueva.', 
			'exists' => 'La liga de recuperación no es valida. Por favor genere una nueva.', 
			'valid' => 'La liga de recuperación ha expirado. Por favor genere una nueva.'
		),
		'activation_key' => array(
			'required' => 'La liga de activación no es valida. Por favor genere una nueva.',
			'exists' => 'La liga de activación no es valida. Por favor genere una nueva.'
		),
		'g-recaptcha-response' => array(
			'required' => 'Prueba que no eres un robot.',
			'captcha'  => 'Prueba que no eres un robot.',
		),
		'assignment' => array(
			'required' => 'The Assignment field is required.',
			'valid_assignment' => 'El campo de asignación no es valido.'
		),
		'id' => array(
			'unique_field' => 'El/La :attribute ha sido tomado.'
		),
		'to' => array(
			'exists' => "El usuario que trata de contactar no existe.",
		),
		'to_user' => array(
			'exists' => 'No se encontró el usuario seleccionado.',
		),
		'to_group' => array(
			'required' => 'El "Para usuario" o "Para grupo" es requerido.',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
		'name'       => 'Nombre',
		'first_name' => 'Primer nombre',
		'last_name'  => 'Apellido',
		'username'   => 'Nombre ee usuario',
		'email'      => 'E-mail',
		'url'        => 'Sitio Web',
		'password'   => 'Password',
		'role'       => 'Rol',
		'status'     => 'Estado de cuenta',
		'reminder_email' => 'E-mail',
		'captcha' => 'Captcha',
		'to' => 'Para',
		'subject' => 'Asunto',
		'message' => 'Mensaje',
		'type' => 'Tipo',
		'id' => 'ID',
		'order' => 'Orden',
	),

);
