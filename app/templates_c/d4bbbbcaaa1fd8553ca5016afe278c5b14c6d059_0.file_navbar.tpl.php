<?php
/* Smarty version 5.4.0, created on 2025-02-20 22:38:21
  from 'file:navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b7a0cd973372_35025231',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4bbbbcaaa1fd8553ca5016afe278c5b14c6d059' => 
    array (
      0 => 'navbar.tpl',
      1 => 1740087497,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b7a0cd973372_35025231 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\EDI\\app\\templates';
?><nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004085;">
    <a class="navbar-brand" href="#">
        <img src="/templates/logo.png" alt="Logo" style="height: 70px;">
    </a>
    <div class="navbar-title mx-auto text-center text-white fw-bold" style="font-size: 3rem; font-family: 'Poppins', sans-serif; ">
        <?php echo $_smarty_tpl->getValue('titulo');?>

    </div>
    
</nav>
<?php }
}
