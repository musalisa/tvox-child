from ftplib import FTP_TLS
import sys

########### MODIFY ########################

USER = '8302248@aruba.it'
PASS = '83TL3f6r71'

########### MODIFY IF YOU WANT ############

SERVER = 'ftp.prezioso.it'
PORT = 21
BINARY_STORE = True # if False then line store (not valid for binary files (videos, music, photos...))

###########################################

def print_line(result):
    print(result)

def connect_ftp():
    #Connect to the server
    ftp = FTP_TLS()
    ftp.connect(SERVER, PORT)
    ftp.login(USER, PASS)
    
    return ftp

def upload_file(ftp_connetion, upload_file_path):

    #Open the file
    try:
        upload_file = open(upload_file_path, 'r')
        
        #get the name
        path_split = upload_file_path.split('/')
        final_file_name = path_split[len(path_split)-1]
    
        #transfer the file
        print('Uploading ' + final_file_name + upload_file_path +  '...')
        
#        if BINARY_STORE:
#            ftp_connetion.storbinary('STOR '+ final_file_name, upload_file)
#        else:
#            #ftp_connetion.storlines('STOR ' + final_file_name, upload_file, print_line)
#            ftp_connetion.storlines('STOR '+ final_file_name, upload_file)
#            
#        print('Upload finished.')
        
    except IOError:
        print ("No such file or directory... passing to next file")

    
#Take all the files and upload all
ftp_conn = connect_ftp()

for arg in sys.argv:
    upload_file(ftp_conn, arg)
