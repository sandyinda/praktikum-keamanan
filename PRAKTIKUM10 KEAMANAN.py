from cryptography.fernet import Fernet

# Generate dan simpan kunci enkripsi
key = Fernet.generate_key()
cipher = Fernet(key)

# Data kartu dummy
data_kartu = "4111111111111111|123|12/27"

# Enkripsi
data_terenkripsi = cipher.encrypt(data_kartu.encode())

# Dekripsi
data_terdekripsi = cipher.decrypt(data_terenkripsi).decode()

print("Kunci Enkripsi         :", key.decode())
print("Data Terenkripsi       :", data_terenkripsi.decode())
print("Data Setelah Deskripsi :", data_terdekripsi)