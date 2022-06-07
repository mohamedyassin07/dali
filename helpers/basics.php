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

if( !function_exists('prr_html') ){
    function prr_html( $array )
    {
        ob_start();
        prr( $array );
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

function name_from_key($key){
    $name = str_replace('-', ' ', $key);
    $name = str_replace('_', ' ', $name);
    $name = ucwords( $name );
    return $name;
}

if( !function_exists('prr') ){
    function prr($element,$title = '',$echo = true){
        $title = is_string($title) && strlen($title) ? $title.' ' : '';
        $title = "<h3>$title(".get_line_info().")</h3>";

        if($echo){
            echo "$title<pre>";
            print_r($element);
            echo "</pre>";
        }else {
            return "$title<pre>".print_r($element)."</pre>";
        }
    }
}

if( !function_exists('get_line_info') ){
    function get_line_info(){
        $excuting_line = debug_backtrace()[1]['line'];
    
        $excuting_file = debug_backtrace()[1]['file'];
        $excuting_file = explode("\\" ,$excuting_file);
        
        $count = count($excuting_file);
    
    
        $excuting_folder 	= @$excuting_file[($count-2)];		
        $excuting_file		= $excuting_file[($count-1)];
        $excuting_file		= explode('.',$excuting_file)[0];
        return "$excuting_folder/$excuting_file@$excuting_line";
    }
}