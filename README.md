# EcoNote

Application to make, and save notes.

Project was made in almoust pure PHP, CSS and HTML with minimal amount of js.


![EcoNote](https://user-images.githubusercontent.com/112412169/188962944-64b66b70-b9e2-4223-bb40-015b1c7cea08.png)

## How Run App?

1. Download zip from this link: 

  https://drive.google.com/file/d/1KSZqUs8YTwudvLxpFTFQDSKFcqeMUJsz/view?usp=sharing

2. Unzip archive.

3. Run usbwebserver.exe - allow everything

4. Stop Apache in usbwebserver and run script.bat

5. Go to "USBWebserver v8.6.6\php" directory, find php.ini file. Open in text editor and find line: extension_dir = "C:/Users/sqann/Desktop/USBWebserver     v8.6.6\php\ext\".
Replace C:/Users/sqann/Desktop/ on path, where USBWebserver was unziped. For example: extension_dir = "E:\Download\USBWebserver v8.6.6\php\ext\"

6. Run Apache in usbwebserver, and type in browser address bar: http://localhost/econote/ 
