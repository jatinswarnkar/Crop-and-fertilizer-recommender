import os
import socket
from http.server import HTTPServer, BaseHTTPRequestHandler

class FileDownloadHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        file_path = "/home/ggpi/Documents/Debjani/SHC/SoilHealthCard.pdf"
        with open(file_path, "rb") as file:
            self.send_response(200)
            self.send_header("Content-type", "application/pdf")
            self.send_header("Content-Disposition", "attachment; filename=SoilHealthCard.pdf")
            self.end_headers()
            self.wfile.write(file.read())

# Start the web server
os.system("sudo service apache2 start")

# Set up the file download handler
handler = FileDownloadHandler

# Get the Raspberry Pi's IP address
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.connect(("8.8.8.8", 80))
ip_address = s.getsockname()[0]
s.close()

# Serve the file for download
httpd = HTTPServer((ip_address, 80), handler)
httpd.serve_forever()