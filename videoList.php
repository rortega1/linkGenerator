<?php

class videoList extends DirectoryIterator
{

	private $files = array();

	public function __construct()
	{
		
		$iterator = new DirectoryIterator(dirname(__FILE__));

		foreach($iterator as $fileinfo)
		{
			if($fileinfo->isFile() && !$fileinfo->isDot() && strpos($fileinfo, ".")!= 0)
			{

				$this->files[] = $fileinfo->getFilename();
			}
		}
	}

	public function getFiles()
	{
		return $this->files;
	}


}

$f = new VideoList();
foreach($f->getFiles() as $x)
{
	echo $x . "<br>";
}
