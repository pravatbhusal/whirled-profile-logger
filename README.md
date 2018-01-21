# Whirled Profile Logger (WPL)
A profile logger for Whirled servers, tracks IP Addresses and player information.

# Profile Logs Website
- https://whirledtracker.000webhostapp.com/

# How It Works
If your avatar has the WPL code, then once you click the "IP Tracker" action  
it will receive the player's information within your Whirled room and send it to a database,  
which shows the data within this website: https://whirledtracker.000webhostapp.com/

# Set-up
1. Download "IPTracer.as" file into your "whirledsdk/examples/avatars/uravatar/src" folder  
2. Open your avatar's flash file, and in the Basic Avatar Code (inside the main scene)  
add this line "new IPTracker(_ctrl, loaderInfo.loaderURL);" under the Body code  
3. Now publish your SWF file and upload it onto a Whirled server!  

Note: The "IP Tracker Avatar.fla" in this GitHub repository is an example avatar that uses  
the WPL code, you may use it as reference.

# Advanced Features (Optional)
The server folder contains the PHP files that I programmed to log information on the  
user within the server-side. Change the variables in the dbconnection.php to your MySQL  
database and place the files in a web-server and modify the URLRequest within the IPTracer.as  
code to create your own WPL instance website.

# DISCLAIMER
THIS PROGRAM HOLDS NO LIABILITIES TO THE IP ADDRESSES, AND THIS SHOULD ONLY BE USED FOR EDUCATIONAL OR SECURITY PURPOSES.  
