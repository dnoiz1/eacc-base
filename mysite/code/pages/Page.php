<?php

class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

	public function requireDefaultRecords() {
		if (Director::isDev()) {
			$loader = new FixtureLoader();
			$loader->loadFixtures();
		}
	}
}

class Page_Controller extends ContentController {
	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
        $ThemeDir =  $this->ThemeDir();
//        Requirements::set_write_js_to_body(false);
//        Requirements::set_write_js_to_body(true);
        //Requirements::set_combined_files_folder('requirements');
        Requirements::combine_files(
            'site.css',
            array(
                $ThemeDir.'/css/bootstrap.css',
                //$ThemeDir.'/css/darkstrap.min.css',
                $ThemeDir.'/css/dinner.css',
                $ThemeDir.'/css/responsive.css'
            )
        );

//        Requirements::javascript("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
        Requirements::javascript( $ThemeDir.'/javascript/bootstrap.min.js');
    }

    public function GetLinkFromID($id = 1) {
       $do = DataObject::get_by_id('SiteTree', $id);
       if($do) return $do->Link();
       return '';
	}

    public function Copyright($startYear = "", $separator = "-") {
        $currentYear = date('Y');
        if(!empty($startYear)) {
            $output = ($startYear>=$currentYear ? $currentYear : $startYear.$separator.$currentYear);
        } else {
            $output = $currentYear;
        }
        return $output;
    }
}
