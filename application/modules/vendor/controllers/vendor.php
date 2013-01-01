<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author farid
 */
class vendor extends MY_Controller
{
    public $rules;
    public $where;

    public function __construct()
    {
        parent::__construct();
        //$this->session->set_userdata('user_id', '512');
        //$this->session->set_userdata('user_id', '7827400');

//        $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);
        
        $this->where = 'KODE_VENDOR = ' . $this->session->userdata('user_id');
        $this->rules = array(
            '0' => array(// tabs-1
                array('model' => 'ep_vendor_perusahaan', 'label' => 'NAMA PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_alamat', 'label' => 'KONTAK PERUSAHAAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_kontak_person', 'label' => 'KONTAK PERSON', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_jamsostek', 'label' => 'KEPESERTAAN JAMSOSTEK', 'rules' => 'required', 'where' => $this->where),
            ),
            '1' => array(// tabs-2
                array('model' => 'ep_vendor_akta', 'label' => 'AKTA PENDIRIAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_domisili', 'label' => 'DOMISILI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_npwp', 'label' => 'NPWP', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_mitra', 'label' => 'JENIS MITRA KERJA', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_siup', 'label' => 'SIUP', 'rules' => 'hasOne', 'where' => $this->where),
                //array('model' => 'ep_vendor_ijin', 'label' => 'IJIN LAIN-LAIN (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_tdp', 'label' => 'TDP', 'rules' => 'required', 'where' => $this->where),
            //array('model' => 'ep_vendor_agen', 'label' => 'SURAT KEAGENAN/DISTRIBUTORSHIP (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'AGEN'"),
            //array('model' => 'ep_vendor_importir', 'label' => 'ANGKA PENGENAL IMPORTIR (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'IMPORTIR'"),
            ),
            '2' => array(// tabs-3
                array('model' => 'ep_vendor_komisaris', 'label' => 'DEWAN KOMISARIS', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_direksi', 'label' => 'DEWAN DIREKSI', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '3' => array(// tabs-4
                array('model' => 'ep_vendor_bank', 'label' => 'REKENING BANK', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_modal', 'label' => 'MODAL SESUAI DENGAN AKTA TERAKHIR', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_laporan_keuangan', 'label' => 'INFORMASI LAPORAN KEUANGAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_klasifikasi', 'label' => 'KLASIFIKASI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
            ),
            '4' => array(// tabs-5
                array('model' => 'ep_vendor_barang', 'label' => 'BARANG YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_jasa', 'label' => 'JASA YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '5' => array(// tabs-6
                array('model' => 'ep_vendor_tenaga_utama', 'label' => 'TENAGA AHLI UTAMA', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_tenaga_pendukung', 'label' => 'TENAGA AHLI PENDUKUNG', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '6' => array(// tabs-7
                array('model' => 'ep_vendor_sertifikat', 'label' => 'KETERANGAN SERTIFIKAT', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '7' => array(// tabs-8
                array('model' => 'ep_vendor_peralatan', 'label' => 'KETERANGAN TENTANG FASILITAS / PERALATAN', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '9' => array(// tabs-10
                array('model' => 'ep_vendor_principal', 'label' => 'PRINCIPAL', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_subkontraktor', 'label' => 'SUBKONTRAKTOR', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_afiliasi', 'label' => 'PERUSAHAAN AFILIASI', 'rules' => 'required', 'where' => $this->where),
            ),
        );
    }

    public function view()
    {
        $this->layout->view('vendor/view');
    }

    public function update()
    {
        $is_success = '';
        $kode_vendor = $this->session->userdata('user_id');
        $param = array(
            array('name' => ':p1', 'value' => $kode_vendor, 'length' => -1, 'type' => SQLT_INT),
//           array('name'=>':a2', 'value'=>&$is_success),
        );
//        $this->db->stored_procedure('EPROC', 'PROC_EP_VENDOR_COPY_TO_TEMP', $param);

        $this->db->query("
            begin 
            EPROC.PROC_EP_VENDOR_COPY_TO_TEMP( " . $this->session->userdata('user_id') . "); 
            end;", FALSE, FALSE);
        
        $this->layout->view('vendor/update');
    }

    public function validate_before_update()
    {
        $this->rules = array(
            '0' => array(// tabs-1
                array('model' => 'temp.ep_vendor_temp_perusahaan', 'label' => 'NAMA PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_alamat', 'label' => 'KONTAK PERUSAHAAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_kontak_person', 'label' => 'KONTAK PERSON', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_jamsostek', 'label' => 'KEPESERTAAN JAMSOSTEK', 'rules' => 'required', 'where' => $this->where),
            ),
            '1' => array(// tabs-2
                array('model' => 'temp.ep_vendor_temp_akta', 'label' => 'AKTA PENDIRIAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_domisili', 'label' => 'DOMISILI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_npwp', 'label' => 'NPWP', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_mitra', 'label' => 'JENIS MITRA KERJA', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_siup', 'label' => 'SIUP', 'rules' => 'hasOne', 'where' => $this->where),
                //array('model' => 'temp.ep_vendor_temp_ijin', 'label' => 'IJIN LAIN-LAIN (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_tdp', 'label' => 'TDP', 'rules' => 'required', 'where' => $this->where),
            //array('model' => 'temp.ep_vendor_temp_agen', 'label' => 'SURAT KEAGENAN/DISTRIBUTORSHIP (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'AGEN'"),
            //array('model' => 'temp.ep_vendor_temp_importir', 'label' => 'ANGKA PENGENAL IMPORTIR (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'IMPORTIR'"),
            ),
            '2' => array(// tabs-3
                array('model' => 'temp.ep_vendor_temp_komisaris', 'label' => 'DEWAN KOMISARIS', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_direksi', 'label' => 'DEWAN DIREKSI', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '3' => array(// tabs-4
                array('model' => 'temp.ep_vendor_temp_bank', 'label' => 'REKENING BANK', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_modal', 'label' => 'MODAL SESUAI DENGAN AKTA TERAKHIR', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_laporan_keuangan', 'label' => 'INFORMASI LAPORAN KEUANGAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_klasifikasi', 'label' => 'KLASIFIKASI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
            ),
//            '4' => array(// tabs-5
//                array('model' => 'temp.ep_vendor_temp_barang', 'label' => 'BARANG YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_jasa', 'label' => 'JASA YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '5' => array(// tabs-6
//                array('model' => 'temp.ep_vendor_temp_tenaga_utama', 'label' => 'TENAGA AHLI UTAMA', 'rules' => 'hasOne', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_tenaga_pendukung', 'label' => 'TENAGA AHLI PENDUKUNG', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '6' => array(// tabs-7
//                array('model' => 'temp.ep_vendor_temp_sertifikat', 'label' => 'KETERANGAN SERTIFIKAT', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '7' => array(// tabs-8
//                array('model' => 'temp.ep_vendor_temp_peralatan', 'label' => 'KETERANGAN TENTANG FASILITAS / PERALATAN', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '9' => array(// tabs-10
//                array('model' => 'temp.ep_vendor_temp_principal', 'label' => 'PRINCIPAL', 'rules' => 'required', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_subkontraktor', 'label' => 'SUBKONTRAKTOR', 'rules' => 'required', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_afiliasi', 'label' => 'PERUSAHAAN AFILIASI', 'rules' => 'required', 'where' => $this->where),
//            ),
        );

        foreach ($this->rules as $k => $v)
        {
            if ($return = $this->xvalidation($v))
            {
                echo json_encode($return);
                exit();
            }
        }
        exit();
    }

    public function create_or_edit()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        if ($this->_is_ajax_request())
            $this->load->view('vendor/create_or_edit');
        else
            $this->layout->view('vendor/create_or_edit');
    }

    /*
     * internal actions
     */

    public function todo()
    {
        $this->layout->view('vendor/todo');
    }

    public function list_for_deactivation()
    {
        $this->layout->view('vendor/list_for_deactivation');
    }
    
    public function list_process()
    {
        $this->layout->view('vendor/list_process');
    }
    
    public function list_update_number_smk()
    {
        $this->layout->view('vendor/list_update_number_smk');
    }
    
    public function list_all()
    {
        $this->layout->view('vendor/list_all');
        //modules::run('vendor/grid/vendor.list_all');
    }
    
    public function generate_bidder_list()
    {
        $rows = $this->db->query("select * from ms_subkelompok_barang")->result_array();
        $grup_barang = array();
        foreach ($rows as $v) {
            $grup_barang[$v['KODE_BARANG']] = $v['NAMA_SUBKELOMPOK'];
        }
        
        
        $this->layout->view('vendor/generate_bidder_list', array(
            'grup_barang'=>$grup_barang,
        ));
    }
    
    public function list_performance()
    {
        $rows = $this->db->query("
                select a.* from (
                    select kode_barang as kode_kel_barang_jasa, nama_subkelompok as nama_kel_barang_jasa from ms_subkelompok_barang
                    union all
                    select kode_kel_jasa, nama_kel_jasa from ep_kom_kelompok_jasa
                ) a
                order by nama_kel_barang_jasa
                ")->result_array();
        $grup_barang = array();
        foreach ($rows as $v) {
            $grup_barang[$v['KODE_KEL_BARANG_JASA']] = $v['NAMA_KEL_BARANG_JASA'];
        }
        
        $this->layout->view('vendor/list_performance', array(
            'grup_barang'=>$grup_barang,
        ));
    }
    
    public function view_performance()
    {
        $this->layout->view('vendor/view_performance');
    }
    
    public function list_suspend()
    {
        $this->layout->view('vendor/list_suspend');
    }
    
    public function list_for_suspend()
    {
        $this->layout->view('vendor/list_for_suspend');
    }
    
    public function list_delisting()
    {
        $this->layout->view('vendor/list_delisting');
    }
    
    public function list_for_delisting()
    {
        $this->layout->view('vendor/list_for_delisting');
    }
    
    public function list_for_blacklist()
    {
        $this->layout->view('vendor/list_for_blacklist');
    }
    
    public function form_suspend(){
        $this->layout->view('vendor/form_suspend');
    }
    
    public function form_unsuspend(){
        $this->layout->view('vendor/form_unsuspend');
    }
    
    public function form_blacklist()
    {
        $this->layout->view('vendor/form_blacklist');
    }
    
    public function form_deactivation()
    {
        $this->layout->view('vendor/form_deactivation');
    }
    
    public function form_delisting()
    {
        $this->layout->view('vendor/form_delisting');
    }
    
    public function form_undelisting()
    {
        $this->layout->view('vendor/form_undelisting');
    }
    
    public function detail_proses()
    {
        $this->layout->view('vendor/detail_proses');
    }
    
    public function form_update_smk()
    {
        $this->layout->view('vendor/form_update_smk');
    }
    
    
    public function checklist_doc()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        $this->session->set_userdata();

        if ($this->_is_ajax_request())
            $this->load->view('vendor/checklist_doc');
        else
            $this->layout->view('vendor/checklist_doc');
    }

    public function activation()
    {
        if (isset($_POST))
        {
            redirect('vendor/todo');
        }
        $this->layout->view('vendor/activation');
    }

    public function compare()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        if ($this->_is_ajax_request())
            $this->load->view('vendor/compare');
        else
            $this->layout->view('vendor/compare');
    }

    // for internal & external actions

    public function xvalidation($rules = array())
    {
        if (count($rules) == 0)
            return false;

        $ret = array('errors' => array());
        foreach ($rules as $v)
        {
            if (!isset($v['rules']))
                return false;

//            $obj = $this->_load_model($v['model']);
            $model = str_replace(".", "/", strtolower($v['model']));
            $this->load->model($model, $v['model']);
            $obj = $this->$v['model'];

//echo $obj->table.'<br>';
//print_r($this);
            if (!$obj)
                show_error("Model Not Found : " . $v['model']);
//            else
//                echo "<br/>Found : " . $v['model'];
//            continue;

            $err = true;
            $cnt = 0;
            if ($v['rules'] == 'required')
            {
                $fields = implode(',', array_keys($obj->validation, array('required' => true)));
                $this->where = '( ' . implode(' IS NOT NULL AND ', array_keys($obj->validation, array('required' => true))) . ' IS NOT NULL )';

                $this->where .= ' AND ' . $v['where'];
                $this->db->select($fields);
                $this->db->where($this->where);
                $this->db->from($obj->table);

                $cnt = $this->db->count_all_results();
                $err = $cnt > 0 ? false : true;
            }
            else
            {
                $filter = $v['where'];
                if (count($obj->attributes) > 0)
                {
                    foreach ($obj->attributes as $key => $value)
                    {
                        if (strlen($filter))
                            $filter .= " AND $key = '$value'";
                        else
                            $filter .= " $key = '$value'";
                    }
                }

                $this->db->where($filter);
                $this->db->from($obj->table);

                $cnt = $this->db->count_all_results();
                $err = $cnt > 0 ? false : true;
            }

//            echo $this->db->last_query() . ";\n";
//            echo $obj->table ."=".strtolower($v['model'])."\n";
//            unset($this->obj);
//            unset($obj);
//            echo $v['rules']."=".$cnt."xx";
            if ($err)
            {
//                echo $v['label'] . ' tidak boleh kosong';
                $ret['errors'][] = array('model' => get_class($obj), 'message' => $v['label'] . ' tidak boleh kosong');
            }
        }

        if (count($ret['errors']) > 0)
        {
//$this->session->set_flashdata($ret);
            return $ret;
        }

        return false;
    }

    public function view_data_vendor()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        if ($this->_is_ajax_request())
            $this->load->view('vendor/view_data_vendor');
        else
            $this->layout->view('vendor/view_data_vendor');
    }

    public function view_checklist_doc()
    {
        $this->load->view('vendor/view_checklist_doc');
    }
    
    public function _view()
    {
        $this->load->view('vendor/_view');
    }

    public function _view_temp()
    {
        $this->load->view('vendor/_view_temp');
    }

    public function _editor()
    {
        $this->load->view('vendor/_editor');
    }

    public function start_wkf_registration()
    {
        
    }

}
?>
