<?php

// Remove Role: Subscriber / Abonnee
if( get_role('subscriber') ){
      remove_role( 'subscriber' );
}
// Remove Role: Author / Auteur
if( get_role('author') ){
      remove_role( 'author' );
}
// Remove Role: Contributor / Schrijver
if( get_role('contributor') ){
      remove_role( 'contributor' );
}
// Remove Role: BackWPup-beheerder
if( get_role('backwpup_admin') ){
      remove_role( 'backwpup_admin' );
}
// Remove Role: BackWPup taken-controle
if( get_role('backwpup_check') ){
      remove_role( 'backwpup_check' );
}
// Remove Role: BackWPup takenhulp
if( get_role('backwpup_helper') ){
      remove_role( 'backwpup_helper' );
}
// Remove Role: Translator
if( get_role('translator') ){
      remove_role( 'translator' );
}
// Rename userrole(s)
function change_role_name() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();
    //You can list all currently available roles like this...
    //$roles = $wp_roles->get_names();
    //echo '<pre>',print_r($roles),'</pre>';
    //Default roles are: "administrator", "editor", "author", "contributor" or "subscriber"...
    $wp_roles->roles['administrator']['name'] = 'Webmaster';
    $wp_roles->role_names['administrator'] = 'Webmaster';
    $wp_roles->roles['editor']['name'] = 'Beheerder';
    $wp_roles->role_names['editor'] = 'Beheerder';
}
add_action('init', 'change_role_name');

?>
