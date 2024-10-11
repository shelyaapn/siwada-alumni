<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'user', 
			'label' => 'Pengguna', 
			'icon' => '<i class="fa fa-user "></i>'
		),
		
		array(
			'path' => 'pengumuman', 
			'label' => 'Pengumuman', 
			'icon' => '<i class="fa fa-info-circle "></i>'
		),
		
		array(
			'path' => 'loker', 
			'label' => 'Lowongan Pekerjaan', 
			'icon' => '<i class="fa fa-briefcase "></i>'
		),
		
		array(
			'path' => 'jurusan', 
			'label' => 'Jurusan', 
			'icon' => '<i class="fa fa-users "></i>'
		),
		
		array(
			'path' => 'mitra', 
			'label' => 'Mitra', 
			'icon' => '<i class="fa fa-gears "></i>'
		)
	);
		
	
	
			public static $jenis_kelamin = array(
		array(
			"value" => "L", 
			"label" => "Laki-laki", 
		),
		array(
			"value" => "P", 
			"label" => "Perempuan", 
		),);
		
			public static $pekerjaan_saat_ini = array(
		array(
			"value" => "Belum/ Tidak Bekerja", 
			"label" => "Belum/ Tidak Bekerja", 
		),
		array(
			"value" => "Mengurus Rumah Tangga", 
			"label" => "Mengurus Rumah Tangga", 
		),
		array(
			"value" => "Pelajar/ Mahasiswa", 
			"label" => "Pelajar/ Mahasiswa", 
		),
		array(
			"value" => "Dosen", 
			"label" => "Dosen", 
		),
		array(
			"value" => "Guru", 
			"label" => "Guru", 
		),
		array(
			"value" => "Pensiunan", 
			"label" => "Pensiunan", 
		),
		array(
			"value" => "Pegawai Negeri Sipil", 
			"label" => "Pegawai Negeri Sipil", 
		),
		array(
			"value" => "Tentara Nasional Indonesia", 
			"label" => "Tentara Nasional Indonesia", 
		),
		array(
			"value" => "Kepolisisan RI", 
			"label" => "Kepolisisan RI", 
		),
		array(
			"value" => "Wirausaha", 
			"label" => "Wirausaha", 
		),
		array(
			"value" => "Wiraswasta", 
			"label" => "Wiraswasta", 
		),
		array(
			"value" => "Petani/ Pekebun", 
			"label" => "Petani/ Pekebun", 
		),
		array(
			"value" => "Peternak", 
			"label" => "Peternak", 
		),
		array(
			"value" => "Nelayan/ Perikanan", 
			"label" => "Nelayan/ Perikanan", 
		),
		array(
			"value" => "Industri", 
			"label" => "Industri", 
		),
		array(
			"value" => "Konstruksi", 
			"label" => "Konstruksi", 
		),
		array(
			"value" => "Transportasi", 
			"label" => "Transportasi", 
		),
		array(
			"value" => "Karyawan Swasta", 
			"label" => "Karyawan Swasta", 
		),
		array(
			"value" => "Karyawan BUMN", 
			"label" => "Karyawan BUMN", 
		),
		array(
			"value" => "Karyawan BUMD", 
			"label" => "Karyawan BUMD", 
		),
		array(
			"value" => "Karyawan Honorer", 
			"label" => "Karyawan Honorer", 
		),
		array(
			"value" => "Buruh Harian Lepas", 
			"label" => "Buruh Harian Lepas", 
		),
		array(
			"value" => "Pembantu Rumah Tangga", 
			"label" => "Pembantu Rumah Tangga", 
		),
		array(
			"value" => "Penata Rias", 
			"label" => "Penata Rias", 
		),
		array(
			"value" => "Penata Busana", 
			"label" => "Penata Busana", 
		),
		array(
			"value" => "Penata Rambut", 
			"label" => "Penata Rambut", 
		),
		array(
			"value" => "Perancang Busana", 
			"label" => "Perancang Busana", 
		),
		array(
			"value" => "Seniman", 
			"label" => "Seniman", 
		),
		array(
			"value" => "Mekanik", 
			"label" => "Mekanik", 
		),
		array(
			"value" => "Penterjemah", 
			"label" => "Penterjemah", 
		),
		array(
			"value" => "Wartawan", 
			"label" => "Wartawan", 
		),
		array(
			"value" => "Juru Masak", 
			"label" => "Juru Masak", 
		),
		array(
			"value" => "Promotor Acara", 
			"label" => "Promotor Acara", 
		),
		array(
			"value" => "Pilot", 
			"label" => "Pilot", 
		),
		array(
			"value" => "Pengacara", 
			"label" => "Pengacara", 
		),
		array(
			"value" => "Notaris", 
			"label" => "Notaris", 
		),
		array(
			"value" => "Arsitek", 
			"label" => "Arsitek", 
		),
		array(
			"value" => "Akuntan", 
			"label" => "Akuntan", 
		),
		array(
			"value" => "Konsultan", 
			"label" => "Konsultan", 
		),
		array(
			"value" => "Dokter", 
			"label" => "Dokter", 
		),
		array(
			"value" => "Bidan", 
			"label" => "Bidan", 
		),
		array(
			"value" => "Perawat", 
			"label" => "Perawat", 
		),
		array(
			"value" => "Apoteker", 
			"label" => "Apoteker", 
		),
		array(
			"value" => "Psikiater/ Psikolog", 
			"label" => "Psikiater/ Psikolog", 
		),
		array(
			"value" => "Penyiar Televisi", 
			"label" => "Penyiar Televisi", 
		),
		array(
			"value" => "Penyiar Radio", 
			"label" => "Penyiar Radio", 
		),
		array(
			"value" => "Pelaut", 
			"label" => "Pelaut", 
		),
		array(
			"value" => "Peneliti", 
			"label" => "Peneliti", 
		),
		array(
			"value" => "Sopir", 
			"label" => "Sopir", 
		),
		array(
			"value" => "Pialang", 
			"label" => "Pialang", 
		),);
		
			public static $account_status = array(
		array(
			"value" => "Active", 
			"label" => "Active", 
		),
		array(
			"value" => "Pending", 
			"label" => "Pending", 
		),
		array(
			"value" => "Blocked", 
			"label" => "Blocked", 
		),);
		
}