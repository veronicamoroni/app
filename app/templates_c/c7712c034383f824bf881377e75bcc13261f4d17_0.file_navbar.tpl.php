<?php
/* Smarty version 5.4.0, created on 2025-02-18 16:42:01
  from 'file:navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b4aa49caf963_09545040',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7712c034383f824bf881377e75bcc13261f4d17' => 
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
function content_67b4aa49caf963_09545040 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\app\\frontend\\templates';
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
