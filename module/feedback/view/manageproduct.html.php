<?php
/**
 * The manage member view of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     feedback
 * @version     $Id: managemember.html.php 4627 2013-04-10 05:42:20Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2>
        <strong><?php echo $product->name;?></strong>
        <small class='text-muted'> <?php echo $lang->feedback->manageProduct;?></small>
      </h2>
    </div>
    <form class='main-form' method='post' target='hiddenwin'>
      <table class='table table-form'> 
        <tr>
          <th class='thWidth text-left'><strong><?php echo $lang->feedback->grantUser;?></strong></th>
          <td></td>
        </tr>
        <?php
        $feedbackUsers = array();
        $developUsers  = array();
        foreach($view as $account)
        {
            if(!isset($users[$account])) continue;
            $user = $users[$account];
            if($user->feedback)  $feedbackUsers[$account] = !empty($user->realname) ? $user->realname : $account;
            if(!$user->feedback) $developUsers[$account]  = !empty($user->realname) ? $user->realname : $account;
            unset($users[$account]);
        }
        ?>
        <?php if($developUsers):?>
        <tr>
          <td class='text-top'>
            <div class="group">
              <div class="checkbox-primary">
                <input checked="checked" id="isFeedback0" type="checkbox">
                <label for="isFeedback0"><?php echo $lang->user->isFeedback[0];?></label>
              </div>
            </div>
          </td>
          <td>
            <?php foreach($developUsers as $account => $realname):?>
            <div class='item'>
              <div class="checkbox-primary">
                <input name="accounts[]" value="<?php echo $account;?>" checked="checked" id="accounts<?php echo $account?>" type="checkbox">
                <label for="account<?php echo $account?>"><?php echo $realname;?></label>
              </div>
            </div>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <?php if($feedbackUsers):?>
        <tr>
          <td class='text-top'>
            <div class='group'>
              <div class="checkbox-primary">
                <input checked="checked" id="isFeedback1" type="checkbox">
                <label for="isFeedback1"><?php echo $lang->user->isFeedback[1];?></label>
              </div>
            </div>
          </td>
          <td class='<?php if($developUsers) echo 'bt-dotted-1px';?>'>
            <?php foreach($feedbackUsers as $account => $realname):?>
            <div class='item'>
              <div class="checkbox-primary">
                <input name="accounts[]" value="<?php echo $account;?>" checked="checked" id="accounts<?php echo $account?>" type="checkbox">
                <label for="account<?php echo $account?>"><?php echo $realname;?></label>
              </div>
            </div>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <tr class='bt-1px'>
          <th class='text-left'><strong><?php echo $lang->feedback->noGrantUser;?></strong></th>
          <td></td>
        </tr>
        <?php
        $feedbackUsers = array();
        $developUsers  = array();
        foreach($users as $account => $user)
        {
            if($user->feedback)  $feedbackUsers[$account] = !empty($user->realname) ? $user->realname : $account;
            if(!$user->feedback) $developUsers[$account]  = !empty($user->realname) ? $user->realname : $account;
        }
        ?>
        <?php if($developUsers):?>
        <tr>
          <td class='text-top'>
            <div class='group'>
              <div class="checkbox-primary">
                <input id="isFeedback0" type="checkbox">
                <label for="isFeedback0"><?php echo $lang->user->isFeedback[0];?></label>
              </div>
            </div>
          </td>
          <td>
            <?php foreach($developUsers as $account => $realname):?>
            <div class='item'>
              <div class="checkbox-primary">
                <input name="accounts[]" value="<?php echo $account;?>" id="accounts<?php echo $account?>" type="checkbox">
                <label for="account<?php echo $account?>"><?php echo !empty($realname) ? $realname : $account;?></label>
              </div>
            </div> 
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <?php if($feedbackUsers):?>
        <tr>
          <td class='text-top'>
            <div class='group'>
              <div class="checkbox-primary">
                <input id="isFeedback1" type="checkbox">
                <label for="isFeedback1"><?php echo $lang->user->isFeedback[1];?></label>
              </div>
            </div>
          </td>
          <td class='<?php if($developUsers) echo 'bt-dotted-1px';?>'>
            <?php foreach($feedbackUsers as $account => $realname):?>
            <div class='item'>
              <div class="checkbox-primary">
                <input name="accounts[]" value="<?php echo $account;?>" id="accounts<?php echo $account?>" type="checkbox">
                <label for="account<?php echo $account?>"><?php echo !empty($realname) ? $realname : $account;?></label>
              </div>
            </div> 
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <tr>
          <td colspan='2' class='text-center form-actions'>
            <?php echo html::submitButton();?>
            <?php echo html::backButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
