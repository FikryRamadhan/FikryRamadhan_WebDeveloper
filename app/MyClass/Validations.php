<?php

namespace App\MyClass;

use App\Models\User;
use App\Rules\MatchOldPassword;

class Validations
{

	/**
	 * Authentication
	 */

	public static function loginValidate($request){
		$request->validate([
			'email' => 'required|exists:users',
		],[
			'email.required' => 'Username wajib diisi',
			'email.exists' => 'Username tidak ditemukan',
		]);
	}

	public static function registerValidate($request){
		$request->validate([
			'email' => 'required',
			'nama' => 'required',
			'password' => 'required',
			'role' => 'required',
			'alamat' => 'required',
		]);
	}

	/*
	 * For Validate Function Setting
	*/
	public static function validateProfile($request, $user){
		$request->validate([
			'nama' => 'required',
			'email' => 'required|unique:users,email,'.$user->id,
			'alamat' => 'required',
		],[
			'nama.required' => 'Nama Wajib Di Isi',
			'email.required' => 'Email Wajib Di Isi',
			'email.unique' => 'Email Sudah Terdaftar',
			'email.email' => 'Email Tidak valid',
			'alamat.required' => 'Alamat Wajib Diisi',
		]);
	}

	public static function validateChangePassword($request){
		$request->validate([
			'password' => ['required', new MatchOldPassword],
			'new_password' => 'required|min:6',
			'confirmation' => 'required|same:new_password',
		],[
			'password.required' => 'Password lama wajib diisi',
			'new_password.required' => 'Password baru wajib diisi',
			'new_password.min' => 'Password minimal 6 karakter',
			'confirmation.required' => 'Konfirmasi password wajib diisi',
			'confirmation.same' => 'Konfirmasi password tidak sama',
		]);
	}

	/**
	 * Validation Untuk Menu 
	 */

	public static function validateMenu($request){
        $request->validate([
			'nama' => 'required',
			'image' => 'required|image|mimes:jpg,jpeg,png',
			'harga' => 'required',
			'deskripsi' => 'required',
		],[
			'nama.required' => 'Nama Menu Wajib Diisi',
			'image.required' => 'Image Menu Wajib Diisi',
			'harga.required' => 'Harga Menu Wajib Diisi',
			'deskripsi.required' => 'Deskripsi Menu Wajib Diisi',
		]);
	}
	public static function validateMenuUpdate($request){
        $request->validate([
			'nama' => 'required',
			'image' => 'nullable|image|mimes:jpg,jpeg,png',
			'harga' => 'required',
			'deskripsi' => 'required',
		],[
			'nama.required' => 'Nama Menu Wajib Diisi',
			'image.required' => 'Image Menu Wajib Diisi',
			'harga.required' => 'Harga Menu Wajib Diisi',
			'deskripsi.required' => 'Deskripsi Menu Wajib Diisi',
		]);
	}

}
