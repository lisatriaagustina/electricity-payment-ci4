<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\Customers;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        // menghapus pesan error sebelumnya dan mengambil data dari form
        $session->removeTempdata('err-auth');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // custom validasi
        if (!$this->validate([
            'username'      => 'required',
            'password'      => 'required',
        ])) {
            $session->setFlashdata('err-auth', $this->validator->listErrors());
            return redirect()->to('/login')->withInput();
        }

        // Buat variabel untuk menyimpan data
        $user = null;
        $data_session = null;

        // panggil model / tabel admin dan cari user, digabung dengan tabel roles untuk mengambil nama role nya
        $adminModel = new Admin();
        $user = $adminModel->where('username', $username)->join('roles', 'roles.id_role = admin.id_role', 'left')->first();
        if ($user) {
            $data_session = [
                'id_user'   => $user['id_admin'],
                'username'  => $user['username'],
                'name'      => $user['name'],
                'role'      => $user['role_name'],
                'IS_LOGIN'  => true
            ];
        }

        // jika user pada tabel admin tidak ditemukan cari di tabel pelanggan
        if (!$user) {
            // panggil model / tabel pelanggan dan cari user, digabung dengan tabel roles untuk mengambil nama role nya
            $customersModel = new Customers();
            $user = $customersModel->where('username', $username)->where('is_active', 1)->first();
            if ($user) {
                $data_session = [
                    'id_user'   => $user['id_customer'],
                    'username'  => $user['username'],
                    'name'      => $user['name'],
                    'address'      => $user['address'],
                    'role'      => 'customer',
                    'IS_LOGIN'  => true
                ];
            }
        }

        // Jika user tidak ditemukan pada 2 tabel maka kembalikan ke halaman login dengan pesan username tidak ditemukan
        if (!$user) {
            $session->setFlashdata('err-auth', 'Username Not Found!');
            return redirect()->to('/login')->withInput();
        }

        // Jika user ketemu, maka cek passwordnya menggunakan sistem ci4 apakah benar ? Kalau iya simpan data user di sistem ci4 / session lalu pindahkan ke dashboard
        if (password_verify($password, $user['password'])) {
            $session->set($data_session);
            return redirect()->to('/');
        }

        // kalau password salah kembalikan ke halaman login dengan pesan password salah
        $session->setFlashdata('err-auth', 'Wrong Password!');
        return redirect()->to('/login')->withInput();
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
