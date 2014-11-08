var LOCATION_CK_INTERVAL = 15000;
var DISTANCE_CHANGE_REFRESH_THRESHOLD = 10;
var CHECKIN_NOTIFICATION_THRESHOLD = 0.05;

var apipath = "";
var isMobile = false;

// Store object refs for each UI panel.
// Arr idx matches html id of panel
var panel = Array();


function AppInit(){
    // DebugOut('initing app');
	// panel['prize'] = new Prize();
    // panel['home'] = new Home();
	// panel['checkin'] = new Checkin();
	// panel['checkindetail'] = new CheckinDetail();
	// panel['location'] = new Location();
	// panel['userlocation'] = new UserLocation();
	// //panel['userprofile'] = new UserProfile();
	// //panel['userlogin'] = new UserLogin();
	// panel['info'] = new Info();
	// panel['app'] = new App();
	// panel['locationoptions'] = new LocationOptions();
	// panel['checkinpop'] = new CheckinPop();
	// panel['share'] = new Share();
//
    // panel['home'].Load();
}

function ShowDetail(pTarget){
    if( $(pTarget).hasClass('expand') ){
        $('.panel .linearlist li').removeClass('expand');
        ga('send', 'event', 'list', 'click', 'collapse', 0);
    }else{
        $('.panel .linearlist li').removeClass('expand');
        $(pTarget).addClass('expand');
        ga('send', 'event', 'list', 'click', 'expand', 0);
    }
}
