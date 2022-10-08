import socket

client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

port = 3000
ip = "10.0.2.4"

client.connect((ip, port))

client.sendall("Le Thanh Nhan".encode())

print(client.recv(1024).decode())

client.close()