<?PHP

/*
 *
 * FileTree need Config class.
 *
 * Class going throw directores and remembering structure of this.
 * Also collecting configs from configs files.
 * Config file is filename.ext.conf.
 *                ^ file name ^ extend of config files '.conf.'
 * File starts or ending by dot (.), will not be showd.
 *
 */


load_config('FileTree');
load_config('ssl');
load_config('urls');

load_class('Config');


class FileTree
{
  private $name;			// just name of this directory
  private $files = false;	// false if not a folder
  private $url;  	 		// an url to get access via www
  private $conf = null;		// all options about this file

  function __construct($source = AD_ROOT . 'Files', $www_adress = PROTOCOL . AD_URL_FILES, $name = ''){
    $this->name = $name;
	$this->url = $www_adress;

	if(!is_file($source)){ /* If this is a directory */
	  $sd = scandir($source);
	  $this->files = array();

	  foreach($sd as $file){
			  if($file[0] == '.' || substr($file, -(strlen(CONF_EXP))) == CONF_EXP)
	      continue;
	
	    $this->files[] = new FileTree("$source/$file", "$www_adress/$file", $file);
	  }
	} else { /* If this is a file, not directory */
		if(is_file($source . CONF_EXP)){
			$this->conf = new Config($source . CONF_EXP);
		}
	}

  }

  function is_folder(){
    if($this->files === false)
	  return false;
	else
	  return true;
  }

  function get_name(){
  	return $this->name;
  }
    function get_files(){
	return $this->files;
  }

  
  function get_url(){
	return $this->url;
  }

  function get_pic_url(){
	if($this->conf != null && $this->conf->get_var('pic_src') != null)
	  return $this->conf->get_var('pic_src');
	return PROTOCOL . AD_URL_IMAGES . '/Default/default.png';
  }

  function print_tree(){
    echo '<a href="' . $this->get_url() .'" >' . $this->url . '/' . $this->name . '</a></br>';
	if($this->files != false)
		foreach($this->files as $file){
			$file->print_tree();
		}

  }

}

?>
