/**
 * Icon Grid It! Block editor handler
 */
(
    function (blocks, blockEditor, components, i18n, element) {
        var el = element.createElement;     // needed to create HTML elements
        var MAX_ITEMS = 15;                 // Number of items

        /**
         * Register block
         */
        wp.blocks.registerBlockType(
            'wbfy/icon-grid-it',
            {
                title: i18n.__('Icon Grid It!'),
                icon: 'screenoptions',                      // Kind of fits
                category: 'widgets',
                keywords: i18n.__('Grid'),
                attributes: {
                    title: { type: 'string' },              // Section title
                    titleAlign: { type: 'string' },         // Section title alignment

                    iconColor: { type: 'string' },          // Global icon color, default is orange

                    // Icon classes
                    icon1: { type: 'string' }, icon2: { type: 'string' }, icon3: { type: 'string' },
                    icon4: { type: 'string' }, icon5: { type: 'string' }, icon6: { type: 'string' },
                    icon7: { type: 'string' }, icon8: { type: 'string' }, icon9: { type: 'string' },
                    icon10: { type: 'string' }, icon11: { type: 'string' }, icon12: { type: 'string' },
                    icon13: { type: 'string' }, icon14: { type: 'string' }, icon15: { type: 'string' },

                    // Icon text
                    text1: { type: 'string' }, text2: { type: 'string' }, text3: { type: 'string' },
                    text4: { type: 'string' }, text5: { type: 'string' }, text6: { type: 'string' },
                    text7: { type: 'string' }, text8: { type: 'string' }, text9: { type: 'string' },
                    text10: { type: 'string' }, text11: { type: 'string' }, text12: { type: 'string' },
                    text13: { type: 'string' }, text14: { type: 'string' }, text15: { type: 'string' },
                },

                /**
                 *  Edit output
                 */
                edit: function (props) {
                    var attrs = parseAttributes(props);

                    var previewItemList = [];
                    var adminItemList = [];

                    // Generate preview and inspector items content
                    for (var i = 1; i <= MAX_ITEMS; i++) {
                        adminItemList.push(itemContent(props, i.toFixed()));
                        if (typeof props.attributes['icon' + i.toFixed()] !== 'undefined') {
                            previewItemList.push(itemPreview(props, i.toFixed(), attrs.iconColor));
                        }
                    }

                    return [
                        // Preview content
                        el('div', { className: [props.className, 'wbfy-grid'].join(' ') },
                            el(attrs.titleTag, { style: { textAlign: attrs.titleAlign } }, attrs.title),
                            el('ul', null, previewItemList)
                        ),
                        // Inspector fields
                        el(
                            blockEditor.InspectorControls,
                            { key: 'inspector' },
                            el(components.PanelBody,
                                {
                                    title: i18n.__('Section'),
                                    initialOpen: (typeof props.attributes.title === 'undefined'),
                                },

                                el(components.TextControl,
                                    {
                                        label: i18n.__('Title'),
                                        placeholder: i18n.__('Grid Title'),
                                        value: props.attributes.title,
                                        onChange: function (newTitle) { props.setAttributes({ title: newTitle }); },
                                    }
                                ),
                                el(components.SelectControl,
                                    {
                                        label: i18n.__('Title Alignment'),
                                        options: [
                                            { label: i18n.__('Center'), value: 'center' },
                                            { label: i18n.__('Left'), value: 'left' },
                                            { label: i18n.__('Right'), value: 'right' },
                                        ],
                                        value: props.attributes.titleAlign,
                                        onChange: function (newTitleAlign) {
                                            props.setAttributes({ titleAlign: newTitleAlign });
                                        },
                                    }
                                )
                            ),
                            el(components.PanelBody,
                                {
                                    title: i18n.__('Icon Color'),
                                    initialOpen: (typeof props.attributes.title === 'undefined'),
                                },
                                el(components.ColorPicker,
                                    {
                                        color: props.attributes.iconColor,
                                        label: i18n.__('Color'),
                                        help: i18n.__('Set the color the icons will be displayed in'),
                                        onChangeComplete: function (newColor) {
                                            props.setAttributes({ iconColor: newColor.hex });
                                        }
                                    }
                                )
                            ),
                            adminItemList
                        )
                    ];
                },
                /* Generate and save front end content */
                save: function (props) {
                    var attrs = parseAttributes(props);
                    var itemList = [];

                    for (var i = 1; i <= MAX_ITEMS; i++) {
                        if (typeof props.attributes['icon' + i.toFixed()] !== 'undefined') {
                            itemList.push(itemPreview(props, i.toFixed(), attrs.iconColor));
                        }
                    }
                    return el('div', null,
                        el('div', { className: 'wbfy-grid' },
                            el(attrs.titleTag, { style: { textAlign: attrs.titleAlign } }, attrs.title),
                            el('ul', null, itemList)
                        )
                    );
                }
            }
        );

        /**
         * Parse attributes and set defaults if not set
         */
        function parseAttributes(props) {
            return {
                title: (typeof props.attributes.title === 'undefined') ? i18n.__('Please add the title and icons in the block settings inspector') : props.attributes.title,
                titleAlign: (typeof props.attributes.titleAlign === 'undefined') ? 'center' : props.attributes.titleAlign,
                titleTag: (typeof props.attributes.title === 'undefined') ? 'p' : 'h2',
                iconColor: (typeof props.attributes.iconColor === 'undefined') ? '#ffa500' : props.attributes.iconColor
            }
        }

        /**
         *  Create item panel entry
         */
        function itemContent(props, itemNo) {
            return el(components.PanelBody,
                {
                    title: i18n.__('Item ' + itemNo),
                    initialOpen: (typeof props.attributes['icon' + itemNo] === 'undefined'),
                },
                el(components.TextControl,
                    {
                        label: i18n.__('Icon'),
                        placeholder: i18n.__('Icon class'),
                        value: props.attributes['icon' + itemNo],
                        onChange: function (newVal) {
                            var ret = {}; ret['icon' + itemNo] = newVal; props.setAttributes(ret);
                        },
                    }
                ),
                el(components.TextControl,
                    {
                        label: i18n.__('Text'),
                        placeholder: i18n.__('Item text'),
                        value: props.attributes['text' + itemNo],
                        onChange: function (newVal) {
                            var ret = {}; ret['text' + itemNo] = newVal; props.setAttributes(ret);
                        },
                    }
                )
            );
        }

        /**
         *  Create item entry preview
         */
        function itemPreview(props, itemNo, iconColor) {
            return el('li', null,
                el('div', { className: 'wbfy-grid-icon' },
                    el('span', { className: ['fa', props.attributes['icon' + itemNo]].join(' '), style: { color: iconColor } }, '')
                ),
                el('div', { className: 'wbfy-grid-text' }, props.attributes['text' + itemNo])
            );
        }
    }
)(
    window.wp.blocks,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.i18n,
    window.wp.element
);
