<?php
/* SVN FILE: $Id$ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php echo $html->charset(); ?>
<title><?php //__('CakePHP: the rapid development php framework:'); ?> <?php echo $title_for_layout; ?>
</title>
<?php
echo $html->meta('icon');
echo $html->css('cake.generic');
echo $scripts_for_layout;
?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="navItems">
			<?php
			if(isset($user)){
				if(in_array("admin",$permissions)) {
					echo $html->link('List All Works',
					array('controller' => 'works', 'action' => 'index'),
					array('escape'=>false)
					);
					echo " | ";
				}
				echo $html->link('Grid view',
				array('controller' => 'works', 'action' => 'grid'),
				array('escape'=>false)
				);
				echo "<br/>";
				//echo " | ";
				echo $html->link('Olga Korper',
				array('controller' => 'works', 'action' => 'find',"?q=olga-korper"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('Page &amp; Strange',
				array('controller' => 'works', 'action' => 'find',"?q=page-strange"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('CANADA',
				array('controller' => 'works', 'action' => 'find',"?q=canada"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('Wynick-Tuck',
				array('controller' => 'works', 'action' => 'find',"?q=wynick-tuck"),
				array('escape'=>false)
				);
				//echo " | ";
				//if (isset($user['User'])) echo $user['User']['username'];
				echo "<br/>";
				//echo " | ";
				/*
				echo $html->link('Family NFS',
				array('controller' => 'works', 'action' => 'find',"?q=NFS-Estate"),
				array('escape'=>false)
				);
				if(in_array("admin",$permissions)) {
				}
				*/
				//echo " | ";
				echo $html->link('Sold Works',
				array('controller' => 'works', 'action' => 'find',"?q=sold"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('Reserved works',
				array('controller' => 'works', 'action' => 'find',"?q=RESERVED"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('In storage',
				array('controller' => 'works', 'action' => 'find',"?q=storage"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('Westies (NJ)',
				array('controller' => 'works', 'action' => 'find',"?loc=westies"),
				array('escape'=>false)
				);
				echo " || ";
				echo $html->link('Pre 1990',
				array('controller' => 'works', 'action' => 'find',"?ds=1960&de=1990"),
				array('escape'=>false)
				);
				echo " | ";
				echo $html->link('Post 1990',
				array('controller' => 'works', 'action' => 'find',"?ds=1990&de=2009"),
				array('escape'=>false)
				);
			}
			?>
			</div>
			<?php if(isset($user)){?>
			<div id="searchFormContainer">
			<form method="get" action="<?php echo BASESEARCH_HREF?>/works/find/">
				<input type="text" name="q" />
				<br />
				<input type="submit" value="search" style="margin-top: 5px" />
			</form>
			</div>
			<?php } ?>
		</div>
		<div id="content">
		<?php $session->flash(); ?>
		<?php echo $content_for_layout; ?>
		</div>
		<div id="footer"></div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
	<?php //echo $cakeDebug; ?>
</body>
</html>
