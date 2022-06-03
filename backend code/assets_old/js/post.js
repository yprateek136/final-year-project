let trendingStatus = 0;
let offset = 0;
let scrollLoad = false;


function populatePosts(data, from, via) {
    console.log(from);
    let uID = ($("#id").val() ? $("#id").val() : 0);
    let content = "";
    let tempFrom = from;
    data.forEach((p) => {
        let commLink = "";
        if (tempFrom == 3) {
            if (p.communityId == 0) {
                from = 0;
                commLink = "";
            } else {
                from = 1;
                commLink = `<i class="fa fa-caret-right" aria-hidden="true"></i><a href="/topic/${p.communityslug}"><p>${p.communityname}</p></a>`;
            }
        }
        content += `
         <div class="mid-container" id="post_${p.id}_${from}">
    <div class="post-main">
        <div class="post-top">
            <div class="header-img">
                <img alt="" src="${getProfilePic(p.profileimage)}">
            </div>
            <a href="/profile/${p.slug}">
                <p>${p.username}</p>
            </a>
            ${commLink}
            <span></span>
            <span><i class="fa fa-clock-o" aria-hidden="true" style="color:#7f7f7f;"></i> ${jQuery.timeago(p.modified_date)} ${p.isEdited==1?'| (edited)':''}</span>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v" aria-hidden="true" style="color:#7f7f7f;"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="javascript:void(0)" onclick="copypost('${p.id}','${from}')">Copy Link</a>
                    <a class="dropdown-item ${p.hasOwnProperty("shareData")?'hide':''} ${p.userId==uID?'':'hide'}" href="javascript:void(0)" onclick="editpost('${p.id}','${from}')">Edit</a>
                    <a class="dropdown-item ${p.userId==uID?'':'hide'}" href="javascript:void(0)" onclick="deletepost('${p.id}','${from}')">Delete</a>
                    <a style="display:none;" class="dropdown-item ${p.userId!=uID?'':'hide'}" href="javascript:void(0)" onclick="showreportpost('${p.id}','${from}')">Report</a>
                </div>
            </div>
        </div>
            ${populateSubPost(p,from)}
        <div class="comment-section comment-sec" id="comment_sec_${p.id}_${from}">
            <div class="comment-input">
                <input type="text" placeholder="Write Comment..." maxlength="1024">
                <button onclick="addcomment(this,'${p.id}','${from}')">Comment</button>
            </div>
            <div class="comment-parent-container"></div>
        </div>
    </div>
</div>
    `;
    });

    //Saved Post
    if ($("#mysavedpost").length != 0) {
        if (from == 1) {
            $("#mysavedcommpost").html(content);
        } else {
            $("#mysavedpost").html(content);
        }
        //My Profile Post        
    } else if ($("#mypost").length != 0) {
        if (via == 1) {
            $("#mypost").append(content);
        } else {
            $("#mypost").html(content);
        }
        // All
    } else {
        if (via == 1) {
            $("#postsContainer").append(content);
        } else {
            $("#postsContainer").html(content);
        }

    }
    scrollLoad = true;
}

function setPostAction() {
    //setLikeClick();
    //setCommentClick();
    //setSaveClick();
}

function populateSubPost(p, from) {
    let con = "";
    if (p.hasOwnProperty("shareData")) {
        let s = p.shareData;
        con = `
        <div class="post-mid"><p>${p.postDescriptionShare}</p></div>
        <div class="post-shared">
            <div class="post-top">
                <div class="header-img">
                    <img alt="" src="${getProfilePic(s.profileimage)}">
                </div>
                <a href="/profile/${s.slug}">
                    <p>${s.username}</p>
                </a>
                <span></span>
                <span><i class="fa fa-clock-o" aria-hidden="true" style="color:#7f7f7f;"></i> ${jQuery.timeago(s.created_date)}</span>
            </div>
            <div class="post-mid">
                <div style="cursor:pointer" onclick="getuniquepostpopupbyclick('${s.id}','${from}')">
                    <p>${s.postDescription}</p>
                    <img class="${(s.postImage?'':'hide')}" src="${getPostPic(s.postImage)}" alt='${s.postImage}'>
                    <div onclick="manageAudioClick(event)">
                     <audio class="${p.postAudio?'':'hide'}" controls src="${getPostAudio(s.postAudio)}"></audio>
                    </div>
                </div>
                <div class="right-links">
                    <a class="${(s.postLink?'':'hide')}" href="${makeLink(s.postLink)}" target="_blank" data-toggle="tooltip" title="Link"><i class="fa fa-link" aria-hidden="true"></i></a>
                    <a class="${(s.postAttachment?'':'hide')}" href="${getPostAttach(s.postAttachment)}" target="_blank" data-toggle="tooltip" title="Attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
         <div class="post-bottom">
            <ul>
                <li class="like ${p.isLiked?'hide':''}" data-id="${p.id}" data-from="${from}"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><span class="likes_count">${p.likes+" Upvotes"}</span></li>
                <li class="unlike ${p.isLiked?'':'hide'}" data-id="${p.id}" data-from="${from}"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><span class="likes_count">${p.likes+" Upvotes"}</span></li>
                <li class="comment-btn" data-id="${p.id}" data-from="${from}"><i class="fa fa-comment-o" aria-hidden="true"></i><span class="comment_count">${p.comments_count} Comments</span></li>
                <li onclick="openShareModal('${s.id}','${from}')"><i class="fa fa-share-alt" aria-hidden="true"></i>Share</li>
                <li class="savepost" data-id="${p.id}" data-from="${from}" data-action="${(p.savedstatus?'1':'0')}"><i class="fa ${(p.savedstatus?'fa-bookmark':'fa-bookmark-o')}" aria-hidden="true"></i><span class="save_status">${(p.savedstatus?'Saved':'Save')}</span></li>
            </ul>
        </div>
        `;
    } else {
        con = `
        <div class="post-mid">
            <div style="cursor:pointer" onclick="getuniquepostpopupbyclick('${p.id}','${from}')">
                <p>${p.postDescription}</p>
                <img class="${(p.postImage?'':'hide')}" src="${getPostPic(p.postImage)}" alt='${p.postImage}'>
                <div onclick="manageAudioClick(event)">
                 <audio class="${p.postAudio?'':'hide'}" controls src="${getPostAudio(p.postAudio)}"></audio>
                </div>
            </div>
            <div class="right-links">
                <a class="${(p.postLink?'':'hide')}" href="${makeLink(p.postLink)}" target="_blank" data-toggle="tooltip" title="Link"><i class="fa fa-link" aria-hidden="true"></i></a>
                <a class="${(p.postAttachment?'':'hide')}" href="${getPostAttach(p.postAttachment)}" target="_blank" data-toggle="tooltip" title="Attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
            </div>
        </div>
         <div class="post-bottom">
            <ul>
                <li class="like ${p.isLiked?'hide':''}" data-id="${p.id}" data-from="${from}"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><span class="likes_count">${p.likes+" Upvotes"}</span></li>
                <li class="unlike ${p.isLiked?'':'hide'}" data-id="${p.id}" data-from="${from}"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><span class="likes_count">${p.likes+" Upvotes"}</span></li>
                <li class="comment-btn" data-id="${p.id}" data-from="${from}"><i class="fa fa-comment-o" aria-hidden="true"></i><span class="comment_count">${p.comments_count} Comments</span></li>
                <li>
                    <div class="dropdown share-dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-share-alt" aria-hidden="true" style="color:#7f7f7f;"></i> Share
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="copypost('${p.id}','${from}')">Copy Link</a>
                        </div>
                    </div>
                </li>
                <li class="savepost" data-id="${p.id}" data-from="${from}" data-action="${(p.savedstatus?'1':'0')}"><i class="fa ${(p.savedstatus?'fa-bookmark':'fa-bookmark-o')}" aria-hidden="true"></i><span class="save_status">${(p.savedstatus?'Saved':'Save')}</span></li>
                
            </ul>
        </div>
        `;
        //<li onclick="openShareModal('${p.id}','${from}')"><i class="fa fa-share-alt" aria-hidden="true"></i>Share</li>
    }
    return con;
}

function manageAudioClick(e){
    e.preventDefault();
    e.stopPropagation();
    console.log('manageAudioClick');  
}

// LIKE & unLIKE
$(document).on('click', '.like', function(event) {
    event.preventDefault();
    if (!$('#id').val()) {
        location.href = $("body").attr('data-base-url') + "login";
        return;
    }
    makeLikeUnlike(this, 1);
});

$(document).on('click', '.unlike', function(event) {
    event.preventDefault();
    if (!$('#id').val()) {
        location.href = $("body").attr('data-base-url') + "login";
        return;
    }
    makeLikeUnlike(this, 0);
});
//COMMENT VIEW
$(document).on('click', '.comment-btn', function(event) {
    if (!$('#id').val()) {
        location.href = $("body").attr('data-base-url') + "login";
        return;
    }
    let postId = $(this).attr('data-id');
    let from = $(this).attr('data-from');
    let target = "#comment_sec_" + postId + "_" + from;
    if ($(target).css('display') == 'none') {
        $(target).slideDown('fast');
        loadCommentsRow(postId, from);
    } else {
        $(target).slideUp('fast');
    }
});

$(document).on('click', '.savepost', function(event) {
    if (!$('#id').val()) {
        location.href = $("body").attr('data-base-url') + "login";
        return;
    }
    savepost(this);
});


function anchorify(text) {
    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
    var text1 = text.replace(exp, '$1');
    var exp2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    return text1.replace(exp2, '$1 http://$2');
}

function makeLink(url) {
    if (url.startsWith("www.")||url.startsWith("http")) {
        return anchorify(url);
    } else {
        return anchorify('www.' + url);
    }
}

function getProfilePic($pic) {
    if ($pic) {
        return "/attachments/profilepic/" + $pic;
    } else {
        return "/attachments/profilepic/avatar-default-icon.png";
    }
}

function getCommPic($pic) {
    if ($pic) {
        return "/attachments/communityimages/" + $pic;
    } else {
        return "/attachments/communityimages/fintech.png";
    }
}

function getPostPic($pic) {
    if ($pic) {
        return "/attachments/postimages/" + $pic;
    } else {
        return "";
    }
}

function getPostAudio($pic) {
    if ($pic) {
        return "/attachments/postaudio/" + $pic;
    } else {
        return "";
    }
}

function getPostAttach($pic) {
    if ($pic) {
        return $("body").attr('data-base-url') + "/attachments/postattachments/" + $pic;
    } else {
        return "";
    }
}