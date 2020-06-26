<?php 
	class Event {
		public $event_id;
		public $event_name;

		function __construct($event_id, $event_name) {
			$this->event_id = $event_id;
			$this->event_name = $event_name;
		}
	}
?>