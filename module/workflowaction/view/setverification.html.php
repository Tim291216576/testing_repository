<?php
/**
 * The set verification view file of workflowaction module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflowaction
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('module', $flow->module);?>
<form id='ajaxForm' method='post' action='<?php echo inlink('setVerification', "id=$action->id");?>'>
  <table class='table table-form' id='verificationTable'>
    <tr>
      <th class='w-80px'></th>
      <td class='w-160px'></td>
      <td class='w-60px'></td>
      <td class='w-200px'></td>
      <td></td>
      <td class='w-120px'></td>
    </tr>
    <tr>
      <th><?php echo $lang->workflowverification->type;?></th>
      <td colspan='4'><?php echo html::select('type', $lang->workflowverification->typeList, !empty($action->verifications->type) ? $action->verifications->type : 'data', "class='form-control'");?></td>
      <td></td>
    </tr>
    <tr class='sqlTR'>
      <th><?php echo $lang->workflowverification->sql;?></th>
      <td colspan='4'>
        <div class='required required-wrapper'></div>
        <?php echo html::textarea('sql', !empty($action->verifications->sql) ? $action->verifications->sql : '', "rows='5' class='form-control' placeholder='{$lang->workflowverification->placeholder->sql}'");?>
      </td>
      <td></td>
    </tr>
    <?php if(!empty($action->verifications->sqlVars)):?>
    <?php foreach($action->verifications->sqlVars as $sqlVar):?>
    <tr class='sqlTR'>
      <th><?php echo $lang->workflowverification->varName;?></th>
      <td><?php echo html::input('varName[]', $sqlVar->varName, "id='varName' class='form-control'");?></td>
      <th><?php echo $lang->workflowverification->varValue;?></th>
      <td class='nopaddingright'>
        <?php echo html::select('paramType[]', $datasources, $sqlVar->paramType, "id='paramType' class='form-control'");?>
      </td>
      <td class='nopaddingleft'>
        <?php echo html::input('param[]', $sqlVar->param, "id='param' class='form-control'");?>
        <span class='param'><?php echo html::select('param[]', array($sqlVar->param => ''), $sqlVar->param, "id='param' class='form-control chosen'");?></span>
      </td>
      <td class='nopaddingleft'>
        <a href='javascript:;' class='btn addVar'><i class='icon-plus icon-large'></i></a>
        <a href='javascript:;' class='btn delVar'><i class='icon-close icon-large'></i></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr class='sqlTR'>
      <th><?php echo $lang->workflowverification->varName;?></th>
      <td><?php echo html::input('varName[]', '', "id='varName' class='form-control'");?></td>
      <th><?php echo $lang->workflowverification->varValue;?></th>
      <td class='nopaddingright'>
        <?php echo html::select('paramType[]', $datasources, $action->action == 'create' ? 'form' : 'record', "id='paramType' class='form-control'");?>
      </td>
      <td class='nopaddingleft'>
        <?php echo html::input('param[]', '', "id='param' class='form-control'");?>
        <span class='param'><?php echo html::select('param[]', '', '', "id='param' class='form-control chosen'");?></span>
      </td>
      <td class='nopaddingleft'>
        <a href='javascript:;' class='btn addVar'><i class='icon-plus icon-large'></i></a>
        <a href='javascript:;' class='btn delVar'><i class='icon-close icon-large'></i></a>
      </td>
    </tr>
    <?php endif;?>
    <tr class='sqlTR'>
      <th><?php echo $lang->workflowverification->result;?></th>
      <td colspan='4'><?php echo html::select('sqlResult', $lang->workflowverification->resultList, isset($action->verifications->sqlResult) ? $action->verifications->sqlResult : 'empty', "class='form-control'");?></td>
    </tr>
    <?php if(!empty($action->verifications->fields)):?>
    <?php foreach($action->verifications->fields as $key => $verification):?>
    <tr class='dataTR'>
      <th>
        <?php if($key == 0):?>
        <?php echo $lang->workflowverification->field;?>
        <?php echo html::hidden("verifications[logicalOperator][]", $verification->logicalOperator);?>
        <?php else:?>
        <?php echo html::select("verifications[logicalOperator][]", $lang->workflowverification->logicalOperatorList, $verification->logicalOperator, "class='form-control'");?>
        <?php endif;?>
      </th>
      <td><?php echo html::select('verifications[field][]', $fields, $verification->field, "id='verificationsfield' class='form-control chosen'");?></td>
      <td colspan='2' class='nopaddingright'>
        <div class='input-group'>
          <?php $conditionDatasources = $datasources;?>
          <?php unset($conditionDatasources['form']);?>
          <?php unset($conditionDatasources['record']);?>
          <?php echo html::select('verifications[operator][]', $config->workflowaction->operatorList, $verification->operator, "class='form-control'");?>
          <span class='input-group-addon fix-border fix-padding'></span>
          <?php echo html::select('verifications[paramType][]', $conditionDatasources, $verification->paramType, "id='paramType' class='form-control'");?>
        </div>
      </td>
      <td class='nopaddingleft'>
        <?php echo html::input('verifications[param][]', $verification->param, "id='param' class='form-control'");?>
        <span class='param'><?php echo html::select('verifications[param][]', array($verification->param => ''), $verification->param, "id='param' class='form-control chosen'");?></span>
      </td>
      <td class='nopaddingleft'>
        <a href='javascript:;' class='btn addVerification'><i class='icon-plus icon-large'></i></a>
        <?php if($key > 0):?>
        <a href='javascript:;' class='btn delVerification'><i class='icon-close icon-large'></i></a>
        <?php endif;?>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr class='dataTR'>
      <th>
        <?php if(empty($action->verifications->fields)):?>
        <?php echo $lang->workflowverification->field;?>
        <?php echo html::hidden("verifications[logicalOperator][]", 'and');?>
        <?php else:?>
        <?php echo html::select("verifications[logicalOperator][]", $lang->workflowverification->logicalOperatorList, 'and', "class='form-control'");?>
        <?php endif;?>
      </th>
      <td><?php echo html::select('verifications[field][]', $fields, '', "id='verificationsfield' class='form-control chosen'");?></td>
      <td colspan='2' class='nopaddingright'>
        <div class='input-group'>
          <?php $conditionDatasources = $datasources;?>
          <?php unset($conditionDatasources['form']);?>
          <?php unset($conditionDatasources['record']);?>
          <?php echo html::select('verifications[operator][]', $config->workflowaction->operatorList, 'equal', "class='form-control'");?>
          <span class='input-group-addon fix-border fix-padding'></span>
          <?php echo html::select('verifications[paramType][]', $conditionDatasources, 'custom', "id='paramType' class='form-control'");?>
        </div>
      </td>
      <td class='nopaddingleft'>
        <?php echo html::input('verifications[param][]', '', "id='param' class='form-control'");?>
        <span class='param'><?php echo html::select('verifications[param][]', '', '', "id='param' class='form-control chosen'");?></span>
      </td>
      <td class='nopaddingleft'>
        <a href='javascript:;' class='btn addVerification'><i class='icon-plus icon-large'></i></a>
        <?php if(!empty($action->verifications->fields)):?>
        <a href='javascript:;' class='btn delVerification'><i class='icon-close icon-large'></i></a>
        <?php endif;?>
      </td>
    </tr>
    <?php endif;?>
    <tr>
      <th><?php echo $lang->workflowverification->message;?></th>
      <td colspan='4'>
        <div class='required required-wrapper'></div>
        <?php echo html::input('message', isset($action->verifications->message) ? $action->verifications->message : '', "class='form-control' placeholder='{$lang->workflowverification->placeholder->message}'");?>
      </td>
    </tr>
    <tr>
      <th></th>
      <td class='form-actions' colspan='5'>
        <?php echo baseHTML::submitButton();?>
        <?php echo baseHTML::a(inlink('setVerification', "id=$action->id&mode=reset"), $lang->workflowaction->resetVerification, "class='btn'");?>
      </td>
    </tr>
  </table>
</form>

<div id='recordFieldsDIV' class='hide'>
  <option></option>
  <?php 
  foreach($fields as $field => $name)
  {
      echo "<option value='$field'>$name</option>";
  }
  ?>
</div>
<div id='formFieldsDIV' class='hide'>
  <option></option>
  <?php 
  foreach($layoutFields as $field => $name)
  {
      echo "<option value='$field'>$name</option>";
  }
  ?>
</div>

<?php
$varName   = html::input('varName[]', '', "class='form-control'");
$paramType = html::select('paramType[]', $datasources, 'custom', "id='paramType' class='form-control'");
$input     = html::input('param[]', '', "id='param' class='form-control'");
$select    = html::select('param[]', '', '', "id='param' class='form-control chosen'");
$varRow = <<<EOT
  <tr class='sqlTR'>
    <th>{$lang->workflowverification->varName}</th>
    <td>{$varName}</td>
    <th>{$lang->workflowverification->varValue}</th>
    <td class='nopaddingright'>{$paramType}</td>
    <td class='nopaddingleft'>
      {$input}
      <span class='param'>{$select}</span>
    </td>
    <td class='nopaddingleft'>
      <a href='javascript:;' class='btn addVar'><i class='icon-plus icon-large'></i></a>
      <a href='javascript:;' class='btn delVar'><i class='icon-close icon-large'></i></a>
    </td>
  </tr>
EOT;

$logicOperater = html::select('verifications[logicalOperator][]', $lang->workflowverification->logicalOperatorList, '', "class='form-control'");
$field         = html::select('verifications[field][]', $fields, '', "class='form-control chosen'");
$operator      = html::select('verifications[operator][]', $config->workflowaction->operatorList, 'equal', "class='form-control'");
$paramType     = html::select('verifications[paramType][]', $conditionDatasources, 'custom', "id='paramType' class='form-control'");
$input         = html::input( 'verifications[param][]', '', "id='param' class='form-control'");
$select        = html::select('verifications[param][]', '', '', "id='param' class='form-control chosen'");
$verificationRow = <<<EOT
  <tr class="dataTR">
    <th>{$logicOperater}</th>
    <td>{$field}</td>
    <td colspan='2' class="nopaddingright">
      <div class="input-group">
        {$operator}
        <span class="input-group-addon fix-border fix-padding"></span>
        {$paramType}
      </div>
    </td>
    <td class="nopaddingleft">
      {$input}
      <span class='param'>{$select}</span>
    </td>
    <td class="nopaddingleft">
      <a href="javascript:;" class="btn addVerification"><i class="icon-plus icon-large"></i></a>
      <a href="javascript:;" class="btn delVerification"><i class="icon-close icon-large"></i></a>
    </td>
  </tr>
EOT;
js::set('varRow', $varRow);
js::set('verificationRow', $verificationRow);
?>
<?php include '../../common/view/footer.modal.html.php';?>
