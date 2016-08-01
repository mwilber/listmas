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

    pTarget = $(pTarget).parent();

    console.log( $(pTarget).find('.options').text() );

    if( $(pTarget).hasClass('expand') ){
        $('.linearlist li').removeClass('expand');
        $('.linearlist li .detail-btn').addClass('fa-angle-down');
        $('.linearlist li .options .fa').removeClass('fa-angle-up').addClass('fa-bars');
        $(pTarget).find('.options').html($(pTarget).find('.options').html().replace('Collapse','Options'));
        ga('send', 'event', 'list', 'click', 'collapse', 0);
    }else{
        $('.linearlist li').removeClass('expand');
        $('.linearlist li .detail-btn').addClass('fa-angle-down');
        $('.linearlist li .options .fa').removeClass('fa-angle-up').addClass('fa-bars');
        $(pTarget).addClass('expand');
        $(pTarget).find('.options .fa').removeClass('fa-bars').addClass('fa-angle-up');
        $(pTarget).find('.options').html($(pTarget).find('.options').html().replace('Options','Collapse'));
        $(pTarget).find('.detail-btn').removeClass('fa-angle-down').addClass('fa-angle-up');
        $(pTarget).find('.icon').css('background-image',$(pTarget).find('.icon').css('background-image').replace('SL160','SL'+$(pTarget).find('.icon').outerWidth()));
        ga('send', 'event', 'list', 'click', 'expand', 0);
    }
}
