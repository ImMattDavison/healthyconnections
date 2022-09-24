<div class="sticky">
    <nav class="navbar navbar-expand-sm">
        <div class="container flex nav-container external-nav-container">
            <div class="flex nav-container small-nav-container">
                <a class="navbar-brand align-items-center" href="../">
                    <img src="./assets/branding/wordmark.svg" alt="logo - HealthyConnections" height="55px">
                </a>
                <button class="navbar-toggle" type="button">
                    &#9776;
                </button>
            </div>
            <ul class="navbar-nav flex nav-sm">
                <li class="nav-item br">
                    <a class="nav-link br" href="../">HOME</a>
                </li>
                <li class="nav-item br sub-nav-parent">
                    <div class="sub-nav-closed-row">
                        <a class="nav-link br" href="../">ABOUT <b class="lg-dropper">&#9207;</b></a><button class="sub-nav-toggle">&#9207;</button>
                    </div>
                    <ul class="sub-nav">
                        <li class="sub-nav-item"><a href="../">Pricing</a></li>
                        <li class="sub-nav-item"><a href="../">FAQ</a></li>
                    </ul>
                </li>
                <li class="nav-item br">
                    <a class="nav-link br" href="../">CONTACT</a>
                </li>
                <?php if(!isset($_SESSION["loggedin"])): ?>
                    <div class="accounts-buttons">
                        <li class="nav-item br account-button-container">
                            <a class="nav-link br register-button" href="/signup.php">SIGN-UP</a>
                        </li>
                        <li class="nav-item br account-button-container">
                            <a class="nav-link br login-button" href="/login.php">LOGIN</a>
                        </li>
                    </div>
                <?php else: if(isset($_SESSION["loggedin"])): ?>
                    <li class="nav-item br sub-nav-parent">
                        <div class="sub-nav-closed-row">
                            <a class="nav-link br" href="../">ACCOUNT <b class="lg-dropper">&#9207;</b></a><button class="sub-nav-toggle">&#9207;</button>
                        </div>
                    </li>
                <?php endif; endif; ?>
            </ul>
    </nav>
        </div>
        <script>
            // Main mobile nav opener/closer
            const menuButton = document.querySelector('.navbar-toggle');
            const navContainer = document.querySelector('.nav-sm');

            menuButton.addEventListener('click', () => {
                if (navContainer.style.maxHeight) {
                    navContainer.style.maxHeight = null;
                } else {
                    navContainer.style.maxHeight = "600px";
                } 
            });

            // First Subnav opener/closer
            const subNavButton = document.querySelector('.sub-nav-toggle');
            const subNavContainer = document.querySelector('.sub-nav');

            subNavButton.addEventListener('click', () => {
                if (subNavContainer.style.maxHeight) {
                    subNavContainer.style.maxHeight = null;
                } else {
                    subNavContainer.style.maxHeight = subNavContainer.scrollHeight + "px";
                } 
            });
        </script>
</div>