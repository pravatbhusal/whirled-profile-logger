# Whirled Profile Logger (WPL)
A profile logger for Whirled servers, tracks IP Addresses and player information.  
If your avatar uses the WPL code, then clicking the "IP Tracker" action will receive the the room's information and send it to a database, which shows the information within this website: https://whirledtracker.000webhostapp.com/index.php

# Setting-up WPL onto your Avatar
1. Download the "IPTracker.as" file into your "whirledsdk/examples/avatars/uravatar/src" folder  
2. In your avatar's flash file, in the Basic Avatar Code frame (within the main scene),  
add this code ```new IPTracker(_ctrl, loaderInfo.loaderURL);``` under the _body code
- It should look similar to this:  
```actionscript
import com.whirled.AvatarControl;
import com.whirled.EntityControl;
import com.whirled.ControlEvent;

if (_ctrl == null)
{
	_ctrl = new AvatarControl(this);
	_body = new Body(_ctrl,this, 550);
	new IPTracker(_ctrl, loaderInfo.loaderURL);
	_ctrl.setHotSpot(275, 350, 250);
	_ctrl.setMoveSpeed(110);
	_ctrl.addEventListener(Event.UNLOAD, handleUnload);
	function handleUnload(... ignored):void
	{
		_body.shutdown();
	}
}
var _ctrl:AvatarControl;
var _body:Body;
``` 
3. Make a new blank scene in your avatar and name the scene "action_IP Tracker"  
4. Publish your SWF file and upload it onto a Whirled website.

Note: The "IP Tracker Avatar.fla" in this GitHub repository is an example avatar that uses  
the WPL code, you may use it as reference.

# Advanced Features (Optional)
The server folder contains the PHP files that I programmed to log information on the user within the server-side.
Change the variables in the dbconnection.php to your MySQL database and place the files in a web-server
and modify the URLRequest within the IPTracker.as code to create your own WPL instance website.

# DISCLAIMER
IP ADDRESSES ARE "PUBLIC" AND THE INFORMATION PROVIDED BY THE ADDRESS IS FOR FREE-USE UNDER AN ISP. THIS WEBSITE HOLDS NO LIABILITIES TO THE IP ADDRESSES, AND THIS SHOULD ONLY BE USED FOR EDUCATIONAL OR SECURITY PURPOSES. 
