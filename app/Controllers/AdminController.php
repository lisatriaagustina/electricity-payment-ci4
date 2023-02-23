<?php

namespace App\Controllers;

use App\Models\Admin;

class AdminController extends BaseController
{
    public function manageAdmin()
    {
        $adminModel = new Admin();
        $data = [
            'listAdmin' => $adminModel->join('roles', 'roles.id_role = admin.id_role', 'left')->findAll()
        ];
        return view('manageAdmin/index', $data);
    }

    public function addAdmin()
    {
        // custom validasi
        if (!$this->validate([
            'name'      => 'required',
            'username'  => 'required|is_unique[admin.username]|is_unique[customers.username]',
            'password'  => 'required',
            // 'role'      => 'required'
        ])) {
            session()->setFlashdata('err-add-admin', $this->validator->listErrors());
            return redirect()->to('/manage-admin')->withInput();
        }

        // ambil data dari form
        $data = [
            'name'      => $this->request->getVar('name'),
            'username'  => $this->request->getVar('username'),
            // password di enkripsi secara default oleh sistem ci4
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            // 'id_role'   => $this->request->getVar('role')
        ];

        // panggil model / tabel admin dari database dan simpan ke database
        $adminModel = new Admin();
        $adminModel->save($data);

        // Tambah keterangan sukses
        session()->setFlashdata('msg-add-admin', 'Successfully added a new admin!');

        // kembalikan ke halaman manage admin
        return redirect()->to('/manage-admin');
    }
}
