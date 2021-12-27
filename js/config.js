/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var uploadUrl = "https://imageupload.localhost.com"; //local URL
var uploadUrl = "https://imgupload.crowdwisdom.co.in";  //Live URL

function ajax_call(url, method, params, cb) {
    $.ajax({
        url: url,
        method: method,
        data: params
    }).done(function (result) {
        cb(result);
    });
}

function ajax_call_multipart(url, method, params, cb) {
    $.ajax({
        url: url,
        method: method,
        data: params,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (result) {
        cb(result);
    });
}

function findUrls(string) {
    var urls = string.match(/(https?:\/\/[^\s]+)/g);
    return urls;
}