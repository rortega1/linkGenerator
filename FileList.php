<?php
/*
	FileList class takes a directory as input and returns an array of files within the directory.
	Input of NULL will return the list of files in the directory of the current file using the public
	method getFiles().
	
	Example:
		
		$files = new FileList();
		foreach($files->getFiles() as $file)
		{
			echo $file;
		}
*/


class FileList extends DirectoryIterator
{
	// Protect the array list from being changed publicly
	protected $files = array();
	
	// Directory var to dynamically iterate through directories
	private $directory;
	
	// Construct that iterates through passed in directory and stores list into protected array
	public function __construct($directory)
	{
		// Set directory before using
		$this->setDirectory($directory);
		
		// Call the DirectoryIterator Class passing class var directory
		$iterator = new DirectoryIterator($this->directory);
		
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
	
	// Publicly set directory to iterate through
	private function setDirectory($directory)
	{
		if($directory == NULL)
		{
			$this->directory = dirname(__FILE__);
		}else
		{
			$this->directory = $directory;
		}
	}

}