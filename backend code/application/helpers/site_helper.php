<?php

/** Functions **/
function logged_data($type='user'){

	switch($type){
		case 'user':	return get_session(USR_SESSION_NAME);	break;
		case 'admin':	return get_session(ADM_SESSION_NAME);	break;
	}

}
//EOF

