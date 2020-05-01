<?php 

return array(
	'app' => array(
		'debug' => 'Modo de depuración',
		'debug_help' => 'Cuando está activado se mostraran los errores de PHP. Si está desactivado, se mostrará un simple error generico.',

		'url' => 'URL del Website',
		'url_help' => ' Esta URL se utiliza en emails, redireccionamiento de paginas y assets. Usted debe establecer esto en la raíz del script.',

		'name' => 'Nombre del Website',
		'name_help' => 'El nombre es usado en emails o títulos de pagina.',

		'color_scheme' => 'Esquema de colores del Website',
		'color_scheme_help' => 'Si usted utiliza el script con su diseño, usted puede escojer entre multiples esquemas de color.',

		'locale' => 'Ubicación por defecto',
		'locale_help' => ' La ubicación por defecto que será usada por la traducción. ',

		'locales' => 'Nombres de ubicación',
		'locales_help' => 'Las ubicaciones disponibles para traducción. <br> Formato: <code>key:value</code> separado por coma (,). Eg: <code>en:English, de:Deutsch</code>.',

		'timezone' => 'Zona horaria',
		'timezone_help' => 'La zona horaria por defecto para su website. (<a href="http://www.php.net/manual/en/timezones.php" target="_blank">?</a>)',

		'csrf' => 'Prevención CSRF',
		'csrf_help' => 'Previente al website de ataques CSRF.',
	),

	'mail' => array(
		'driver' => 'Controlador de Email',
		'driver_help' => 'Para "mailgun" y "mandrill" usted trendrá que configurar las api keys la pagina <a href=":link">Servicios</a> o en <span class="text-info">app/config/services.php</span>',

		'host' => 'Dirección del SMTP Host',
		'host_help' => '',
		
		'port' => 'Puerto del SMTP Host',
		'port_help' => '',

		'from_address' => 'Dirección "De" Global',
		'from_address_help' => 'Le permite enviar emails desde la misma dirección de correo electrónico.',

		'from_name' => 'Nombre "De" Global',
		'from_name_help' => 'Le permite enviar emails con el mismo nombre.',

		'encryption' => 'Protocolo de encriptación de E-Mail',
		'encryption_help' => '',

		'username' => 'Nombre de usuario del SMTP Server',
		'username_help' => '',

		'password' => 'Contraseña del SMTP Server',
		'password_help' => '',

		'sendmail' => 'Ruta del sistema de Sendmail',
		'sendmail_help' => ''
	),

	'auth' => array(
		'require_username' => 'Nombre de usuario Auth',
		'require_username_help' => 'Indica si los nombres de usuario serán usados. Para un sistema de login basico esta opción se puede desabilitar .',

		'username_change' => 'Permitir cambio de nombre de usuario',
		'username_change_help' => 'Indica si los usuarios puede cambiar sus nombres de usuario.',

		'delete_account' => 'Permitir eliminación de cuenta',
		'delete_account_help' => 'Indica si los usuarios pueden eliminar sus cuentas.',

		'email_activation' => 'Enviar Email de Activación',
		'email_activation_help' => 'Si está habilitado, un email de activación será enviado al usuario con el link de activación. Si se deshabilita, la cuenta se activará por defecto.',

		'default_role' => 'Rol por defecto',
		'default_role_help' => 'El rol por defecto que se usará cuando alguien inicie sesión.',

		'captcha' => 'CAPTCHA',
		'captcha_help' => 'Indica si debería usarse el CAPTCHA. Si se habilta, tendrá de configurar las api keys en la pagina <a href=":link">Servicios</a> o en :file.',

		'login_redirect' => 'Login Redirect URL',
		'login_redirect_help' => 'La URL a la que los usuarios serán redirigidos después de iniciar sesión. Si no se establece, la pagina se recargará.',

		'providers' => 'Provedores de servicio OAuth',
		'providers_help' => 'Los servicios disponibles que los usuarios pueden usar para autenticarse o registrarse. Por cada uno que sea habilitado, tendrá que definir las api keys en la pagina <a href=":link">Servicios</a> o en :file. <br> Formato: <code>key:value</code> separado por coma(,). Eg: <code>facebook:Facebook, twitter:Twitter</code>.',
	),
	
	'pms' => array(
		'realtime' => 'Tiempo real',
		'realtime_help' => 'Indica si el mensaje deberá aparecer en tiempo real en la bandeja de entrada. Al habilitar esta opción el website podría ralentizarse.',

		'delay' => 'Retraso de la solicitud',
		'delay_help' => 'El retraso en segundos entre las solicitudes para checar por nuevos mensajes.',

		'maxlength' => 'Tamaño maximo del mensaje',
		'maxlength_help' => 'El tamaño maximo de mensaje permitido.',

		'limit' => 'Límite de mensajes',
		'limit_help' => 'El numero de mensajes permitidos que un usuario puede enviar por hora.',

		'webmaster' => 'ID de usuario del Webmaster',
		'webmaster_help' => 'ID de usuario del webmaster. Utilizado cuando el usuario quiere contactar al administrador del sitio.',
	),

	'comments' => array(
		'moderation' => 'Moderacion de comentrios',
		'moderation_help' => 'Si los moderadores han aprobado todos los comentarios.',

		'use_smilies' => 'Comment Smiles',
		'use_smilies_help' => 'The smiles must be defined in <span class="text-info">app/config/smiles.php</span>',

		'replies' => 'Respuestas a comentarios',
		'replies_help' => 'Si permitir respuestas a comentarios.',

		'restricted_words' => 'Palabras restringidas',
		'restricted_words_help' => 'Los comentarios que contengas esas palabras requerirán de aprobación del moderador antes de ser publicadas.',

		'blacklist' => 'Lista negra de IDs de usuario',
		'blacklist_help' => 'Los usuarios en esta lista no podrán publicar comentarios.',

		'whitelist' => 'Lista blanca de IDs de usuario',
		'whitelist_help' => 'Los usuarios de esta lista podrán pasar el filtro de palabras restringidas.',

		'max_links' => 'Ligas maximas',
		'max_links_help' => 'Los comentarios que contengan mas ligas requeriran de aprobación del moderador antes de ser publicados. <br> Dejar vacío para deshabilitar.',

		'max_pending' => 'Maximo de comentarios pendientes',
		'max_pending_help' => 'Bloquear usuarios que tengan mas comentarios no aprobados. Dejar vacío para deshabilitar.',

		'per_page' => 'Comentarios por pagina',
		'per_page_help' => 'El número de comentarios que deberán ser cargados en la página. Dejar vacío para cargar todos los comentarios.',

		'default_sort' => 'Ordenación por defecto de comentarios',
		'default_sort_help' => '',

		'maxlength' => 'Tamaño máximo de comentario',
		'maxlength_help' => 'Dejar vacío para tamaño no especificado.',

		'time_between' => 'Tiempo entre comentarios',
		'time_between_help' => 'El número de segundos entre comentarios para prevenir desborde. Dejar vacío para deshabilitar.',

		'webmaster' => 'Notificación de email para Webmaster',
		'webmaster_help' => 'Email del webmaster/admin del sitio. Dejar vacío para deshabilitar.',

		'html' => 'Permitir HTML y CSS',
		'html_help' => 'Para habilitar edición de HTML y CSS <span class="text-info">app/config/comments.php</span>',
	),
);