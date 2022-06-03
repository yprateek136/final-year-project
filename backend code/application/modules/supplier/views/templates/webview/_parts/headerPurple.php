<!-- Header -->
<header class="inner">
	<div class="row align-items-center">


		<div class="col-4 align-self-center menu" onclick="goBack()"><span><i class="fa fa-angle-left"></i><i class="d-none d-lg-inline-block page-name">

					<?php if (strpos($_SERVER['REQUEST_URI'], 'viewNotifi') !== false) : ?>
						View Notification
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'addNotification') !== false) : ?>
						Add Notification
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'viewUserList') !== false) : ?>
						User List
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'addUser') !== false) : ?>
						Add User
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'addCompany') !== false) : ?>
						Add Company
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'companyList') !== false) : ?>
						Company List
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'editCompany') !== false) : ?>
						Edit Company Detail
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'addHoliday') !== false) : ?>
						Add Holiday
					<?php elseif (strpos($_SERVER['REQUEST_URI'], 'notification') !== false) : ?>
						Notification
					<?php else : ?>
						Back
					<?php endif; ?>

				</i></span></div>

	</div>
</header>
<script>
	function goBack(event) {
		if ('referrer' in document) {
			window.location = document.referrer;
			/* OR */
			//location.replace(document.referrer);
		} else {
			window.history.back();
		}
	}
</script>