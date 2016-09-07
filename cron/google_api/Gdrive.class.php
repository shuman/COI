<?php 
ini_set("memory_limit", "-1");
ini_set('max_execution_time', 0);
set_time_limit(0);

set_include_path('/home/cutout/cron/google_api/src');
require_once 'autoload.php'; // or wherever autoload.php is located

class Gdrive {

	const CLIENT_ID      = '616510159988-a5veju0igj92mqsugl4ib78obl788e17.apps.googleusercontent.com';
	const CLIENT_SECRET  = 'Muon7gctHPqMvKvp8FiR8TuI';
	const REDIRECT_URI   = 'http://portal.cutoutimage.com/save_token.php';
	const TOKEN_FILE     = '/home/cutout/cron/google_api/token.txt';
	const LOCK_FILE      = '/home/cutout/cron/google_api/cron.lock';
	const UPLOADS_FOLDER = '/home/cutout/public_html/portal/uploads';
	const ARCHIVE_FOLDER = '/home/cutout/public_html/portal/archive';

	private $client;
	private $service;
	private $token;
	private $folder_id;
	private $file_service;

    function __construct() {
    	$this->check_rw_permission(getcwd()); //current working dir
    	$this->check_rw_permission(self::TOKEN_FILE);
    	$this->check_rw_permission(self::UPLOADS_FOLDER);
    	$this->check_rw_permission(self::UPLOADS_FOLDER);

    	if($this->is_locked()){
    		exit('Exited. Process running!');
    	}

        $this->client = new Google_Client();
        $this->client->setClientId(self::CLIENT_ID);
		$this->client->setClientSecret(self::CLIENT_SECRET);
		$this->client->setAccessType('offline');
		$this->client->setRedirectUri(self::REDIRECT_URI);
		$this->client->addScope("https://www.googleapis.com/auth/drive");


		$this->service = new Google_Service_Drive($this->client);
		$this->file_service = new Google_Service_Drive_FileList($this->client);
    }

    function get_lists(){
    	$this->get_token();

		$parameters               = array();
		$parameters['maxResults'] = 100;
		$parameters['q']          = '(title = "ORDERS" or title = "QUOTES") and mimeType = "application/vnd.google-apps.folder"';
		$files                    = $this->service->files->listFiles($parameters);
		$result                   = $files->getItems();
		echo '<pre>';
		print_r( $result );	
		echo '</pre>';
    }

    function initialize(){
    	$this->get_token();


    	$this->lock();
    	$skip = array('..', '.', '.DS_Store', 'Thumbs.db');
    	$base_path = self::UPLOADS_FOLDER;
		
		//Get all folders list in uploads directory
		$scanned_base = array_diff(scandir($base_path), $skip);

		//Loop folders in upload directory
		foreach ($scanned_base as $dir_name){
			$dir_path = self::UPLOADS_FOLDER . DIRECTORY_SEPARATOR . $dir_name;

			//Check valid folder for COI
			if(is_dir($dir_path) && preg_match('/COI/', $dir_name)) {
				//Get file infomation
				$scanned_files = array_diff(scandir($dir_path), $skip);
				
				if(preg_match('/QR/', $dir_name)){
					$parentid = $this->create_folder($dir_name, '0B5bHDUTycrn6LXJzeHJ5MXdoZDg'); //Quote folder id
				}
				else{
					$parentid = $this->create_folder($dir_name, '0B5bHDUTycrn6dUZUU045djBPQ1U'); //Order folder id
				}
				//Check folder empty or not
				if(!empty($scanned_files)){

					//Loop files for upload to drive
					foreach ($scanned_files as $file_name) {
						$upload_file = $dir_path . DIRECTORY_SEPARATOR . $file_name;

						$mimeType = $this->get_mimetype($upload_file);

						$this->upload($upload_file, $file_name, $mimeType, $parentid);
					}
				}
				$oldpath = self::UPLOADS_FOLDER . DIRECTORY_SEPARATOR . $dir_name;
				$newpath = self::ARCHIVE_FOLDER . DIRECTORY_SEPARATOR . $dir_name;
				
				//Move folder upload_temp to uploads folder 
				rename($oldpath, $newpath);

				$this->unlock();
				exit('Upload folder done');
			}
			// exit('Single loop done');
		}
		$this->unlock();
		exit('All folders uploaded');
    }

    function upload($upload_file, $file_name, $mimeType, $parentid){
    	if($this->client->getAccessToken()){

			$drive_file = new Google_Service_Drive_DriveFile();
			$drive_file->setTitle($file_name);
		    $drive_file->setMimeType($mimeType);

		    $parent = new Google_Service_Drive_ParentReference();
		    $parent->setId($parentid);
		    $drive_file->setParents(array($parent));


			$createdFile = $this->service->files->insert(
													$drive_file,
													array(
														'data' => file_get_contents($upload_file),
														'mimeType' => $mimeType,
														'uploadType' => 'multipart'
													)
												);
			return true;
		}
		else{
			$this->alert(array("msg"=>"getAccessToken failed!", "type"=>"critical"));
		}
    }

    function create_folder($dir_name, $dir_parent_id){
    	
    	if($this->client->getAccessToken()){
			
			$drive_file = new Google_Service_Drive_DriveFile();

			$drive_file->setTitle($dir_name);
			$drive_file->setDescription('A Project Folder');
			$drive_file->setMimeType('application/vnd.google-apps.folder');

			
			$parent = new Google_Service_Drive_ParentReference();
		    $parent->setId($dir_parent_id);
		    $drive_file->setParents(array($parent));
			
			$createdfolder = $this->service->files->insert($drive_file, array(
			    'mimeType' => 'application/vnd.google-apps.folder',
			));
			if($createdfolder){
				return $createdfolder->id;
			}
		}
		else{
			$this->alert(array("msg"=>"getAccessToken failed!", "type"=>"critical"));
		}
    }


    function get_mimetype($filename, $mode = 0){

		if(function_exists('mime_content_type') && $mode==0){ 
	        $mimetype = mime_content_type($filename); 
	        return $mimetype; 

		}
		elseif(function_exists('finfo_open')&&$mode==0){ 
		        $finfo = finfo_open(FILEINFO_MIME); 
		        $mimetype = finfo_file($finfo, $filename); 
		        finfo_close($finfo); 
		        return $mimetype; 
		}
		elseif(array_key_exists($ext, $mime_types)){ 
		        return $mime_types[$ext]; 
		}
		else { 
		        return 'application/octet-stream'; 
		} 
	}

    function alert($data){
    	@mail('jobaer.shuman@gmail.com', 'CIO cronjob critcal error.', print_r($data, true));

    	if($data['type'] == 'critical'){
    		$this->unlock();
    		die($data['msg']);
    	}
    }

    function get_token(){
    	$file = fopen(self::TOKEN_FILE, "r");
		if (!$file) {
			$this->alert(array("msg"=>"Unable to open token file!", "type"=>"critical"));
		}
		$filesize = filesize(self::TOKEN_FILE);
		if($filesize > 0){
			$this->token = fread($file, $filesize);
		}
		else{
			$authUrl = $this->client->createAuthUrl();
			@mail('jobaer.shuman@gmail.com', 'Auth url for CIO', $authUrl);
			exit();
		}
		fclose($file);

		$this->client->setAccessToken($this->token);
    }

    function save_token(){
    	if (isset($_GET['code'])) {
			$this->client->authenticate($_GET['code']);
			$access_token = $this->client->getAccessToken();

			$handle = fopen(self::TOKEN_FILE, "w");
			ftruncate($handle, 0);
		    fwrite($handle, $access_token);
			fclose($handle);

			$message = "Access Token: $access_token";
			@mail('jobaer.shuman@gmail.com', 'Access token for CIO', $message);

			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  			header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}
		else{
			echo 'oAuth code error!';
		}
    }

    function check_rw_permission($file_path){
    	if(is_writable($file_path)){
    		return true;
    	}
    	else{
    		$this->alert(array("msg"=>"File permission failed. [$file_path]", "type"=>"critical"));
    		return false;
    	}
    }

    function is_locked(){
    	if(file_exists(self::LOCK_FILE)){
    		return true;
    	}
    	return false;
    }

    function lock(){
    	$handle = fopen(self::LOCK_FILE, "w");

		if (flock($handle, LOCK_EX)) {  // acquire an exclusive lock
			// ftruncate($handle, 0);
		    fwrite($handle, "Cronjob running at ".date("Y-m-d H:i:s")." \n");
		    fflush($handle);            // flush output before releasing the lock
		}
		fclose($handle);
    }

    function unlock(){
    	if(file_exists(self::LOCK_FILE)){
	    	$handle = fopen(self::LOCK_FILE, "r+");
    		if(flock($handle, LOCK_EX)) {
		    	flock($handle, LOCK_UN);    // release the lock
		    }
	    	fclose($handle);
	    	unlink(self::LOCK_FILE);
    	}
    }

}


