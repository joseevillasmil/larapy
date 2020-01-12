import sys
import serial
import time

#Evaluamos si tenemos los parametros minimos
if(len(sys.argv) < 5):
    print("{error: 'missing parameters'}")
    exit()

SENDER = b"A"
port = sys.argv[1]
destiny = sys.argv[2].encode("ANSI")
command = sys.argv[3].encode("ANSI")
value = sys.argv[4].encode("ANSI")

#Preparamos el puerto serial.
serial_port = serial.Serial(port, baudrate=300, bytesize=8, parity='N', stopbits=1, timeout=1)

#Enviamos lo que nos pidieron enviar
serial_port.write(SENDER)
serial_port.write(destiny)
serial_port.write(command)
serial_port.write(value)
serial_port.write(b'\r')

#Preparamos el escucha.
wait = True
step = 0
while wait:
    ++step
    #20 segundos de espera.
    if(step >= 20):
        wait = False
    #Leemos la entrada.
    response = serial_port.readline()
    #Imprimios lo que llega
    if(len(response) >= 1):
        print("{error: false, response: '" + response.decode("ANSI")[0: len(response) - 1] + "'}")
        wait = False
    else:
        #Si no cae nada, esperamos...
        time.sleep(1)