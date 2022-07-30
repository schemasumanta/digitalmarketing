<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tabel extends CI_Model {

    function get_datatables($type=null,$sort=null,$order=null,$search=null)
    {
        $this->_get_datatables_query($type,$sort,$order,$search);
        if($type != 'laporan_pasien'){
            if($_GET['length'] != -1){
                $this->db->limit($_GET['length'], $_GET['start']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }


    private function _get_datatables_query($type=null,$sort=null,$order=null,$search=null)
    {         
        switch ($type) {

            case 'nasabah':
            $this->db->select('a.*');
            $this->db->from('nasabah a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.kode',$search);
                $this->db->or_like('a.nama',$search);
                $this->db->or_like('a.email',$search);
                $this->db->or_like('a.tgl_masuk',$search);
            }
            
            break;

            case 'subscribe':
            $this->db->select('a.*');
            $this->db->from('tbl_subscribe a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id_subscribe',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.id_subscribe',$search);
                $this->db->or_like('a.tgl_subscribe',$search);
                $this->db->or_like('a.email_subscribe',$search);
            }
            
            break;

            case 'syarat':
            $this->db->select('a.*');
            $this->db->from('syarat_ketentuan a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id_syarat',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.id_syarat',$search);
                $this->db->or_like('a.syarat',$search);
            }
            
            break;

             case 'about':
            $this->db->select('a.*');
            $this->db->from('tbl_about_us a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.about_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.about_id',$search);
                $this->db->or_like('a.about_isi',$search);
            }
            
            break;


             case 'feature':
            $this->db->select('a.*');
            $this->db->from('tbl_feature a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.feature_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.feature_id',$search);
                $this->db->or_like('a.feature_isi',$search);
            }
            
            break;


            case 'clients':
            $this->db->select('a.*');
            $this->db->from('tbl_clients a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.clients_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.clients_id',$search);
                $this->db->or_like('a.clients_nama',$search);
            }
            
            break;

            case 'pengawas':
            $this->db->select('a.*');
            $this->db->from('tbl_pengawas a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pengawas_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.pengawas_id',$search);
                $this->db->or_like('a.pengawas_nama',$search);
            }
            
            break;
            case 'testimoni':
            $this->db->select('a.*');
            $this->db->from('tbl_testimoni a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.testimoni_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.testimoni_id',$search);

                $this->db->or_like('a.testimoni_nama',$search);
                $this->db->or_like('a.testimoni_jabatan',$search);
                $this->db->or_like('a.testimoni_isi',$search);
            }
            
            break;

            case 'profile':
            $this->db->select('a.*');
            $this->db->from('tbl_profile a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id_profile',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.nama_website',$search);
                $this->db->or_like('a.pemilik',$search);
                $this->db->or_like('a.email_profile',$search);
                $this->db->or_like('a.telp_profile',$search);
            }
            
            break;

            case 'produk':
            $this->db->select('a.*,b.nama_kategori');
            $this->db->join('tbl_kategori_produk b','b.id_kategori=a.id_kategori');
            $this->db->from('tbl_master_produk a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.nama_produk',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.id_produk',$search);
                $this->db->or_like('b.nama_kategori',$this->session->kode);
                $this->db->or_like('a.nama_produk',$this->session->kode);
                $this->db->or_like('a.keterangan_produk',$this->session->kode);
            }

            break;

            case 'galeri':
            $this->db->select('a.*,b.nama_kategori');
            $this->db->join('tbl_kategori_produk b','b.id_kategori=a.id_kategori');
            $this->db->from('tbl_galeri_foto a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id_galeri',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.judul_foto',$search);
                $this->db->or_like('b.nama_kategori',$this->session->kode);
                $this->db->or_like('a.deskripsi_foto',$this->session->kode);
                $this->db->or_like('a.id_galeri',$this->session->kode);
            }

            break;


            case 'history_cicilan':
            $this->db->select('a.*,(a.jumlah + a.bunga +a.denda)as total,b.kode_nasabah');
            $this->db->where('b.kode_nasabah',$this->session->kode);
            $this->db->where('MONTH(a.tanggal_dibayarkan)',date('m'));
            $this->db->where('YEAR(a.tanggal_dibayarkan)',date('Y'));
            $this->db->join('pinjaman b','b.pinjaman_id=a.pinjaman_id');
            $this->db->from('cicilan a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.tanggal_dibayarkan',$search);
                $this->db->where('b.kode_nasabah',$this->session->kode);
                $this->db->where('MONTH(a.tanggal_dibayarkan)',date('m'));
                $this->db->where('YEAR(a.tanggal_dibayarkan)',date('Y'));

                $this->db->or_like('a.pinjaman_id',$search);
                $this->db->where('b.kode_nasabah',$this->session->kode);
                $this->db->where('MONTH(a.tanggal_dibayarkan)',date('m'));
                $this->db->where('YEAR(a.tanggal_dibayarkan)',date('Y'));


            }

            break;


            case 'history_simpanan':
            $this->db->select('a.*');
            $this->db->where('a.kode_nasabah',$this->session->kode);
            $this->db->where('MONTH(a.tanggal)',date('m'));
            $this->db->where('YEAR(a.tanggal)',date('Y'));

            $this->db->from('simpanan a');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }



            if ($search!=null && $search!='') {
                $this->db->like('a.jenis',$search);
                $this->db->where('a.kode_nasabah',$this->session->kode);
                $this->db->where('MONTH(a.tanggal)',date('m'));
                $this->db->where('YEAR(a.tanggal)',date('Y'));
            }

            break;



            case 'simpanan':
            $this->db->select('a.*,b.nama,SUM(a.jumlah) as saldo');
            $this->db->from('simpanan a');
            $this->db->join('nasabah b','b.kode=a.kode_nasabah');


            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }



            if ($search!=null && $search!='') {
                $this->db->like('a.kode',$search);
                $this->db->or_like('a.nama',$search);
                $this->db->or_like('a.tgl_masuk',$search);
            }

            $this->db->group_by('a.kode_nasabah');
            
            break;



            case 'pengajuan':
            $this->db->select('a.*,b.nama as marketing,c.nama_produk');
            $this->db->from('tbl_pengajuan a');
            $this->db->join('tbl_master_user b','b.id_user=a.id_user','left');
            $this->db->join('tbl_master_produk c','c.id_produk=a.id_produk','left');
            if ($this->session->level=="Marketing") {
                $this->db->where('a.id_user',$this->session->id_user);
            }
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id_pengajuan',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.kode_pengajuan',$search);
                $this->db->or_like('a.nik',$search);
                if ($this->session->level!="Marketing") {
                    $this->db->or_like('b.nama',$search);
                }
                $this->db->or_like('a.tanggal_input',$search);
                $this->db->or_like('a.nama',$search);
                $this->db->or_like('a.nama_usaha_pekerjaan',$search);
                $this->db->or_like('a.omset_usaha',$search);
                $this->db->or_like('c.nama_produk',$search);
                $this->db->or_like('a.besar_plafon',$search);
            }

            break;

            case 'potensi_wilayah':
            $this->db->select('a.*,b.nama as marketing');
            $this->db->from('tbl_nasabah a');
            $this->db->join('tbl_master_user b','b.id_user=a.id_user','left');
            $this->db->where('a.id_cabang',$this->session->cabang);

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.id_nasabah',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.id_nasabah',$search);
                $this->db->or_like('a.nama_nasabah',$search);
                $this->db->or_like('a.tanggal_input',$search);
                $this->db->or_like('a.alamat_nasabah',$search);

            }
            break;

            case 'cabang':
            $this->db->select('a.*');
            $this->db->from('tbl_master_cabang a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.nama_cabang',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.id_cabang',$search);
                $this->db->or_like('a.nama_cabang',$search);
                $this->db->or_like('a.telp_cabang',$search);

            }
            
            break;

            case 'portofolio':
            $this->db->select('a.*,b.nama');
            $this->db->join('tbl_master_user b','b.id_user=a.id_user');
            $this->db->from('tbl_portofolio a');
            if ($this->session->level=="Marketing") {
                $this->db->where('a.id_user',$this->session->id_user);
            }
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('b.nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.telepon_portofolio',$search);
                $this->db->or_like('a.sambutan_portofolio',$search);
                $this->db->or_like('a.alamat_portofolio',$search);
                $this->db->or_like('b.nama',$search);
            }
            
            break;

            case 'kategori_produk':
            $this->db->select('a.*');
            $this->db->from('tbl_kategori_produk a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.nama_kategori',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.id_kategori',$search);
                $this->db->or_like('a.nama_kategori',$search);
            }
            
            break;

            case 'jabatan':
            $this->db->select('a.*');
            $this->db->from('tbl_master_jabatan a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.nama_jabatan',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.id_jabatan',$search);
                $this->db->or_like('a.nama_jabatan',$search);
            }
            
            break;

            case 'pinjaman':
            $this->db->select('a.*,b.nama');
            $this->db->from('pinjaman a');
            $this->db->join('nasabah b','b.kode=a.kode_nasabah');
            $this->db->where('a.status','Disetujui');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pinjaman_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.pinjaman_id',$search);
                $this->db->where('a.status','Disetujui');

                $this->db->or_like('b.nama',$search);
                $this->db->where('a.status','Disetujui');

                $this->db->or_like('a.tanggal',$search);
                $this->db->where('a.status','Disetujui');

            }
            
            break;

            case 'pengajuan_pinjaman':
            $this->db->select('a.*,b.nama');
            $this->db->from('pinjaman a');
            $this->db->join('nasabah b','b.kode=a.kode_nasabah');

            $this->db->where('a.status','Pengajuan');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pinjaman_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->where('a.status','Pengajuan');

                $this->db->like('a.pinjaman_id',$search);
                $this->db->or_like('b.nama',$search);
                $this->db->where('a.status','Pengajuan');

                $this->db->or_like('a.tanggal',$search);
                $this->db->where('a.status','Pengajuan');

            }
            
            break;

            case 'pinjaman_lunas':
            $this->db->select('a.*,b.nama');
            $this->db->from('pinjaman a');
            $this->db->join('nasabah b','b.kode=a.kode_nasabah');

            $this->db->where('a.status','Lunas');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pinjaman_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->where('a.status','Lunas');

                $this->db->like('a.pinjaman_id',$search);
                $this->db->or_like('b.nama',$search);
                $this->db->where('a.status','Lunas');

                $this->db->or_like('a.tanggal',$search);
                $this->db->where('a.status','Lunas');

            }
            
            break;


            case 'pinjaman_tolak':
            $this->db->select('a.*,b.nama');
            $this->db->from('pinjaman a');
            $this->db->join('nasabah b','b.kode=a.kode_nasabah');

            $this->db->where('a.status','Ditolak');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pinjaman_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->where('a.status','Ditolak');

                $this->db->like('a.pinjaman_id',$search);
                $this->db->or_like('b.nama',$search);
                $this->db->where('a.status','Ditolak');

                $this->db->or_like('a.tanggal',$search);
                $this->db->where('a.status','Ditolak');

            }
            
            break;

            case 'pinjaman_saya':
            $this->db->select('a.*,b.nama');
            $this->db->where('a.kode_nasabah',$this->session->kode);

            $this->db->from('pinjaman a');
            $this->db->join('nasabah b','b.kode=a.kode_nasabah');

            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.pinjaman_id',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.pinjaman_id',$search);
                $this->db->or_like('b.nama',$search);
                $this->db->or_like('a.tanggal',$search);
            }
            
            break;
            case 'user':
            $this->db->select('a.*,b.*,c.*');
            $this->db->from('tbl_master_user a');
            $this->db->join('tbl_master_cabang b','b.id_cabang=a.id_cabang');
            $this->db->join('tbl_master_jabatan c','c.id_jabatan=a.id_jabatan');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.nama',$order);
            }else{
                $this->db->order_by($sort,$order);
            }
            if ($search!=null && $search!='') {
                $this->db->like('a.nama',$search);
                $this->db->or_like('a.email',$search);
                $this->db->or_like('a.username',$search);
                $this->db->or_like('a.level',$search);
            }
            
            break;


            case 'keanggotaan':
            $this->db->select('*');
            $this->db->from('keanggotaan a');
            if($_GET['order'][0]['column'] == 0)
            {
                $this->db->order_by('a.jenis',$order);
            }else{
                $this->db->order_by($sort,$order);
            }

            if ($search!=null && $search!='') {
                $this->db->like('a.jenis',$search);
                $this->db->or_like('a.keterangan',$search);
            }
            
            break;



            default:

            break;
        }
    }

    function count_filtered($type=null,$sort=null,$order=null,$search=null)
    {

        $this->_get_datatables_query($type,$sort,$order,$search);
        return $this->db->get()->num_rows();
        // return $query->num_rows();


    }



    public function count_all($type=null,$sort=null,$order=null,$search=null)
    {
        $this->_get_datatables_query($type,$sort,$order,$search);
        return $this->db->get()->num_rows();
        // $results = $db_results->result();
        // $num_rows = $db_results->num_rows();
        // return $num_rows;
    }

}
