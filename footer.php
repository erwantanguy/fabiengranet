<footer id="footer" class="row">
				<div class="col-lg-6 col-md-6"><!-- © -->
					<p>Fabien Granet <i class="glyphicon glyphicon-copyright-mark"></i> Tous Droits Réservés - 2015 - Création <a href="http://www.ticoet.fr">ticoët</a></p>
				</div>	
				<div class="col-lg-6 col-md-6">
					<?php wp_nav_menu(array(
						'theme_location' => 'troisieme',
						'walker' => new Bootstrap_Walker_Nav_Menu(),
						'menu_class' => 'nav navbar-nav navbar-right'
					) );
					?>
				</div>
				<?php wp_footer(); ?>
			</footer>
		</div>
	</body>
</html>