<?php
/* Smarty version 5.4.0, created on 2025-02-18 01:01:41
  from 'file:navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b3cde523ecf8_36152895',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13e2c053649f2fa91d5e87dc8058e43747b7a455' => 
    array (
      0 => 'navbar.tpl',
      1 => 1739752326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b3cde523ecf8_36152895 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\a\\templates';
?><nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004085;">
    <a class="navbar-brand" href="#">
        <img src="/logo.png" alt="Logo" style="height: 70px;">
    </a>
    <div class="navbar-title mx-auto text-center text-white" style="font-size: 2rem;">
        <?php echo $_smarty_tpl->getValue('titulo');?>

    </div>
</nav>
<?php }
}
