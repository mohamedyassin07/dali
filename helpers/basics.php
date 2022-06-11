<?php 
    function dali_path( $path ){
        $path =  DALI_PLUGIN_DIR . $path;

        if( is_dir($path) || is_file( $path ) ){
            return $path;
        }

       throw new ErrorException( 'incorrect path' );
    }

    function dali_url( $url ){
        return DALI_PLUGIN_URL . $url;
    }

    function prr_html( $array )
    {
        ob_start();
        echo "<pre>";
        print_r( $array );
        echo "</pre>";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    function name_from_key($key){
        $name = str_replace('-', ' ', $key);
        $name = str_replace('_', ' ', $name);
        $name = ucwords( $name );
        return $name;
    }
