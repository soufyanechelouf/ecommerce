<?php
	
	function lang ($phrase){
		static $lang = array(
			'message'=>'أهلا',
			'admin'=>'المدير');

		return $lang[$phrase];


	}