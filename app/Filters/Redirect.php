<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Redirect implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak ada tindakan sebelum request diproses
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Periksa apakah pengguna sudah login
        if (session()->has('isLoggedIn')) {
            // Dapatkan peran pengguna dari session
            $role = session()->get('role');

            // Arahkan pengguna berdasarkan peran
            if ($role === 'admin') {
                return redirect()->to('/admin/dashboard'); // Halaman admin
            } elseif ($role === 'user') {
                return redirect()->to('/user/dashboard'); // Halaman user
            } else {
                return redirect()->to('/'); // Halaman default
            }
        }
    }
}