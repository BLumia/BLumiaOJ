import time
import os
import MySQLdb
import string

while True:
	try:
		time.sleep(3)
		db = MySQLdb.connect("localhost","root","usbw","judge",3307)
		cursor = db.cursor()
		sql = "SELECT * FROM VJ_Solution WHERE runid=(SELECT min(runid) FROM VJ_Solution WHERE status='Pending')"
		cursor.execute(sql)
		results = cursor.fetchall()
		db.close()
		if len(results) > 0:
			os.system("python ./judge_client.py")
	except MySQLdb.Error,e:
		print "Mysql Error 1-%d: %s" % (e.args[0], e.args[1])
		#db.close()
		exit(1)

