<?php 
   //require_once('thirdparty/thirdparty.config.inc.php');
   //define ('DATE_FORMAT', 'Y-m-d\TH:i:s\Z');

   /************************************************************************
    * REQUIRED
    *
    * * Access Key ID and Secret Acess Key ID, obtained from:
    * http://aws.amazon.com
    *
    * IMPORTANT: Your Secret Access Key is a secret, and should be known
    * only by you and AWS. You should never include your Secret Access Key
    * in your requests to AWS. You should never e-mail your Secret Access Key
    * to anyone. It is important to keep your Secret Access Key confidential
    * to protect your account.
    ***********************************************************************/
    //define('AWS_ACCESS_KEY_ID', 'AKIAJXZHJ4W775V6BPLQ');
    //define('AWS_SECRET_ACCESS_KEY', 'y+23fIarxTEzt7MCpHhebL1Uw3Ig3MgMFW/Bj5+e');

   /************************************************************************
    * REQUIRED
    * 
    * All MWS requests must contain a User-Agent header. The application
    * name and version defined below are used in creating this value.
    ***********************************************************************/
    //define('APPLICATION_NAME', 'sellertool');
    //define('APPLICATION_VERSION', '1');
    
   /************************************************************************
    * REQUIRED
    * 
    * All MWS requests must contain the seller's merchant ID and
    * marketplace ID.
    ***********************************************************************/
    //define ('MERCHANT_ID', 'A196A8GC0YNHR');
    
   /************************************************************************ 
    * OPTIONAL ON SOME INSTALLATIONS
    *
    * Set include path to root of library, relative to Samples directory.
    * Only needed when running library from local directory.
    * If library is installed in PHP include path, this is not needed
    ***********************************************************************/   
	
    //set_include_path(get_include_path() . PATH_SEPARATOR . '../../.');
	set_include_path(THIRLD_PARTY.'amazone/');    
    
   /************************************************************************ 
    * OPTIONAL ON SOME INSTALLATIONS  
    * 
    * Autoload function is reponsible for loading classes of the library on demand
    * 
    * NOTE: Only one __autoload function is allowed by PHP per each PHP installation,
    * and this function may need to be replaced with individual require_once statements
    * in case where other framework that define an __autoload already loaded.
    * 
    * However, since this library follow common naming convention for PHP classes it
    * may be possible to simply re-use an autoload mechanism defined by other frameworks
    * (provided library is installed in the PHP include path), and so classes may just 
    * be loaded even when this function is removed
    ***********************************************************************/  
   
     function __autoload($className){
        $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $includePaths = explode(PATH_SEPARATOR, get_include_path());
		
        foreach($includePaths as $includePath){
			//echo $includePath . DIRECTORY_SEPARATOR . $filePath;
            $p  = get_include_path().$filePath;
            if(file_exists($p)){
				require_once $p;
                return;
            }
        }
    }
	
	$serviceUrl = "https://mws.amazonservices.com";
	$config = array (
	  'ServiceURL' => $serviceUrl,
	  'ProxyHost' => null,
	  'ProxyPort' => -1,
	  'MaxErrorRetry' => 3,
	);
	/* $mws_service_array = new MarketplaceWebService_Client(
		 AWS_ACCESS_KEY_ID, 
		 AWS_SECRET_ACCESS_KEY, 
		 $config,
		 APPLICATION_NAME,
		 APPLICATION_VERSION);*/
		
	

	  


