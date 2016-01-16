/*
function ajaxLoadPage(fromurl) {
	//args: fromurl,method,sendData,toDiv,fromDiv
	//e.g.: 
	NProgress.start();
	var toDiv = arguments[3] ? arguments[3] : '#mainContent';
	var fromDiv = arguments[4] ? arguments[4] : '.mainContent';
	$.ajax({
        url: './'+fromurl, //这里是静态页的地址
		data: arguments[2] ? arguments[2] : '{}',
        type: arguments[1] ? arguments[1] : 'GET', //静态页用get方法，否则服务器会抛出405错误
		dataType: "html",
        success: function(data) {
			console.log(data);
            var result = $(data);
			//console.log(result);
			console.log(fromurl);
            $(toDiv).html(result);
		},
		complete:function(jqXHR, textStatus) {
			NProgress.done();
		}
	});
}
*/

