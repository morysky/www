# -*- coding: utf-8 -*-
#########################################################################
# Author: Yao Kun
# Created Time: 五  8/15 19:15:20 2014
# File Name: check7daysinn.py
# Description: 
#########################################################################
import urllib2  
import smtplib  
from email.mime.text import MIMEText  
import time

day_range = 4
url = "http://localhost/test/curl_api.php?date="

# 写个写法好朴素啊
def checkMonth(today):
    if today[5] == '0' and today[6] == '1':
        return 0;
    elif today[5] == '0' and today[6] == '2':
        return 2;
    elif today[5] == '0' and today[6] == '3':
        return 0;
    elif today[5] == '0' and today[6] == '4':
        return 1;
    elif today[5] == '0' and today[6] == '5':
        return 0;
    elif today[5] == '0' and today[6] == '6':
        return 1;
    elif today[5] == '0' and today[6] == '7':
        return 0;
    elif today[5] == '0' and today[6] == '8':
        return 0;
    elif today[5] == '0' and today[6] == '9':
        return 1;
    elif today[5] == '1' and today[6] == '0':
        return 0;
    elif today[5] == '1' and today[6] == '1':
        return 1;
    elif today[5] == '1' and today[6] == '2':
        return 0;

def getNextYear(today):
    newyear = ""
    for i in range(0, 4):
        newyear += today[i]
    return str(int(newyear)+1)+'-01'

def getNextMonth(today):
    newmonth = ""
    if today[5] == '1' and today[6] == '2':
        newmonth += getNextYear(today)
    else:
        for i in range(0, 4):
            newmonth += today[i]
        if today[6] == '9':
            newmonth += '1'
            newmonth += '0'
        else:
            newmonth += today[5]
            newmonth += str(int(today[6])+1)
    newmonth += '-01'
    return newmonth

def getNextDay(today):
    #二月
    newday = ""
    if (today[8] == '2') and (today[9] == '8') and (checkMonth(today) == 2):
        newday += getNextMonth(today)
    elif (today[8] == '3') and (today[9] == '0') and (checkMonth(today) == 1):
        newday += getNextMonth(today)
    elif (today[8] == '3') and (today[9] == '1') and (checkMonth(today) == 0):
        newday += getNextMonth(today)
    else:
        for i in range(0, 8):
            newday += today[i]  
        if today[9] == '9':
            newday += str(int(today[8])+1)
            newday += '0'
        else:
            newday += today[8]
            newday += str(int(today[9])+1)
    return newday

def mysendemail(subject, html):
    sender = 'syaokun219@163.com'  
    receiver = 'syaokun219@vip.qq.com'
    smtpserver = 'smtp.163.com'  
    username = 'syaokun219'  
    password = 'sss1989114'  
         
    msg = MIMEText(html,'html','utf-8')  
    msg['Subject'] = subject  
          
    smtp = smtplib.SMTP()  
    smtp.connect('smtp.163.com')  
    smtp.login(username, password)  
    smtp.sendmail(sender, receiver, msg.as_string())  
    smtp.quit()

def local_log(data):
    logtime = time.strftime('%Y-%m-%d  %H:%M',time.localtime(time.time()))
    logfile = open("local_log.txt", "a")
    logfile.write(logtime)
    logfile.write(data)
    logfile.write("\n\n")
    logfile.close()

while (True):
    today=time.strftime("%Y-%m-%d", time.localtime())
    tmp = ""
    for i in range(0, day_range):
        today = getNextDay(today)
        response = urllib2.urlopen(url+today)  
        result = response.read()  
        if(len(result) > 0 and result[0] != '<'):
            tmp += "日期: <strong>" + today + "</strong><br>"
            tmp += result
            tmp += "<br>"
        time.sleep(10)
    
    if(len(tmp) > 0):
        #记录日志
        local_log(tmp)
        html = "<html>" + tmp + "</html>"
        mysendemail("7天2000积分房自动邮件", html)
    time.sleep(10000)
