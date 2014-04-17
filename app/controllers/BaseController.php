<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
        var $data;
        public function __construct() {

            $this->beforeFilter('csrf', array('on'=>'post'));
         
            $this->logged_in_user  =   Auth::user();
            $this->is_admin        =   "";
            if($this->logged_in_user){
                if($this->logged_in_user->rool_id==1){
                    $this->is_admin  = "admin";
                }

            }
            View::share('is_admin', $this->is_admin);
            
        }
        
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function doLog($text)
    {
        // open log file
        $logFileName = storage_path() . "/system_log.text";
        $logger = fopen($logFileName, "a") or die("Could not open log file.");

        fwrite($logger, date("d-m-Y, H:i")." - $text\n") or die("Could not write file!");
        fclose($logger);
    }
}