/**
 * Save fields to server
 *
 * @param {boolean}  [includeAll] if set to true then export all shown or hidden fields
 * @param {function} [callback]   Callback for save complete
 * @param {boolean}  [force]      Force save and ignore changes status
 * @return {Object[]} Field objects list
 */
function saveFields(includeAll, callback, force)
{
    if(typeof includeAll === 'function')
    {
        callback   = includeAll;
        includeAll = false;
    }

    var fieldsList    = [];
    var changedFields = [];
    var revertChanges = function()
    {
        for(var i = 0; i < changedFields.length; ++i)
        {
            changedFields[i].changed = true;
        }
    };
    var errorsCount = 0;
    for(var i = 0; i < fields.length; ++i)
    {
        var originField = fields[i];

        if(originField.changed)
        {
            originField.changed = false;
            changedFields.push(originField);
        }

        if(!includeAll && originField.show !== '1') continue;

        var field = $.extend({}, originField);

        if(originField.errors && originField.errors.$length) errorsCount++;

        field.order = i + 1;
        if(field.id[0] === '_') delete field.id;
        delete field.unsaved;
        delete field._options;
        delete field.errors;
        delete field.changed;
        delete field.layoutRules;
        if($.isArray(field.options))
        {
            var options = {};
            for(var j = 0; j < field.options.length; ++j)
            {
                var option = field.options[j];
                options[option.value] = option.text;
            }
            field.options = options;
        }
        if($.isArray(field.rules))
        {
            field.rules = field.rules.join(',');
        }
        fieldsList.push(field);
    }

    if(!force && !changedFields.length) return;

    if(errorsCount)
    {
        revertChanges();
        $('#editor').addClass('highlight-errors');
        setTimeout(function()
        {
            $('#editor').removeClass('highlight-errors');
        }, 5000);
        return new $.zui.Messager(validateMessages.failSummary.replace('%s', errorsCount),
        {
            type: 'danger',
            icon: 'bell',
            placement: 'center',
        }).show();
    }

    var link = createLink('workflow', 'ui', 'module=' + flowModule + '&action=' + action);
    $.post(link, {fields: JSON.stringify(fieldsList)}, function(response)
    {
        try {response = JSON.parse(response);}
        catch(error)
        {
            response = response ? response : unknownError;
            new $.zui.Messager(response,
            {
                type: 'danger',
                icon: 'bell',
                placement: 'center',
                time: 10000
            }).show();
            revertChanges();
            if(callback) callback(false, response);
            return;
        }
        if(response.result == 'fail')
        {
            if(typeof response.message === 'string') bootbox.alert(response.message);
            else if($.isPlainObject(response.message))
            {
                var errors = {};
                if(response.field) errors[response.field] = response.message;
                else errors = response.message;
                window.updateFieldsErrors(errors);
            }

            revertChanges();
            if(callback) callback(false, response);
        }
        else
        {
            $('#saveBtn').popover(
            {
                trigger: 'manual',
                content: response.message,
                tipClass: 'popover-success popover-form-result',
                placement: 'left'
            }).popover('show');

            setTimeout(function(){$('#saveBtn').popover('destroy')}, 2000);

            if(callback) callback(true, response);
        }
    });
    return true;
}

/**
 * Get default options list of specific option type
 *
 * @param {Object}   field field object
 * @param {Function} callback   callback
 * @return {Object} return default options key-value with a object
 */
function getDefaultsOfOption(field, callback)
{
    /* Fetch default options from server, then call callback on ready */
    var sql        = '';
    var control    = window.btoa(encodeURI(field.control));
    var optionType = field.options;
    var type       = field.type;
    var link       = createLink('workflowfield', 'ajaxGetDefaultControl', 'mode=quick&control=' + control + '&optionType=' + optionType + '&type=' + type + '&sql=' + sql);
    $.getJSON(link, callback);
}

/* https://tc39.github.io/ecma262/#sec-array.prototype.findIndex */
if (!Array.prototype.findIndex)
{
    Object.defineProperty(Array.prototype, 'findIndex',
    {
        value: function(predicate)
        {
            if(this == null) throw new TypeError('"this" is null or not defined');

            var o   = Object(this);
            var len = o.length >>> 0;

            if(typeof predicate !== 'function') throw new TypeError('predicate must be a function');

            var thisArg = arguments[1];
            var k = 0;
            while(k < len)
            {
                var kValue = o[k];
                if(predicate.call(thisArg, kValue, k, o)) return k;
                k++;
            }
            return -1;
        }
    });
}

$(function()
{
    var isForm         = uiMode === 'form';
    var isView         = uiMode === 'view';
    var isBatchForm    = uiMode === 'batchForm';
    var canSetWidth    = uiMode === 'browse' || isBatchForm;
    var canSetPosition = canSetWidth || uiMode === 'view';
    var $previewBox    = $('#editorPreview');
    var $preview       = $(isForm ? '#uiPreview' : isView ? '#uiViewWrapper' : '#uiListHeader');
    var $infoPreview   = isView ? $('#uiInfoViewPreview') : null;
    var $basicPreview  = isView ? $('#uiBasicViewPreview') : null;
    var $listPreview   = canSetWidth ? $('#uiListPreviewItems') : null;
    var $filedEditForm = $('#filedEditForm');
    var remoteOptions  = window.remoteOptions = defaultOptions || {};
    var hasActionsInList;
    var activedField;

    /* Format options to standart, like [{text: 'Today', value: 'today'}, ...] */
    var formatOptions = function(options)
    {
        if(typeof options === 'string')
        {
            options = options.split(',');
        }
        if($.isArray(options) || $.isPlainObject(options))
        {
            var optionsList = [];
            $.each(options, function(value, text)
            {
                optionsList[text.length ? 'push' : 'unshift']({value: value, text: text});
            });
            options = optionsList;
        }
        return options;
    };

    /* Get keys of a object */
    var getObjectKeys = function(obj, filter)
    {
        var keys = [];
        $.each(obj, function(key)
        {
            if(filter && !filter(key)) return;
            keys.push(key);
        });
        return keys;
    };

    /* Get field index in list by id or field code */
    var getFieldIndex = function(id)
    {
        if(typeof id === 'number') id = String(id);
        return fields.findIndex(function(field)
        {
            return field.id === id || field.field === id;
        });
    };

    /* Get field object by id or field code */
    var getField = function(id)
    {
        var index = getFieldIndex(id);
        return index > -1 ? fields[index] : null;
    };

    /* Check whether the field is buildin  */
    var isBuildInField = function(field)
    {
        return field.buildin === '1' || defaultFields[field.field];
    };

    /* Get field select control type, return 'multi', 'single' or false */
    var getFieldSelectType = function(field)
    {
        if(isBuildInField(field) && field.field !== 'status') return false;
        if(field.control === 'multi-select' || field.control === 'checkbox') return 'multi';
        else if(field.control === 'select' || field.control === 'radio') return 'single';
        return false;
    };

    /* Create preview control element for form mode */
    var createFieldControl = function(field, onlyHtml)
    {
        var controlType = field.control;
        // var id = onlyHtml ? '' : ('field-control-' + field.id);
        var html = '';
        switch(controlType)
        {
            case 'label':
                html = '<p class="form-control-static"></p>';
                break;
            case 'textarea':
                html = '<textarea class="form-control" rows="' + (isBatchForm ? 1 : 3) + '" style="resize:' + (isBatchForm ? 'none' : 'vertical') + '"></textarea>';
                break;
            case 'select':
                html = '<select class="form-control"></select>';
                break;
            case 'multi-select':
                html = '<select class="form-control" multiple></select>';
                break;
            case 'checkbox':
                html = '<div class="checkbox-list"></div>';
                break;
            case 'radio':
                html = '<div class="radio-list"></div>';
                break;
            case 'file':
                html = '<div class="file-input-list"><div class="file-input-empty"><button type="button" class="btn btn-link file-input-btn"><i class="icon icon-plus"></i> ' + langAddFile + '</button></div></div>';
                break;
            default:
                html = '<input type="text" class="form-control">';
        }
        return onlyHtml ? html : $(html);
    };

    /* Update field preview control for form mode */
    var updateFieldControl = function($wrapper, field)
    {
        if(field.field === 'file') return;
        var controlType  = field.control;
        var readonly     = field.readonly;
        var defaultValue = field.defaultValue;
        switch(controlType)
        {
            case 'label':
                $wrapper.find('.form-control-static').text(defaultValue);
                break;
            case 'textarea':
                $wrapper.find('textarea').val(defaultValue);
                break;
            case 'select':
            case 'multi-select':
                var $select = $wrapper.find('select');
                $select.empty();
                if(typeof field.options === 'object')
                {
                    $.each(field.options, function(_, option)
                    {
                        var $option = $('<option></option>').attr('value', option.value).text(option.text);
                        $select.append($option);
                    });
                }
                if(!$select.data('chosen')) $select.chosen();
                else $select.trigger('chosen:updated');
                break;
            case 'checkbox':
            case 'radio':
                var $list = $wrapper.find('.' + controlType + '-list');
                $list.empty();
                var name  = 'field-' + controlType + '-' + field.id;
                var options = typeof field.options === 'object' ? field.options : [{value: '__example', text: ''}];
                $.each(options, function(_, option)
                {
                    var $label = $('<label class="'+ controlType + '-inline"></label>');
                    var $option = $('<input type="' + controlType + '">').attr({name: name, value: option.value});
                    $label.append($option).append($('<span></span>').text(option.text));
                    if(option.value === '__example') $label.find('span').addClass('example-text-holder');
                    $list.append($label);
                });
                break;
            case 'date':
                var $input = $wrapper.find('.form-control');
                $input.val(defaultValue).attr('readonly', readonly === '1' ? 'readonly' : null);
                if(!$input.data('datetimepicker')) $input.datepicker();
                break;
            case 'datetime':
                var $input = $wrapper.find('.form-control');
                $input.val(defaultValue).attr('readonly', readonly === '1' ? 'readonly' : null);
                if(!$input.data('datetimepicker')) $input.datetimepicker();
                break;
            default:
                $wrapper.find('.form-control').val(defaultValue);
        }
    };

    /* Update field detail view item for view mode */
    var updateFieldView = function($wrapper, field)
    {
        var $label = $wrapper.find('.field-label');
        $label.text(field.name);
        if(field.position !== $wrapper.closest('.view-dropbox').data('position'))
        {
            var $viewBox = field.position === 'basic' ? $basicPreview : $infoPreview;
            var inserted = false;
            $viewBox.find('.field-view-item').each(function()
            {
                var $field = $(this);
                if(field.order >= $field.data('order'))
                {
                    $field.after($wrapper);
                    inserted = true;
                    return false;
                }
            });
            if(!inserted) $viewBox.append($wrapper);
        }
    };

    /* Update field preview control for list column */
    var updateFieldColumn = function($wrapper, field)
    {
        var $label = $wrapper.find('.field-col-item-label');
        $label.text(field.name);
        $wrapper.css(
        {
            width:     field.width,
            textAlign: field.position
        });
    };

    var createListPreviewItem = function(field)
    {
        return isBatchForm ? '<div class="field-col-preview-form">' + (field ? createFieldControl(field, true) : '<input type="text" class="form-control" />') + '</div>' : ('<div class="field-col-preview-view"><div class="example-text-holder" data-size="' + (Math.floor(Math.random() * 8) + 2) + '"></div></div>');;
    };

    /* Update list preview */
    var updateListPreview = function()
    {
        if(!canSetWidth) return;
        var $columns = $listPreview.children('.field-col-preview').addClass('expired');
        var totalWidth = 8;
        $preview.find('.field-col-item').each(function()
        {
            var $colHeader = $(this);
            var colId    = $colHeader.data('id');
            var colWidth = $colHeader.outerWidth();
            var $col     = $columns.filter('[data-id="' + colId + '"]');
            var field    = isBatchForm ? getField(colId) : null;
            if(!$col.length)
            {
                $col = $([
                    '<div class="field-col-preview">',
                        createListPreviewItem(field), createListPreviewItem(field), createListPreviewItem(field), createListPreviewItem(field), createListPreviewItem(field),
                    '</div>'
                ].join('')).attr('data-id', colId);
            }
            $col.css('width', colWidth).removeClass('expired').appendTo($listPreview);
            if(isBatchForm) updateFieldControl($col.find('.field-col-preview-form'), field);
            totalWidth += colWidth;
        });
        $listPreview.css('width', totalWidth);
        $columns.filter('.expired').remove();
    };

    /* Update field preview control */
    var updateField = function(field, relativeField, relativeAsNext)
    {
        var id     = field.id;
        var $field = $('#field-' + id);
        if(field.show !== '1')
        {
            if($field.length) $field.remove();
            return;
        }
        if(!$field.length)
        {
            var fieldHtmlLines;
            if(isForm)
            {
                fieldHtmlLines =
                [
                    '<div data-field="' + (field.field || '') + '" data-id="' + id + '" id="field-' + id + '" class="field-item">',
                        '<div class="field-item-row">',
                            '<div class="field-label"></div>',
                            '<div class="field-control"></div>',
                            '<div class="field-buttons">',
                                '<button type="button" class="btn btn-link field-sort-handler" data-type="move"><i class="icon icon-move"></i></button>',
                                '<button type="button" class="btn btn-link field-delete-btn" data-type="delete"><i class="icon icon-trash"></i></button>',
                                '<button type="button" class="btn btn-link field-copy-btn" data-type="copy"><i class="icon icon-copy"></i></button><button type="button" class="btn btn-link field-error-btn" data-toggle="tooltip"><i class="icon icon-alert text-danger"></i></button>',
                            '</div>',
                        '</div>',
                    '</div>'
                ];
            }
            else if (isView)
            {
                fieldHtmlLines =
                [
                    '<div data-field="' + (field.field || '') + '" data-id="' + id + '" id="field-' + id + '" class="field-view-item">',
                        '<div class="field-item-row">',
                            '<div class="field-label"></div>',
                            '<div class="field-value"><div class="example-text-holder"></div></div>',
                            '<div class="field-buttons">',
                                '<button type="button" class="btn btn-link field-sort-handler" data-type="move"><i class="icon icon-move"></i></button>',
                                '<button type="button" class="btn btn-link field-delete-btn" data-type="delete"><i class="icon icon-trash"></i></button>',
                                '<button type="button" class="btn btn-link field-copy-btn" data-type="copy"><i class="icon icon-copy"></i></button><button type="button" class="btn btn-link field-error-btn" data-toggle="tooltip"><i class="icon icon-alert text-danger"></i></button>',
                            '</div>',
                        '</div>',
                    '</div>'
                ];
            }
            else
            {
                fieldHtmlLines =
                [
                    '<div data-field="' + field.field + '" data-id="' + id + '" id="field-' + id + '" class="field-col-item">',
                        '<i class="icon icon-move field-sort-handler"></i>',
                        '<span class="field-col-item-label field-sort-handler"></span>',
                        '<i class="icon icon-sort text-primary"></i>',
                        '<button type="button" class="btn btn-link field-delete-btn" data-type="delete"><i class="icon icon-trash"></i></button>',
                        '<button type="button" class="btn btn-link field-error-btn" data-toggle="tooltip"><i class="icon icon-alert text-danger"></i></button>',
                    '</div>'
                ];
            }
            $field = $(fieldHtmlLines.join(''));
            if(field.field === 'actions' && !isForm)
            {
                $field.find('.field-col-item-label').removeClass('field-sort-handler');
            }

            if(relativeField)
            {
                var $relativeField = $('#field-' + relativeField.id);
                if($relativeField.length) $relativeField[relativeAsNext ? 'before' : 'after']($field);
            }
            else if(isView)
            {
                $field.find('.example-text-holder').attr('data-size', Math.floor(Math.random() * 10) + 1);
                $field.appendTo(field.position === 'basic' ? $basicPreview : $infoPreview);
            }
            else $field.appendTo($preview);

            $field.find('.field-error-btn').tooltip(
            {
                placement: 'top',
                container: 'body',
                tipClass: 'tooltip-danger',
                html: true,
                title: function()
                {
                    if(field.errors && field.errors.$length)
                    {
                        var messages = [];
                        $.each(field.errors, function(key, message)
                        {
                            if(key[0] === '$') return;
                            messages.push(message);
                        });
                        return messages.join('<br>');
                    }
                }
            });
        }
        if(isForm)
        {
            var $control = $field.find('.field-control');
            var controlType = field.control;
            if($control.data('type') !== controlType) {
                $control.data('type', controlType).empty().append(createFieldControl(field));
            }
            updateFieldControl($control, field);
        }
        else if(isView) updateFieldView($field, field);
        else updateFieldColumn($field, field);

        $field.find('.field-label').text(field.name);
        $field.attr('data-order', field.order)
            .attr('data-field', field.field)
            .data('order', field.order)
            .toggleClass('has-error', !!(field.errors && field.errors.$length))
            .toggleClass('active', !!(activedField && activedField.id === id))
            .toggleClass('field-required', (',' + field.rules + ',').indexOf(',' + notEmptyRule + ',') > -1);

        updateListPreview(field);
    };

    /* Update showed field list at left of page */
    var updateShowedFields = function()
    {
        var showedFields = [];
        for(var i = 0; i < fields.length; ++i)
        {
            var field = fields[i];
            if(field.show === '0' && !field.unsaved) showedFields.push(field);
        }
        showedFields.sort(function(field1, field2)
        {
            return ('' + field1.name).localeCompare(field2.name);
        });

        var $editorShowedFields = $('#editorShowedFields');
        var $fields = $editorShowedFields.find('.btn').addClass('can-remove');

        for(var i = 0; i < showedFields.length; ++i)
        {
            var field = showedFields[i];
            var $field = $fields.filter('[data-field="' + field.field + '"]');
            if($field.length) $field.removeClass('can-remove').appendTo($editorShowedFields);
            else $('<button type="button" class="btn btn-field-control" data-field="' + field.field + '">' + field.name + '</button>').appendTo($editorShowedFields);
        }

        $fields.filter('.can-remove').remove();
    };

    /* Sort fields by order property */
    var sortFields = function()
    {
        fields.sort(function(x, y){return x.order * 1 - y.order * 1;});
    };

    /* Update all fields */
    var updateFields = function(sort)
    {
        hasActionsInList = false;
        if(sort) sortFields();
        for(var i = 0; i < fields.length; ++i)
        {
            var field = fields[i];
            if(!field.id) field.id = '_' + $.zui.uuid();
            if(sort) field.order = i * 100 + 1;
            if($.isPlainObject(field.options))
            {
                var options = [];
                $.each(field.options, function(value, text)
                {
                    options[text.length ? 'push' : 'unshift']({value: value, text: text});
                });
                field.options = options;
                field._options = options;
            }
            else if($.isArray(field.options))
            {
                var options = [];
                $.each(field.options, function(index, option)
                {
                    if(typeof option === 'string') option = {value: String(index), text: option};
                    else option = $.extend({value: '', text: ''}, option);
                    options[option.text.length ? 'push' : 'unshift'](option);
                });
                field.options = options;
            }
            if(field.field === 'file') field.control = 'file';
            if(typeof field.show === 'number') field.show = String(field.show);
            validateField(field);
            updateField(field);

            if(!isForm && field.field === 'actions') hasActionsInList = true;
        }
    };

    /* Validate field properties */
    var validateField = function(field, includeHiddenField)
    {
        if(!field)
        {
            var errorsCount;
            for(var i = 0; i < fields.length; ++i)
            {
                if(validateField(fields[i], includeHiddenField)) {
                    errorsCount++;
                }
            }
            return errorsCount;
        }

        if(typeof field === 'string')
        {
            field = getField(field);
            if(!field) return;
        }

        if(!includeHiddenField && field.show !== '1') return;

        var errors = field.errors || {};
        if(!errors.name && (typeof field.name !== 'string' || !field.name.length)) errors.name = validateMessages.nameRequired;

        var buildin = field.buildin === '1' || defaultFields[field.field];
        var isTypeLengthRequired = field.type === 'decimal' || field.type === 'char' || field.type === 'varchar';
        if(!buildin)
        {
            if(!errors.field)
            {
                if(typeof field.field !== 'string' || !field.field.length) errors.field = validateMessages.fieldRequired;
                else if(!/^[a-zA-Z]+$/.test(field.field)) errors.field = validateMessages.fieldInvalid;
                else
                {
                    for(var i = 0; i < fields.length; ++i)
                    {
                        var thisField = fields[i];
                        if(thisField.id !== field.id && thisField.field === field.field)
                        {
                            errors.field = validateMessages.fieldDuplicated.replace('%s', thisField.name);
                            break;
                        }
                    }
                }
            }
            if(!errors.length && (typeof field.length !== 'string' || !field.length.length) && isTypeLengthRequired)
            {
                errors.length = validateMessages.lengthRequired;
            }

            if(!errors.defaultValue && typeof field.defaultValue === 'string' && field.defaultValue.length)
            {
                var fieldSelectType = getFieldSelectType(field);
                if(fieldSelectType)
                {
                    var isCustomOption = typeof field.options === 'object';
                    var fieldOptions = isCustomOption ? field.options : remoteOptions[field.options];
                    if(fieldOptions)
                    {
                        var isMultiSelect = fieldSelectType === 'multi';
                        var defaultValues = isMultiSelect ? field.defaultValue.split(',') : [field.defaultValue];
                        var defaultValueError;
                        for(var i = 0; i < defaultValues.length; ++i)
                        {
                            var defaultValue = defaultValues[i];
                            var optionIndex = fieldOptions.findIndex(function(option)
                            {
                                return option.value == defaultValue;
                            });
                            if(optionIndex < 0)
                            {
                                if(fieldOptions.findIndex(function(option){return option.text === defaultValue;}) > 0) defaultValueError = validateMessages.defaultNotOptionKey.replace('%s', defaultValue);
                                else defaultValueError = validateMessages.defaultNotInOptions.replace('%s', defaultValue);
                                break;
                            }
                        }
                        if(defaultValueError) errors.defaultValue = defaultValueError;
                    }
                    else if(!isCustomOption)
                    {
                        delete errors.defaultValue;
                    }
                }
            }
        }

        if(!errors.width && canSetWidth && field.width && field.width !== 'auto' && !/^\d+$/.test(field.width))
        {
            errors.width = validateMessages.widthInvalid;
        }

        errors.$length = getObjectKeys(errors, function(key)
        {
            return key[0] !== '$';
        }).length;
        if(activedField && activedField.id === field.id)
        {
            var $fieldNameMessage = $('#fieldNameMessage');
            if(errors.name) $fieldNameMessage.html(errors.name).show();
            else $fieldNameMessage.hide();
            $('#fieldEditName').toggleClass('has-error', !!errors.name);

            if(!buildin)
            {
                var $fieldFieldMessage = $('#fieldFieldMessage');
                if(errors.field) $fieldFieldMessage.html(errors.field).show();
                else $fieldFieldMessage.hide();
                $('#fieldEditField').toggleClass('has-error', !!errors.field);

                var $fieldLengthMessage = $('#fieldLengthMessage');
                if(errors.length) $fieldLengthMessage.html(errors.length).show();
                else $fieldLengthMessage.hide();
                $('#fieldLength').toggleClass('has-error', !!errors.length);
                $('#fieldEditType').toggleClass('hide-type-length', !isTypeLengthRequired);

                var $fieldDefaultValueMessage = $('#fieldDefaultValueMessage');
                if(errors.defaultValue) $fieldDefaultValueMessage.html(errors.defaultValue).show();
                else $fieldDefaultValueMessage.hide();
                $('#fieldEditDefaultValue').toggleClass('has-error', !!errors.defaultValue);
            }

            if(canSetWidth)
            {
                var $fieldWidthMessage = $('#fieldWidthMessage');
                if(errors.width) $fieldWidthMessage.html(errors.width).show();
                else $fieldWidthMessage.hide();
                $('#widthEditControl').toggleClass('has-error', !!errors.width);
            }
        }
        field.errors = errors;
        updateField(field);

        return errors.$length;
    };

    /* Public method to update field errors, usually used for form submit result */
    window.updateFieldsErrors = function(errors)
    {
        var firstField;
        var errorsCount = 0;
        $.each(errors, function(fieldId, errorsMap)
        {
            var field = getField(fieldId);
            if(field)
            {
                field.errors = errorsMap;
                if(field.errors) field.errors.$length = getObjectKeys(field.errors).length;
                updateField(field);
                if(!firstField) firstField = field;
                errorsCount++;
            }
        });
        if(firstField)
        {
            activeField(firstField.id, true);
            $('#editor').addClass('highlight-errors');
            setTimeout(function()
            {
                $('#editor').removeClass('highlight-errors');
            }, 5000);

            return new $.zui.Messager(validateMessages.failSummary.replace('%s', errorsCount),
            {
                type: 'danger',
                icon: 'bell',
                placement: 'center',
            }).show();
        }
    };

    /* Edit field properties and update editor at right of page */
    var editField = function(field)
    {
        if(typeof field === 'string') field = getField(field);
        var $filedEditTip = $('#filedEditTip');
        if(!field)
        {
            $filedEditTip.show();
            $filedEditForm.hide();
            return;
        }
        $filedEditTip.hide();

        var isFileOrActions = field.field === 'file' || field.field === 'actions';
        $filedEditForm.find('#fieldName').val(field.name).attr('readonly', isFileOrActions);

        var errors = field.errors || {};
        var buildin = isBuildInField(field);
        var $fieldNameMessage = $('#fieldNameMessage');
        if(errors.name) $fieldNameMessage.html(errors.name).show();
        else $fieldNameMessage.hide();
        $('#fieldEditName').toggleClass('has-error', !!errors.name).toggleClass('required', !isFileOrActions);

        $('#fieldControl').val(field.control).change();
        if(!buildin && !isFileOrActions)
        {
            $('#fieldField').val(field.field);
            var $fieldFieldMessage = $('#fieldFieldMessage');
            if(errors.field) $fieldFieldMessage.html(errors.field).show();
            else $fieldFieldMessage.hide();
            $('#fieldEditField').toggleClass('has-error', !!errors.field);

            $('#fieldType').val(field.type);
            $('#fieldLength').val(field.length);
            $('#fieldDefaultValue').val(field.defaultValue);
            $('#fieldRules').val((typeof field.rules === 'string' && field.rules.length) ? field.rules.split(',') : field.rules).trigger('chosen:updated');

            var $fieldLengthMessage = $('#fieldLengthMessage');
            if(errors.length) $fieldLengthMessage.html(errors.length).show();
            else $fieldLengthMessage.hide();

            $('#fieldLength').toggleClass('has-error', !!errors.length);

            var $fieldDefaultValueMessage = $('#fieldDefaultValueMessage');
            if(errors.defaultValue) $fieldDefaultValueMessage.html(errors.defaultValue).show();
            else $fieldDefaultValueMessage.hide();
            $('#fieldEditDefaultValue').toggleClass('has-error', !!errors.defaultValue);
        }

        if(canSetWidth)
        {
            var $fieldWidthMessage = $('#fieldWidthMessage');
            if(errors.width) $fieldWidthMessage.html(errors.width).show();
            else $fieldWidthMessage.hide();
            $('#widthEditControl').toggleClass('has-error', !!errors.width);
        }

        if(!buildin || field.field === 'status')
        {
            var isCustomOptions = typeof field.options === 'object';
            $('#fieldOptionType').val(isCustomOptions ? 'custom' : field.options).change();
        }

        if(canSetWidth) $('#fieldWidth').val(field.width);
        if(canSetPosition) $('#fieldPosition').val(field.position);

        $('#fieldIsValue').prop('checked', field.isValue === '1');

        $filedEditForm.toggleClass('is-status', field.field === 'status').toggleClass('is-file', isFileOrActions).toggleClass('is-buildin', !!buildin).show();
    };

    /* Unactive field in preview */
    var unactiveField = function()
    {
        if(activedField)
        {
            var oldActiveField = activedField;
            activedField = null;
            updateField(oldActiveField);
            editField();
        }
    };

    /* Active field in preview */
    var activeField = function(id, force)
    {
        var oldActiveField = activedField;
        var field          = typeof id === 'object' ? id : getField(id);
        if(field && field.show === '1' && (force || !oldActiveField || oldActiveField.id !== field.id))
        {
            activedField = field;
            if(oldActiveField) updateField(oldActiveField);
            updateField(field);
            editField(field);
            var $field = $('#field-' + field.id);
            if($field.length && $field[0].scrollIntoViewIfNeeded)
            {
                $field[0].scrollIntoViewIfNeeded();
            }
        }
    };

    /* Delete field in preview */
    var deleteField = function(id)
    {
        var field = getField(id);
        if(field)
        {
            field.show    = '0';
            field.changed = true;

            updateField(field);
            updateShowedFields();
            if(activedField && activedField.id === field.id) unactiveField();
            updateListPreview();
        }
    };

    /* Clone field in preview */
    var cloneField = function(id)
    {
        var fieldIndex = getFieldIndex(id);
        if(fieldIndex > -1)
        {
            var field     = fields[fieldIndex];
            var copyField = $.extend({}, field, {id: '_' + $.zui.uuid(), order: field.order + 1, field: '', name: '', changed: true, unsaved: true, buildin: '0', errors: {$length: 0}});
            fields.splice(fieldIndex, 0, copyField);
            updateField(copyField, field);
            validateField(copyField);
            activeField(copyField.id);
        }
    };

    /* Update fields preview controls and showed list on left */
    updateFields(true);
    updateShowedFields();

    /* Bind events on preview element */
    $preview.on('click', '.field-buttons>.btn,.field-delete-btn', function(e)
    {
        var $this   = $(this);
        var btnType = $this.data('type');
        var id      = $this.closest('.field-item,.field-col-item,.field-view-item').data('id');
        if(btnType === 'delete') deleteField(id);
        else if(btnType === 'copy') cloneField(id);
        e.stopPropagation();
    }).on('click', '.field-item,.field-col-item,.field-view-item', function()
    {
        activeField($(this).data('id'));
    });

    /* Make preview control sortable */
    $preview.sortable(
    {
        selector: '.field-item,.field-col-item,.field-view-item',
        trigger: '.field-sort-handler',
        containerSelector: isView ? '#uiInfoViewPreview, #uiBasicViewPreview' : false,
        start: function(){$('#editorPreview').addClass('editor-sorting');},
        stopPropagation: false,
        before: function(e)
        {
            /* Fix backyard task #11550 https://back.zcorp.cc/pms/task-view-11550.html */
            e.event.preventDefault = function(){};
        },
        finish: function(e)
        {
            $('#editorPreview').removeClass('editor-sorting');
            if(e.changed)
            {
                for(var i = 0; i < e.list.length; ++i)
                {
                    var $item = e.list[i].item;
                    var field = getField($item.data('id'));
                    field.order = i * 100 + 1;
                    field.changed = true;
                }
                sortFields();
                if(isView)
                {
                    var field = getField(e.element.data('id'));
                    var newPosition = e.element.closest('.view-dropbox').data('position');
                    if(newPosition !== field.position)
                    {
                        field.position = newPosition;
                        field.changed = true;
                        updateField(field);
                    }
                }
                updateListPreview();
            }
        }
    });

    /* Bind events on properties editor */
    var $fieldEditOptionsList = $('#fieldEditOptionsList');
    $filedEditForm.on('change', function(e)
    {
        var field = activedField;
        if(!field) return;
        var $control = $(e.target);
        if($control.closest('.field-option-item').length)
        {
            $control = $('#fieldControl');
        }
        var controlName = $control.attr('name');
        var oldValue = field[controlName];
        var controlValue = $control.val();
        if($control.is(':checkbox')) controlValue = $control.prop('checked') ? controlValue : '';
        if(controlName === 'optionType')
        {
            oldValue = typeof field.options === 'object' ? 'custom' : field.options;
            if(controlValue === 'custom')
            {
                field.options = field._options || [];
            }
            else
            {
                if(typeof field.options === 'object') field._options = field.options;
                field.options = controlValue;
            }
        }
        else if(!controlName !== 'control' && field.field !== 'file') field[controlName] = controlValue;
        if(controlName === 'control' || controlName === 'optionType')
        {
            var optionSelectType = getFieldSelectType(field);
            $filedEditForm.find('#fieldEditOptionType').toggleClass('hide', !optionSelectType);
            var isCustomOptions    = optionSelectType && typeof field.options === 'object';
            $('#fieldEditOptions').toggleClass('hide', !isCustomOptions);
            $('#fieldEditSql').toggleClass('hide', isCustomOptions || !optionSelectType || field.options !== 'sql');
            var $optionsList       = $fieldEditOptionsList.empty();
            var $fieldDefaultValue = $('#fieldDefaultValue');
            var isMultiSelect      = optionSelectType === 'multi';
            if(oldValue !== controlValue) field.defaultValue = '';
            if(optionSelectType)
            {
                if(!$fieldDefaultValue.is('select'))
                {
                    $fieldDefaultValue.replaceWith($('<select id="fieldDefaultValue" name="defaultValue" class="form-control"><option value=""></option></select>').attr('multiple', isMultiSelect ? 'multiple' : null));
                    $fieldDefaultValue = $('#fieldDefaultValue').chosen({allow_single_deselect: true});
                }
                else if(isMultiSelect !== !!$fieldDefaultValue.attr('multiple'))
                {
                    $fieldDefaultValue.data('chosen').destroy();
                    $fieldDefaultValue.attr('multiple', isMultiSelect ? 'multiple' : null).chosen({allow_single_deselect: true});
                }
                $fieldDefaultValue.empty();
                if(isCustomOptions)
                {
                    var hasEmptyOption;
                    if(!field.options.length) field.options.push({value: '', text: ''});
                    $.each(field.options, function(_, option)
                    {
                        var $inputGroup = $('<div class="input-group field-option-item"></div>');
                        $inputGroup.append('<span class="input-group-addon">' + keyValueList.key + '</span>');
                        $inputGroup.append($('<input name="optionValue" class="form-control w-50px" placeholder="' + langOptionCode + '" />').val(option.value));
                        $inputGroup.append('<span class="input-group-addon">' + keyValueList.value + '</span>');
                        $inputGroup.append($('<input name="optionText" class="form-control" />').val(option.text));
                        $inputGroup.append('<span class="input-group-addon" style="padding: 4px 2px"><i class="icon icon-plus" data-type="add"></i><i class="icon icon-minus" data-type="delete"></i></span>');
                        $optionsList.append($inputGroup);
                        $fieldDefaultValue.append($('<option>').attr('value', option.value).text(option.text));
                        if(!option.value.length) hasEmptyOption = true;
                    });
                    if(!hasEmptyOption) $fieldDefaultValue.prepend('<option value=""></option>');
                }
                else
                {
                    var options = remoteOptions[field.options];
                    var hasEmptyOption;
                    if(options)
                    {
                        $.each(options, function(_, option)
                        {
                            if(!option.value.length) hasEmptyOption = true;
                            $fieldDefaultValue.append($('<option>').attr('value', option.value).text(option.text));
                        });
                    }
                    if(!hasEmptyOption) $fieldDefaultValue.prepend('<option value=""></option>');
                }
                $fieldDefaultValue.val(field.defaultValue).trigger('chosen:updated');
            }
            else
            {
                if(!$fieldDefaultValue.is('input'))
                {
                    var chosen = $fieldDefaultValue.data('chosen');
                    if(chosen) chosen.destroy();
                    $fieldDefaultValue.replaceWith('<input type="text" id="fieldDefaultValue" name="defaultValue" class="form-control" />');
                    $fieldDefaultValue = $('#fieldDefaultValue').val(field.defaultValue);
                }
            }

            $fieldDefaultValue.attr('placeholder', isMultiSelect ? multiDefaultPlaceholder : '');

            if(optionSelectType && controlName === 'optionType' && !isCustomOptions)
            {
                getDefaultsOfOption(field, function(options)
                {
                    remoteOptions[field.options] = formatOptions(options);
                    validateField(field);
                    $('#fieldControl').change();
                });
            }
        }
        else if(controlName === 'type')
        {
            $('#fieldEditType').toggleClass('hide-type-length', field.type !== 'decimal' && field.type !== 'char' && field.type !== 'varchar');
        }
        if(oldValue !== controlValue)
        {
            field.changed = true;
            if(field.errors)
            {
                if(field.errors && field.errors[controlName]) delete field.errors[controlName];
                if(controlName === 'control' || controlName === 'optionType') delete field.errors.defaultValue;
                if(controlName === 'type') delete field.errors.length;
            }
        }
        validateField(field);
        updateField(field);
    });

    /* Synchronize field options after use change it */
    var syncFieldOptions = function()
    {
        if(!activedField || typeof activedField.options !== 'object') return;
        var options = [];
        $fieldEditOptionsList.find('.field-option-item').each(function()
        {
            var $item = $(this);
            var value = $item.find('[name="optionValue"]').val();
            var text = $item.find('[name="optionText"]').val();
            options.push(
            {
                value: value,
                text: text,
            });
        });
        activedField.options = options;
        activedField._options = options;
        activedField.changed = true;
        validateField(activedField);
        $('#fieldControl').change();
    };
    $fieldEditOptionsList.on('focus', 'input', function()
    {
        $(this).closest('.field-option-item').addClass('active');
    }).on('blur', 'input', function()
    {
        $(this).closest('.field-option-item').removeClass('active');
    }).on('click', '.icon', function()
    {
        var $this = $(this);
        var type = $this.data('type');
        var $item = $this.closest('.field-option-item');
        if(type === 'add')
        {
            var $newItem = $item.clone();
            $newItem.find('[name="optionValue"],[name="optionText"]').val('');
            $item.after($newItem);
        }
        else
        {
            if($fieldEditOptionsList.find('.field-option-item').length === 1)
            {
                $item.find('[name="optionValue"],[name="optionText"]').val('');
            }
            else $item.remove();
        }
        syncFieldOptions();
    }).on('change', syncFieldOptions);

    /* Support to add fields to preview section with drag-and-drop */
    $('#editorControls').droppable(
    {
        container: 'body',
        selector: '.btn-field-control',
        target: '.field-item,#uiPreview,.field-col-item' + (hasActionsInList ? '' : ',#uiListHeader,#uiInfoViewPreview,#uiBasicViewPreview,.field-view-item'),
        stopPropagation: true,
        nested: true,
        start: function()
        {
            $('#editor').addClass('editor-dragging');
        },
        always: function()
        {
            $('#editor').removeClass('editor-dragging');
        },
        drag: function(e)
        {
            $previewBox.find('.drop-hover').removeClass('drop-hover');
            if(e.isIn) $(e.target).closest('#uiListTable,#uiPreviewWrapper,.view-panel').addClass('drop-hover');
        },
        drop: function(e)
        {
            var $element = e.element;
            var field = $element.data('field');
            var nextField;
            var getOrder = function()
            {
                var $target = e.target;
                nextField = $target.is('#uiPreview,#uiListHeader,#uiInfoViewPreview,#uiBasicViewPreview') ? null : getField($target.data('id'));
                if(nextField) return nextField.order - 1;
                var lastField = getField($preview.find('.field-item,.field-col-item,.field-view-item').last().data('id'));
                return lastField ? lastField.order + 1 : fields.length * 100 + 2;
            }
            if(field)
            {
                field = getField(field);
                if(field)
                {
                    field.show    = '1';
                    field.order   = getOrder();
                    field.changed = true;
                    if(isView)
                    {
                        field.position = e.target.closest('.view-dropbox').data('position');
                    }
                }
            }
            else
            {
                var controlType = $element.data('type');
                if(controlType)
                {
                    field =
                    {
                        id          : '_' + $.zui.uuid(),
                        control     : controlType,
                        name        : controlTypeList[controlType],
                        order       : getOrder(),
                        buildin     : '0',
                        layoutRules : '',
                        defaultValue: '',
                        mobileShow  : '0',
                        module      : flowModule,
                        options     : [{value: '', text: ''}],
                        position    : isView ? e.target.closest('.view-dropbox').data('position') : 'left',
                        readonly    : '0',
                        rules       : '',
                        show        : '1',
                        totalShow   : '0',
                        type        : 'varchar',
                        length      : '255',
                        width       : 'auto',
                        changed     : true,
                        isValue     : '0',
                        unsaved     : true
                    };
                    fields.push(field);
                }
            }
            if(field && typeof field === 'object')
            {
                if(nextField) nextField.changed = true;
                field.changed = true;
                sortFields();
                updateField(field, nextField, true);
                updateShowedFields();
                activeField(field);
            }
        }
    });

    /* Limit input content to prevent mistakes */
    $('#fieldLength').on('change', function()
    {
        var $input = $(this);
        $input.val($input.val().replace(/[^\d,]/g, ''));
    });
    $('#fieldField').on('change', function()
    {
        var $input = $(this);
        $input.val($input.val().replace(/[^a-zA-Z]/g, ''));
    });
    $('#fieldEditOptionsList').on('change', '[name="optionValue"]', function()
    {
        var $input = $(this);
        $input.val($input.val().replace(/[^a-zA-Z\d]/g, ''));
    });

    /* Bind event to make list preview auto scroll with header */
    $preview.on('scroll', function()
    {
        $('#uiListBody').scrollLeft($preview.scrollLeft());
    });

    /* Bind event to unactive field on use click top menu */
    $('#editorNav').on('click', unactiveField);

    $('#saveBtn').on('click', saveFields.bind(null, false, function(result)
        {
            if(result) setTimeout(function(){location.href = location.href;}, 1200);
        },
        true
    ));

    $('#editorPages > .btn, .prevStep, #editorSteps > ul > li > a[href*=flowchart]').on('click', function()
    {
        var url = $(this).attr('href');
        if(saveFields(function(result)
        {
            if(result) setTimeout(function(){location.href = url;}, 1200);
        })) return false;
    });

    $('.release.btn').on('click', function(){$('#confirmReleaseModal .close').click();});

    /* Show alert before user leave page without save changes */
    $(window).on('beforeunload', function(e)
    {
        var hasChanges;
        for(var i = 0; i < fields.length; ++i)
        {
            var field = fields[i];
            if(field.changed)
            {
                hasChanges = true;
                break;
            }
        }

        if(hasChanges)
        {
            e = e || window.event;

            // IE8, Firefox 4
            if(e) e.returnValue = leavePageTip;

            // Chrome, Safari, Firefox 4+, Opera 12+ , IE 9+
            return leavePageTip;
        }
    });

    setAutoHeight();
    $(window).on('resize', setAutoHeight);
});
