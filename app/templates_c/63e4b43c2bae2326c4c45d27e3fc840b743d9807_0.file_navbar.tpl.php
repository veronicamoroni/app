<?php
/* Smarty version 5.4.0, created on 2025-02-20 21:49:05
  from 'file:navbar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b79541eff297_11879838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63e4b43c2bae2326c4c45d27e3fc840b743d9807' => 
    array (
      0 => 'navbar.tpl',
      1 => 1740084543,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b79541eff297_11879838 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\app1 - copia\\templates';
?><nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004085;">
    <a class="navbar-brand" href="#">
        <img src="/templates/logo.png" alt="Logo" style="height: 70px;">
    </a>
    <div class="navbar-title mx-auto text-center text-white fw-bold" style="font-size: 2.5rem; font-family: 'Poppins', sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); letter-spacing: 2px;">
        <?php echo $_smarty_tpl->getValue('titulo');?>

    </div>
    
</nav>
<?php }
}
