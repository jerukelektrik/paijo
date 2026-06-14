(function() {
	tinymce.PluginManager.add('paijo_related_post', function(editor, url) {
		editor.addButton('paijo_related_post', {
			text: 'Related Post',
			tooltip: 'Insert a manual related post card',
			icon: false,
			onclick: function() {
				editor.windowManager.open({
					title: 'Pilih Artikel Terkait',
					url: ajaxurl + '?action=paijo_editor_posts_selector',
					width: 720,
					height: 550,
					buttons: [{
						text: 'Batal',
						onclick: 'close'
					}]
				});
			}
		});
	});
})();
