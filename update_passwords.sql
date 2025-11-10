-- Update password database dengan bcrypt hash untuk Laravel
USE canteenly;

-- Update password untuk setiap user dengan bcrypt hash
UPDATE users SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE email = 'admin.canteenly@gmail.com'; -- password: 123456
UPDATE users SET password = '$2y$10$UroOGBFj8mUniDNOjrMBwu4ISs9F39.AlZr2iGmYxb9j3BaRc5Wn2' WHERE email = 'syakila.da27@gmail.com'; -- password: 270304
UPDATE users SET password = '$2y$10$UoieHxoVCGsKgHLDO0KiL.l51JB4HM1gJpd5Z.X19YQzrNN4A7JoO' WHERE email = 'rafi.pratama@gmail.com'; -- password: 111222
UPDATE users SET password = '$2y$10$PQkgD8GF.lsgdK1TF1DQ7uvjeJzoyQGH9lHxVBs4GQsIcBB5jBQN.' WHERE email = 'alya.sari@gmail.com'; -- password: 333444
UPDATE users SET password = '$2y$10$hIcM7Th7IP2fpknD6YSg6uR6GrBrIx./.Rw8IdcDQSPzaQbGBPKoS' WHERE email = 'budi.santoso@gmail.com'; -- password: 555666
UPDATE users SET password = '$2y$10$Oc62aX0z4U1Zl/xqHuvIveWjADQrFHfwz2qBHajvEYEBaQ2e2oi1.' WHERE email = 'siti.nurhaliza@gmail.com'; -- password: 777888
UPDATE users SET password = '$2y$10$9LvAK.PHQwuTHpOzRj9dWeCxpwvlxGHHFIKyE.uV.4gOyxd5sWbN6' WHERE email = 'ahmad.fauzi@gmail.com'; -- password: 999000
UPDATE users SET password = '$2y$10$Z.EKHDZ8tFJ22KhNLn4aDOt7dtQ6ptzcJKLJhpnLLtL1KfHJSXAr6' WHERE email = 'joko.widodo@gmail.com'; -- password: 101010
UPDATE users SET password = '$2y$10$8eyH5Al3Xm.PCEvX6.Orie2yBhK8H1FWzg0VfhrKoitC0HpOAyvD.' WHERE email = 'sari.dewi@gmail.com'; -- password: 202020
UPDATE users SET password = '$2y$10$h9Bi3RwvIAHGZZOaQcwcs.G2Vw6M3lwiESSay58c0N/DaUDElV9du' WHERE email = 'ahmad.yani@gmail.com'; -- password: 303030
UPDATE users SET password = '$2y$10$L3b2rkwvYfgEap3xB9Dh2.8ARkcWHoKCMgI6VRnTsRJ5zUCMIl/H2' WHERE email = 'rina.sari@gmail.com'; -- password: 404040
UPDATE users SET password = '$2y$10$hLRlQ8D7YKeGtE.fFjS1JuR1dAiCGfVR3G2tXN6QQgmwXxeO1s3Si' WHERE email = 'bambang.staf@gmail.com'; -- password: 505050
UPDATE users SET password = '$2y$10$Kj0TUHKlH75KGu/dFLhBEeNyxtLN8yAoN8f3O1qEi7FHXp.N55vP.' WHERE email = 'indah.sari@gmail.com'; -- password: 606060

-- Verifikasi update
SELECT name, email, password, role FROM users ORDER BY role, name;