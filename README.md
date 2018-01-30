# Whirled Profile Logger (WPL)
A profile logger for Whirled servers, tracks IP Addresses and player information.  
If your avatar uses the WPL code, then clicking the "WPL" action will receive the the room's information and send it to a database, which shows the information within this website: https://whirledtracker.000webhostapp.com

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
3. Make a new blank scene in your avatar and name the scene "action_WPL"  
4. Publish your SWF file and upload it onto a Whirled website.

Note: The "IP Tracker Avatar.fla" in this GitHub repository is an example avatar that uses  
the WPL code, you may use it as reference.

# Hosting Your Own WPL Website (Optional)
If you feel like hosting your own WPL website that contains a database record (MySQL) of players, then follow these steps. This is optional and is NOT required to make use of WPL.  
1. Create a new MySQL database and export the database.sql file into your new database  
2. Open the dbconnection.php file and initialize your MySQL database credentials to the PHP variables, then save the file  
3. Place the IPTracker.php, index.php, and dbconnection.php files in your web host's root directory  
4. Download the "IPTracker.as" file into your "whirledsdk/examples/avatars/uravatar/src" folder 
5. In your avatar's flash file, in the Basic Avatar Code frame (within the main scene), add this code ```new IPTracker(_ctrl, loaderInfo.loaderURL, "https://example.com/IPTracker.php");``` under the _body code
6. Replace the ```https://example.com/IPTracker.php``` part from the code in step 5 to your web host's IPTracker.php URL
7. Make a new blank scene in your avatar and name the scene "action_WPL"  
8. Publish your SWF file and upload it onto a Whirled website.  
9. Now whenever clicking the "WPL" action on your avatar, it should send the room's information to your website's database and show the results when loading your website in a web-browser

# DISCLAIMER
IP ADDRESSES ARE "PUBLIC" AND THE INFORMATION PROVIDED BY THE ADDRESS IS FOR FREE-USE UNDER AN ISP. THIS WEBSITE HOLDS NO LIABILITIES TO THE IP ADDRESSES, AND THIS SHOULD ONLY BE USED FOR EDUCATIONAL OR SECURITY PURPOSES. 
