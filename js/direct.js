var direct = function(method,args,callback){
	var argString = "";
	for(arg in args){
		argString += "&" + arg + "=" + args[arg];
	}
	$.ajax({
		url: "direct.php?method=" + method + argString,
		complete: function(data){
			callback($.parseJSON(data.responseText));
		}
	});
};