<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 't_account';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'full_name', 'email', 'password', 'telp', 'active_account', 'hak_akses', 'address', 'image_profile'];

    //View paggination semua seller
    public function AllSellerPagination()
    {
        $data = $this->select('id,username, full_name, email, telp, active_account, address')->where('hak_akses', '2');
        return $data;
    }

    //View paggination semua seller berdasarkan keyword
    public function FindSellerPagination($keyword)
    {
        $data = $this->select('id,username, full_name, email, telp, active_account, address');
        $data = $data->like('username', $keyword)->orLike('full_name', $keyword)->orLike('address', $keyword)->orLike('active_account', $keyword);
        $data = $data->where('hak_akses', '2');
        return $data;
    }

    //select semua data user by username
    public function detailUser($username)
    {
        $data = $this->select('id,username,full_name,email,password,telp,active_account,hak_akses,address,image_profile');
        $data = $this->where('username', $username)->where('hak_akses', '2')->first();
        return $data;
    }

    //select semua data profile by id
    public function profileUser($id)
    {
        $data = $this->select('id,username,full_name,email,password,telp,active_account,hak_akses,address,image_profile');
        $data = $this->where('id', $id)->first();
        return $data;
    }

    //delete seller
    public function deleteSeller($id)
    {
        $this->where('id', $id)->delete();
    }
}
