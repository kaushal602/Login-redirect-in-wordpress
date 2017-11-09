add_action( 'wp_login_failed', 'front_end_login_fail' );
function front_end_login_fail( $username ) {
  // Getting URL of the login page
  $referrer = $_SERVER['HTTP_REFERER'];    
  // if there's a valid referrer, and it's not the default log-in screen
  if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) && !strstr( $referrer,' wp-login.php' )) {
   
    $_SESSION['log_arr']="Please Enter Valid Username And Password";
      if($_POST['pdfurl']!=''){
        wp_redirect( get_permalink( 322 ) . "?rdurl=".$_POST['rdurl'] );
        exit;
      } else {
        wp_redirect( get_permalink( 322 ) . "?login=empty" );
        exit;
      }
  }
}

add_action( 'authenticate', 'check_username_password', 1, 3);
function check_username_password( $login, $username, $password ) {

// Getting URL of the login page
$referrer = $_SERVER['HTTP_REFERER'];

// if there's a valid referrer, and it's not the default log-in screen
if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {
    if( $username == "" || $password == "" ){
        $_SESSION['log_arr']="Username And Password Are Require";
        if($_POST['pdfurl']!=''){
          wp_redirect( get_permalink( 322 ) . "?rdurl=".$_POST['rdurl'] );
          exit;
        } else {
          wp_redirect( get_permalink( 322 ) . "?login=empty" );
          exit;
        }
    }
}

}

function soi_login_redirect($redirect_to, $request, $user)
{
  //return $_POST['pdfurl'];
    if($_POST['pdfurl']!=''){
      $siturl = site_url().'/technical-information';
    } else {
      $siturl = site_url();
    }
    return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url() : $siturl;
}
add_filter('login_redirect', 'soi_login_redirect', 10, 3);
