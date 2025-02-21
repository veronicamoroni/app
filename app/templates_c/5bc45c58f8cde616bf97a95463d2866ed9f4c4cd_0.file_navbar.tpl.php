<?php
/* Smarty version 5.4.0, created on 2025-02-20 14:00:23
  from 'file:navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b72767a14f22_01464967',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5bc45c58f8cde616bf97a95463d2866ed9f4c4cd' => 
    array (
      0 => 'navbar.tpl',
      1 => 1740056419,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b72767a14f22_01464967 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\app1\\templates';
?><nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004085;">
    <a class="navbar-brand" href="#">
        <img src="/templates/logo.png" alt="Logo" style="height: 70px;">
    </a>
    <div class="navbar-title mx-auto text-center text-white" style="font-size: 2rem;">
        <?php echo $_smarty_tpl->getValue('titulo');?>

    </div>
</nav>
<?php }
}
