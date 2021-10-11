<style>
input[id^=urCommon]{border-right:0px;}
</style>
<?php
$clientLang = $this->app->getClientLang();
$html  = "<div class='form-group'><label>{$lang->custom->conceptQuestions['URAndSR']}</label>";
$html .= "<div class='checkbox'>" . html::radio('URAndSR', $lang->custom->conceptOptions->URAndSR, zget($this->config->custom, 'URAndSR', '0')) . "</div>";
$html .= "</div>";
$html .= "<div class='form-group' id='URSRName'><label>{$lang->custom->conceptQuestions['URSRName']}</label>";
$html .= "<div class='input-group'>";

$URSRName = isset($this->config->custom->URSRName) ? json_decode($this->config->custom->URSRName, true) : array();
$html .= html::input("urCommon[{$clientLang}]", isset($URSRName['urCommon'][$clientLang]) ? $URSRName['urCommon'][$clientLang] : $lang->custom->URStory, "class='form-control'");
$html .= "<span class='input-group-addon'></span>";
$html .= html::input("srCommon[{$clientLang}]", isset($URSRName['srCommon'][$clientLang]) ? $URSRName['srCommon'][$clientLang] : $lang->custom->SRStory, "class='form-control'");
$html .= "</div></div>";
?>
<script>
$(function()
{
    $('#ajaxForm .modal-body .form-group').eq(1).after(<?php echo json_encode($html);?>);
    $('input[name=URAndSR]').change(function(){toggleURSR($(this).val());})
    $("[name='storyRequirement']").change(function()
    {
        $("[name='URAndSR']").closest('.form-group').toggle($(this).val() == 0);
        toggleURSR($(this).val() == 0);
    });
    $("[name='storyRequirement']:checked").change();
    toggleURSR($('input[name=URAndSR]:checked').val())
})
function toggleURSR(value)
{
    if(value == 0)
    {
        $('#ajaxForm .modal-body .form-group').eq(3).show();
        $('#ajaxForm .modal-body .form-group#URSRName').hide();
    }
    else
    {
        $('#ajaxForm .modal-body .form-group').eq(3).hide();
        $('#ajaxForm .modal-body .form-group#URSRName').show();
    }
}
</script>
