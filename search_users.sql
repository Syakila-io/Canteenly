-- Query untuk mencari user dengan nama yang mengandung 'Dina', 'Tiara', atau 'Ari'
SELECT id, name, email, role, no_hp, created_at 
FROM users 
WHERE name LIKE '%Dina%' 
   OR name LIKE '%Tiara%' 
   OR name LIKE '%Ari%';