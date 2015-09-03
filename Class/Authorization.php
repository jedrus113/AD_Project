<?PHP

/*
 *
 * Class to checking authorisation.
 * Just checking if user is known, and getting a basic data of him.
 *
 */


load_config('Authorization');

load_class('Database');

class Authorization {

  private static $instance = false;

  public static function get_instance(){
    if(self::$instance == false) {
      self::$instance = new Authorization();
    }
    return self::$instance;
  }

  private function __construct(){
    if(isset($_COOKIE[AUTH_COOKIE_NAME])){
	    // prawdopodobnie zalogowany, a na pewno ma ciasteczko.
    } else {
      /* 
       * ASCII
       * 48-57  = numbers
       * 65-90  = big letters
       * 97-122 = small letters
       *
       * (57-48)+(90-65)+(122-97) = 59
      */
      $val = "";
      for($i=0; $i<AUTH_COOKIE_VAL_LEN; $i++) {
        $v = rand(0, 59);
        if($v < 10) $v += 48;
        elseif($v < 35) $v += 65 - 10;
        else $v += 97 - 35;
        $val .= chr($v);
      }
      setcookie(AUTH_COOKIE_NAME, $val);
    }
  }	

}

?>
