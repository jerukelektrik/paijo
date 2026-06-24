const { registerBlockType } = wp.blocks;
const { MediaUpload, MediaUploadCheck } = wp.blockEditor || wp.editor;
const { Button, Placeholder } = wp.components;
const { createElement: el } = wp.element;

registerBlockType('paijo/template-image', {
	title: 'Paijo Template Image',
	description: 'Upload an image that will be locked at 1200x800 resolution.',
	icon: 'format-image',
	category: 'widgets',
	attributes: {
		imageUrl: {
			type: 'string',
			default: ''
		},
		imageId: {
			type: 'number',
			default: 0
		}
	},
	edit: function(props) {
		const onSelectImage = function(media) {
			let url = media.url;
			if (media.sizes && media.sizes['paijo-template-image']) {
				url = media.sizes['paijo-template-image'].url;
			}
			props.setAttributes({
				imageUrl: url,
				imageId: media.id
			});
		};

		if (props.attributes.imageUrl) {
			return el('div', { className: props.className, style: { marginBottom: '20px', position: 'relative' } },
				el('img', { 
					src: props.attributes.imageUrl, 
					style: { 
						width: '100%', 
						height: 'auto', 
						display: 'block', 
						borderRadius: '12px',
						border: '1px solid #e5e7eb'
					} 
				}),
				el('div', { style: { position: 'absolute', top: '10px', right: '10px' } },
					el(Button, { 
						onClick: () => props.setAttributes({ imageUrl: '', imageId: 0 }), 
						isDestructive: true,
						variant: 'secondary',
						style: { backgroundColor: 'white' }
					}, 'Remove')
				)
			);
		}

		return el('div', { className: props.className, style: { marginBottom: '20px' } },
			el(Placeholder, {
				icon: 'format-image',
				label: 'Template Image (1200x800)',
				instructions: 'Pilih atau unggah gambar. Gambar akan secara otomatis dipotong/diresize menjadi 1200x800 pixel.'
			},
				el(MediaUploadCheck, null,
					el(MediaUpload, {
						onSelect: onSelectImage,
						allowedTypes: ['image'],
						value: props.attributes.imageId,
						render: function(obj) {
							return el(Button, { 
								onClick: obj.open, 
								isPrimary: true 
							}, 'Pilih Gambar');
						}
					})
				)
			)
		);
	},
	save: function(props) {
		if (!props.attributes.imageUrl) {
			return null;
		}
		return el('div', { className: props.className },
			el('img', { 
				src: props.attributes.imageUrl, 
				alt: 'Template Image',
				className: 'w-full h-auto object-cover rounded-xl border border-paijo-line/30 my-6' 
			})
		);
	}
});
