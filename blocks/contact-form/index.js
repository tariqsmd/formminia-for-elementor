(function (blocks, element, blockEditor, components, serverSideRender) {
    var el = element.createElement;
    var registerBlockType = blocks.registerBlockType;
    var InspectorControls = blockEditor.InspectorControls;
    var PanelBody = components.PanelBody;
    var SelectControl = components.SelectControl;
    var ToggleControl = components.ToggleControl;
    var TextControl = components.TextControl;
    var TextareaControl = components.TextareaControl;
    var RangeControl = components.RangeControl;
    var ServerSideRender = serverSideRender;

    // Skin options
    var skinOptions = [
        { label: 'Default', value: 'default' },
        { label: 'Modern', value: 'modern' },
        { label: 'Dark', value: 'dark' },
        { label: 'Gradient', value: 'gradient' },
        { label: 'Glassmorphism', value: 'glassmorphism' },
        { label: 'Minimal', value: 'minimal' },
        { label: 'Card', value: 'card' },
        { label: 'Neon', value: 'neon' },
        { label: 'Elegant', value: 'elegant' },
        { label: 'Brutalist', value: 'brutalist' },
    ];

    // Layout options
    var layoutOptions = [
        { label: 'Stacked (Default)', value: 'stacked' },
        { label: 'Inline Labels', value: 'inline' },
        { label: 'Floating Labels', value: 'floating' },
        { label: 'Material Design', value: 'material' },
        { label: 'Side by Side', value: 'side-by-side' },
        { label: 'Compact', value: 'compact' },
    ];

    // Animation options
    var animationOptions = [
        { label: 'None', value: 'none' },
        { label: 'Fade In', value: 'fade-in' },
        { label: 'Slide Up', value: 'slide-up' },
        { label: 'Slide Left', value: 'slide-left' },
        { label: 'Zoom In', value: 'zoom-in' },
        { label: 'Bounce', value: 'bounce' },
    ];

    // Button style options
    var buttonStyleOptions = [
        { label: 'Solid', value: 'solid' },
        { label: 'Outline', value: 'outline' },
        { label: 'Gradient', value: 'gradient' },
        { label: 'Glow', value: 'glow' },
        { label: 'Pill', value: 'pill' },
        { label: '3D Effect', value: '3d' },
    ];

    // Input style options
    var inputStyleOptions = [
        { label: 'Default', value: 'default' },
        { label: 'Underline Only', value: 'underline' },
        { label: 'Rounded', value: 'rounded' },
        { label: 'Pill Shape', value: 'pill' },
        { label: 'Shadow', value: 'shadow' },
    ];

    // Button icon options
    var buttonIconOptions = [
        { label: 'None', value: 'none' },
        { label: 'Send', value: 'send' },
        { label: 'Arrow Right', value: 'arrow-right' },
        { label: 'Check', value: 'check' },
        { label: 'Mail', value: 'mail' },
    ];

    registerBlockType('mtcf/contact-form', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            // Helper to create attribute updater
            function updateAttribute(name) {
                return function (value) {
                    var obj = {};
                    obj[name] = value;
                    setAttributes(obj);
                };
            }

            return [
                el(InspectorControls, { key: 'controls' },
                    // Preset & Layout Panel
                    el(PanelBody, { title: 'Preset & Layout', initialOpen: true },
                        el(SelectControl, {
                            label: 'Preset Skin',
                            value: attributes.skin,
                            options: skinOptions,
                            onChange: updateAttribute('skin'),
                            help: 'Choose a preset design for your form'
                        }),
                        el(SelectControl, {
                            label: 'Form Layout',
                            value: attributes.layout,
                            options: layoutOptions,
                            onChange: updateAttribute('layout')
                        }),
                        el(SelectControl, {
                            label: 'Animation',
                            value: attributes.animation,
                            options: animationOptions,
                            onChange: updateAttribute('animation')
                        })
                    ),

                    // Fields Configuration Panel
                    el(PanelBody, { title: 'Form Fields', initialOpen: false },
                        el(ToggleControl, {
                            label: 'Show Name Field',
                            checked: attributes.show_name === 'yes',
                            onChange: function (value) { setAttributes({ show_name: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Email Field',
                            checked: attributes.show_email === 'yes',
                            onChange: function (value) { setAttributes({ show_email: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Phone Field',
                            checked: attributes.show_phone === 'yes',
                            onChange: function (value) { setAttributes({ show_phone: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Website Field',
                            checked: attributes.show_website === 'yes',
                            onChange: function (value) { setAttributes({ show_website: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Subject Field',
                            checked: attributes.show_subject === 'yes',
                            onChange: function (value) { setAttributes({ show_subject: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Message Field',
                            checked: attributes.show_message === 'yes',
                            onChange: function (value) { setAttributes({ show_message: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show GDPR Consent',
                            checked: attributes.show_gdpr === 'yes',
                            onChange: function (value) { setAttributes({ show_gdpr: value ? 'yes' : 'no' }); }
                        }),
                        el('hr'),
                        el(ToggleControl, {
                            label: 'Show Labels',
                            checked: attributes.show_labels === 'yes',
                            onChange: function (value) { setAttributes({ show_labels: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Placeholders',
                            checked: attributes.show_placeholders === 'yes',
                            onChange: function (value) { setAttributes({ show_placeholders: value ? 'yes' : 'no' }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Field Icons',
                            checked: attributes.show_icons === 'yes',
                            onChange: function (value) { setAttributes({ show_icons: value ? 'yes' : 'no' }); }
                        })
                    ),

                    // Labels & Placeholders Panel
                    el(PanelBody, { title: 'Labels & Placeholders', initialOpen: false },
                        attributes.show_name === 'yes' && el(TextControl, {
                            label: 'Name Label',
                            value: attributes.label_name,
                            onChange: updateAttribute('label_name')
                        }),
                        attributes.show_name === 'yes' && el(TextControl, {
                            label: 'Name Placeholder',
                            value: attributes.placeholder_name,
                            onChange: updateAttribute('placeholder_name')
                        }),
                        attributes.show_email === 'yes' && el(TextControl, {
                            label: 'Email Label',
                            value: attributes.label_email,
                            onChange: updateAttribute('label_email')
                        }),
                        attributes.show_email === 'yes' && el(TextControl, {
                            label: 'Email Placeholder',
                            value: attributes.placeholder_email,
                            onChange: updateAttribute('placeholder_email')
                        }),
                        attributes.show_subject === 'yes' && el(TextControl, {
                            label: 'Subject Label',
                            value: attributes.label_subject,
                            onChange: updateAttribute('label_subject')
                        }),
                        attributes.show_subject === 'yes' && el(TextControl, {
                            label: 'Subject Placeholder',
                            value: attributes.placeholder_subject,
                            onChange: updateAttribute('placeholder_subject')
                        }),
                        attributes.show_message === 'yes' && el(TextControl, {
                            label: 'Message Label',
                            value: attributes.label_message,
                            onChange: updateAttribute('label_message')
                        }),
                        attributes.show_message === 'yes' && el(TextControl, {
                            label: 'Message Placeholder',
                            value: attributes.placeholder_message,
                            onChange: updateAttribute('placeholder_message')
                        }),
                        attributes.show_gdpr === 'yes' && el(TextareaControl, {
                            label: 'GDPR Text',
                            value: attributes.gdpr_text,
                            onChange: updateAttribute('gdpr_text')
                        })
                    ),

                    // Button Settings Panel
                    el(PanelBody, { title: 'Submit Button', initialOpen: false },
                        el(TextControl, {
                            label: 'Button Text',
                            value: attributes.button_text,
                            onChange: updateAttribute('button_text')
                        }),
                        el(SelectControl, {
                            label: 'Button Style',
                            value: attributes.button_style,
                            options: buttonStyleOptions,
                            onChange: updateAttribute('button_style')
                        }),
                        el(SelectControl, {
                            label: 'Button Width',
                            value: attributes.button_width,
                            options: [
                                { label: 'Auto', value: 'auto' },
                                { label: 'Full Width', value: 'full' }
                            ],
                            onChange: updateAttribute('button_width')
                        }),
                        el(SelectControl, {
                            label: 'Button Icon',
                            value: attributes.button_icon,
                            options: buttonIconOptions,
                            onChange: updateAttribute('button_icon')
                        }),
                        attributes.button_icon !== 'none' && el(SelectControl, {
                            label: 'Icon Position',
                            value: attributes.button_icon_position,
                            options: [
                                { label: 'Before Text', value: 'left' },
                                { label: 'After Text', value: 'right' }
                            ],
                            onChange: updateAttribute('button_icon_position')
                        })
                    ),

                    // Input Styling Panel
                    el(PanelBody, { title: 'Input Styling', initialOpen: false },
                        el(SelectControl, {
                            label: 'Input Style',
                            value: attributes.input_style,
                            options: inputStyleOptions,
                            onChange: updateAttribute('input_style')
                        }),
                        el(SelectControl, {
                            label: 'Input Size',
                            value: attributes.input_size,
                            options: [
                                { label: 'Small', value: 'small' },
                                { label: 'Medium', value: 'medium' },
                                { label: 'Large', value: 'large' }
                            ],
                            onChange: updateAttribute('input_size')
                        })
                    ),

                    // Messages Panel
                    el(PanelBody, { title: 'Messages', initialOpen: false },
                        el(TextareaControl, {
                            label: 'Success Message',
                            value: attributes.success_message,
                            onChange: updateAttribute('success_message')
                        }),
                        el(TextareaControl, {
                            label: 'Error Message',
                            value: attributes.error_message,
                            onChange: updateAttribute('error_message')
                        })
                    )
                ),

                // Block Preview
                el('div', { className: props.className },
                    el('div', {
                        style: {
                            padding: '30px',
                            background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                            borderRadius: '12px',
                            textAlign: 'center',
                            color: '#fff'
                        }
                    },
                        el('div', { style: { fontSize: '48px', marginBottom: '15px' } }, '📧'),
                        el('h3', { style: { margin: '0 0 10px', fontWeight: '600' } }, 'MT Contact Form'),
                        el('div', {
                            style: {
                                display: 'flex',
                                justifyContent: 'center',
                                gap: '15px',
                                flexWrap: 'wrap',
                                fontSize: '13px',
                                opacity: '0.9'
                            }
                        },
                            el('span', null, '🎨 Skin: ', el('strong', null, attributes.skin)),
                            el('span', null, '📐 Layout: ', el('strong', null, attributes.layout))
                        ),
                        el('p', {
                            style: {
                                margin: '15px 0 0',
                                fontSize: '12px',
                                opacity: '0.7'
                            }
                        }, 'Form preview appears on the frontend. Use the sidebar to customize.')
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
    window.wp.components,
    window.wp.serverSideRender
));
