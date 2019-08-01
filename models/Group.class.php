<?php
	/**
	 * Created by PhpStorm.
	 * User: Dhiresh Hirani
	 * Date: 27-07-2019
	 * Time: 20:00
	 */
	
	
	/**
	 * Class Group:
	 *
	 * A model class created to store the division id, division, batch id, batch as a single entity.
	 * It is being used in the teacher sidenav.
	 */
	class Group
	{
		public $division_id = 0;
		public $division = "";
		public $batch_id = 0;
		public $batch = "";
		
		public function __construct($division_id, $division, $batch_id, $batch)
		{
			$this->division_id = $division_id;
			$this->division = $division;
			$this->batch_id = $batch_id;
			$this->batch = $batch;
		}
		
		/**
		 * @return int
		 */
		public function getBatchId()
		{
			return $this->batch_id;
		}
		
		/**
		 * @param int $batch_id
		 */
		public function setBatchId($batch_id)
		{
			$this->batch_id = $batch_id;
		}
		
		/**
		 * @return int
		 */
		public function getDivisionId()
		{
			return $this->division_id;
		}
		
		/**
		 * @param int $division_id
		 */
		public function setDivisionId($division_id)
		{
			$this->division_id = $division_id;
		}
		
		/**
		 * @return string
		 */
		public function getDivision()
		{
			return $this->division;
		}
		
		/**
		 * @param string $division
		 */
		public function setDivision($division)
		{
			$this->division = $division;
		}
		
		/**
		 * @return string
		 */
		public function getBatch()
		{
			return $this->batch;
		}
		
		/**
		 * @param string $batch
		 */
		public function setBatch($batch)
		{
			$this->batch = $batch;
		}
	}
	