<?php

namespace App\Models;

use CodeIgniter\Model;

class PhoneModel extends Model
{
    protected $table = 't_smartphone';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_smartphone', 'slug', 'merek', 'network', 'harga', 'tahun', 'tebal', 'berat', 'bahan_body', 'sim', 'tipe_sim', 'sim_stand', 'jenis_layar', 'jenis_protect_layar', 'resolution_layar', 'tipe_ui_os', 'jenis_chipset', 'nama_chipset', 'clock_speed_cpu', 'jumlah_core', 'jenis_gpu', 'nama_lengkap_gpu', 'internal_storage', 'ram', 'tipe_main_camera', 'resolusi_main_camera', 'selfie_camera', 'resolusi_selfie_camera', 'WLAN', 'bluetooth', 'infraret', 'radio', 'usb_tipe', 'fingerprint', 'face_sensor', 'tipe_batrai', 'kapasitas_batrai', 'tipe_charger', 'test_antutu', 'image1', 'image2', 'image3', 'id_seller'];

    public function allSmartphonePaginationAdmin($id_seller)
    {
        $data = $this->select('t_smartphone.id as id,slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller')->join('t_account', 't_account.id=t_smartphone.id_seller')->where('id_seller', $id_seller);
        return $data;
    }

    public function FindAllSmartphonePaginationAdmin($keyword, $id_seller)
    {
        $data = $this->select('t_smartphone.id as id,slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller')->join('t_account', 't_account.id=t_smartphone.id_seller');
        $data = $data->like('nama_smartphone', $keyword)->orLike('merek', $keyword)->orLike('t_account.full_name', $keyword)->where('id_seller', $id_seller);
        return $data;
    }

    public function findSmartphoneBySlug($slug)
    {
        $data = $this->where('slug', $slug)->first();
        return $data;
    }

    public function deletePhoneSeller($idSeller)
    {
        $this->where('id_seller', $idSeller)->delete();
    }

    //function hitung nilai fungsi keanggotaan
    public function Hitung_fk($id_smartphone, $variable_fk, $tabel_fk_model, $tabel_nilai_fk_model)
    {
        //periksa data ada atau tidak sesuai id_smartphone
        $cek = $this->table($tabel_nilai_fk_model)->where('id_smartphone',$id_smartphone)->first();
        //jika ada tidak perlu bikin, namun jika belum bikin mentahannya
        if ($cek==null) {
            $data = [
                'id_smartphone'=>$id_smartphone,
            ];
            $this->table($tabel_nilai_fk_model)->save($data);
        }
        $batas_keanggotaan = $this->table($tabel_fk_model)->where('ket_aktif', 'true')->findAll();
        foreach ($batas_keanggotaan as $keanggotaan) {
            if ($keanggotaan['kd_rules'] == 1) {
                // Rumus Linier Naik
                if ($variable_fk <= $keanggotaan['batas_bawah']) {
                    $nilai = 0;
                } elseif ($variable_fk >= $keanggotaan['batas_atas']) {
                    $nilai = 1;
                } else {
                    $nilai = ($variable_fk - $keanggotaan['batas_bawah']) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_bawah']);
                }
            } elseif ($keanggotaan['kd_rules'] == 2) {
                // Rumus Linier Turun
                if ($variable_fk <= $keanggotaan['batas_bawah']) {
                    $nilai = 1;
                } elseif ($variable_fk >= $keanggotaan['batas_atas']) {
                    $nilai = 0;
                } else {
                    $nilai = ($keanggotaan['batas_atas'] - $variable_fk) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_bawah']);
                }
            } elseif ($keanggotaan['kd_rules'] == 3) {
                // Rumus Segetiga
                if ($variable_fk <= $keanggotaan['batas_bawah'] || $variable_fk >= $keanggotaan['batas_atas']) {
                    $nilai = 0;
                } elseif ($keanggotaan['batas_tengah'] == $variable_fk) {
                    $nilai = 1;
                } elseif ($keanggotaan['batas_bawah'] <= $variable_fk && $variable_fk <= $keanggotaan['batas_tengah']) {
                    $nilai = ($variable_fk - $keanggotaan['batas_bawah']) / ($keanggotaan['batas_tengah'] - $keanggotaan['batas_bawah']);
                } elseif ($keanggotaan['batas_tengah'] <= $variable_fk && $variable_fk <= $keanggotaan['batas_atas']) {
                    $nilai = ($keanggotaan['batas_atas'] - $variable_fk) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_tengah']);
                }
            } elseif ($keanggotaan['kd_rules'] == 4) {
                // Rumus Sigmoid Pertumbuhan
                $rt = ($keanggotaan['batas_atas'] + $keanggotaan['batas_bawah']) / 2;
                if ($variable_fk <= $keanggotaan['batas_bawah']) {
                    $nilai = 0;
                } elseif ($variable_fk >= $keanggotaan['batas_atas']) {
                    $nilai = 1;
                } elseif ($variable_fk == $rt) {
                    $nilai = 1 / 2;
                } elseif ($keanggotaan['batas_bawah'] <= $variable_fk && $variable_fk <= $rt) {
                    $nilai = 2 * pow(($variable_fk - $keanggotaan['batas_bawah']) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_bawah']), 2);
                } elseif ($rt <= $variable_fk && $variable_fk <= $keanggotaan['batas_atas']) {
                    $nilai = 1 - (2 * pow(($keanggotaan['batas_atas'] - $variable_fk) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_bawah']), 2));
                }
            } elseif ($keanggotaan['kd_rules'] == 5) {
                // Rumus Sigmoid Penyusutan
                $rt = ($keanggotaan['batas_atas'] + $keanggotaan['batas_bawah']) / 2;
                if ($variable_fk <= $keanggotaan['batas_bawah']) {
                    $nilai = 1;
                } elseif ($variable_fk >= $keanggotaan['batas_atas']) {
                    $nilai = 0;
                } elseif ($variable_fk == $rt) {
                    $nilai = 1 / 2;
                } elseif ($keanggotaan['batas_bawah'] <= $variable_fk && $variable_fk <= $rt) {
                    $nilai = 1 - (2 * pow(($variable_fk - $keanggotaan['batas_bawah']) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_bawah']), 2));
                } elseif ($rt <= $variable_fk && $variable_fk <= $keanggotaan['batas_atas']) {
                    $nilai = 2 * pow(($keanggotaan['batas_atas'] - $variable_fk) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_bawah']), 2);
                }
            } else {
                // Rumus Kurva S
                if ($variable_fk <= $keanggotaan['batas_bawah'] || $variable_fk >= $keanggotaan['batas_atas']) {
                    $nilai = 0;
                } elseif ($variable_fk == $keanggotaan['batas_tengah']) {
                    $nilai = 1;
                } elseif ($keanggotaan['batas_bawah'] <= $variable_fk && $variable_fk <= $keanggotaan['batas_tengah']) {
                    $rt = ($keanggotaan['batas_tengah'] + $keanggotaan['batas_bawah']) / 2;
                    if ($variable_fk == $rt) {
                        $nilai = 1 / 2;
                    } elseif ($variable_fk < $rt) {
                        $nilai = 2 * pow(($variable_fk - $keanggotaan['batas_bawah']) / ($keanggotaan['batas_tengah'] - $keanggotaan['batas_bawah']), 2);
                    } else {
                        $nilai = 1 - (2 * pow(($keanggotaan['batas_tengah'] - $variable_fk) / ($keanggotaan['batas_tengah'] - $keanggotaan['batas_bawah']), 2));
                    }
                } elseif ($keanggotaan['batas_tengah'] <= $variable_fk && $variable_fk <= $keanggotaan['batas_atas']) {
                    $rt = ($keanggotaan['batas_atas'] + $keanggotaan['batas_tengah']) / 2;
                    if ($variable_fk == $rt) {
                        $nilai = 1 / 2;
                    } elseif ($variable_fk < $rt) {
                        $nilai = 1 - (2 * pow(($variable_fk - $keanggotaan['batas_tengah']) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_tengah']), 2));
                    } else {
                        $nilai = 2 * pow(($keanggotaan['batas_atas'] - $variable_fk) / ($keanggotaan['batas_atas'] - $keanggotaan['batas_tengah']), 2);
                    }
                }
            }
            $data = [
                'id_smartphone' => $id_smartphone,
                'keanggotaan' . $keanggotaan['id'] => $nilai
            ];
            //setelahnya masukan Update data keanggotaan
            $this->table($tabel_nilai_fk_model)->where('id_smartphone', $data['id_smartphone'])->set($data)->update();
        }
    }

}
