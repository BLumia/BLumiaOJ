# Head
import sys
import MySQLdb
import HTMLParser
import urlparse
import urllib
import urllib2
import cookielib
import string
import re
import time
import demjson

# Login
def login():
        hosturl = 'http://www.bnuoj.com/v3/'
        posturl = 'http://www.bnuoj.com/v3/ajax/login.php'
        cj = cookielib.LWPCookieJar()
        cookie_support = urllib2.HTTPCookieProcessor(cj)
        opener = urllib2.build_opener(cookie_support, urllib2.HTTPHandler)
        urllib2.install_opener(opener)
        h = urllib2.urlopen(hosturl)
        headers = {'User-Agent' : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:14.0) Gecko/20100101 Firefox/14.0.1','Referer' : ''}
        postData = {
                    'username' : 'awesome',
                    'password' : 'awes0me',
                    'cksav' : '30'
                    }
        postData = urllib.urlencode(postData)
        request = urllib2.Request(posturl, postData, headers)
        response = urllib2.urlopen(request)
        text = response.read()
        if text.find("Success")>=0:
                return 1
        else:
                return 0

# Send To Judge
def send(pid,lang,code):
        print "PID=",pid;
        posturl = 'http://www.bnuoj.com/v3/ajax/problem_submit.php'
        headers = {'User-Agent' : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:14.0) Gecko/20100101 Firefox/14.0.1','Referer' : ''}
        postData = {
                    'user_id' : 'awesome',
                    'problem_id' : pid,
                    'language' : lang,
                    'isshare' : '0',
                    'source' : code,
                    }
        postData = urllib.urlencode(postData)
        request = urllib2.Request(posturl, postData, headers)
        response = urllib2.urlopen(request)
        text = response.read()
        if text.find('Invalid')>0:
		print "login NEEDED"
                time.sleep(1)
                if login()==0:
                        print "login FAILED,Exit..."
			db.close()
			exit(1)
		time.sleep(1)
                request = urllib2.Request(posturl, postData, headers)
                response = urllib2.urlopen(request)
                text = response.read()
        if text.find('Submit')>=0:
		print "Submit SUCCESS"
                return 1
        else:
		print "Submit FAILED"
                return 0

# Wait
def get_result():
        i = 0
        while i <= 15: # wait 60s
            i += 1
            time.sleep(4)
            url = "http://www.bnuoj.com/v3/ajax/status_data.php?bSearchable_0=true&sSearch_0=awesome"
            req = urllib2.Request(url)
            res_data = urllib2.urlopen(req)
            res = res_data.read()
            json = demjson.decode(res)
            status = json['aaData']
            result = status[0][3]
            print "VJRES=",results
            if (result != "Judging" and result != None):
               return result
        return "Judge Time Out"

# Write Log
fsock = open('xcvj.log', 'a')
sys.stdout = fsock
# Connect DB
db = MySQLdb.connect("localhost","root","usbw","judge",3307)
cursor = db.cursor()

#===Loop====
while True:
        # Select Run ID
        try:
           sql = "SELECT * FROM VJ_Solution WHERE runid=(SELECT min(runid) FROM VJ_Solution WHERE status='Pending')"
           cursor.execute(sql)
           results = cursor.fetchall()
           if len(results) == 0:
	      db.close()
              exit(0)
           for row in results:
              runid = row[0]
              pid = row[1]
              lang =  row[2]
              code = row[3]
              user = row[4]
           print "----Run ID=",runid,"----"
           sql = "UPDATE VJ_Solution SET status='Judging' WHERE runid='%d'" % (runid)
           cursor.execute(sql)
           db.commit()
        except MySQLdb.Error,e:
           print "Mysql Error 1-%d: %s" % (e.args[0], e.args[1])
           db.rollback()
	   db.close()
           exit(1)

        # Send
        if send(pid,lang,code)==1:
		ret=get_result()
	else:
		ret="Judge Error"

        # Update DB
        sql = "UPDATE VJ_Solution SET status='%s' WHERE runid='%d'" % (ret,runid)
        try:
           cursor.execute(sql)
           db.commit()
           print "----finish----"
        except MySQLdb.Error,e:
           print "Mysql Error 2-%d: %s" % (e.args[0], e.args[1])
           db.rollback()
	   db.close()
           exit(1)

