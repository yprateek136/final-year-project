// $("#postDescription").emojioneArea({
//     pickerPosition: "bottom",
//     toneStyle: "bullet"
// });

document.addEventListener('play', function(e) {
    var allAudios = document.getElementsByTagName('audio');
    for (var i = 0; i < allAudios.length; i++) {
        if (allAudios[i] != e.target) {
            allAudios[i].pause();
        }
    }
}, true);

function openSearch() {
    $('#myModal').modal('hide');
    $("#searchModal").modal().show();
}


//dropzone image
function addFileDZ(from, mf) {
    let currDZ = Dropzone.forElement("#" + from);
    currDZ.emit("addedfile", mf);
    currDZ.emit("thumbnail", mf, mf.sUrl);
    currDZ.emit("complete", mf);
    //currDZ.options.maxFiles = 0;
    currDZ.files[0] = mf;
    currDZ.accepted = true;
}
//dropzone file
function addFileDZWT(from, mf) {
    let currDZ = Dropzone.forElement("#" + from);
    currDZ.emit("addedfile", mf);
    //currDZ.emit("thumbnail", mf, mf.sUrl);
    currDZ.emit("complete", mf);
    //currDZ.options.maxFiles = 0;
    currDZ.files[0] = mf;
    currDZ.accepted = true;
}
//remove errors
$('input,textarea').keyup(function(event) {
    /* Act on the event */
    $(this).removeClass('form-error-input');
    $(this).siblings(".form-error-msg").html("");
});

//ajax to unlink files from server
function doAjaxCall(sUrl = "") {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: 'POST', // http method
            url: '/common/deleteimage',
            data: { fileUrl: sUrl }, // data to submit
            dataType: 'json',
            success: function(data, status, xhr) {
                console.log('status: ' + status + ', data: ' + data.message);
                if (status == "success") {
                    resolve();
                    console.log(data.message);
                } else {
                    reject();
                }
            },
            error: function(jqXhr, textStatus, errorMessage) {
                reject();
                console.log('Error' + errorMessage);
            }
        });
    });
}


//follow & unfollow
function followUnfollow(curr, follow_id, from) {
    var follower_id = $('#id').val();
    $('.preloader-defalt').show();
    $.ajax({
        type: 'POST',
        url: from == 1 ? '/Common/userfollow' : '/Common/userunfollow',
        dataType: 'json',
        data: { follow_id: follow_id, follower_id: follower_id },
        success: function(data, status, xhr) {
            if (status == "success") {
                $('.preloader-defalt').hide();
                $(curr).addClass('hide');
                $(curr).siblings().removeClass('hide');
                $(curr).parent().find('span.follower_count').text(data.updated + " Followers");
                $("#followerscount").html(data.updated);
            } else {
                $('.preloader-defalt').hide();
                console.log(data.message);
            }

        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}

//follow community
$('.follow-community').on('click', function() {
    var commId = $(this).attr("data-id");
    let fc = $(this);
    $('.preloader-defalt').show();
    $.ajax({
        type: 'POST',
        url: '/common/communityfollow',
        data: { commId: commId, userId: $('#id').val(), followed: 1 },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                $('.preloader-defalt').hide();
                fc.parent().find('span.members_count').text(data.updated + " members");
                $("#communityfollowerscount").html(data.updated);
                fc.addClass('hide');
                fc.siblings().removeClass('hide');
            } else {
                $('.preloader-defalt').hide();
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
});

//unfollow community
$('.unfollow-community').on('click', function() {
    var commId = $(this).attr("data-id");
    $ufc = $(this);
    $('.preloader-defalt').show();
    $.ajax({
        type: 'POST',
        url: '/common/communityunfollow',
        data: { commId: commId, userId: $('#id').val(), unfollowed: 1 },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                $('.preloader-defalt').hide();
                $ufc.parent().find('span.members_count').text(data.updated + " members");
                $("#communityfollowerscount").html(data.updated);
                $ufc.addClass('hide');
                $ufc.siblings().removeClass('hide');
            } else {
                $('.preloader-defalt').hide();
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
});
//share
function openShareModal(postId, from) {
    if (!$('#id').val()) {
        location.href = $("body").attr('data-base-url') + "login";
        return;
    }
    //for user followerd communities (auto open)
    //populateCommunities("", 1);
    $('.preloader-defalt').show();
    $.ajax({
        method: 'POST',
        url: '/Common/getSharePostById',
        data: {
            postId: postId,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            $('.preloader-defalt').hide();
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                if (data.status == "N200") {
                    populateSharePosts(data.data, from);
                    $('#shareModal').modal('show');
                } else {
                    console.log(data.message);
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            $('.preloader-defalt').hide();
            console.log('Error' + errorMessage);
        }
    });
}

function populateSharePosts(p, commId, from) {
    let content = `
          <input type="hidden" id="shareData" data-comm-id="${p.communityId}" data-post-id="${p.id}">
          <div class="mid-container" id="post_${p.id}_${from}">
            <div class="post-main">
                <div class="post-top">
                    <div class="header-img">
                        <img alt="" src="${getProfilePic(p.profileimage)}">
                    </div>
                    <a href="/profile/${p.slug}">
                      <p>${p.username}</p>
                    </a> 
                    <span>${p.qualification}</span>
                    <span><i class="fa fa-clock-o" aria-hidden="true" style="color:#7f7f7f;"></i> ${jQuery.timeago(p.created_date)}</span>
                </div>
                <div class="post-mid">
                    <div style="cursor:pointer" data-toggle="modal" data-target="#exampleModaluniquepostcommunity">
                        <p>${p.postDescription}</p>
                        <img class="${(p.postImage?'':'hide')}" src="${getPostPic(p.postImage)}" alt='${p.postImage}'>
                        <audio controls src="${getPostAudio(p.postAudio)}"></audio>
                    </div>
                    <div class="right-links">
                        <a class="${(p.postLink?'':'hide')}" href="${makeLink(p.postLink)}" target="_blank" data-toggle="tooltip" title="Link"><i class="fa fa-link" aria-hidden="true"></i></a>
                        <a class="${(p.postAttachment?'':'hide')}" href="${getPostAttach(p.postAttachment)}" target="_blank" data-toggle="tooltip" title="Attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
                    </div>
                </div>
              </div>
        </div>
    `;
    $("#sharePostContainer").html(content).promise().done(function() {});
}

//creating post creation modal
function createModal() {
    resetModal();
    $("#myModal .modal-title").html('Create a post');
    $('#myModal').modal('show');
    $('#saveDraft').show();
    $("#inputComm").attr('disabled', false);
    $("#allCommContainer").show();
    //for user followerd communities (auto open)
    //populateCommunities("", 0);
}
//reset modal
function resetModal() {
    $("#isUpdate").val("");
    //reset community id & name
    $("#communityId").val("");
    $("#inputComm").val("");
    //reset audio
    closeAudio();
    //reset text
    $("#contentbox").text("");
    //reset image
    try {
        Dropzone.forElement("#imagePhoto").removeAllFiles(true);
        //reset attachment
        Dropzone.forElement("#attachmentPhoto").removeAllFiles(true);
    } catch (e) {
        console.log(e);
    }
    //reset link
    closeLink();
}

//copy post
function copypost(postId, from) {
    let temp = btoa(postId + "::" + from);
    console.log(temp);
    var copyText = $("body").attr('data-base-url') + "post?key=" + temp;
    copyTextToClipboard(copyText);
}

function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function() {
        console.log('Async: Copying to clipboard was successful!');
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
}

//REUSED
function getuniquepostpopupbyclick(postId, from) {
    event.stopPropagation();
    let temp = btoa(postId + "::" + from);
    console.log(temp);
    location.href = $("body").attr('data-base-url') + "post?key=" + temp;
}


function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }
    document.body.removeChild(textArea);
}

//EDIT comm post
function editpost(postId, from) {
    $('.preloader-defalt').show();
    $.ajax({
        method: 'POST',
        url: '/Common/getPostById',
        data: {
            postId: postId,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            $('.preloader-defalt').hide();
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                if (data.status == "N200") {
                    createModal();
                    $("#inputComm").attr('disabled', true);
                    if (from == 0) {
                        $("#allCommContainer").hide();
                    }
                    $('#saveDraft').hide();
                    $("#isUpdate").val(postId);
                    //set modal title
                    $("#myModal .modal-title").html('Edit Post');
                    //set community id & name
                    $("#communityId").val(data.data.communityId);
                    $('#inputComm').val(data.data.communityname);
                    // subscribedCommunity.forEach(function(item, index) {
                    //     if (item.id == data.data.communityId) {        
                    //     }
                    // });
                    //set audio
                    presetAudio(getPostAudio(data.data.postAudio));
                    $("#tempAudio").attr('data-audio-name', data.data.postAudio);
                    //set text
                    $("#contentbox").text(data.data.postDescription);
                    if (data.data.postImage != "" && data.data.postImage != null) {
                        let mockFile = {
                            size: 1000000,
                            accepted: true,
                            sName: data.data.postImage,
                            sUrl: $("body").attr("data-base-url") + "attachments/postimages/" + data.data.postImage
                        };
                        addFileDZ("imagePhoto", mockFile);
                    }
                    if (data.data.postAttachment && data.data.postAttachment != "") {
                        let ext = data.data.postAttachment.substr(data.data.postAttachment.lastIndexOf('.') + 1);
                        let mockFile = {
                            //size: 1000000,
                            name: ext,
                            accepted: true,
                            sName: data.data.postAttachment,
                            type: 'application/pdf',
                            sUrl: $("body").attr("data-base-url") + "attachments/postattachments/" + data.data.postAttachment
                        };
                        addFileDZWT("attachmentPhoto", mockFile);
                    }
                    console.log(data.data.postLink);
                    if (data.data.postLink != "") {
                        $("#postLink").val(data.data.postLink);
                        addLink1();
                    }

                } else {
                    console.log(data.message);
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            $('.preloader-defalt').hide();
            console.log('Error' + errorMessage);
        }
    });
}

//delete  post
function deletepost(postId, from) {
    $('.preloader-defalt').show();
    $.ajax({
        method: 'POST',
        url: '/Common/deletemypost',
        data: {
            userId: ($("#id").val() ? $("#id").val() : 0),
            postId: postId,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            $('.preloader-defalt').hide();
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                if (data.status == "N200") {
                    $('#post_' + postId + "_" + from).fadeOut('slow');
                    //window.location.href = $('body').attr('data-base-url') + '/' + page_name;
                } else {
                    console.log(data.message);
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            $('.preloader-defalt').hide();
            console.log('Error' + errorMessage);
        }
    });
}

//LIKE post
function makeLikeUnlike(curr, via) {
    let postId = $(curr).attr("data-id");
    let from = $(curr).attr("data-from");
    let currHtml = $(curr);
    $('.preloader-defalt').show();
    $.ajax({
        type: 'POST',
        url: via == 1 ? '/Common/likesCount' : '/Common/unlikesCount',
        data: {
            postId: postId,
            from: from,
            userId: $('#id').val()
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                $('.preloader-defalt').hide();
                if (data.status == "N200") {
                    $(currHtml).parent().find('span.likes_count').text(data.updated + " upvotes");
                    $(currHtml).addClass('hide');
                    $(currHtml).siblings().removeClass('hide');
                } else {
                    console.log(data.message);
                }
            } else {
                $('.preloader-defalt').hide();
                console.log("ajax failed");
            }

        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}


//load comments
function loadCommentsRow(postId, from) {
    $('.preloader-defalt').show();
    $.ajax({
        method: 'POST',
        url: '/Common/getComments',
        data: {
            postId: postId,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            $('.preloader-defalt').hide();
            if (status == "success") {
                if (data.status == "N200") {
                    populateComment(data.data, postId, from);
                } else {
                    console.log(data.message);
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            $('.preloader-defalt').hide();
            console.log('Error' + errorMessage);
        }
    });
}

//populate comment
function populateComment(data, postId, from) {
    let content = "";
    data.forEach((c) => {
        content += `
         <div class="comment-item">
            <div class="comment-section-con">
                <div class="img">
                    <img src="${getProfilePic(c.profileimage)}">
                </div>
                <strong>${c.username}</strong>
                <span>${$.timeago(c.created)}</span>
                <div class="clearfix"></div>
                <p>${c.comment}</p>
                <div class="clearfix"></div>
            </div>
            <div class="comment-section-bottom-btn">
                <a href="javascript:void(0)" class="comment-btn-reply" data-id="${c.id}" data-from="${from}">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    <span class="replies_count">${c.replies_count} replies</span>
                </a>
                <a href="javascript:void(0)" class="likecomment ${c.isLiked?'hide':''}" data-id="${c.id}" data-from="${from}">
                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    <span class="commentlikes_count">${c.likes} Upvotes</span>
                </a>
                <a href="javascript:void(0)" class="unlikecomment ${c.isLiked?'':'hide'}" data-id="${c.id}" data-from="${from}">
                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    <span class="commentlikes_count">${c.likes} Upvotes</span>
                </a>            
              </div>
            <div class="comment-section comment-sec comment-reply" id="comment_sec_reply_${c.id}_${from}">
                <div class="comment-input">
                  <input type="text" placeholder="Write Reply..." maxlength="1024">
                  <button onclick="addcommentreply(this,'${c.id}','${from}')">Reply</button>
                </div>
                <div class="comment-parent-container"></div>
            </div>
        </div>
  `;
    });
    $("#comment_sec_" + postId + "_" + from).children('.comment-parent-container').html(content).promise().done(function() {
        // setLikeClickComment();
        // setCommentClickReply();
    });

}

// LIKE & UNLIKE SUB Comment
$(document).on('click', '.likecomment', function(event) {
    makeLikeUnlikeComment(this, 1);
});
$(document).on('click', '.unlikecomment', function(event) {
    makeLikeUnlikeComment(this, 0);
});

$(document).on('click', '.comment-btn-reply', function(event) {
    let comment_id = $(this).attr('data-id');
    let from = $(this).attr('data-from');
    let target = "#comment_sec_reply_" + comment_id + "_" + from;
    if ($(target).css('display') == 'none') {
        $(target).slideDown('fast');
        loadCommentsReplyRow(comment_id, from);
    } else {
        $(target).slideUp('fast');
    }
});

// LIKE & UNLIKE SUB Comment
// function setLikeClickComment() {
//     $('.likecomment').click(function(event) {
//         makeLikeUnlikeComment(this, 1);
//     });
//     $('.unlikecomment').click(function(event) {
//         makeLikeUnlikeComment(this, 0);
//     });
// }
// function setCommentClickReply() {
//     $(".comment-btn-reply").click(function() {
//     });
// }

function addcomment(curr, postId, from) {
    var comment = $(curr).siblings('input').val().trim();
    if (comment == "") {
        return false;
    }
    $.ajax({
        type: 'POST',
        url: '/Common/addcomment',
        data: {
            postId: postId,
            userId: $("#id").val(),
            comment: comment,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                if (data.status == "N200") {
                    $(curr).siblings('input').val("");
                    let c = $(curr).parents('.comment-section').siblings('.post-bottom').find('.comment_count');
                    let temp = parseInt($(c).html().split(" ")[0]);
                    $(c).html((temp += 1) + " comments");
                    loadCommentsRow(postId, from);
                } else {

                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}

function makeLikeUnlikeComment(curr, via) {
    let commentId = $(curr).attr("data-id");
    let from = $(curr).attr("data-from");
    let currHtml = $(curr);
    $('.preloader-defalt').show();
    $.ajax({
        type: 'POST',
        url: via == 1 ? '/Common/likesCommentCount' : '/Common/unlikesCommentCount',
        data: {
            comment_id: commentId,
            from: from,
            user_id: $('#id').val()
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                $('.preloader-defalt').hide();
                if (data.status == "N200") {
                    $(currHtml).parent().find('span.commentlikes_count').text(data.updated + " likes");
                    $(currHtml).addClass('hide');
                    $(currHtml).siblings().removeClass('hide');
                } else {
                    console.log(data.message);
                }
            } else {
                $('.preloader-defalt').hide();
                console.log("ajax failed");
            }

        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}

function loadCommentsReplyRow(comment_id, from) {
    $('.preloader-defalt').show();
    $.ajax({
        method: 'POST',
        url: '/Common/getCommentsReply',
        data: {
            comment_id: comment_id,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            $('.preloader-defalt').hide();
            if (status == "success") {
                if (data.status == "N200") {
                    populateCommentReply(data.data, comment_id, from);
                } else {
                    console.log(data.message);
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            $('.preloader-defalt').hide();
            console.log('Error' + errorMessage);
        }
    });
}

function populateCommentReply(data, comment_id, from) {
    let content = "";
    data.forEach((r) => {
        content += `
      <div class="comment-section-con">
               <div class="img">
                <img src="${getProfilePic(r.profileimage)}">
               </div>
               <strong>${r.username}</strong>
               <span>${$.timeago(r.created)}</span>
               <div class="clearfix"></div>
               <p>${r.reply}</p>
               <div class="clearfix"></div>
             </div>
    `;
    });
    $("#comment_sec_reply_" + comment_id + "_" + from).children('.comment-parent-container').html(content).promise().done(function() {
        // setLikeClickComment();
        // setCommentClickReply();
    });

}

//not in use
function getdynamicCommentreplybox(comment_id) {
    var comment_id = comment_id;
    $('.preloader-defalt').show();
    $.ajax({

        url: $('body').attr('data-base-url') + 'myprofile/getdynamicCommentreplybox',
        method: 'post',
        data: {
            comment_id: comment_id
        }
    }).done(function(response) {
        $('.preloader-defalt').hide();
        // console.log(response);
        // console.log("#comment_"+post_id);
        $("#commentreplyid_" + comment_id).html('');
        $("#commentreplyid_" + comment_id).html(response);
        $("#commentreplyid_" + comment_id).toggle();
        return false;
    });
}

function addcommentreply(curr, comment_id, from) {
    var reply = $(curr).siblings('input').val().trim();
    if (reply == "") {
        return false;
    }
    $.ajax({
        type: 'POST',
        url: '/Common/addcommentreply',
        data: {
            comment_id: comment_id,
            user_id: $("#id").val(),
            reply: reply,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                if (data.status == "N200") {
                    $(curr).siblings('input').val("");
                    loadCommentsReplyRow(comment_id, from);
                } else {

                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}

//save post
function savepost(curr) {
    let postId = $(curr).attr("data-id");
    let action = $(curr).attr("data-action");
    let from = $(curr).attr("data-from");
    let currHtml = $(curr);
    $('.preloader-defalt').show();
    $.ajax({
        url: '/Common/savepost',
        method: 'POST',
        data: {
            postId: postId,
            action: action,
            from: from
        },
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                $('.preloader-defalt').hide();
                if (data.status == "N200") {
                    $(currHtml).attr('data-action', data.updated);
                    if (data.updated == 1) {
                        $(currHtml).children('.fa').removeClass('fa-bookmark-o');
                        $(currHtml).children('.fa').addClass('fa-bookmark');
                        $(currHtml).children('.save_status').html('Saved');
                    } else {
                        $(currHtml).children('.fa').removeClass('fa-bookmark');
                        $(currHtml).children('.fa').addClass('fa-bookmark-o');
                        $(currHtml).children('.save_status').html('Save');
                    }
                } else {
                    console.log(data.message);
                }
            } else {
                $('.preloader-defalt').hide();
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}


//Report user posts
function showreportpost(post_id, from) {
    $('.preloader-defalt').show();
    $.ajax({
        url: $('body').attr('data-base-url') + 'mypage/getCommonReportsbox',
        method: 'post',
        data: {
            post_id: post_id
        }
    }).done(function(response) {
        $('.preloader-defalt').hide();
        $("#myModal-report_" + post_id).html(response).modal('show');
        return false;
    });
}

function closeReport() {
    $('.preloader-defalt').hide();
    document.location.reload();
}

//clicked on the data from server
function addreportpost(postID) {
    var returnval = true;
    var postID = document.getElementById("reportpostid_" + postID).value;
    var user_id = document.getElementById("id_" + postID).value;
    var reason = document.getElementById("report_reason_" + postID).value;
    var other_reason = document.getElementById("other_reason_" + postID).value;
    if (reason == "") {
        document.getElementById('reportreasonerror_' + postID).innerText = "*Reason is required.";
        returnval = false;
    }
    if (returnval == true) {
        $.ajax({
            url: $('body').attr('data-base-url') + 'mypage/insertReports',
            type: 'POST',
            data: {
                postID: postID,
                user_id: user_id,
                reason: reason,
                other_reason: other_reason
            }
        }).done(function(response) {
            //    $('.preloader-defalt').hide();
            // console.log(response);
            // console.log("#comment_"+postID);
            $("#myModal-report_" + postID).html(response).modal('show');
            // $("#comment_"+postID).html('');
            // $("#comment_"+postID).html(response);
            // $("#comment_"+postID).toggle();
            // loadCommentsRow(postID);
            return false;
        });
    }
}

function reportpost() {
    var returnval = true;
    clearerrors();
    var user_id = $("#id").val();
    var postID = $('#report_userposts').attr('data-value');
    var e = document.getElementById("report_reason");
    var reason = e.options[e.selectedIndex].value;
    var other_reason = $("#other_reason").val();
    if (reason == "" || other_reason == "") {
        document.getElementById('reportreasonerror').innerText = "*Report reason is required.";
        returnval = false;
    }
    if (returnval == true) {
        $.ajax({
            url: $('body').attr('data-base-url') + "Mypage/insertReports",
            type: 'POST',
            data: { user_id: user_id, postID: postID, reason: reason, other_reason: other_reason },
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.success == "200") {
                    $('#successmsgreport').fadeIn().html("Reported succcessfully");
                    setTimeout(function() {
                        $('#successmsgreport').fadeOut(5000);
                    }, 1000);
                    window.location.href = $('body').attr('data-base-url') + "mypage";
                } else {
                    alert("error");
                }
            }
        });
    }
}

// Multiple Invites
$("#btn_invites").on("click", function(e) {
    var contactIds = $("#contact-ids").val().trim();
    console.log(contactIds);
    const phoneExp = /^\d{10}$/;
    const emailExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (contactIds == "" || contactIds.length <= 5) {
        $("#contact-ids").addClass('form-error-input');
        $('#invite-err').html("*Input is invalid");
        return false;
    }
    let resp = false;
    let temp = contactIds.split(",");
    for (var i = 0; i < temp.length; i++) {
        const item = temp[i].trim();
        if (phoneExp.test(item) || emailExp.test(String(item).toLowerCase())) {
            resp = true;
        } else {
            $("#contact-ids").addClass('form-error-input');
            $('#invite-err').html("Value is invalid");
            resp = false;
            break;
        }
    }
    if (resp) {
        $('.preloader-defalt').show();
        $.ajax({
            type: 'POST',
            url: '/Common/invitetofriends',
            data: { contactIds: contactIds },
            dataType: 'json',
            success: function(data, status, xhr) {
                console.log('status: ' + status + ', data: ' + ":" + data + ":");
                if (status == "success") {
                    $('.preloader-defalt').hide();
                    if (data.status == "N200") {
                        $('#contact-ids').val('');
                        $('#invite-succ').html('Invite sent successfully!!!');
                        setTimeout(() => {
                            $('#invite-succ').html('');
                        }, 2000);
                    } else {
                        $("#invite-err").html(data.message);
                    }
                } else {
                    console.log("ajax failed");
                }
            },
            error: function(jqXhr, textStatus, errorMessage) {
                $('.preloader-defalt').hide();
                console.log('Error' + errorMessage);
            }
        });
    }
});



$(document).ready(function() {
    // $('.btn-publish').click(function(e) {
    //     var shop_category = $('[name="shop_categorie"]').val();
    //     if (shop_category == null) {
    //         e.preventDefault();
    //         alert('There is no create and selected shop category!');
    //     }
    // });

    $("a.confirm-delete").click(function(e) {
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
            callback: function(result) {
                if (result) {
                    window.location.href = lHref;
                }
            }
        });
    });

    $("a.confirm-save").click(function(e) {
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
            callback: function(result) {
                if (result) {
                    document.getElementById(formId).submit();
                }
            }
        });
    });

    // $('#country').change(function() {
    //     var country_code = $(this).val();
    //     if (country_code) {
    //         $.ajax({

    //             url: $('body').attr('data-base-url') + 'contact/getcountrycode',
    //             method: 'post',
    //             data: {
    //                 id: $(this).attr('data-src'),
    //                 country_code: country_code
    //             }
    //         }).done(function(response) {
    //             $('#country_code').val(response);
    //             return false;
    //         });
    //     }
    // });

    //End Here
    $("#addmoreskills").on("click", function(e) {
        $('#more_skills').show();
        $('#myskills').hide();
        $('#addmoreskills').hide();
        $('.preloader-defalt').hide();
    });

    $("#add_skills").on("focusout", function() {
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
            }).done(function(response) {
                $('.preloader-defalt').hide();
                if (response > 0) {
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
    //useless
    // $(".close").on("click", function(e) {
    //     window.location.href = $('body').attr('data-base-url') + "communities/manage/";
    // });

    $("#remove_ads").on("click", function(e) {
        window.location.href = $('body').attr('data-base-url') + "promotionaladvertising";
    });

    $("#btn_suggestions").on("click", function(e) {
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
                url: '/Common/setsuggestions',
                method: 'post',
                data: {
                    user_suggestions: suggestion,
                    page_url: page_url
                }
            }).done(function(response) {
                $('.preloader-defalt').hide();
                $('#suggestions_div').html('');
                $('#suggestions_div').html(response);
                return false;
            });
        }
        return false;

    });


});

// CHECK LATER
function editcommunity(com_id) {
    var community_id = com_id;
    $.ajax({
        url: $('body').attr('data-base-url') + 'common/setsuggestions',
        method: 'post',
        data: {
            id: $(this).attr('data-src'),
            community_id: community_id
        }
    }).done(function(response) {
        $('#suggestions_div').html('');
        $('#suggestions_div').html(response);
        return false;
    });
}


//FUNC removed
// function hidepost(action, postid, page_name) {
//     var post_id = postid;
//     $('.preloader-defalt').show();
//     $.ajax({
//         url: $('body').attr('data-base-url') + 'common/hidemypost',
//         method: 'post',
//         data: {
//             id: $(this).attr('data-src'),
//             postID: post_id,
//             action: action,
//             page_name: page_name
//         }
//     }).done(function(response) {
//         $('.preloader-defalt').hide();
//         if (response > 0) {
//             setTimeout(function() { $('#mypost_' + post_id).hide(); }, 1000);
//         }
//         window.location.href = $('body').attr('data-base-url') + '' + page_name;
//         return true;
//     });
// }









//    function loadCommentsrepliesRow(comment_id)
// {
//        var id = comment_id;
//        var comment_id = comment_id;
//        $('.preloader-defalt').show();
//        $.ajax({

//            url: $('body').attr('data-base-url') + 'myprofile/getdynamicCommentreplybox',
//            method: 'post',
//            data: {
//                id: comment_id,
//                comment_id: comment_id
//            }
//        }).done(function (response) {
//            $('.preloader-defalt').hide();
//            //console.log(response);
//            //console.log("#comment_"+post_id);
//            $("#commentreplyid_"+comment_id).html('');
//            $("#commentreplyid_"+comment_id).html(response);
//            $("#commentreplyid_"+comment_id).toggle();
//            return false;
//        })
// }


// function addreplybypressingenter(comment_id) {
//     if (window.event.keyCode === 13) {
//         window.event.preventDefault();
//         document.getElementById("addreplybyenter_" + comment_id).click();
//     }
// }
// function addcommentbypressingenter(post_id) {
//     if (window.event.keyCode === 13) {
//         window.event.preventDefault();
//         document.getElementById("addcommentbyenter_" + post_id).click();
//     }
// }
// function addcommunitycommentbyenter(post_id) {
//     if (window.event.keyCode === 13) {
//         window.event.preventDefault();
//         document.getElementById("addcommunitycommentbyenter_" + post_id).click();
//     }
// }
// function addcommunityreplybyenter(comment_id) {
//     if (window.event.keyCode === 13) {
//         window.event.preventDefault();
//         document.getElementById("addcommunityreplybyenter_" + comment_id).click();
//     }
// }