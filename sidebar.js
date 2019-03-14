( ( wp ) => {
  const registerPlugin = wp.plugins.registerPlugin;
  const PluginSidebar = wp.editPost.PluginSidebar;
  const el = wp.element.createElement;
  const Text = wp.components.TextControl;
  const withSelect = wp.data.withSelect;
  const withDispatch = wp.data.withDispatch;

  const mapSelectToProps = ( select ) => {
    return {
      metaFieldValue: select( 'core/editor' )
        .getEditedPostAttribute( 'meta' )
        [ 'igv_sidebar_meta_block_field' ]
    }
  }

  const mapDispatchToProps = ( dispatch ) => {
    return {
      setMetaFieldValue: function( value ) {
        dispatch( 'core/editor' ).editPost(
          { meta: { igv_sidebar_meta_block_field: value } }
        );
      }
    }
  }

  const MetaBlockField = ( props ) => {
    return el( Text, {
        label: 'Globie Meta Block Field',
        value: props.metaFieldValue,
        onChange: ( content ) => {
          props.setMetaFieldValue( content );
        },
    } );
  }

  const MetaBlockFieldWithData = withSelect( mapSelectToProps )( MetaBlockField );
  const MetaBlockFieldWithDataAndActions = withDispatch( mapDispatchToProps )( MetaBlockFieldWithData );

  registerPlugin( 'globie-sidebar', {
    render: () => {
      return el( PluginSidebar,
        {
          name: 'globie-sidebar',
          icon: 'admin-post',
          title: 'Globie Sidebar',
        },
        el( 'div',
          { className: 'globie-sidebar-content' },
          el( MetaBlockFieldWithDataAndActions )
        )
      );
    },
  } );
} )( window.wp );
