$(document).ready(function()
{
    $(document).on('hide.zui.modal', '#triggerModal.layout-modal', function()
    {
        var action = $(this).data('action');

        $('#actionList tr[data-action=' + action + '] .select-action' ).click();
    });

    $('#actionList .select-action').click(function()
    {
        $('#actionList tr.checked').removeClass('checked row-check-begin row-check-end');

        var $tr           = $(this).parents('tr').addClass('checked row-check-begin row-check-end');
        var name          = $tr.data('name');
        var action        = $tr.data('action');
        var buildin       = $tr.data('buildin');
        var extensionType = $tr.data('extensiontype');
        var open          = $tr.data('open');

        $('#previewArea .panel-heading').html('<strong>' + name + '</strong>');

        if(buildin == '1' && extensionType != 'override')
        {
            $('.layout-buildin-tip').show();
            $('.layout-empty-tip').hide();
            $('.layout-no-tip').hide();
            $('.layout-preview').hide();
        }
        else if(open)
        {
            var previewLink = createLink('workflowaction', 'ajaxPreview', 'module=' + module + '&action=' + action);
            $('#previewArea .layout-preview').load(previewLink, function(response)
            {
                if(!response)
                {
                    var setLayoutLink   = createLink('workflowlayout', 'admin', 'module=' + module + '&action=' + action);
                    var setLayoutButton = "<a href='" + setLayoutLink + "' class='btn btn-secondary setLayout' data-toggle='modal'>" + setLayout + '</a>';
                    $('.layout-buildin-tip').hide();
                    $('.layout-empty-tip').find('.setLayout').remove();
                    $('.layout-empty-tip').append(setLayoutButton).show();
                    $('.layout-no-tip').hide();
                    $('.layout-preview').hide();
                    return false;
                }

                $('.preview-content .chosen').chosen();

                $('.example-text-holder').each(function()
                {
                    $(this).attr('data-size', Math.floor(Math.random() * 8) + 2);
                });

                $('.btn-group').fixInputGroup();
            });

            $('.layout-buildin-tip').hide();
            $('.layout-empty-tip').hide();
            $('.layout-no-tip').hide();
            $('.layout-preview').show();
        }
        else
        {
            $('.layout-buildin-tip').hide();
            $('.layout-empty-tip').hide();
            $('.layout-no-tip').show();
            $('.layout-preview').hide();
        }
    });

    $('#actionList .select-action:first').click();

    /* Action */
    $(document).on('change', '#actionTable #type', function()
    {
        $('#batchMode').parents('tr').toggle($(this).val() == 'batch');
        $('#position, #show').parents('tr').toggle($(this).val() == 'single');
        $('#open option[value=modal]').toggle($(this).val() == 'single');
        if($(this).val() == 'batch' && $('#open').val() == 'modal')
        {
            $('#open').val('normal');
        }
    });

    var dateOptions =
    {
        language:  config.clientLang,
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: 'yyyy-mm-dd'
    };
    var datetimeOptions =
    {
        language:  config.clientLang,
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        format: 'yyyy-mm-dd hh:ii'
    };

    /* Condition */
    $(document).on('change', '#conditionTable #conditionType', function()
    {
        $('.sqlTR').toggle($(this).val() == 'sql');
        $('.dataTR').toggle($(this).val() == 'data');
    });

    $(document).on('click', '#conditionTable .addCondition', function()
    {
        $(this).parents('tr').after(itemRow);
        var chosenDefaultOptions = {no_results_text: noResultsMatch, disable_search_threshold: 1, search_contains: true, width: '100%', allow_single_deselect: true};
        $(this).parents('tr').next().find('[name*=field]').chosen(chosenDefaultOptions);
    });

    $(document).on('click', '#conditionTable .delCondition', function()
    {
        $(this).parents('tr').remove();
    });

    $(document).on('change', '#conditionTable [name*=field]', function()
    {
        var $tr  = $(this).parents('tr');
        var name = window.btoa(encodeURI('param[]'));
        var link = createLink('workflowfield', 'ajaxGetFieldControl', 'module=' + module + '&field=' + $(this).val() + '&value=&elementName=' + name + '&elementID=param');
        $tr.find('#paramTD').load(link, function()
        {
            $tr.find('select.chosen').chosen();

            $tr.find('.form-date').datetimepicker(dateOptions);

            $tr.find('.form-datetime').datetimepicker(datetimeOptions);
        });
    });

    /* Linkage */
    $(document).on('change', '#linkageTable [name^=source]', function()
    {
        processField();

        var field  = $(this).find('option:selected').val();
        var $value = $(this).parents('tr').find('[name^=value]');
        var value  = $value.val();
        var name   = $value.attr('name');
        var id     = $value.attr('id');

        value = window.btoa(encodeURI(value));
        name  = window.btoa(encodeURI(name));
        $(this).parents('tr').find('td.value').load(createLink('workflowfield', 'ajaxGetFieldControl', 'module=' + module + '&field=' + field + '&value=' + value + '&elementName=' + name + '&elementID=' + id), function()
        {
            $(this).parents('tr').find('td.value select.chosen').chosen();

            $('.form-datetime').datetimepicker(
            {
                language:  config.clientLang,
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii'
            });

            $('.form-date').datetimepicker(
            {
                language:  config.clientLang,
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: 'yyyy-mm-dd'
            });
        });
    });

    $(document).on('click', '#linkageTable .addTarget', function()
    {
        var $rowspan = parseInt($('th.target').attr('rowspan'));
        $rowspan++;

        $('th.target').attr('rowspan', $rowspan);
        $(this).parents('tr').after(targetRow.replace(/KEY/g, targetIndex));
        $(this).parents('tr').next().find('.chosen').chosen();

        targetIndex++;

        processField();
    })

    $(document).on('click', '#linkageTable .delTarget', function()
    {
        if($('.delTarget').length == 1)
        {
            $(this).parents('tr').find('input,select').val('');
            $(this).parents('tr').find('.chosen').trigger('chosen:updated');
            return false;
        }

        var rowspan = parseInt($('th.target').attr('rowspan'));
        rowspan--;

        if($(this).parents('tr').find('th').length) 
        {
            $(this).parents('tr').next().prepend(th.replace(/ROWSPAN/g, rowspan));
        }
        else
        {
            $('th.target').attr('rowspan', rowspan);
        }
        $(this).parents('tr').remove();

        processField();
    })

    $(document).on('change', '#linkageTable [name^=target]', function()
    {
        processField();
    });

    $(document).on('change', '#linkageTable [name^=source], #linkageTable [name^=operator], #linkageTable [name^=value]', function()
    {
        $('#sourceLabel').remove();
    });

    $(document).on('change', '#linkageTable [name^=target], #linkageTable [name^=status]', function()
    {
        $('#targetLabel').remove();
    });

    /* Verification */
    $(document).on('change', '#verificationTable [name^=paramType], #verificationTable [name*=\\[field\\]], #verificationTable [name*=\\[paramType\\]]', function()
    {
        var $tr       = $(this).closest('tr');
        var paramType = $tr.find('[name*=paramType]').val();
        if(paramType != 'custom')
        {
            var name = 'param[]';
            if($tr.hasClass('dataTR'))  name = 'conditions[param][]';
            if($tr.hasClass('fieldTR')) name = 'fields[param][]';
            if($tr.hasClass('whereTR')) name = 'wheres[param][]';

            if($tr.find('span.param .chosen').length == 0) $tr.find('span.param .chosen').html("<select name='" + name + "' id='param' class='form-control chosen'></select>");
            $tr.find('span.param .chosen').chosen();
        }

        if(paramType == 'today' || paramType == 'now' || paramType == 'actor' || paramType == 'deptManager')
        {
            $tr.find('input#param').attr('disabled', 'disabled').val('').show();
            $tr.find('select#param').removeAttr('disabled');
            $tr.find('#param_chosen').hide();
        }
        else if(paramType == 'custom')
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            var field = $tr.find('[name*=\\[field\\]]').val();
            var value = $tr.find('input#param').val();
            var name  = $tr.find('input#param').attr('name');
            var id    = $tr.find('input#param').attr('id');

            value = window.btoa(encodeURI(value));
            name = window.btoa(encodeURI(name));
            var link = createLink('workflowfield', 'ajaxGetFieldControl', 'module=' + module + '&field=' + field + '&value=' + value + '&elementName=' + name + '&elementID=' + id);

            $.get(link, function(data)
            {
                paramValue = $tr.find('span.param .chosen').val();
                $tr.find('span.param').html(data);
                $tr.find('span.param .chosen').val(paramValue).chosen();

                $tr.find('span.param .form-date').datetimepicker(dateOptions);

                $tr.find('span.param .form-datetime').datetimepicker(datetimeOptions);
            });
        }
        else if(paramType == 'form')
        {
            var value = $tr.find('select#param').val();
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            $tr.find('#param_chosen .chosen-single span').html('');
            $tr.find('#param_chosen').show();
            $tr.find('#param_chosen .chosen-single').focus();
            $tr.find('select#param').removeAttr('disabled').empty().append($('#formFieldsDIV').html());
            $tr.find('select#param').val(value).trigger('chosen:updated');
        }
        else if(paramType == 'record')
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            $tr.find('#param_chosen .chosen-single span').html('');
            $tr.find('#param_chosen').show();
            $tr.find('#param_chosen .chosen-single').focus();
            var value = $tr.find('select#param').val();
            $tr.find('select#param').removeAttr('disabled').empty().append($('#recordFieldsDIV').html());
            $tr.find('select#param').val(value).trigger('chosen:updated');
        }
        else
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            var value = $tr.find('select#param').val();

            value = window.btoa(encodeURI(value));

            var link  = createLink('workflowfield', 'ajaxGetParamOptions', 'paramType=' + $(this).val() + '&param=' + value);
            $tr.find('select#param').removeAttr('disabled').load(link, function()
            {
                $tr.find('select#param').trigger('chosen:updated');
            });
            $tr.find('#param_chosen .chosen-single span').html('');
            $tr.find('#param_chosen').show();
            $tr.find('#param_chosen .chosen-single').focus();
        }
    });

    $(document).on('click', '#verificationTable .addVerification, #verificationTable .addVar', function()
    {
        var $tr = $(this).parents('tr');
        if($(this).hasClass('addVar'))
        {
            $tr.after(varRow);
        }
        else if($(this).hasClass('addVerification'))
        {
            $tr.after(verificationRow);
        }
        $tr.next().find('.chosen').chosen();
        $tr.next().find('#param_chosen').hide();
    });

    $(document).on('click', '#verificationTable .delVerification, #verificationTable .delVar', function()
    {
        if($(this).hasClass('delVar'))
        {
            $('#sql').val($('#sql').val().replace("'$" + $(this).parents('tr').find('#varName').val() + "'", ''));
            if($('.delVar').size() == 1) 
            { 
                $(this).parents('tr').find('input,select').val('').find('.chosen').trigger('chosen:updated');
                $(this).parents('tr').find('.chosen-single span').html('');
                return;
            }
        }

        $(this).parents('tr').remove();
    });

    $(document).on('change', '#verificationTable [name*=varName]', function()
    {
        if($(this).val() != '') $('#sql').val($('#sql').val() + "'$" + $(this).val() + "'");
    });

    /* Hook */
    $(document).on('change', '.hookForm #conditionType', function()
    {
        $('.sqlTR').toggle($(this).val() == 'sql');
        $('.dataTR').toggle($(this).val() == 'data');
    });

    $(document).on('change', '.hookForm #action, .hookForm #table', function()
    {
        $('.fieldTR').toggle($('#action').val() != 'delete');
        
        if($('#action').val() == 'insert')
        {
            $('.whereTR').hide().find('input,select').attr('disabled', 'disabled');
        }
        else
        {
            $('.whereTR').show().find('input,select').removeAttr('disabled');
        }

        if($(this).attr('id') == 'table')
        {
            var link = createLink('workflowhook', 'ajaxGetTableFields', 'table=' + $(this).val());
            $('.field').load(link, function()
            {
                $('.field').trigger('chosen:updated');
            });
        }
    });

    $(document).on('click', '.hookForm .toggleCondition', function()
    {
        var val = $('#condition').val() == 1 ? 0 : 1;
        $('#condition').val(val);
        $('#conditionDIV').toggle();
    });

    $(document).on('change', '.hookForm [name^=paramType], .hookForm [name*=\\[field\\]], .hookForm [name*=\\[paramType\\]]', function()
    {
        var $tr       = $(this).parents('tr');
        var paramType = $tr.find('[name*=paramType]').val();
        if(paramType != 'custom')
        {
            var name = 'param[]';
            if($tr.hasClass('dataTR'))  name = 'conditions[param][]';
            if($tr.hasClass('fieldTR')) name = 'fields[param][]';
            if($tr.hasClass('whereTR')) name = 'wheres[param][]';

            $tr.find('span.param').html("<select name='" + name + "' id='param' class='form-control chosen'></select>");
            $tr.find('span.param .chosen').chosen();
        }

        if(paramType == 'today' || paramType == 'now' || paramType == 'actor' || paramType == 'deptManager')
        {
            $tr.find('input#param').removeAttr('disabled').attr('readonly', 'readonly').val('').show();
            $tr.find('select#param').removeAttr('disabled');
            $tr.find('#param_chosen').hide();
        }
        else if(paramType == 'custom')
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            var field = $tr.find('[name*=\\[field\\]]').val() || '';
            var value = $tr.find('input#param').val();
            var name  = $tr.find('input#param').attr('name');
            var id    = $tr.find('input#param').attr('id');

            value = window.btoa(encodeURI(value));
            name  = window.btoa(encodeURI(name));
            var link = createLink('workflowfield', 'ajaxGetFieldControl', 'module=' + ($tr.hasClass('dataTR') ? module : $('#table').val()) + '&field=' + field + '&value=' + value + '&elementName=' + name + '&elementID=' + id);

            $tr.find('span.param').load(link, function()
            {
                if($tr.attr('class') == 'whereTR' && $tr.is(':hidden'))
                {
                    $tr.find('span.param input#param').attr('disabled', 'disabled');
                }

                $tr.find('span.param .chosen').chosen();

                $tr.find('span.param .form-datetime').datetimepicker(
                {
                    language:  config.clientLang,
                    weekStart: 1,
                    todayBtn:  1,
                    autoclose: 1,
                    todayHighlight: 1,
                    startView: 2,
                    forceParse: 0,
                    showMeridian: 1,
                    format: 'yyyy-mm-dd hh:ii'
                });

                $tr.find('span.param .form-date').datetimepicker(
                {
                    language:  config.clientLang,
                    weekStart: 1,
                    todayBtn:  1,
                    autoclose: 1,
                    todayHighlight: 1,
                    startView: 2,
                    minView: 2,
                    forceParse: 0,
                    format: 'yyyy-mm-dd'
                });
            });
        }
        else if(paramType == 'form')
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            $tr.find('#param_chosen .chosen-single span').html('');
            $tr.find('#param_chosen').show();
            $tr.find('#param_chosen .chosen-single').focus();
            var value = $tr.find('input#param').val();
            $tr.find('select#param').removeAttr('disabled').empty().append($('#formFieldsDIV').html());
            $tr.find('select#param').val(value).trigger('chosen:updated');
        }
        else if(paramType == 'record')
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            $tr.find('#param_chosen .chosen-single span').html('');
            $tr.find('#param_chosen').show();
            $tr.find('#param_chosen .chosen-single').focus();
            var value = $tr.find('input#param').val();
            $tr.find('select#param').removeAttr('disabled').empty().append($('#recordFieldsDIV').html());
            $tr.find('select#param').val(value).trigger('chosen:updated');
        }
        else
        {
            $tr.find('input#param').attr('disabled', 'disabled').hide();
            var value = $tr.find('input#param').val();

            value = window.btoa(encodeURI(value));

            var link  = createLink('workflowfield', 'ajaxGetParamOptions', 'paramType=' + paramType + '&param=' + value);
            $tr.find('select#param').removeAttr('disabled').load(link, function()
            {
                $tr.find('select#param').trigger('chosen:updated');
            });
            $tr.find('#param_chosen .chosen-single span').html('');
            $tr.find('#param_chosen').show();
            $tr.find('#param_chosen .chosen-single').focus();
        }
    });

    $(document).on('click', '.hookForm .addVar, .hookForm .addCondition, .hookForm .addField, .hookForm .addWhere', function()
    {
        var $tr = $(this).parents('tr');
        if($(this).hasClass('addVar'))
        {
            $tr.after(varRow);
        }
        else if($(this).hasClass('addCondition'))
        {
            $tr.after(conditionRow);
        }
        else if($(this).hasClass('addField'))
        {
            $tr.after(fieldRow);

            var link = createLink('workflowhook', 'ajaxGetTableFields', 'table=' + $('#table').val());
            $tr.next('tr').find('.field').load(link, function()
            {
                $(this).trigger('chosen:updated');
            });
        }
        else if($(this).hasClass('addWhere'))
        {
            $tr.after(whereRow);

            var link = createLink('workflowhook', 'ajaxGetTableFields', 'table=' + $('#table').val());
            $tr.next('tr').find('.field').load(link, function()
            {
                $(this).trigger('chosen:updated');
            });
        }
        $tr.next().find('.chosen').chosen();
        $tr.next().find('#param_chosen').hide();
    });

    $(document).on('click', '.hookForm .delVar, .hookForm .delCondition, .hookForm .delField, .hookForm .delWhere', function()
    {
        if($(this).hasClass('delVar'))
        {
            $('#sql').val($('#sql').val().replace("'$" + $(this).parents('tr').find('#varName').val() + "'", ''));
            if($('.delVar').size() == 1) 
            { 
                $(this).parents('tr').find('input,select').val('').find('.chosen').trigger('chosen:updated');
                $(this).parents('tr').find('.chosen-single span').html('');
                return;
            }
        }

        $(this).parents('tr').remove();
    });

    $(document).on('change', '.hookForm [name*=varName]', function()
    {
        if($(this).val() != '') $('#sql').val($('#sql').val() + "'$" + $(this).val() + "'");
    });

    $panelHeadingHeight = $('.panel-heading').outerHeight(true);
    $panelMarginBottom  = $('.panel').css('margin-bottom').replace('px', '');
    $editorNavHeight    = $('#editorNav').outerHeight(true);
    $editorMenuHeight   = $('#editorMenu').outerHeight();
    $spaceHeight        = $('.space.space-sm').outerHeight(true);
    
    $maxHeight = $(window).height() - $panelHeadingHeight - $panelMarginBottom - $editorNavHeight - $editorMenuHeight - $spaceHeight;
    $('.panel-body').css('max-height', $maxHeight + 'px');
});

/**
 * Make sure each field be selected only once.
 *
 * @access public
 * @return void
 */
function processField()
{
    $('#linkageTable [name^=source]').each(function()
    {
        var $this    = $(this);
        var selected = $this.val();
        $this.empty().append($('#fieldTemplate').html());
        $('#linkageTable [name^=source]').not(this).each(function()
        {
            var next = $(this).val();
            if(next != 0) $this.find('option[value=' + next + ']').remove();
        });
        $('#linkageTable [name^=target]').each(function()
        {
            var next = $(this).val();
            if(next != 0) $this.find('option[value=' + next + ']').remove();
        });
        $this.val(selected).trigger('chosen:updated');
    });

    $('#linkageTable [name^=target]').each(function()
    {
        var $this    = $(this);
        var selected = $this.val();
        $this.empty().append($('#fieldTemplate').html());
        $('#linkageTable [name^=target]').not(this).each(function()
        {
            var next = $(this).val();
            if(next != 0) $this.find('option[value=' + next + ']').remove();
        });
        $('#linkageTable [name^=source]').each(function()
        {
            var next = $(this).val();
            if(next != 0) $this.find('option[value=' + next + ']').remove();
        });
        $this.val(selected).trigger('chosen:updated');
    });
}
