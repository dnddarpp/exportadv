(function ($) {
	$.fn.uploader_pic = function (action, success, fail) {
		var rnd = Math.floor(Math.random() * 1000000000);

		if (!this.children().length)
			this.html('<form style=display:inline method=post enctype=multipart/form-data target=uploader_target_' + rnd + ' action="' + action.replace(/"/, '"') + '"><input name=file type=file><input type=submit></form>');

		var input = this.find('input[type=file]:eq(0)');
		var call_name = 'uploader_success_callback_' + rnd;
		var fail_name = 'uploader_fail_callback_' + rnd;
		this.find('form:eq(0)').append('<input type=hidden name=call value=' + call_name + '><input type=hidden name=fail value=' + fail_name + '>');
		this.append('<iframe name=uploader_target_' + rnd + ' scrolling=no frameborder=0 style=width:1px;height:1px></iframe>');
		window[call_name] = function (filename) {
			success(filename);
		};
		window[fail_name] = function (error) {
			fail(error);
		};
	};
})(jQuery);
