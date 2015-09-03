<?PHP

/*
 *
 * Class for reading confing files.
 * Every setting value in file can you get by using get_var($name) function
 * settings file should looks like "var='value'"
 *
 */


class Config
{

	private $vars_list = array();
	
	function __construct($config_file){
		$file = fopen($config_file, "r");
		if($file) {
			while(($line = fgets($file)) !== false) {
				$exp = explode("=", $line);

				$quote = null;
				$temp = '';
				$string = '';
				foreach(str_split($exp[1]) as $ch){
					if($quote == null && $ch == '\''){
						$quote = '\'';
					} elseif ($quote == null && $ch == '"'){
						$quote = '"';
					} elseif ($quote == '\''){
						if($ch == '\''){
							$quote = null;
						} else {
							$string .= $ch;
						}
					} elseif($quote == '"') { /* add using variable of AD */
						if($ch != '"'){
							$quote = null;
						} else {
							$string .= $ch;
						}
					} else {
						$string .= $ch;
					}
				}
				$this->vars_list[$exp[0]] = $string;

			}
			fclose($file);
		} else {
			/* ERROR FILE NOT OPEN */
		}
	}

	function get_var($var){
		if(isset($this->vars_list[$var])){
			return $this->vars_list[$var];
		} else{
			return null;
		}
	}

}


?>
