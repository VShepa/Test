<?php    
    foreach(new DirectoryIterator('../datafiles') as $fileInfo){
        
        if( preg_match( '~^[[:alnum:]]+\.ixt$~', $fileInfo->getFileName() ) )
            
            echo $object->getFileName() . '<br>';
    }
