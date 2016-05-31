<?php

/**
 * Pembuatan schema Model
 *
 */
class Pembuatan_schema extends Abstract_model {

    public $table           = "users";
    public $pkey            = "id";
    public $alias           = "usr";

    public $fields          = array(
                                'id'                => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID User'),
                                'ip_address'        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'IP Address'),
                                'username'          => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Username'),
                                'password'          => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Password'),
                                'salt'              => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Salt'),
                                'email'             => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Email'),
                                'activation_code'   => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Activation Code'),
                                'forgotten_password_code'   => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Forgoten Password Code'),
                                'forgotten_password_time'   => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Forgoten Password Time'),
                                'remember_code'     => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Remember Code'),
                                'created_on'        => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Created On'),
                                'last_login'        => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Last Login'),
                                'active'            => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Active'),
                                'first_name'        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'First Name'),
                                'last_name'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Last Name'),
                                'company'           => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Company'),
                                'phone'             => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Phone'),

                            );

    public $selectClause    = "usr.id, usr.ip_address, usr.username, usr.email, to_char(to_timestamp_num(created_on),'dd-mm-yyyy HH24:MI:SS')  as created_on,
                                    to_char(to_timestamp_num(last_login),'dd-mm-yyyy HH24:MI:SS')  as last_login,
                                    coalesce(usr.active,0) active, usr.first_name, usr.last_name, usr.company, usr.phone,
                                    CASE coalesce(usr.active,0) WHEN 0 THEN 'Not Active'
                                        WHEN 1 THEN 'Active'
                                    END as status_active";
    public $fromClause      = "users usr";

    public $refs            = array('users_groups' => 'user_id');

    function __construct() {
        parent::__construct();
    }

    function validate() {
        $ci =& get_instance();

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            //$this->record['created_date'] = date('Y-m-d');
            //$this->record['updated_date'] = date('Y-m-d');
            if (isset($this->record['password'])){
                if (trim($this->record['password']) == '') throw new Exception('Password Field is Empty');
                if (strlen($this->record['password']) < 4) throw new Exception('Mininum password length is 4 characters');
                $ci->load->model('ion_auth_model');
                $this->record['password'] = $ci->ion_auth_model->hash_password($this->record['password']);
            }

            $this->record[$this->pkey] = $this->generate_id($this->table);
            $this->record['created_on'] = time();
        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
            unset($this->record['password']);
        }
        return true;
    }

}

/* End of file Users.php */
