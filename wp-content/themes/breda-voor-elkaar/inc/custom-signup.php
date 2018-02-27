<?php

//1. Add a new form element...
add_action( 'register_form', 'breda_register_form' );
function breda_register_form() {

    // global $wp_roles;

    // echo '<select name="role" class="input">';
    // foreach ( $wp_roles->roles as $key=>$value ) {
    //    // Exclude default roles such as administrator etc. Add your own
    //    if ( ! in_array( $value['name'], [ 'Administrator', 'Contributor', ] ) ) {
    //       echo '<option value="'.$key.'">'.$value['name'].'</option>';
    //    }
    // }
    // echo '</select>';

    ?>
        <select name="role" class="input">
            <option value="cs_candidate">Vrijwilliger</option>
            <option value="cs_employer">Organisatie</option>
        </select>
    <?
}

//2. Add validation.
add_filter( 'registration_errors', 'breda_registration_errors', 10, 3 );
function breda_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    if ( empty( $_POST['role'] ) || ! empty( $_POST['role'] ) && trim( $_POST['role'] ) == '' ) {
         $errors->add( 'role_error', __( '<strong>ERROR</strong>: U moet een rol invullen.', 'breda' ) );
    }
    if ($_POST['role'] != 'cs_candidate' && $_POST['role'] != 'cs_employer' ) {
        $errors->add( 'role_error', __( '<strong>ERROR</strong>: Selecteer Canidate of Employer.', 'breda' ) );
    }

    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'breda_user_register' );
function breda_user_register( $user_id ) {
    $user_id = wp_update_user( array( 'ID' => $user_id, 'role' => $_POST['role'] ) );
}