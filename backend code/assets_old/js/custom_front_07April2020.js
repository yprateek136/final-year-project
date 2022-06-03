$(document).ready(function () {
$('.btn-publish').click(function (e) {
    var shop_category = $('[name="shop_categorie"]').val();
    if (shop_category == null) {
        e.preventDefault();
        alert('There is no create and selected shop category!');
    }
});

$("a.confirm-delete").click(function (e) {
    e.preventDefault();
    var lHref = $(this).attr('href');
    bootbox.confirm({
        message: "Are you sure want to delete?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                window.location.href = lHref;
            }
        }
    });
});

$("a.confirm-save").click(function (e) {
    e.preventDefault();
    var formId = $(this).data('form-id');
    bootbox.confirm({
        message: "Are you sure want to save?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                document.getElementById(formId).submit();
            }
        }
    });
});

$('#country').change(function () {
		var country_code = $(this).val();
		if (country_code) {
			$.ajax({

				url: $('body').attr('data-base-url') + 'contact/getcountrycode',
				method: 'post',
				data: {
					id: $(this).attr('data-src'),
					country_code: country_code
				}
			}).done(function (response) {
				$('#country_code').val(response);
				return false;
			});
		}
	});
// Multiple Invites
$("#btn_invites").on("click", function (e) {
		var email_ids = $.trim($("#email_ids").val()); 
		var page_url = $.trim($("#page_url").val()); 
		$("#suggestion_msg").remove();
		$("#email_ids").parent().removeClass('has-error');

		var error_flag = 'N';
		if (email_ids == '') {
			$("<span style='color:red;' id='suggestion_msg'>Please enter Email id's.</span>").insertAfter("#email_ids");
			$("#email_ids").parent().addClass('has-error');
			error_flag = 'Y';
		}
		if (error_flag == 'N') {
			$('.preloader-defalt').show();
			$.ajax({

				url: $('body').attr('data-base-url') + 'common/invitetofriends',
				method: 'post',
				data: {
					id: $(this).attr('data-src'),
					email_ids: email_ids
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					$('#suggestions_div').html('');
					$('#suggestions_div').html('Invite send successfully!!!');
				} else {
				  	$("<span style='color:red;' id='suggestion_msg'>Invalid Request!</span>").insertAfter("#email_ids");
				}
				return false;
			});
		} 
		return false;

	});
//End Here
	$("#addmoreskills").on("click", function (e) {
		$('#more_skills').show();
		$('#myskills').hide();
		$('#addmoreskills').hide();
		$('.preloader-defalt').hide();
	});

	$("#add_skills").on("focusout", function () {
		var add_skills = $.trim($("#add_skills").val()); 
		$("#suggestion_msg").remove();
		$("#add_skills").parent().removeClass('has-error');

		var error_flag = 'N';
		if (add_skills == '') {
			$("<p style='color:red;' id='suggestion_msg'>Please enter your Interests.</p>").insertAfter("#add_skills");
			$("#add_skills").parent().addClass('has-error');
			error_flag = 'Y';
		}
		if (error_flag == 'N') {
			$('.preloader-defalt').show();
			
			$.ajax({

				url: $('body').attr('data-base-url') + 'common/setmoreskills',
				method: 'post',
				data: {
					id: $(this).attr('data-src'),
					addmoreskills: add_skills
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					$('#myskills').html('');
					$('#myskills').html(add_skills);
					$('#more_skills').hide();
					$('#myskills').show();
					$('#addmoreskills').show();
					
				} else {
					alert('Invalid Request');
				}
				return false;
			});
		} 
		return false;

	});

	$(".close").on("click", function (e) {
		window.location.href = $('body').attr('data-base-url') +"communities/manage/";
	});
	
	$("#remove_ads").on("click", function (e) {
		window.location.href = $('body').attr('data-base-url') +"promotionaladvertising";
	});
		
	$("#btn_suggestions").on("click", function (e) {
		var suggestion = $.trim($("#suggestions").val()); 
		var page_url = $.trim($("#page_url").val()); 
		$("#suggestion_msg").remove();
		$("#suggestion").parent().removeClass('has-error');

		var error_flag = 'N';
		if (suggestion == '') {
			$("<span style='color:red;' id='suggestion_msg'>Please enter your suggestions.</span>").insertAfter("#suggestions");
			$("#suggestions").parent().addClass('has-error');
			error_flag = 'Y';
		}
		if (error_flag == 'N') {
			$('.preloader-defalt').show();
			$.ajax({

				url: $('body').attr('data-base-url') + 'common/setsuggestions',
				method: 'post',
				data: {
					id: $(this).attr('data-src'),
					user_suggestions: suggestion,
					page_url: page_url
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				$('#suggestions_div').html('');
				$('#suggestions_div').html(response);
				return false;
			});
		} 
		return false;

	});

	$('.like').on('click', function(){
		//     var postID = $(this).data('postID');
			 var postID = $(this).attr("data-id");
			 var user_id = $('#id').val();
			 $post = $(this);
		//	 console.log($post);
	  
	//    console.log(postID);
	//    console.log(user_id);
			 $.ajax({
				 url: $('body').attr('data-base-url') + 'Mypage/likesCount',
				 type: 'post',
				 data: {
					 liked: 1,
					 postID: postID,
					 user_id: user_id
				 },
				 success: function(response){
					 if(response>1){ $post.parent().find('span.likes_count').text(response + " likes"); }
					 else{
					 $post.parent().find('span.likes_count').text(response + " like");}
					 $post.addClass('hide');
					 $post.siblings().removeClass('hide');
				 }
			 });
		 });


		 $('.unlike').on('click', function(){
            var postID = $(this).attr("data-id");
            var user_id = $('#id').val();
	//		var postid = $(this).data('id');
		    $post = $(this);
// console.log(postID);
// console.log(user_id);

			$.ajax({
				url: $('body').attr('data-base-url') + 'Mypage/unlikesCount',
				type: 'post',
				data: {
					unliked: 1,
                    postID: postID,
                    user_id: user_id
				},
				success: function(response){
					if(response>1){ $post.parent().find('span.likes_count').text(response + " likes"); }
					else{
                	$post.parent().find('span.likes_count').text(response + " like"); }
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});


 $('.followcommunity').on('click', function(){

var slug = $(this).attr("data-id");
var follower_id = $('#id').val();
$followcommunity = $(this);
    
$.ajax({
        url: $('body').attr('data-base-url') +'Mypage/communityfollow',
        type: 'POST',
        data: {slug: slug ,follower_id:follower_id ,followed : 1},
        error: function() {
           alert('Something is wrong');
        },
        success: function(data) {     
		//     console.log(data);
		if(data>1){
		 $followcommunity.parent().find('span.members_count').text(data + " members");}
		 else{  $followcommunity.parent().find('span.members_count').text(data + " member");}
             $followcommunity.addClass('hide');
             $followcommunity.siblings().removeClass('hide');	
        
        }
     });

 });


  $('.unfollowcommunity').on('click', function(){

var slug = $(this).attr("data-id");
var follower_id = $('#id').val();
$unfollowcommunity = $(this);
    
$.ajax({
        url: $('body').attr('data-base-url') + 'Mypage/communityunfollow',
        type: 'POST',
        data: {slug: slug ,follower_id:follower_id ,unfollowed : 1},
        error: function() {
           alert('Something is wrong');
        },
        success: function(data) {     
		 //    console.log(data);
		 if(data>1){
		 $unfollowcommunity.parent().find('span.members_count').text(data + " members");}
		 else{ $unfollowcommunity.parent().find('span.members_count').text(data + " member");}
             $unfollowcommunity.addClass('hide');
             $unfollowcommunity.siblings().removeClass('hide');	
        
        }
     });

 });


 $('.follow').on('click', function(){

	var follow_id = $(this).attr("data-id");
	var follower_id = $('#id').val();
	$user = $(this);
//      console.log(follow_id);

	$.ajax({
			url:  $('body').attr('data-base-url') + 'Mypage/peoplefollow' ,
			type: 'POST',
			data: {follow_id: follow_id ,follower_id:follower_id ,followed : 1},
			error: function() {
			   alert('Something is wrong');
			},
			success: function(data) {     
			 //    console.log(data);
				 $user.addClass('hide');
				 $user.siblings().removeClass('hide');	
			//     $user.siblings().hide();	
			}
		 });

	 });


	 
	 $('.unfollow').on('click', function(){

		var follow_id = $(this).attr("data-id");
		var follower_id = $('#id').val();
		$user = $(this);
	 //   console.log(follow_id);

		$.ajax({
			url:  $('body').attr('data-base-url') + 'Mypage/unpeoplefollow',
			type: 'POST',
			data: {follow_id: follow_id ,follower_id:follower_id ,unfollowed : 1},
			error: function() {
				alert('Something is wrong');
		},
		success: function(data) {           
	   //      console.log(data);
		   $user.addClass('hide');
		   $user.siblings().removeClass('hide');
	  //     $('#follow_id').val(follow_id);	
	  }
	});

 });


 $('.likecommpost').on('click', function(){
    
		 var postID = $(this).attr("data-id");
		 var user_id = $('#id').val();
		 $post = $(this);
	//	 console.log($post);
  
   // console.log(postID);
    //console.log(user_id);
		 $.ajax({
			 url: $('body').attr('data-base-url') + 'Communities/likesCount',
			 type: 'post',
			 data: {
				 liked: 1,
				 postID: postID,
				 user_id: user_id
			 },
			 success: function(response){
				 if(response>1){ $post.parent().find('span.likes_count').text(response + " likes"); }
				 else{
				 $post.parent().find('span.likes_count').text(response + " like");}
				 $post.addClass('hide');
				 $post.siblings().removeClass('hide');
			 }
		 });
	 });

	 $('.unlikecommpost').on('click', function(){
		var postID = $(this).attr("data-id");
		var user_id = $('#id').val();
//		var postid = $(this).data('id');
		$post = $(this);
// console.log(postID);
// console.log(user_id);

		$.ajax({
			url: $('body').attr('data-base-url') + 'Communities/unlikesCount',
			type: 'post',
			data: {
				unliked: 1,
				postID: postID,
				user_id: user_id
			},
			success: function(response){
				if(response>1){ $post.parent().find('span.likes_count').text(response + " likes"); }
				else{
				$post.parent().find('span.likes_count').text(response + " like"); }
				$post.addClass('hide');
				$post.siblings().removeClass('hide');
			}
		});
	});

$(".comment-btn").click(function(){
	//$(".comment-sec").toggle();
})



$(".viewUserComments").on("click", function (e) {
		var id = $(this).attr('data-src');
		var post_id = $(this).attr('data-value');
		$('.preloader-defalt').show();
		$.ajax({

			url: $('body').attr('data-base-url') + 'myprofile/getCommonCommentsbox',
			method: 'post',
			data: {
				id: $(this).attr('data-src'),
				post_id: post_id
			}
		}).done(function (response) {
			$('.preloader-defalt').hide();
			// console.log(response);
			// console.log("#comment_"+post_id);
			$("#comment_"+post_id).html('');
			$("#comment_"+post_id).html(response);
			$("#comment_"+post_id).toggle();
			return false;
		})
	});


	$(".viewUserCommentscommunity").on("click", function (e) {
		var id = $(this).attr('data-src');
		var post_id = $(this).attr('data-value');
		$('.preloader-defalt').show();
		$.ajax({

			url: $('body').attr('data-base-url') + 'Communities/getCommonCommentsboxcommunity',
			method: 'post',
			data: {
				id: $(this).attr('data-src'),
				post_id: post_id
			}
		}).done(function (response) {
			$('.preloader-defalt').hide();
			// console.log(response);
			// console.log("#comment_"+post_id);
			$("#communitypost_"+post_id).html('');
			$("#communitypost_"+post_id).html(response);
			$("#communitypost_"+post_id).toggle();
			return false;
		})
	});


});

function editcommunity(com_id) {
	var community_id = com_id
	$.ajax({

			url: $('body').attr('data-base-url') + 'common/setsuggestions',
			method: 'post',
			data: {
					id: $(this).attr('data-src'),
					community_id: community_id
				}
			}).done(function (response) {
				$('#suggestions_div').html('');
				$('#suggestions_div').html(response);
				return false;
			});
}

function savepost(action, postid, page_name){
	var post_id = postid;
	$('.preloader-defalt').show();
	$.ajax({

			url: $('body').attr('data-base-url') + 'common/saveuserpost',
			method: 'post',
			data: {
					id: $(this).attr('data-src'),
					postID: post_id,
					action: action
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					setTimeout(function() { $('#msg_div_'+post_id).html('Post Saved Successfully!!!'); }, 1000);
				} else {
					setTimeout(function() { $('#msg_div_'+post_id).html('Post Removed from Your Saved List'); }, 1000);
				}
				window.location.href = $('body').attr('data-base-url') +''+page_name;
				return true;
			});
}

function hidepost(action, postid, page_name){
	var post_id = postid;
	$('.preloader-defalt').show();
	$.ajax({

			url: $('body').attr('data-base-url') + 'common/hidemypost',
			method: 'post',
			data: {
					id: $(this).attr('data-src'),
					postID: post_id,
					action: action,
					page_name : page_name
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					setTimeout(function() { $('#mypost_'+post_id).hide(); }, 1000);
				}
				window.location.href = $('body').attr('data-base-url')+''+page_name;
				return true;
			});
}

function deletepost(action, postid, page_name){
	var post_id = postid;
	$('.preloader-defalt').show();
	$.ajax({

			url: $('body').attr('data-base-url') + 'common/deletemypost',
			method: 'post',
			data: {
					id: $(this).attr('data-src'),
					postID: post_id
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					setTimeout(function() { $('#mypost_'+post_id).hide(); }, 1000);
				}
				window.location.href = $('body').attr('data-base-url') +''+page_name;
				return true;
			});


	
}

function hidecommunitypost(action, postid, page_name){
	var post_id = postid;
	$('.preloader-defalt').show();
	$.ajax({

			url: $('body').attr('data-base-url') + 'common/hidemycommunitiespost',
			method: 'post',
			data: {
					id: $(this).attr('data-src'),
					postID: post_id,
					action: action,
					page_name : page_name
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					setTimeout(function() { $('#mypost_'+post_id).hide(); }, 1000);
				}
				window.location.href = $('body').attr('data-base-url')+''+page_name;
				return true;
			});
}

function deletecommunitypost(action, postid, page_name){
	var post_id = postid;
	$('.preloader-defalt').show();
	$.ajax({

			url: $('body').attr('data-base-url') + 'common/deletemycommunitiespost',
			method: 'post',
			data: {
					id: $(this).attr('data-src'),
					postID: post_id
				}
			}).done(function (response) {
				$('.preloader-defalt').hide();
				if(response>0){
					setTimeout(function() { $('#mypost_'+post_id).hide(); }, 1000);
				}
				window.location.href = $('body').attr('data-base-url') +'/'+page_name;
				return true;
			});


	
}


function addcomment(postID){
	var returnval =  true;
	var comment = document.getElementById("commenttext_"+postID).value;
	var postID = document.getElementById("commentpostid_"+postID).value;
	var user_id = document.getElementById("id_"+postID).value;

	if(comment == ""){
		document.getElementById('postcommenterror').innerText = "*Comment is required.";
		returnval = false;
		  }
		  
		  if(returnval == true){
            $.ajax({
               url: $('body').attr('data-base-url') + 'myprofile/addcomment',
               type: 'POST',
			   data: { postID: postID ,
				user_id:user_id ,
				comment:comment
			     }
			}).done(function (response) {
			//	$('.preloader-defalt').hide();
			// console.log(response);
			// console.log("#comment_"+postID);
				$("#comment_"+postID).html('');
				$("#comment_"+postID).html(response);
				$("#comment_"+postID).toggle();
				loadCommentsRow(postID);
				return false;
			})
        
        }

}

function loadCommentsRow(postID)
{
		var id = postID;
		var post_id = postID;
		$('.preloader-defalt').show();
		$.ajax({

			url: $('body').attr('data-base-url') + 'myprofile/getCommonCommentsbox',
			method: 'post',
			data: {
				id: postID,
				post_id: postID
			}
		}).done(function (response) {
			$('.preloader-defalt').hide();
			//console.log(response);
			//console.log("#comment_"+post_id);
			$("#comment_"+post_id).html('');
			$("#comment_"+post_id).html(response);
			$("#comment_"+post_id).toggle();
			return false;
		})
}


function addcommentcommunity(postID){
	var returnval =  true;
	var comment = document.getElementById("communitycommenttext_"+postID).value;
	var postID = document.getElementById("communitycommentpostid_"+postID).value;
	var user_id = document.getElementById("id_"+postID).value;

	if(comment == ""){
		document.getElementById("communitypostcommenterror_"+postID).innerText = "*Comment is required.";
		returnval = false;
		  }
		  
		  if(returnval == true){
            $.ajax({
               url: $('body').attr('data-base-url') + 'Communities/addcommentcommunity',
               type: 'POST',
			   data: { postID: postID ,
				user_id:user_id ,
				comment:comment
			     }
			}).done(function (response) {
			//	$('.preloader-defalt').hide();
			// console.log(response);
			// console.log("#comment_"+postID);
				$("#communitypost__"+postID).html('');
				$("#communitypost_"+postID).html(response);
				$("#communitypost_"+postID).toggle();
				loadCommentsRowcommunity(postID);
				return false;
			})
        
        }

}

function loadCommentsRowcommunity(postID)
{
		var id = postID;
		var post_id = postID;
		$('.preloader-defalt').show();
		$.ajax({

			url: $('body').attr('data-base-url') + 'Communities/getCommonCommentsboxcommunity',
			method: 'post',
			data: {
				id: postID,
				post_id: postID
			}
		}).done(function (response) {
			$('.preloader-defalt').hide();
			//console.log(response);
			//console.log("#comment_"+post_id);
			$("#communitypost_"+post_id).html('');
			$("#communitypost_"+post_id).html(response);
			$("#communitypost_"+post_id).toggle();
			return false;
		})
}