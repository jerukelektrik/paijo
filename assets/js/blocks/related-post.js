const { registerBlockType } = wp.blocks;
const { SelectControl, PanelBody } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { useSelect } = wp.data;

registerBlockType('paijo/related-post', {
	title: 'Paijo Related Post',
	description: 'Insert a manual related post card.',
	icon: 'admin-links',
	category: 'widgets',
	attributes: {
		postId: {
			type: 'string',
			default: ''
		}
	},
	edit: ({ attributes, setAttributes }) => {
		const posts = useSelect((select) => {
			return select('core').getEntityRecords('postType', 'post', { per_page: 100, status: 'publish' });
		}, []);

		let options = [{ label: 'Select a post...', value: '' }];
		if (posts) {
			posts.forEach(post => {
				// strip html tags if any in title
				const cleanTitle = (post.title && post.title.rendered) 
					? post.title.rendered.replace(/<\/?[^>]+(>|$)/g, "") 
					: `Post #${post.id}`;
				options.push({ label: cleanTitle, value: post.id.toString() });
			});
		}

		const selectedPost = posts ? posts.find(p => p.id.toString() === attributes.postId) : null;
		const displayTitle = selectedPost 
			? (selectedPost.title && selectedPost.title.rendered ? selectedPost.title.rendered.replace(/<\/?[^>]+(>|$)/g, "") : `Post #${selectedPost.id}`)
			: 'No post selected. Choose one in the block settings.';

		return wp.element.createElement(
			wp.element.Fragment,
			null,
			wp.element.createElement(
				InspectorControls,
				null,
				wp.element.createElement(
					PanelBody,
					{ title: 'Related Post Settings', initialOpen: true },
					wp.element.createElement(
						SelectControl,
						{
							label: 'Select Article',
							value: attributes.postId,
							options: options,
							onChange: (value) => setAttributes({ postId: value })
						}
					)
				)
			),
			wp.element.createElement(
				'div',
				{
					style: {
						padding: '16px',
						backgroundColor: '#f3f4f6',
						border: '1px dashed #ded8cd',
						borderRadius: '12px',
						fontFamily: 'sans-serif',
						fontSize: '14px',
						color: '#111111',
						display: 'flex',
						alignItems: 'center',
						justifyContent: 'space-between',
						gap: '16px',
						margin: '20px 0'
					}
				},
				wp.element.createElement(
					'div',
					{ style: { flex: 1, minWidth: '0' } },
					wp.element.createElement('div', { style: { fontSize: '10px', fontWeight: 'bold', color: '#f1818f', textTransform: 'uppercase', marginBottom: '4px' } }, 'Related Article'),
					wp.element.createElement('h4', { style: { margin: '0 0 8px 0', fontSize: '15px', fontWeight: 'bold', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' } }, displayTitle),
					wp.element.createElement('span', { style: { fontSize: '11px', color: '#74706a' } }, 'Manual Selector')
				),
				wp.element.createElement(
					'div',
					{
						style: {
							width: '60px',
							height: '60px',
							backgroundColor: '#e5e7eb',
							borderRadius: '12px',
							display: 'flex',
							alignItems: 'center',
							justifyContent: 'center',
							fontSize: '9px',
							color: '#9ca3af',
							flexShrink: 0
						}
					},
					'Thumbnail'
				)
			)
		);
	},
	save: () => {
		return null;
	}
});
