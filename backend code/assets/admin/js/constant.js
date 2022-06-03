var SERVER_URL = "https://www.9ightout.com/_dev_ops/enterprise/";
var API_KEY = "108045B4BAF2D77655BD7D68F5D5B0C1";
var IMAGE_URL = "http://35.154.128.163/attachments/";

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

function doAjaxCall(sUrl) {
    return new Promise(function(resolve, reject) {
     $.ajax({
                type: 'POST',  // http method
                url: '/admin/api/removeimage',
                data: { fileUrl: sUrl },  // data to submit
                dataType: 'json',
                success: function (data, status, xhr) {
                    console.log('status: ' + status + ', data: ' + data.message);
                    if(status=="success"){
                        resolve();
                        console.log(data.message);
                    }else{
                        reject();
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    reject();
                        console.log('Error' + errorMessage);
                    }
            });
    });
}


function dateFormat(d) {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var date = new Date(d);

    var dy = date.getDay();
    var da = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    return dayNames[dy] + ', ' + da + ' ' + monthNames[m] + ' ' + y;
}

function time12(time) {
    var arr = time.split(":");
    var ampm = 'AM';
    if (arr[0] >= 12) {
        ampm = 'PM';
    }
    if (arr[0] > 12) {
        arr[0] = arr[0] - 12;
    }
    op = arr[0] + ':' + arr[1] + ' ' + ampm;
    return op;
}

function timeRZ(time) {
    var arr = time.split(":");
    return arr[0] + ':' + arr[1];
}