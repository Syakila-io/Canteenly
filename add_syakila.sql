-- Menambahkan user Syakila ke database
USE canteenly;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `kelas`, `jabatan`, `no_hp`) VALUES
(13, 'Syakila Dwi Ananda', 'syakila.da27@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', '12 RPL 1', NULL, '081234567802');

-- Update auto increment
ALTER TABLE `users` AUTO_INCREMENT = 14;

-- Verifikasi data
SELECT * FROM users WHERE email = 'syakila.da27@gmail.com';