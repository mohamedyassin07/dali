<?php 
    function dali_path( $path ){
        $path =  DALI_PLUGIN_DIR.$path;

        if( is_dir($path) || is_file( $path ) ){
            return $path;
        }

       throw new ErrorException( 'incorrect path' );
    }