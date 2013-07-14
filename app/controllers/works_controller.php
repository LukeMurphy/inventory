<?php
class WorksController extends AppController {

	var $name = 'Works';
	var $helpers = array('Html', 'Form', 'YearList','Consignment','Status');
	var $components = array('Attachment');
	var $paginate =  array('limit' => 500, 'order' => array('Work.date_year') );
	var $userObject = array();
	var $permissions = array('guest');
	//var $scaffold;
	//var $components = array('Upload');
	//var $components = array('Attachment');

	/**
	 * Before any Controller action
	 */
	function beforeFilter()
	{

		$this->set('user',$this->userObject);
			
		if( !$this->Session->check('User') ) {
			$this->redirect('/users/login');
		} else {
			// save user data
			$this->userObject = $this->Session->read('User');
			$this->set('user',$this->userObject);
			$this->permissions = array('viewer');

			if($this->userObject['User']['group'] == "editor") {
				$this->permissions = array("editor");
			}
			if($this->userObject['User']['group'] == "admin"){
				$this->permissions = array("editor","admin");
			}
		}

		$this->set('permissions',$this->permissions);
		/*
		 print_r($this->Session);
		 print_r($this->Session->read('User'));
		 echo "<hr>";
		 var_dump($this->permissions);
		 */
	}

	function index()
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");
		Controller::loadModel("Exhibition");

		//$this->set('images', $this->Image->findAll());
		$this->set('images', $this->Image->find("all"));
		$this->Work->recursive = 0;
		$this->set('works', $this->paginate());
		$this->set('imagePath',IMAGE_PATH);
		// set up for super admins
		if($this->permissions != "admin"){
			//$this->set('works', $this->paginate('Work', array('Work.status !=' => 'RESERVED')));
			$this->set('works', $this->paginate($this->Work));
		} else {
			$this->set('works', $this->paginate($this->Work));
		}
	}

	function listing()
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");
		Controller::loadModel("Exhibition");

		//$this->set('images', $this->Image->findAll());
		$this->set('images', $this->Image->find("all"));
		$this->Work->recursive = 0;
		$this->set('works', $this->paginate());
		$consignment = "%p-s%";
		$status = "%on%";
		//$this->set('works', $this->paginate('Work', array('Work.consignment NOT LIKE' => '%'.$q)));


		$options = array( 'AND' => array(
		array('Work.consignment LIKE ' => $consignment)
		,array('Work.status LIKE ' => $status)
		)
		);
		//$options = array("MATCH(Work.consignment,Work.status) AGAINST('$consignment' IN BOOLEAN MODE)");
		$this->set(array('works' => $this->paginate('Work', $options)));
		$this->set('imagePath',IMAGE_PATH);
	}

	function bulk__()
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");

		//$this->set('images', $this->Image->findAll());
		$this->set('images', $this->Image->find("all"));
		$this->Work->recursive = 0;
		$this->set('works', $this->paginate());
		$this->set('imagePath',IMAGE_PATH);
		// set up for super admins
		if($this->permissions != "admin"){
			$q = "w-t";
			$q = "%".$q."%";
			$options = array(
	   			'OR' => array(
			array('Work.notes LIKE ' => $q),
			array('Work.status LIKE ' => $q),
			array('Work.consignment LIKE ' => $q)
			)
			);
			$this->set(array('works' => $this->paginate('Work', $options)));
			$worksFound = $this->Work->findAllByConsignment('p-s');

			//$this->set('works', $this->paginate($this->Work));
			//$this->set('works', $this->paginate('Work', array('Work.consignment LIKE' => 'consignment')));
			//$this->set('works', $this->paginate($this->Work));
		} else {
			$this->set('works', $this->paginate($this->Work));
		}

		echo "<pre>";
		//print_r($worksFound);
		foreach ($worksFound as $work){
			if($work['Work']['status'] != "sold"){
				echo $work['Work']['consignment'];
				echo $work['Work']['title'];
				$this->data['Work'] = $work['Work'];
				$this->data['Work']['consignment'] = "p-s";
				$this->data['Work']['status'] = "on consignment";
				$this->Work->save($this->data['Work']);
			}
		}
	}

	function grid() {
		Controller::loadModel("Image");
		Controller::loadModel("Location");
		$this->set('images', $this->Image->find("all"));
		$this->Work->recursive = 0;

		//$this->set('works', $this->paginate('Work', array('Work.status !=' => 'RESERVED')));
		//$this->set('works', $this->Work->find('all', array('conditions' => array('Work.status' => 'RESERVED'))));
		//'order'=>array('Post.post_date'=>'DESC'));
		//ORDER BY `Work`.`date_year` asc
		// set up for super admins
		if(in_array("admin", $this->permissions)){
			$this->set('works', $this->paginate($this->Work));
		} else {
			$this->set('works', $this->paginate('Work', array("AND" =>
			array('Work.consignment !=' => 'RESERVED'),
			array('Work.consignment !=' => 'NFS-Estate'),
			array('Work.consignment !=' => 'sold')
			)));
		}
		$this->set('imagePath',IMAGE_PATH);
	}

	function sortByConsignment($consignment = 'storage')
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");
		$this->set('images', $this->Image->find("all"));
		$this->Work->recursive = 0;
		$this->set('imagePath',IMAGE_PATH);
		if($consignment == "storage"){
			$this->set('works', $this->paginate('Work', array('Work.consignment LIKE' => '%'.$consignment)));
		} else {
			$this->set('works', $this->paginate('Work', array('Work.consignment =' => $consignment)));
		}
		$this->render('grid');
	}

	function find()
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");
		$this->set('images', $this->Image->find("all"));
		$this->set('locations', $this->Location->find("all"));
		$this->Work->recursive = 0;
		$this->Location->recursive = 0;
		$this->set('imagePath',IMAGE_PATH);

		# query comes from GET request parameter 'q'
		if(isset($_GET['ds'])){
			$input = $this->params['url']['ds'];

			# sanitize the query
			App::import('Sanitize');
			$q = "".Sanitize::escape($input)."";
			$q2 = "";

			if(isset($_GET['de'])){
				$q2 = "".Sanitize::escape($this->params['url']['de'])."";
			}

			# we are searching a table called 'listings'
			$options = array("MATCH(Work.title,Work.notes,Work.date_year,Work.consignment) AGAINST('$q' IN BOOLEAN MODE)");
			$options = array( 'AND' => array( array('Work.date_year >= ' => $q), array('Work.date_year <= ' => $q2)));
			$this->set(array('works' => $this->paginate('Work', $options)));
		}

		if(isset($_GET['q'])){
			$input = $this->params['url']['q'];

			# sanitize the query
			App::import('Sanitize');
			$q = "%".Sanitize::escape($input)."%";

			$options = array(
	   			'OR' => array(
			array('Work.title LIKE ' => $q),
			array('Work.notes LIKE ' => $q),
			array('Work.date_year LIKE ' => $q),
			array('Work.status LIKE ' => $q),
			array('Work.consignment LIKE ' => $q)
			)
			);

			$this->set(array('works' => $this->paginate('Work', $options)));

			//print_r($this);
			//$this->set(array('works' => $this->paginate('Work', $options)));

		}
		if(isset($_GET['loc'])){
			// /works/find/?loc=NY-NJ%20Westies%20Storage
			$loc = $this->params['url']['loc'];
			//$res = $this->Location->find('all',	array('conditions' =>array('Location.location LIKE ' => '%'.$loc.'%')));

			//$clean  = array_unique($res);
			//print_r($res);
			$this->set(array_unique(array('works' => $this->paginate('Location',
			array('Location.location LIKE ' => '%'.$loc.'%')))));
		}
		/*
		 else {
		 $this->set('images', $this->Image->find("all"));
		 $this->Work->recursive = 0;
		 $this->set('works', $this->paginate());
		 }
		 */
		//$this->render('index');
		if(isset($_GET['list'])){
			$this->render('listing');
		} else {
			$this->render('grid');
		}
	}

	function view($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid Work.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('work', $this->Work->read(null, $id));
		$this->set('imagePath',IMAGE_PATH);
	}

	function _bulk()
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");

		$this->data['Work']['consignment'] = "In storage";
		$this->data['Work']['location/date']="2010";
		$this->data['Work']['location']='Halifax-Storage';
		$this->data['Work']['date_general'] = "";

		//$directoryPath = "ferguson-inventory/ferg_stencil_038_055";
		$this->data['Work']['date_year'] = "2008";
		$directoryPath = "ferguson-inventory/ferguson-10-2010/castiron";

		/*
		 $directoryPath = "ferguson-inventory/Rod_LoRes";
		 $this->data['Work']['date_year'] = "2000";

		 $directoryPath = "ferguson-inventory/Clothesline_LoRes";
		 $this->data['Work']['date_year'] = "2000";

		 $directoryPath = "ferguson-inventory/Rope_Rod_LoRes";
		 $this->data['Work']['date_year'] = "2000";

		 $directoryPath = "ferguson-inventory/Rope_LoRes";
		 $this->data['Work']['date_year'] = "2000";

		 $directoryPath = "ferguson-inventory/StillLifes_Stencils_LoRes";
		 $this->data['Work']['date_year'] = "1991";
		 $directoryPath = "ferguson-inventory/Circle_Dot_LoRes";
		 $this->data['Work']['date_year'] = "1969";
		 */

		if ($directoryPath == true) {

			print ($directoryPath);
			print ("<br>");

			$directoryPathLink = $directoryPath;
			$directory =  opendir ($directoryPath) or die("not avail");
			$fronts = array();
			$backs = array();
			$details = array();
			$date = "";

			while ($files = readdir ($directory)) {

				/* Build arrays of fronts, backs, details
				 *
				 */

				if ( !is_dir($directoryPath."/".$files) ) {
					if($files != "Thumbs.db"){
						print "<a href=/inventory/" . $directoryPathLink . "/" . $files .">". $files . "</a>";

						$imageNameSplit = explode("_F", $files);
						$imageNameSplitBacks = explode("_B", $files);
						$imageNameSplitDetails = explode("_D", $files);
						$imgTemp = new AttachmentComponent();

						if (count($imageNameSplit) > 1){
							array_push($fronts, $files);
						}

						if (count($imageNameSplitBacks) > 1){
							array_push($backs, $files);
						}

						if (count($imageNameSplitDetails) > 1){
							array_push($details, $files);
						}
					}
				}
				if ( is_dir($directoryPath."/".$files))  {
				}
				print "<br>\n";

			}
			closedir ($directory);

			/* Walk through arrays of fronts and create a work record for each
			 * one. Then create image records for each front, back and detail and
			 associate
			 * them with that work
			 */

			print_r($fronts);

			foreach($fronts as $workImage){
				$imageNameSplit = explode("_F", $workImage);
				$nameParts = explode("_",$workImage);
				//echo $workImage;
				foreach($nameParts as $part){
					if(strchr($part,"x")){
						$htwd = explode("x",$part);
					}

					// add date
					if(($part*1) > 1965 && ($part * 1) < 2010){
						$date = $part;
					}
				}

				$workTitleParts = explode("_", $imageNameSplit[0]);
				$workTitle = "";
				foreach($workTitleParts as $part){
					$workTitle .= $part . " ";
				}

				echo "<br/>";
				echo "title=" . $workTitle . "<br><br>";
				echo "<br/>";

				print_r($this->data);
				$this->data['Work']['width']= $htwd[1];
				$this->data['Work']['height']= $htwd[0];
				$this->data['Work']['title'] = $workTitle;
				$this->data['Work']['date_year'] = $date;

				$this->set('defaultInventoryId',$this->Work->find('count'));
				ini_set("max_execution_time", 60);
				ini_set("max_input_time", 160);
				ini_set("post_max_size", "8M");
				ini_set("upload_max_filesize", "8M");

				/*********  create a new work **************/
				$this->Work->create();
				$this->Work->save($this->data['Work']);

				echo "<hr>";
				echo $this->Work->find('count');
				echo "<hr>";

				$this->Location->create();
				$this->Location->save(array("date"=>$this->data['Work']['location/date'],"work_id"=>$this->Work->id,"location"=>$this->data['Work']['location']));

				echo "<br>created Work and location<br />";
				//print_r($this->Work);

				//mkdir(WWW_ROOT."attachments",0777);
				//chmod(WWW_ROOT."".$directoryPath."/".$files, 0777);

				foreach($imgTemp->config['images_size'] as $key=>$size){
					$imageNameCreated = $imageNameSplit[0]."_F_" . $key .".jpg";
					$imageNameCreated = str_replace("#","", $imageNameCreated);
					$imageNameForDB = str_replace("#","", $imageNameSplit[0]);

					if($key == "big") {
						echo "<br> image created == " . $imageNameCreated;
						//rename(WWW_ROOT."".$directoryPath."/".$workImage, WWW_ROOT."attachments"."/".$imageNameCreated);
						copy(WWW_ROOT."".$directoryPath."/".$workImage, WWW_ROOT."attachments"."/".$imageNameCreated);
					} else {
						$imgTemp->resizeImage("resize",
						WWW_ROOT."".$directoryPath."/".$workImage,
						WWW_ROOT."attachments",
						$imageNameCreated,
						$size[0],$size[1]
						);
					}
				}

				$this->Image->create();
				$this->Image->save(array(
					"title"=>$imageNameSplit[0]."_F",
					"work_id"=>$this->Work->id,
					"path"=>"attachments"."/".$imageNameForDB."_F"
					));

					foreach($backs as $backImage){
						if(strstr($backImage,$imageNameSplit[0])){
							echo "<br/>";
							echo $backImage;

							foreach($imgTemp->config['images_size'] as $key=>$size){
								$imageNameCreated = $imageNameSplit[0]."_B_" . $key .".jpg";
								$imageNameCreated = str_replace("#","", $imageNameCreated);
								$imageNameForDB = str_replace("#","", $imageNameSplit[0]);
								$imgTemp->resizeImage("resize",
								WWW_ROOT."".$directoryPath."/".$backImage,
								WWW_ROOT."attachments",
								$imageNameCreated,
								$size[0],$size[1]
								);
							}

							$this->Image->create();
							$this->Image->save(array(
						 	"title"=>$imageNameSplit[0]."_B",
						 	"work_id"=>$this->Work->id,
						 	"path"=>"attachments"."/".$imageNameForDB."_B"
						 	));
						}
					}

					foreach($details as $detailImage){
						if(strstr($detailImage,$imageNameSplit[0])){
							echo "<br/>";
							echo $detailImage;
							foreach($imgTemp->config['images_size'] as $key=>$size){
								$imageNameCreated = $imageNameSplit[0]."_D_" . $key .".jpg";
								$imageNameCreated = str_replace("#","", $imageNameCreated);
								$imgTemp->resizeImage("resize",
								WWW_ROOT."".$directoryPath."/".$detailImage,
								WWW_ROOT."attachments",
								$imageNameCreated,
								$size[0],$size[1]
								);
							}
							$this->Image->create();
							$this->Image->save(array(
						 	"title"=>$imageNameSplit[0]."_D",
						 	"work_id"=>$this->Work->id,
						 	"path"=>"attachments"."/".$imageNameForDB."_D"
						 	));
						}
					}
			}
		}
		die;
	}

	function add()
	{
		Controller::loadModel("Image");
		Controller::loadModel("Location");
		$this->set('imagePath',IMAGE_PATH);
		$this->set('defaultInventoryId',$this->Work->find('count'));
		//echo "hi";
		ini_set("max_execution_time", 60);
		ini_set("max_input_time", 160);
		ini_set("post_max_size", "8M");
		ini_set("upload_max_filesize", "8M");
		if (!empty($this->data)) {
			$this->Work->create();
			if ($this->Work->save($this->data)) {
				$num = 3;
				for ($i=1; $i<=$num; $i++)
				{
					if (!isset($this->data['Work']['Image/filedata'.$i])) continue;
					$file = $this->data['Work']['Image/filedata'.$i];
					if (!$file['name']) continue;
					$binary_data = $this->Attachment->upload($file, $this->Image->loc);
					$this->Image->create();
					$this->Image->save(array("title"=>$binary_data['name'],"work_id"=>$this->Work->id,"path"=>$binary_data['path']));
				}

				if ($this->data['Work']['location']!='') {
					$this->Location->create();
					$this->Location->save(array("date"=>$this->data['Work']['location/date'],"work_id"=>$this->Work->id,"location"=>$this->data['Work']['location']));
				}

				$this->Session->setFlash(__('The Work has been saved', true));
				$this->redirect(array('action'=>'view','id'=>$this->Work->id));
			} else {
				$this->Session->setFlash(__('The Work could not be saved. Please, try again.', true));
			}
		}
		$exhibitions = $this->Work->Exhibition->find('list');
		$this->set(compact('exhibitions'));
	}

	function edit($id = null)
	{
		if(in_array("editor", $this->permissions)){
			Controller::loadModel("Image");
			Controller::loadModel("Location");
			Controller::loadModel("Exhibition");
			$this->set('imagePath',IMAGE_PATH);
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid Work', true));
				$this->redirect(array('action'=>'grid'));
			}
			if (!empty($this->data)) {
				$res = $this->Work->read(null, $id);

				if(($res['Work']['consignment'] == "RESERVED" || $res['Work']['consginment'] == "NFS-Estate") && in_array("admin", $this->permissions)) {
					if ($this->saveWork($this->data)) {
						$this->Session->setFlash(__('The Work has been saved', true));
						$this->redirect(array('action'=>'view','id'=>$this->Work->id));
					} else {
						$this->Session->setFlash(__('The Work could not be saved. Please, try again.', true));
					}
				} else if($res['Work']['consignment'] != "RESERVED" && in_array("editor", $this->permissions)) {
					if ($this->saveWork($this->data)) {
						$this->Session->setFlash(__('The Work has been saved', true));
						$this->redirect(array('action'=>'view','id'=>$this->Work->id));
					} else {
						$this->Session->setFlash(__('The Work could not be saved. Please, try again.', true));
					}
				} else {
					$this->Session->setFlash(__('The Work could not be saved. Please, try again.', true));
					$this->data = $this->Work->read(null, $id);
					$this->set('work', $this->Work->read(null, $id));
				}

			}
			if (empty($this->data)) {
				$this->data = $this->Work->read(null, $id);
				$this->set('work', $this->Work->read(null, $id));
				//$this->set('exhibit', $this->Work->read(null, $id));
			}
		} else {
			$this->redirect(array('action'=>'grid'));
		}
		$exhibitions = $this->Work->Exhibition->find('list');
		$this->set(compact('exhibitions'));
	}

	private function saveWork($data)
	{
		if($this->Work->save($this->data)){
			$num = 3;
			for ($i=1; $i<=$num; $i++)
			{
				$file = $this->data['Work']['Image/filedata'.$i];
				if (!$file['name']) continue;
				$binary_data = $this->Attachment->upload($file, $this->Image->loc);
				$this->Image->create();
				$this->Image->save(array("title"=>$binary_data['name'],"work_id"=>$this->Work->id,"path"=>$binary_data['path']));
			}

			if ($this->data['Work']['location']!='') {
				$this->Location->create();
				$this->Location->save(array("date"=>$this->data['Work']['location/date'],"work_id"=>$this->Work->id,"location"=>$this->data['Work']['location']));
			}

			return true;
		} else {
			return $false;
		}
	}

	function delete($id = null)
	{
		if(in_array("admin", $this->permissions)){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for Work', true));
				$this->redirect(array('action'=>'grid'));
			}
			if ($this->Work->del($id)) {
				$this->Session->setFlash(__('Work deleted', true));
				$this->redirect(array('action'=>'grid'));
			}
		} else {
			$this->data = $this->Work->read(null, $id);
			$this->set('work', $this->Work->read(null, $id));
			$this->redirect(array('action'=>'view'));
		}
	}

}
?>