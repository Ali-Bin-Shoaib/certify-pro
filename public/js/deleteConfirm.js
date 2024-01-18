$('li>form.dropdown-item>button').click(function (e) {
	e.preventDefault();
	$.confirm({
		title: 'حذف',
		content: 'هل أنت متأكد من الحذف؟',
		buttons: {
			confirm: function () {
				$('li>form.dropdown-item>button').submit();
			},
			cancel: function () {
				$.alert('Canceled!');
			},
		},
	});
});
