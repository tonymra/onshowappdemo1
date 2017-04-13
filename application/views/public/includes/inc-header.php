<nav id="mainmenu" class="navbar navbar-fixed-top main-menu head-menu auto-height" role="navigation">
        <div class="container">
            
            <!-- LOGO CONTAINER -->
            <div class="logo-cont">
                    <a class="navbar-brand" href='<?php echo base_url("welcome"); ?>'><!-- SCROLLS TO TOP OF THE PAGE -->
                        
                        <!--PLACE URL OF YOUR LOGO BELOW-->
                        <img src="<?php echo base_url('/assets/public'); ?>/img/01-logo-ORANGE.png" alt>
                        
                    </a>
                    
            </div>
            
            <!-- MAIN MENU BUTTONS CONTAINER -->
          
            
            <!-- "BURGER MENU" FOR RESPONSIVE VIEW -->
            <div class="navbar-header" id="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <!-- MAIN MENU CONTAINER -->
            <div id="navbar" class="navbar-collapse collapse">
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                      
                        <!-- MAIN MENU POSITIONS -->
                        <li><a href='<?php echo base_url("welcome"); ?>'>Home</a></li>
                        <li><a href='<?php echo base_url("welcome"); ?>'>Buyer</a></li>
                        <li><a href='<?php echo base_url("real_estate_agent"); ?>' >Real Estate Agent</a></li>
                        <li><a href='<?php echo base_url("private_seller"); ?>'>Private Seller</a></li>
                        <li><a href='<?php echo base_url("property_developer"); ?>' >Property Developer</a></li>
                        <li><a href='<?php echo base_url("private_auction"); ?>'>Private Auction</a></li>
                        <li><a href='<?php echo base_url("auction_house"); ?>'>Auction House</a></li>
                        <li><a href="http://support.onshowapp.co.za/" target="_blank">Get in touch</a></li>
                        
                    </ul>
                </div>
            </div>
            
        </div>
    </nav>