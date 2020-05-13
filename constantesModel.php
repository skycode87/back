	<?php
	require_once 'Conexion.php';
	
	
	
	class constanteModel extends conexion
	
	
	{ 


		const ESTATUS_APLICADO                 = 152;     
		const ESTATUS_POR_EVALUAR              = 153;     
		const ESTATUS_APROBADO                 = 154;     
		const ESTATUS_ADEUDADO                 = 157;     
		const ESTATUS_COMPLETADO               = 158;     
		const ESTATUS_DECLINADO                = 155;     
		const ESTATUS_ANULADO                  = 213;     
		const ESTATUS_PROSPECTO                = 151; 
		
		
		const EVENTO_REGISTROWEB               = 303; 
		const EVENTO_PREREGISTRO               = 304; 
		const EVENTO_FALLIDO                   = 306; 
		const EVENTO_FIRMADOCUMENTO            = 311; 
		const EVENTO_CONSIGNACION              = 312; 
		
		const EVENTO_ANULACIONCREDITO          = 322; 
		const EVENTO_RECHAZOCREDITO            = 321; 
		const EVENTO_SOLVENCIACREDITO          = 320; 
		const EVENTO_AMORTIZACIONCREDITO       = 319; 
		const EVENTO_CONSIGNACIONCREDITO       = 318; 
		const EVENTO_ESPERACONSIGNACION        = 317; 
		const EVENTO_APROBACIONCREDITO         = 316; 
		const EVENTO_ACTUALIZACIONMONTOCREDITO = 315; 
		const EVENTO_ASIGNACIONCIFIN           = 314; 
		const EVENTO_EVALUACIONCREDITO         = 313; 

		
		const ROOT_LOCATION                    = 151; 	    



		const ESTATUS_VACANTELIMPIA            = 327;     
		const ESTATUS_VACANTESUCIA             = 326;     
		const ESTATUS_OCUPADALIMPIA            = 324;     
		const ESTATUS_OCUPADASUCIA             = 325;     
		const ESTATUS_FUERASERVICIO            = 328;     
		const ESTATUS_MANTENIMIENTO            = 329;     
		const ESTATUS_ENESPERA                 = 330;     
		const CORRELATIVO_PLACE                = 331;     
		


	//const API_SENGRID         = "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";     
		const API_SENGRID         = "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";     
		const API_HABLAME         = "pYroNJ0c5ZIXFTd0Lr3vTaBheUqGXH";     
		const USER_HABLAME        = 10011758;  

		const PHONE_ADMIN         = "(318) 685-5563";     
		const MAIL_ADMIN          = "developer.projas@gmail.com";     

		const PHONE_ADMIN2        = "(318) 251-8023";     
		const MAIL_ADMIN2         = "morenovlisbethc@gmail.com";    

		const PHONE_SUPERVISOR    = "(318) 685-5563";     
		const MAIL_SUPERVISOR     = "developer.projas@gmail.com";    

		const PHONE_SUPERVISOR2   = "(318) 685-5563";     
		const MAIL_SUPERVISOR2    = "developer.projas@gmail.com";    

		const PHONE_SUPERVISOR3   = "(318) 685-5563";     
		const MAIL_SUPERVISOR3    = "developer.projas@gmail.com";    

		const URL_CONTRATO        = "https://qreatech.com/lead/contrato.html";     
		const TITULO_CONTRATO     = "FIRMAR CONTRATO";     

		const URL_PAGARE          = "https://qreatech.com/lead/pagare.html";     
		const TITULO_PAGARE       = "FIRMAR PAGARÉ Y CONTRATO";     


		const CONTRATO_ONLINE     = "https://qreatech.com/API/public/Contrato-Capital-al-Instante.php";     
		const PAGARE_ONLINE       = "https://qreatech.com/API/public/Pagare-Capital-al-Instante.php";     
		const TOKEN_ONLINE        = "https://qreatech.com/API/public/Validacion-Token-Capital-al-Instante.php";     

		const CORRELATIVO_PAGARE          = 205;     
		const CORRELATIVO_CONTRATO        = 204;    	



		public static function getEstatusPorEvaluar() 
		{ 
			return self::ESTATUS_POR_EVALUAR; 
		} 

		public static function getEstatusAprobado() 
		{ 
			return self::ESTATUS_APROBADO; 
		} 

		public static function getEstatusAdeudado() 
		{ 
			return self::ESTATUS_ADEUDADO; 
		} 

		public static function getEstatusCompletado() 
		{ 
			return self::ESTATUS_COMPLETADO; 
		} 

		public static function getEstatusDeclinado() 
		{ 
			return self::ESTATUS_DECLINADO; 
		} 

		public static function getEstatusAplicado() 
		{ 
			return self::ESTATUS_APLICADO; 
		} 


		public static function getEstatusAnulado() 
		{ 
			return self::ESTATUS_ANULADO; 
		} 


		public static function getEstatusProspecto() 
		{ 
			return self::ESTATUS_PROSPECTO; 
		} 



		public static function ApiSengrid() 
		{ 
			return self::API_SENGRID; 
		} 


		public static function ApiHablame() 
		{ 
			return self::API_HABLAME; 
		} 


		public static function UserHablame() 
		{ 
			return self::USER_HABLAME; 
		} 


		public static function PhoneAdmin() 
		{ 
			return self::PHONE_ADMIN; 
		} 



		public static function MailAdmin() 
		{ 
			return self::MAIL_ADMIN; 
		} 



		public static function MailAdmin2() 
		{ 
			return self::MAIL_ADMIN2; 
		} 


		public static function PhoneAdmin2() 
		{ 
			return self::PHONE_ADMIN2; 
		} 


		public static function MailSupervisor() 
		{ 
			return self::MAIL_SUPERVISOR; 
		} 



		public static function MailSupervisor2() 
		{ 
			return self::MAIL_SUPERVISOR2; 
		} 



		public static function MailSupervisor3() 
		{ 
			return self::MAIL_SUPERVISOR3; 
		} 



		public static function PhoneSupervisor() 
		{ 
			return self::PHONE_SUPERVISOR; 
		} 



		public static function PhoneSupervisor2() 
		{ 
			return self::PHONE_SUPERVISOR2; 
		} 



		public static function PhoneSupervisor3() 
		{ 
			return self::PHONE_SUPERVISOR3; 
		} 


		public static function UrlPagare() 
		{ 
			return self::URL_PAGARE; 
		} 


		public static function TituloPagare() 
		{ 
			return self::TITULO_PAGARE; 
		} 


		public static function UrlContrato() 
		{ 
			return self::URL_CONTRATO; 
		} 


		public static function TituloContrato() 
		{ 
			return self::TITULO_CONTRATO; 
		} 

		public static function CorrelativoContrato() 
		{ 
			return self::CORRELATIVO_CONTRATO; 
		} 

		public static function CorrelativoPagare() 
		{ 
			return self::CORRELATIVO_PAGARE; 
		} 



		public static function ContratoOnline() 
		{ 
			return self::CONTRATO_ONLINE; 
		} 

		public static function PagareOnline() 
		{ 
			return self::PAGARE_ONLINE; 
		} 

		public static function TokenOnline() 
		{ 
			return self::TOKEN_ONLINE; 
		} 



		public static function getRegistroWeb() 
		{ 
			return self::EVENTO_REGISTROWEB; 
		} 


		public static function getRegistro2daFase() 
		{ 
			return self::EVENTO_PREREGISTRO; 
		} 


		public static function getEventoFallido() 
		{ 
			return self::EVENTO_FALLIDO;
		} 


		public static function getEventoFirmaDocumentos() 
		{ 
			return self::EVENTO_FIRMADOCUMENTO;
		} 


		public static function getEventoConsignacionCredito() 
		{ 
			return self::EVENTO_CONSIGNACION;
		} 


		public static function getEventoAnulacionCredito() 
		{ 
			return self::EVENTO_ANULACIONCREDITO;
		} 


		public static function getEventoRechazoCredito() 
		{ 
			return self::EVENTO_RECHAZOCREDITO;
		} 


		public static function getEventoSolvenciaCredito() 
		{ 
			return self::EVENTO_SOLVENCIACREDITO;
		} 

		public static function getEventoAmortizacionCredito() 
		{ 
			return self::EVENTO_AMORTIZACIONCREDITO;
		} 


		public static function getEventoConfirmacionConsignacion() 
		{ 
			return self::EVENTO_CONSIGNACIONCREDITO;
		} 


		public static function getEventoEsperaConsignacion() 
		{ 
			return self::EVENTO_ESPERACONSIGNACION;
		} 


		public static function getEventoAprobacionCredito() 
		{ 
			return self::EVENTO_APROBACIONCREDITO;
		} 


		public static function getEventoActualizacionMonto() 
		{ 
			return self::EVENTO_ACTUALIZACIONMONTOCREDITO;
		} 

		public static function getEventoAsignacionCifin() 
		{ 
			return self::EVENTO_ASIGNACIONCIFIN;
		} 

		public static function getEventoEvaluacionCredito() 
		{ 
			return self::EVENTO_EVALUACIONCREDITO;
		} 


		public static function getStatusVacanteLimpia() 
		{ 
			return self::ESTATUS_VACANTELIMPIA;
		} 

		public static function getStatusVacanteSucia() 
		{ 
			return self::ESTATUS_VACANTESUCIA;
		} 



		public static function getStatusOcupadaLimpia() 
		{ 
			return self::ESTATUS_OCUPADALIMPIA;
		} 


		public static function getStatusOcupadaSucia() 
		{ 
			return self::ESTATUS_OCUPADASUCIA;
		} 


		public static function getStatusFueraServicio() 
		{ 
			return self::ESTATUS_FUERASERVICIO;
		} 


		public static function getStatusMantenimiento() 
		{ 
			return self::ESTATUS_MANTENIMIENTO;
		} 

		public static function getStatusEnEspera() 
		{ 
			return self::ESTATUS_ENESPERA;
		} 

		public static function getCorrelativoPlace() 
		{ 
			return self::CORRELATIVO_PLACE;
		} 


	} 