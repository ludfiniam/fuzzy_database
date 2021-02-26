<?php

namespace App\Models;

use CodeIgniter\Model;

class PhoneModel extends Model
{
    protected $table = 't_smartphone';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_smartphone','slug','merek','network','harga','tahun','tebal','berat','bahan_body','sim','tipe_sim','sim_stand','jenis_layar','jenis_protect_layar','resolution_layar','tipe_ui_os','jenis_chipset','nama_chipset','clock_speed_cpu','jumlah_core','jenis_gpu','nama_lengkap_gpu','internal_storage','ram','tipe_main_camera','resolusi_main_camera','selfie_camera','resolusi_selfie_camera','WLAN','bluetooth','infraret','radio','usb_tipe','fingerprint','face_sensor','tipe_batrai','kapasitas_batrai','tipe_charger','test_antutu','image1','image2','image3','id_seller'];

    public function allSmartphonePaginationAdmin($id_seller)
    {
    	$data = $this->select('t_smartphone.id as id,slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller')->join('t_account','t_account.id=t_smartphone.id_seller')->where('id_seller',$id_seller);
    	return $data;
    }

    public function FindAllSmartphonePaginationAdmin($keyword,$id_seller)
    {
    	$data = $this->select('t_smartphone.id as id,slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller')->join('t_account','t_account.id=t_smartphone.id_seller');
    	$data = $data->like('nama_smartphone',$keyword)->orLike('merek',$keyword)->orLike('t_account.full_name',$keyword)->where('id_seller',$id_seller);
    	return $data;
    }

    public function findSmartphoneBySlug($slug)
    {
    	$data = $this->where('slug',$slug)->first();
    	return $data;
    }
}
?>