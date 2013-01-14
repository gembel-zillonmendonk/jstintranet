<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pgd extends MY_Controller {

    public function pengadaan() {
        $query = $this->db->query("select kode_kantor, nama_kantor from MS_KANTOR order by nama_kantor")->result_array();
        $kantor = array();
        if ($query > 0) {
            foreach ($query as $v) {
                $kantor[$v['KODE_KANTOR']] = $v['NAMA_KANTOR'];
            }
        }
        $this->layout->view('pgd/pengadaan', array(
            'kantor' => $kantor,
        ));
    }

    public function rekap_perencanaan() {
        $this->layout->view('pgd/rekap_perencanaan');
    }

    public function kinerja_pengadaan() {
        $query = $this->db->query("select kode_kantor, nama_kantor from MS_KANTOR order by nama_kantor")->result_array();
        $kantor = array();
        if ($query > 0) {
            foreach ($query as $v) {
                $kantor[$v['KODE_KANTOR']] = $v['NAMA_KANTOR'];
            }
        }
        $this->layout->view('pgd/kinerja_pengadaan', array(
            'kantor' => $kantor,
        ));
    }

    public function rekap_pengadaan() {
        $query = $this->db->query("select kode_jabatan, nama_jabatan from MS_JABATAN order by nama_jabatan")->result_array();
        $jabatan = array();
        if ($query > 0) {
            foreach ($query as $v) {
                $jabatan[$v['KODE_JABATAN']] = $v['NAMA_JABATAN'];
            }
        }
        $this->layout->view('pgd/rekap_pengadaan', array(
            'jabatan' => $jabatan
        ));
    }

    public function kinerja_pengadaan_perbiro() {
        $query = $this->db->query("select kode_kantor, nama_kantor from MS_KANTOR where kode_tipe = 2 order by nama_kantor")->result_array();
        $jabatan = array();
        if ($query > 0) {
            foreach ($query as $v) {
                $jabatan[$v['KODE_KANTOR']] = $v['NAMA_KANTOR'];
            }
        }
        $this->layout->view('pgd/kinerja_pengadaan_perbiro', array(
            'jabatan' => $jabatan
        ));
    }

    public function kinerja_pengadaan_perpelaksana() {
        $query = $this->db->query("select KODE_KANTOR, NAMA_KANTOR from MS_KANTOR where kode_tipe = 2 order by nama_kantor")->result_array();
        $jabatan = array();
        if ($query > 0) {
            foreach ($query as $v) {
                $jabatan[$v['KODE_KANTOR']] = $v['NAMA_KANTOR'];
            }
        }


        $this->load->model('opsi');
        $pelaksana = $this->opsi->getPenataPerencana();
        $this->layout->view('pgd/kinerja_pengadaan_perpelaksana', array(
            'jabatan' => $jabatan,
            'pelaksana' => $pelaksana,
        ));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */