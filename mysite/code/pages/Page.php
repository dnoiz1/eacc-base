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
        Requirements::set_write_js_to_body(true);
        Requirements::set_combined_files_folder('requirements');
        Requirements::combine_files(
            'site.css',
            array(
                $ThemeDir.'/css/bootstrap.css',
                $ThemeDir.'/css/responsive.css',
            )
        );

//        Requirements::javascript("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
        Requirements::combine_files(
            'site.js',
            array(
                $ThemeDir.'/javascript/libs.js',
                $ThemeDir.'/javascript/bootstrap/bootstrap-affix.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-alert.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-button.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-carousel.js',
                $ThemeDir.'/javascript/bootstrap/bootstrap-collapse.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-dropdown.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-modal.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-popover.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-scrollspy.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-tab.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-tooltip.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-transition.js',
//                $ThemeDir.'/javascript/bootstrap/bootstrap-typeahead.js',
                $ThemeDir.'/javascript/main.js'
            )
        );

//		if($m = Member::CurrentUser()) var_dump($m);

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
