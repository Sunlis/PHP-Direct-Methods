var direct = function(method, args, callback, callbefore) {
	var argString = "";
	for(arg in args){
		argString += "&" + arg + "=" + args[arg];
	}
	if (is_defined(callbefore)) {
		callbefore({
			'method':method,
			'args':args,
			'callback':callback
		});
	}
	if(is_defined(method)){
		$.ajax({
			url: "direct.php?method=" + method + argString,
			complete: function(data){
				if (is_defined(callback)) {
					callback($.parseJSON(data.responseText));
				}
			}
		});
	}else{
		console.log("No method provided! Aborted direct call");
	}
};
// simple wrapper to allow argument passing via an object
var direct_config = function(config) {
	direct(config['method'], config['args'], config['callback'], config['callbefore']);
}

var is_defined = function(what){
	return (what !== undefined && what !== null);
}