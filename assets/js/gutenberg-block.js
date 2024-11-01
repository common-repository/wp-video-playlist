const { registerBlockType } = wp.blocks
const { select } = wp.data

registerBlockType('wp-video-playlist/video-player', {
  title: "WP Video Playlist",
  description: "WP Video Playlist",
  icon: "admin-media",
  category: "media",
  attributes: {
    id: {
      type: "string"
    }
  },
  edit: ({ setAttributes }) => {
    let id = '';
    if(select( 'core/block-editor' ).getSelectedBlock()) {
      id = select( 'core/block-editor' ).getSelectedBlock().clientId
      setAttributes({
        id: select( 'core/block-editor' ).getSelectedBlock().clientId
      })
    }
    return `WP Video Playlist`
  },
  save: () => null,
  example: {
    'preview' : true
  },
})