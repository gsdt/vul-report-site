#! /usr/bin/python3

import smtplib
import time
import sys

def send_email(TO, USER, TOKEN):

    TEXT = '''
    Hello {0},
    Vulnerable Report System recieved a request to reset your account.
    Please click this link to continue: http://localhost:8080/reset?action=reset&token={1}.
    If you don't request reset password, please skip it.
    Thanks you.
    '''.format(USER, TOKEN)

    SUBJECT = 'Reset password'

    # Gmail Sign In
    gmail_sender = 'test.gsdt.01@gmail.com'
    gmail_passwd = 'vnhacker0903'

    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.ehlo()
    server.starttls()
    server.login(gmail_sender, gmail_passwd)

    BODY = '\r\n'.join(['To: %s' % TO,
                        'From: %s' % gmail_sender,
                        'Subject: %s' % SUBJECT,
                        '', TEXT])

    try:
        server.sendmail(gmail_sender, [TO], BODY)
        print ('email sent')
    except:
        print ('error sending mail')

    server.quit()

send_email(sys.argv[1], sys.argv[2], sys.argv[3])