(function (blocks, element, blockEditor, components) {
    var el = element.createElement;
    var registerBlockType = blocks.registerBlockType;
    var InspectorControls = blockEditor.InspectorControls;
    var PanelBody = components.PanelBody;
    var SelectControl = components.SelectControl;

    registerBlockType('mtcf/contact-form', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            function onChangeSkin(newSkin) {
                setAttributes({ skin: newSkin });
            }

            return [
                el(InspectorControls, { key: 'controls' },
                    el(PanelBody, { title: 'Form Settings', initialOpen: true },
                        el(SelectControl, {
                            label: 'Skin',
                            value: attributes.skin,
                            options: [
                                { label: 'Default', value: 'default' },
                                { label: 'Modern', value: 'modern' },
                                { label: 'Dark', value: 'dark' },
                            ],
                            onChange: onChangeSkin
                        })
                    )
                ),
                el('div', { className: props.className },
                    el('div', { style: { padding: '20px', border: '1px dashed #ccc', backgroundColor: '#f0f0f0', textAlign: 'center' } },
                        'MT Contact Form (Skin: ' + attributes.skin + ')'
                    )
                )
            ];
        },
        save: function () {
            return null; // Rendered via PHP
        },
    });
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components
));
