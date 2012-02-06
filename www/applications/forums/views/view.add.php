<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Forum"]);
		$title       = recoverPOST("title",       $data[0]["Title"]);
		$description = recoverPOST("description", $data[0]["Description"]);
		$language    = recoverPOST("language",    $data[0]["Language"]);
		$situation 	 = recoverPOST("situation",   $data[0]["Situation"]);
		$edit        = TRUE;
		$action	     = "edit";
		$href        = path($this->application ."/cpanel/edit/$ID");		
	} else {
		$ID          = 0;
		$title       = recoverPOST("title");
		$description = recoverPOST("description");
		$language    = recoverPOST("language");
		$situation   = recoverPOST("situation");
		$edit        = FALSE;
		$action	     = "save";
		$href	     = path($this->application ."/cpanel/add/");
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array(
								"name"  => "title", 
								"class" => "span10 required", 
								"field" => __(_("Title")), 
								"p" 	=> TRUE, 
								"value" => $title));
					
			print formTextarea(array(
								"name"  => "description", 
								"class" => "span10 required", 
								"style" => "height: 150px;", 
								"field" => __(_("Description")), 
								"p" 	=> TRUE, 
								"value" => $description));
			
			print formField(NULL, __(_("Languages")) ."<br />". getLanguageRadios($language)); 	
			
			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __(_("Active")),
						"selected" => ($situation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __(_("Inactive")),
						"selected" => ($situation === "Inactive") ? TRUE : FALSE
					)
			);

			print formSelect(array("name" => "situation", "class" => "required", "p" => TRUE, "field" => __(_("Situation"))), $options);
						
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		print formClose();
	print div(FALSE);