$('.cat-list_item').on('click', function () {
	$('.cat-list_item').removeClass('active');
	$(this).addClass('active');

	$.ajax({
		type: 'POST',
		url: '/wp-admin/admin-ajax.php',
		dataType: 'html',
		data: {
			action: 'filter_projects',
			category: $(this).data('slug'),
			type: $(this).data('type'),
		},
		success: function (res) {
			$('.project-tiles').html(res);
		},
	});
});

$('input[type=radio]').on('change', function() {
    $(this).closest("form").submit();
});
