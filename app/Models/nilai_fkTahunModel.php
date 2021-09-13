<?php

namespace App\Models;

use CodeIgniter\Model;

class nilai_fkTahunModel extends Model
{
    protected $table = 'nilai_fk_tahun';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_smartphone', 'keanggotaan1', 'keanggotaan2', 'keanggotaan3', 'keanggotaan4', 'keanggotaan5'];

    //function hitung nilai fungsi keanggotaan
    public function Hitung_fk($id_smartphone, $variable_fk, $batas_keanggotaan)
    {
        //periksa data ada atau tidak sesuai id_smartphone
        $cek = $this->where('id_smartphone', $id_smartphone)->first();
        //jika ada tidak perlu bikin, namun jika belum bikin mentahannya
        if ($cek == null) {
            $data = [
                'id_smartphone' => $id_smartphone,
            ];
            $this->save($data);
        }
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
            $this->where('id_smartphone', $data['id_smartphone'])->set($data)->update();
        }
    }
}
