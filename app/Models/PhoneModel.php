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
        $data = $this->select('t_smartphone.id as id,t_smartphone.slug as slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller')->join('t_account', 't_account.id=t_smartphone.id_seller')->where('id_seller', $id_seller);
        return $data;
    }

    public function allSmartphonePaginationForPublic()
    {
        $data = $this->select('t_smartphone.id as id,t_smartphone.slug as slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller,image1,image2,image3')->join('t_account', 't_account.id=t_smartphone.id_seller');
        return $data;
    }

    public function FindAllSmartphonePaginationAdmin($keyword, $id_seller)
    {
        $data = $this->select('t_smartphone.id as id,t_smartphone.slug as slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller')->join('t_account', 't_account.id=t_smartphone.id_seller');
        $data = $data->like('nama_smartphone', $keyword)->orLike('merek', $keyword)->orLike('t_account.full_name', $keyword)->where('id_seller', $id_seller);
        return $data;
    }

    public function FindAllSmartphonePaginationForPublic($keyword)
    {
        $data = $this->select('t_smartphone.id as id,t_smartphone.slug as slug,nama_smartphone,merek,tahun,harga,t_account.full_name as nama_seller,image1,image2,image3')->join('t_account', 't_account.id=t_smartphone.id_seller');
        $data = $data->like('nama_smartphone', $keyword)->orLike('merek', $keyword)->orLike('t_account.full_name', $keyword);
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
        $cek = $this->table($tabel_nilai_fk_model)->where('id_smartphone', $id_smartphone)->first();
        //jika ada tidak perlu bikin, namun jika belum bikin mentahannya
        if ($cek == null) {
            $data = [
                'id_smartphone' => $id_smartphone,
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

    //Fuction filter Fuzzy Database tahani AND
    public function FuzzyDatabaseAND($Data, $merek, $harga, $ram, $internal, $tahun, $ui_os, $jns_processor, $speed_processor, $jenis_gpu, $antutu, $bahan_body, $resolusi_layar, $tipe_layar, $proteksi_layar, $kamera_belakang, $kapasitas_batrai, $usb_tipe)
    {
        //Kategori non fuzzy
        if ($merek != 0) {
            $Data = $Data->join('t_jenis_merek', 't_jenis_merek.nama_merek = t_smartphone.merek');
            $Data = $Data->where('t_jenis_merek.slug', $merek);
        }
        if ($ui_os != 0) {
            $Data = $Data->join('t_jenis_ui_os', 't_jenis_ui_os.nama_ui_os = t_smartphone.tipe_ui_os');
            $Data = $Data->where('t_jenis_ui_os.id', $ui_os);
        }
        if ($jns_processor != 0) {
            $Data = $Data->join('t_jenis_chipset', 't_jenis_chipset.nama_chipset = t_smartphone.jenis_chipset');
            $Data = $Data->where('t_jenis_chipset.id', $jns_processor);
        }
        if ($jenis_gpu != 0) {
            $Data = $Data->join('t_jenis_gpu', 't_jenis_gpu.nama_gpu = t_smartphone.jenis_gpu');
            $Data = $Data->where('t_jenis_gpu.id', $jenis_gpu);
        }
        if ($bahan_body != 0) {
            $Data = $Data->join('t_jenis_bahan_body', 't_jenis_bahan_body.nama_bahan_body = t_smartphone.bahan_body');
            $Data = $Data->where('t_jenis_bahan_body.id', $bahan_body);
        }
        if ($tipe_layar != 0) {
            $Data = $Data->join('t_jenis_layar', 't_jenis_layar.nama_jenis_layar = t_smartphone.jenis_layar');
            $Data = $Data->where('t_jenis_layar.id', $tipe_layar);
        }
        if ($proteksi_layar != 0) {
            $Data = $Data->join('t_jenis_protect_layar', 't_jenis_protect_layar.nama_protect_layar = t_smartphone.jenis_protect_layar');
            $Data = $Data->where('t_jenis_protect_layar.id', $proteksi_layar);
        }
        if ($usb_tipe != 0) {
            $Data = $Data->join('t_jenis_usb', 't_jenis_usb.nama_usb = t_smartphone.usb_tipe');
            $Data = $Data->where('t_jenis_usb.id', $usb_tipe);
        }

        $dt_harga = null;
        $dt_ram = null;
        $dt_internal = null;
        $dt_tahun = null;
        $dt_processor = null;
        $dt_antutu = null;
        $dt_layar = null;
        $dt_kamera = null;
        $dt_batrai = null;


        // Kategori Fuzzy
        // -----------FK HARGA-----------
        if ($harga != 0) {
            $dt_harga = true;
            $Data = $Data->select('nilai_fk_harga.keanggotaan' . $harga . ' as keanggotaan_harga')->join('nilai_fk_harga', 'nilai_fk_harga.id_smartphone=t_smartphone.id');
        }
        // RAM
        if ($ram != 0) {
            $dt_ram = true;
            $Data = $Data->select('nilai_fk_ram.keanggotaan' . $ram . ' as keanggotaan_ram')->join('nilai_fk_ram', 'nilai_fk_ram.id_smartphone=t_smartphone.id');
        }
        // INTERNAL
        if ($internal != 0) {
            $dt_internal = true;
            $Data = $Data->select('nilai_fk_internal.keanggotaan' . $internal . ' as keanggotaan_internal')->join('nilai_fk_internal', 'nilai_fk_internal.id_smartphone=t_smartphone.id');
        }
        // TAHUN
        if ($tahun != 0) {
            $dt_tahun = true;
            $Data = $Data->select('nilai_fk_tahun.keanggotaan' . $tahun . ' as keanggotaan_tahun')->join('nilai_fk_tahun', 'nilai_fk_tahun.id_smartphone=t_smartphone.id');
        }
        // SPEED_PROCESSOR
        if ($speed_processor != 0) {
            $dt_processor = true;
            $Data = $Data->select('nilai_fk_processor.keanggotaan' . $speed_processor . ' as keanggotaan_speed_processor')->join('nilai_fk_processor', 'nilai_fk_processor.id_smartphone=t_smartphone.id');
        }
        // ANTUTU
        if ($antutu != 0) {
            $dt_antutu = true;
            $Data = $Data->select('nilai_fk_antutu.keanggotaan' . $antutu . ' as keanggotaan_antutu')->join('nilai_fk_antutu', 'nilai_fk_antutu.id_smartphone=t_smartphone.id');
        }
        // RESOLUSI_LAYAR
        if ($resolusi_layar != 0) {
            $dt_layar = true;
            $Data = $Data->select('nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' as keanggotaan_resolusi_layar')->join('nilai_fk_resolusi_layar', 'nilai_fk_resolusi_layar.id_smartphone=t_smartphone.id');
        }
        // KAMERA_BELAKANG
        if ($kamera_belakang != 0) {
            $dt_kamera = true;
            $Data = $Data->select('nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' as keanggotaan_kamera_belakang')->join('nilai_fk_resolusi_kamera', 'nilai_fk_resolusi_kamera.id_smartphone=t_smartphone.id');
        }
        // KAPASITAS BATRAI
        if ($kapasitas_batrai != 0) {
            $dt_batrai = true;
            $Data = $Data->select('nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ' as keanggotaan_batrai')->join('nilai_fk_batrai', 'nilai_fk_batrai.id_smartphone=t_smartphone.id');
        }

        //////////////////////////////////////////////////////////////////////////////
        if ($dt_harga == true) {
            if ($dt_ram == true) {
                if ($dt_internal == true) {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //ALL
                                            $Data = $Data->select(
                                                'IF(
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_harga.keanggotaan' . $harga . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_harga.keanggotaan' . $harga . ',
                                                IF(
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_ram.keanggotaan' . $ram . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_ram.keanggotaan' . $ram . ',
                                                IF(
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_internal.keanggotaan' . $internal . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_internal.keanggotaan' . $internal . ',
                                                IF(
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_tahun.keanggotaan' . $tahun . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_tahun.keanggotaan' . $tahun . ',
                                                IF(
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_processor.keanggotaan' . $speed_processor . ',
                                                IF(
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_antutu.keanggotaan' . $antutu . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_antutu.keanggotaan' . $antutu . ',
                                                IF(
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' and
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ',
                                                IF(
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_harga.keanggotaan' . $harga . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_ram.keanggotaan' . $ram . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_internal.keanggotaan' . $internal . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_tahun.keanggotaan' . $tahun . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_processor.keanggotaan' . $speed_processor . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_antutu.keanggotaan' . $antutu . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_resolusi_layar.keanggotaan' . $resolusi_layar . ' and
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ' <= nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . ',
                                                nilai_fk_resolusi_kamera.keanggotaan' . $kamera_belakang . ',
                                                nilai_fk_batrai.keanggotaan' . $kapasitas_batrai . '
                                                )
                                                )
                                                )
                                                )
                                                )
                                                )
                                                )
                                                ) as fungsi_keanggotaan_database_tahani_and'
                                            );
                                            //Setelah mencari nilai fk_database tahaninya di urutkan berdasarkan rekomendasi
                                            $Data = $Data->orderBy('fungsi_keanggotaan_database_tahani_and', 'DESC');
                                            $Data = $Data->orderBy('t_smartphone.id', 'DESC');
                                        } else {
                                            //Kecuali Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Kamera
                                        } else {
                                            //Kecuali Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Layar
                                        } else {
                                            //Kecuali Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Layar dan Kamera
                                        } else {
                                            //Kecuali Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Antutu
                                        } else {
                                            //Kecuali Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Antutu dan Kamera
                                        } else {
                                            //Kecuali Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Antutu dan Layar
                                        } else {
                                            //Kecuali Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Processor
                                        } else {
                                            //Kecuali Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor dan Kamera
                                        } else {
                                            //Kecuali Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor dan Layar
                                        } else {
                                            //Kecuali Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor dan Antutu
                                        } else {
                                            //Kecuali Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun
                                        } else {
                                            //Kecuali Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun dan Kamera
                                        } else {
                                            //Kecuali Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun dan Layar
                                        } else {
                                            //Kecuali Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun dan Antutu
                                        } else {
                                            //Kecuali Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Tahun dan Processor
                                        } else {
                                            //Kecuali Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal
                                        } else {
                                            //Kecuali Internal dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal dan Kamera
                                        } else {
                                            //Kecuali Internal, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal dan Layar
                                        } else {
                                            //Kecuali Internal, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal dan Antutu
                                        } else {
                                            //Kecuali Internal, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Antutu dan Kamera
                                        } else {
                                            //Kecuali Internal, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Antutu dan Layar
                                        } else {
                                            //Kecuali Internal, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Internal dan Processor
                                        } else {
                                            //Kecuali Internal, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor dan Kamera
                                        } else {
                                            //Kecuali Internal, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor dan Layar
                                        } else {
                                            //Kecuali Internal, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor dan Antutu
                                        } else {
                                            //Kecuali Internal, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Internal, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Internal, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal dan Tahun
                                        } else {
                                            //Kecuali Internal, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun dan Layar
                                        } else {
                                            //Kecuali Internal, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun dan Antutu
                                        } else {
                                            //Kecuali Internal, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali Internal, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Internal, Tahun dan Processor
                                        } else {
                                            //Kecuali Internal, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Internal, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Internal, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if ($dt_internal == true) {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM
                                        } else {
                                            //Kecuali RAM dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM dan Kamera
                                        } else {
                                            //Kecuali RAM, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM dan Layar
                                        } else {
                                            //Kecuali RAM, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Antutu
                                        } else {
                                            //Kecuali RAM, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali RAM dan Processor
                                        } else {
                                            //Kecuali RAM, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor dan Kamera
                                        } else {
                                            //Kecuali RAM, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor dan Layar
                                        } else {
                                            //Kecuali RAM, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor dan Antutu
                                        } else {
                                            //Kecuali RAM, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM dan Tahun
                                        } else {
                                            //Kecuali RAM, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun dan Layar
                                        } else {
                                            //Kecuali RAM, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun dan Antutu
                                        } else {
                                            //Kecuali RAM, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali RAM, Tahun dan Processor
                                        } else {
                                            //Kecuali RAM, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM dan Internal
                                        } else {
                                            //Kecuali RAM dan Internal dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal dan Antutu
                                        } else {
                                            //Kecuali RAM, Internal, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali RAM, Internal dan Processor
                                        } else {
                                            //Kecuali RAM, Internal, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor dan Antutu
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal dan Tahun
                                        } else {
                                            //Kecuali RAM, Internal, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun dan Antutu
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali RAM, Internal, Tahun dan Processor
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali RAM, Internal, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if ($dt_ram == true) {
                if ($dt_internal == true) {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga
                                        } else {
                                            //Kecuali Harga dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga dan Kamera
                                        } else {
                                            //Kecuali Harga, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga dan Layar
                                        } else {
                                            //Kecuali Harga, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Antutu
                                        } else {
                                            //Kecuali Harga, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga dan Processor
                                        } else {
                                            //Kecuali Harga, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga dan Tahun
                                        } else {
                                            //Kecuali Harga, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun dan Layar
                                        } else {
                                            //Kecuali Harga, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun dan Antutu
                                        } else {
                                            //Kecuali Harga, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, Tahun dan Processor
                                        } else {
                                            //Kecuali Harga, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga dan Internal
                                        } else {
                                            //Kecuali Harga, Internal dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal dan Antutu
                                        } else {
                                            //Kecuali Harga, Internal, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, Internal dan Processor
                                        } else {
                                            //Kecuali Harga, Internal, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal dan Tahun
                                        } else {
                                            //Kecuali Harga, Internal, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun dan Antutu
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, Internal, Tahun dan Processor
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, Internal, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if ($dt_internal == true) {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga dan RAM
                                        } else {
                                            //Kecuali Harga, RAM dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, RAM dan Processor
                                        } else {
                                            //Kecuali Harga, RAM, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM dan Tahun
                                        } else {
                                            //Kecuali Harga, RAM, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, RAM, Tahun dan Processor
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($dt_tahun == true) {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM dan Internal
                                        } else {
                                            //Kecuali Harga, RAM, Internal dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, RAM, Internal dan Processor
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($dt_processor == true) {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal dan Tahun
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($dt_antutu == true) {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //kecuali Harga, RAM, Internal, Tahun dan Processor
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            } else {
                                if ($dt_layar == true) {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor dan Antutu
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu, Kamera dan Batrai
                                        }
                                    }
                                } else {
                                    if ($dt_kamera == true) {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu dan Layar
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu, Layar dan Batrai
                                        }
                                    } else {
                                        if ($dt_batrai == true) {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu, Layar dan Kamera
                                        } else {
                                            //Kecuali Harga, RAM, Internal, Tahun, Processor, Antutu, Layar, Kamera dan Batrai
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $Data;
    }
}
