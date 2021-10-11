$(document).ready(function()
{
    $('#fieldList').on('sort.sortable', function(e, data)
    {
        $.post(createLink('workflowfield', 'sort'), data.orders, function(response)
        {
            if(response.result == 'success')
            {
               return location.reload();            
            }
            else
            {
              bootbox.alert(response.message);
            }
        }, 'json');
    });

    $(document).on('change', '#type', function()
    {
        var type = $(this).val();
        $('.length').toggle(type == 'decimal' || type == 'char' || type == 'varchar');
        $('#default').parents('tr').toggle(type != 'text');
    });

    /* Toggle options. */
    $(document).on('change', '#control', function()
    {   
        var control         = $(this).val();
        var isOptionControl = (control == 'select' || control == 'multi-select' || control == 'radio' || control == 'checkbox');

        if(control == 'textarea') $('#type').val('text').change();

        $('.optionType').toggle(isOptionControl);
        $('#optionType').change();
    }); 

    $(document).on('change', '#optionType', function()
    {
        var control         = $('#control').val();
        var isOptionControl = (control == 'select' || control == 'multi-select' || control == 'radio' || control == 'checkbox');

        $('#optionTR').toggle(isOptionControl && $(this).val() == 'custom');
        $('#optionTR .input-group').fixInputGroup();
        $('.sqlTR').toggle(isOptionControl && $(this).val() == 'sql');
        $('#varsTR').toggle(isOptionControl && $(this).val() == 'sql' && $.trim($('#varsTD').html()) != '');

        getDefaultOptions();
    });

    $(document).on('change', 'input[name^=options], #sql', function()
    {
        getDefaultOptions();
    });

    /* Add a option. */
    $(document).on('click', '.addItem', function()
    {   
        var $parent = $(this).parents('.input-group');
        $parent.after($parent.prop('outerHTML').replace('checked="checked"', ''));
        $parent.next().find('input[type=text]').val('');
    }); 

    /* Delete a option. */
    $(document).on('click', '.delItem', function()
    {   
        if($(this).parents('td').find('diinput-group').size() == 1)
        {   
            $(this).parents('.input-group').find('input').val('');
        }   
        else
        {   
            $(this).parents('.input-group').remove();
        }   
    }); 

    $(document).on('click', '[name=requestType]', function()
    {
        $('#selectList').toggle($(this).val() == 'select' || $(this).val() == 'multi-select');
    });

    $(document).on('click', '.delSqlVar', function()
    {
        $('#sql').val($('#sql').val().replace("'$" + $(this).parents('.varControl').attr('id') + "'", ''));
        $(this).parents('.varControl').remove();
        fixVarControls();
    });

    $panelHeadingHeight = $('.panel-heading').outerHeight(true);
    $panelMarginBottom  = $('.panel').css('margin-bottom').replace('px', '');
    $editorNavHeight    = $('#editorNav').outerHeight(true);
    $editorMenuHeight   = $('#editorMenu').outerHeight();
    $spaceHeight        = $('.space.space-sm').outerHeight(true);
    
    $maxHeight = $(window).height() - $panelHeadingHeight - $panelMarginBottom - $editorNavHeight - $editorMenuHeight - $spaceHeight;
    $('.panel-body').css('max-height', $maxHeight + 'px');
});

function fixVarControls()
{
    var varControls = $('#varsTD .varControl');
    if(varControls.size() == 0) $('#varsTR').hide();
    for(i = 0; i < varControls.size(); i++)
    {
        if(i % 2 == 0)
        {
            $(varControls[i]).removeClass('pull-left pull-right').addClass('pull-left');    
        }
        else
        {
            $(varControls[i]).removeClass('pull-left pull-right').addClass('pull-right');
        }
        if(i > 1) 
        {
            $(varControls[i]).css('padding-top', '5px'); 
        }
        else
        {
            $(varControls[i]).css('padding', '0'); 
        }
    }
}

function getDefaultOptions()
{
    var optionType = $('#optionType').val();
    var control    = $('#control').val();

    if((control != 'select' && control != 'multi-select' && control != 'radio' && control != 'checkbox') || !optionType) return false;

    var defaultValue = $('#default').val();
    if(typeof defaultValue === 'string') defaultValue = defaultValue.split(',');

    if(optionType == 'custom')
    {
        var name     = (control == 'multi-select' || control == 'checkbox') ? 'default[]' : 'default';
        var multiple = (control == 'multi-select' || control == 'checkbox') ? 'multiple' : '';

        $('#default').parent().html("<select name='" + name + "' id='default' class='form-control'" + multiple + '>');
        $('#default').append("<option></option>");
        
        $('input[id^=options][id*=code]').each(function(index, code)
        {
            var code = $(this).val();
            var name = $(this).closest('.input-group').find('input[id^=options][id*=name]').val();

            $('#default').append("<option value='" + code + "'>" + name + '</option>');
        });

        $('#default').val(defaultValue).chosen();
    }
    else
    {

        var type = $('#type').val(); 
        var sql  = $('#sql').val();

        control = window.btoa(encodeURI(control));
        sql     = window.btoa(encodeURI(sql));

        var link = createLink('workflowfield', 'ajaxGetDefaultControl', 'mode=advanced&control=' + control + '&optionType=' + optionType + '&type=' + type + '&sql=' + sql);
        $('#default').parent('td').load(link, function()
        {
            $('#default').val(defaultValue).chosen();
        })
    }

    return false;
}
