import urllib2
import serial
import struct

try:
	
	ser = serial.Serial('/dev/ttyUSB0', 115200, timeout=1)
	#ser = serial.Serial('/dev/ttyACM0', 115200, timeout=1)
	
	
	#response = urllib2.urlopen('http://gottaspecial.tk/')
	#url='http://localhost/autonomia/mode.txt'
	url = "http://pat2015.ga/mode.txt"
	
	modeOLD=-1
	while True:
		response = urllib2.urlopen(url)
		try:
			mode = int(response.read())
			ser.write([mode]) #scrivi sempre
		except ValueError:
			mode = modeOLD
		if mode!=modeOLD:
			print mode
			#ser.write([mode])
			modeOLD=mode
	
except KeyboardInterrupt:
	pass
	
