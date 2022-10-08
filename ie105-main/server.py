import socket

server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
print("Socket successfully created")

port = 3000

server.bind(("", 3000))
print("Socket binded to %s" %(port))

server.listen(5)
print("Socket is listening")

while True:
    c, addr = server.accept()
    print("Got connection from", addr)

    name = c.recv(1024).decode()

    c.send(("Hello " + name).encode())

    c.close()

    break
