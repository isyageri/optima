<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Customer_controller
* @version 07/05/2015 12:18:00
*/
class Message_controller {

    function read() {

        $start = getVarClean('current','int',0);
        $limit = getVarClean('rowCount','int',5);

        $sort = getVarClean('sort','str','cn_trans.trx_id');
        $dir  = getVarClean('dir','str','desc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('message/message');
            $table = $ci->message;

            //Set default criteria. You can override this if you want
            foreach ($table->fields as $key => $field){
                if (!empty($$key)){ // <-- Perhatikan simbol $$
                    if ($field['type'] == 'str'){
                        $table->setCriteria($table->getAlias().$key.$table->likeOperator." '".$$key."' ");
                    }else{
                        $table->setCriteria($table->getAlias().$key." = ".$$key);
                    }
                }
            }

            if(!empty($searchPhrase)) {
                $table->setCriteria("(upper(cn_trans.trx_name) ".$table->likeOperator." upper('%".$searchPhrase."%') OR upper(cn_trans.code) ".$table->likeOperator." upper('%".$searchPhrase."%'))");
            }

            $start = ($start-1) * $limit;
            $items = $table->getAll($start, $limit, $sort, $dir);
            $totalcount = $table->countAll();

            $data['rows'] = $items;
            $data['success'] = true;
            $data['total'] = $totalcount;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function update_flag(){
        $trx_id = getVarClean('trx_id','int',0);

        try {
            
            $ci = & get_instance();
            $ci->load->model('message/message');
            $table = $ci->message;
            $scs = $table->update_flag($trx_id);

            if($scs){
                $data = 'data berhasil di update';
            }else{
                $data = 'data gagal di update';
            }
            
            echo $data;
            exit;
        } catch (Exception $e) {
            $data = $e->getMessage();

            echo $data;
            exit;
        }

    }
   
}

/* End of file Groups_controller.php */