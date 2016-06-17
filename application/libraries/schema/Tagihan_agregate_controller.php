<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Tagihan_agregate_controller
* @version 07/05/2015 12:18:00
*/
class Tagihan_agregate_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','nd');
        $sord = getVarClean('sord','str','asc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $schema_id = getVarClean('schema_id','str','');
        $an_fact = getVarClean('an_fact','int',0);
        $per_fact = getVarClean('per_fact','int',0);

        try {

            $ci = & get_instance();
            $ci->load->model('schema/tagihan_agregate');
            $table = $ci->tagihan_agregate;

            $req_param = array(
                "sort_by" => $sidx,
                "sord" => $sord,
                "limit" => null,
                "field" => null,
                "where" => null,
                "where_in" => null,
                "where_not_in" => null,
                "search" => $_REQUEST['_search'],
                "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
            );

            // Filter Table
            $req_param['where'] = array("an_fact = ".$an_fact,
                                        "per_fact = ".$per_fact,
                                        "nd in (select distinct p_notel from cc_dataref_batch where schema_id = '".$schema_id."')");

            $table->setJQGridParam($req_param);
            $count = $table->countAll();

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            $req_param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );

            $table->setJQGridParam($req_param);

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $table->getAll();
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }


    function readLov() {

        $start = getVarClean('current','int',0);
        $limit = getVarClean('rowCount','int',5);

        $sort = getVarClean('sort','str','nd');
        $dir  = getVarClean('dir','str','asc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');

        $schema_id = getVarClean('schema_id','str','');
        $an_fact = getVarClean('an_fact','int',0);
        $per_fact = getVarClean('per_fact','int',0);

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {
            permission_check('view-schema');

            $ci = & get_instance();
            $ci->load->model('schema/tagihan_agregate');
            $table = $ci->tagihan_agregate;

            if(!empty($searchPhrase)) {
                $table->setCriteria("(upper(a.nd) ".$table->likeOperator." upper('%".$searchPhrase."%') OR upper(a.no_cpta) ".$table->likeOperator." upper('%".$searchPhrase."%'))");
            }

            $table->setCriteria("an_fact = ".$an_fact);
            $table->setCriteria("per_fact = ".$per_fact);
            $table->setCriteria("nd in (select distinct p_notel from cc_dataref_batch where schema_id = '".$schema_id."')");

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

    function crud() {

        $data = array();
        $oper = getVarClean('oper', 'str', '');
        switch ($oper) {

            case 'del' :
                permission_check('delete-schema');
                $data = $this->destroy();
            break;

            default :
                permission_check('view-schema');
                $data = $this->read();
            break;
        }

        return $data;
    }

    function excelDetailTableTrendInfo() {

        $sort = getVarClean('sort','str','nd');
        $dir  = getVarClean('dir','str','asc');

        $schema_id = getVarClean('schema_id','str','');
        $an_fact = getVarClean('an_fact','int',0);
        $per_fact = getVarClean('per_fact','int',0);

        $ci = & get_instance();
        $ci->load->model('schema/tagihan_agregate');
        $table = $ci->tagihan_agregate;

        $table->setCriteria("an_fact = ".$an_fact);
        $table->setCriteria("per_fact = ".$per_fact);
        $table->setCriteria("nd in (select distinct p_notel from cc_dataref_batch where schema_id = '".$schema_id."')");

        $items = $table->getAll(0, -1, $sort, $dir);

        $html  = '<table border="1">';
        $html .= '<tr>';
        $html .= '<th>NO</th>';
        $html .= '<th>NCLI</th>';
        $html .= '<th>NDOS</th>';
        $html .= '<th>TYPE_EDIT_FACT</th>';
        $html .= '<th>NDOS_GRP</th>';
        $html .= '<th>ND</th>';
        $html .= '<th>AN_FACT</th>';
        $html .= '<th>PER_FACT</th>';
        $html .= '<th>GROUPE_FACT</th>';
        $html .= '<th>NFACT</th>';
        $html .= '<th>NELTFACT</th>';
        $html .= '<th>NO_CPTA</th>';
        $html .= '<th>SENS</th>';
        $html .= '<th>MNT_COM</th>';
        $html .= '<th>ID_TRAITEMENT</th>';
        $html .= '<th>CENTITE</th>';
        $html .= '<th>IND_RVT</th>';
        $html .= '<th>CTAXE</th>';
        $html .= '<th>TYPE_DEST</th>';
        $html .= '<th>BATCH_ID</th>';
        $html .= '<th>LELTFACT</th>';
        $html .= '</tr>';

        $i = 1;
        foreach($items as $item) {
            $html .= '<tr>';
            $html .= '<td>'.$i++.'</td>';
            $html .= '<td>&nbsp;'.$item['ncli'].'</td>';
            $html .= '<td>'.$item['ndos'].'</td>';
            $html .= '<td>'.$item['type_edit_fact'].'</td>';
            $html .= '<td>'.$item['ndos_grp'].'</td>';
            $html .= '<td>&nbsp;'.$item['nd'].'</td>';
            $html .= '<td>'.$item['an_fact'].'</td>';
            $html .= '<td>'.$item['per_fact'].'</td>';
            $html .= '<td>'.$item['groupe_fact'].'</td>';
            $html .= '<td>'.$item['nfact'].'</td>';
            $html .= '<td>'.$item['neltfact'].'</td>';
            $html .= '<td>&nbsp;'.$item['no_cpta'].'</td>';
            $html .= '<td>'.$item['sens'].'</td>';
            $html .= '<td>'.$item['mnt_com'].'</td>';
            $html .= '<td>'.$item['id_traitement'].'</td>';
            $html .= '<td>'.$item['centite'].'</td>';
            $html .= '<td>'.$item['ind_rvt'].'</td>';
            $html .= '<td>'.$item['ctaxe'].'</td>';
            $html .= '<td>'.$item['type_dest'].'</td>';
            $html .= '<td>'.$item['batch_id'].'</td>';
            $html .= '<td>'.$item['leltfact'].'</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        startExcel('detail_trend_info_'.$schema_id.'.xls');
        echo '<html>';
        echo '<head><title>Excel Trend & Info Detail</title></head>';
        echo '<body>';
        echo $html;
        echo '</body>';
        echo '</html>';
        exit;
    }

}

/* End of file Scema_controller.php */