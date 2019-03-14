/*
- Dashicons: https://developer.wordpress.org/resource/dashicons/
- Categories: common | formatting | layout | widgets | embed
*/

/* Save some references */
const el = wp.element.createElement;
const registerBlockType = wp.blocks.registerBlockType;
// Remove this if creating static block
const RichText = wp.editor.RichText;

/* Register new block type */
registerBlockType( 'igv-blocks/globie-gutenberg-block', {
  title: 'Globie Block',
  description: 'Globie\'s favorite block.',
  icon: 'universal-access-alt',
  category: 'layout',

  /* A RichText editable block */
  attributes: {
    content: {
      type: 'string',
      source: 'html',
      selector: 'p',
    }
  },

  // The editor block
  edit: ( props ) => {
    const content = props.attributes.content;

    const onChangeContent = ( newContent ) => {
      props.setAttributes( { content: newContent } );
    }

    return el(
      RichText,
      {
        tagName: 'p',
        className: props.className,
        onChange: onChangeContent,
        value: content,
      }
    );
  },

  // The front-end block
  save: function( props ) {
    const content = props.attributes.content;

    return el( RichText.Content, {
      tagName: 'p',
      className: props.className,
      value: content
    } );
  },

  /* A static block */
  // The editor block
  /*
  edit: (props) => {
    return el ( 'p', { className: props.className }, 'Hello editor.' );
  },
  */

  // The front-end block
  /*
  save: () => {
    return   el( 'p', {}, 'Hello saved content.' );
  },
  */
} );
