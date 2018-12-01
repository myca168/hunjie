<?php
/*
** Files/Folders copy and delete
*/
class Caclass_Files {
// to remove a folder with contents
	public static function rrmdir($dir) {
    if (is_dir($dir)) // ensures that we actually have a directory
    {
        $objects = scandir($dir); // gets all files and folders inside
        foreach ($objects as $object)
        {
            if ($object != '.' && $object != '..')
            {
                if (filetype($dir . '/' . $object) == 'dir')
                {
                    self::rrmdir($dir . '/' . $object);  // if we find a directory, do a recursive call
                } else {
                    unlink($dir . '/' . $object); // if we find a file, simply delete it
                }
            }
        }
        rmdir($dir); // the original directory is now empty, so delete it
    }
	}
	//copy files from source to target path 
	public static function copy($source, $target) {
        if (!is_dir($source)) {//it is a file, do a normal copy
            copy($source, $target);
            return;
        }
        //it is a folder, copy its files & sub-folders
        @mkdir($target);
        $d = dir($source);
        $navFolders = array('.', '..');
        while (false !== ($fileEntry=$d->read() )) {//copy one by one
            //skip if it is navigation folder . or ..
            if (in_array($fileEntry, $navFolders) ) {
                continue;
            }
            //do copy
            $s = "$source/$fileEntry";
            $t = "$target/$fileEntry";
            self::copy($s, $t);
        }
        $d->close();
    }
}