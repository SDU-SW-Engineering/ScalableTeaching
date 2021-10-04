<nav class="navbar has-shadow is-transparent">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                WebTech 2021
            </a>
            <div class="navbar-burger" data-target="navbarExampleTransparentExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <div class="navbar-start">
            </div>

            <div class="navbar-end">
                <a class="navbar-item">
                    {{ auth()->user()->getAuthIdentifierName() }}</a>
            </div>
        </div>
    </div>
</nav>
