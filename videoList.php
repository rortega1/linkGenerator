<?php

class videoList extends DirectoryIterator
{
	// Protect the array list from being changed publicly
	protected $files = array();
	
	// Construct that iterates through file level directory and stores list into protected array
	public function __construct()
	{
		
		// Call the DirectoryIterator Class
		$iterator = new DirectoryIterator(dirname(__FILE__));
		
		// Pass DirectoryIterator objects into working variable $fileinfo
		foreach($iterator as $fileinfo)
		{
			// Only store files in protected array that do not contain dots at first position of string
			if($fileinfo->isFile() && strpos($fileinfo, ".")!= 0)
			{
				// Store result of condition in protected array
				$this->files[] = $fileinfo->getFilename();
			}
		}
	}
	
	// Function to publicly access protected array data
	public function getFiles()
	{
		return $this->files;
	}


}


// Test class and method
$f = new VideoList();
foreach($f->getFiles() as $x)
{
	echo $x . "<br>";
}
