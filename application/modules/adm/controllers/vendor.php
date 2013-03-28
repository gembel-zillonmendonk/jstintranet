<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author FM
 */
class vendor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->session->set_userdata('user_id', '512');
        $this->session->set_userdata('user_id', '7827400');
    }

    public function createOrEdit()
    {
        $this->layout->view('vendor/createOrEdit');
    }

    public function activation()
    {
        // validation rules
        $where = 'KODE_VENDOR = ' . $this->session->userdata('user_id');
        $rules = array(
            // tabs-1
            array('model' => 'ep_vendor_perusahaan', 'label' => 'NAMA PERUSAHAAN', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_alamat', 'label' => 'KONTAK PERUSAHAAN', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_kontak_person', 'label' => 'KONTAK PERSON', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_jamsostek', 'label' => 'KEPESERTAAN JAMSOSTEK', 'rules' => 'required', 'where' => $where),
            // tabs-2
            array('model' => 'ep_vendor_akta', 'label' => 'AKTA PENDIRIAN', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_domisili', 'label' => 'DOMISILI PERUSAHAAN', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_npwp', 'label' => 'NPWP', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_mitra', 'label' => 'JENIS MITRA KERJA', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_siup', 'label' => 'SIUP', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_ijin', 'label' => 'IJIN LAIN-LAIN (OPSIONAL)', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_tdp', 'label' => 'TDP', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_agen', 'label' => 'SURAT KEAGENAN/DISTRIBUTORSHIP (OPSIONAL)', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_importir', 'label' => 'ANGKA PENGENAL IMPORTIR (OPSIONAL)', 'rules' => 'hasOne', 'where' => $where),
            // tabs-3
            array('model' => 'ep_vendor_komisaris', 'label' => 'DEWAN KOMISARIS', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_direksi', 'label' => 'DEWAN DIREKSI', 'rules' => 'hasOne', 'where' => $where),
            // tabs-4
            array('model' => 'ep_vendor_bank', 'label' => 'REKENING BANK', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_modal', 'label' => 'MODAL SESUAI DENGAN AKTA TERAKHIR', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_laporan_keuangan', 'label' => 'INFORMASI LAPORAN KEUANGAN', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_klasifikasi', 'label' => 'KLASIFIKASI PERUSAHAAN', 'rules' => 'required', 'where' => $where),
            // tabs-5
            array('model' => 'ep_vendor_barang', 'label' => 'BARANG YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_jasa', 'label' => 'JASA YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $where),
            // tabs-6
            array('model' => 'ep_vendor_tenaga_utama', 'label' => 'TENAGA AHLI UTAMA', 'rules' => 'hasOne', 'where' => $where),
            array('model' => 'ep_vendor_tenaga_pendukung', 'label' => 'TENAGA AHLI PENDUKUNG', 'rules' => 'hasOne', 'where' => $where),
            // tabs-7
            array('model' => 'ep_vendor_sertifikat', 'label' => 'KETERANGAN SERTIFIKAT', 'rules' => 'hasOne', 'where' => $where),
            // tabs-8
            array('model' => 'ep_vendor_peralatan', 'label' => 'KETERANGAN TENTANG FASILITAS / PERALATAN', 'rules' => 'hasOne', 'where' => $where),
            // tabs-10
            array('model' => 'ep_vendor_principal', 'label' => 'PRINCIPAL', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_subkontraktor', 'label' => 'SUBKONTRAKTOR', 'rules' => 'required', 'where' => $where),
            array('model' => 'ep_vendor_afiliasi', 'label' => 'PERUSAHAAN AFILIASI', 'rules' => 'required', 'where' => $where),
        );

        if ($return = $this->xvalidation($rules))
        {
            //$this->load->view('myform');
            echo json_encode($return);
//            echo "<pre>";
//            print_r($this->session->flashdata('errors'));
//            echo "false";
        }
    }

    public function xvalidation($rules = array())
    {
        if (count($rules) == 0)
            return false;

        $ret = array('errors' => array());
        foreach ($rules as $v)
        {
            if (!isset($v['rules']))
                return false;

            $obj = $this->_load_model($v['model']);
            if ($v['rules'] == 'required')
            {
                $fields = implode(',', array_keys($obj->validation, array('required' => true)));
                $where = '( ' . implode(' IS NULL OR ', array_keys($obj->validation, array('required' => true))) . ' IS NULL )';

                $where .= ' AND ' . $v['where'];
                $this->db->select($fields);
                $this->db->where($where);
                $this->db->from($obj->table);
            }
            else
            {
                $this->db->where($v['where']);
                $this->db->from($obj->table);
            }

            if ($this->db->count_all_results() > 0)
            {
                $ret['errors'][] = array('model' => $v['model'], 'message' => $v['label'] . ' tidak boleh kosong');
            }
        }

        if (count($ret['errors']) > 0)
        {
            $this->session->set_flashdata($ret);
            return $ret;
        }

        return false;
    }

    private function _load_model($model, $type = 'grid', $return = true)
    {
        if (file_exists(APPPATH . 'models/' . strtolower($model) . '.php'))
        {
            $this->load->model(strtolower($model), 'crud_model', true);
        }
        else
        {
            show_error("Cannot find model " . $model);
        }

        if ($return)
            return $this->crud_model;
    }

}
?>
