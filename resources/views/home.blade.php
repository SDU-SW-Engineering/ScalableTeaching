<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Technologies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
@include('partials.navbar')
<section class="hero is-link">
    <div class="hero-body">
        <div class="container">
            <p class="title">
                Assignment 1
            </p>
            <p class="subtitle">
                Due date 29/10/2021 23:59:59
            </p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-6-desktop is-offset-3-desktop">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Start Assignment
                        </p>
                        <button class="card-header-icon" aria-label="more options">
                            <span class="icon">
                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                        </button>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            @if(session()->has('missing-gitlab-user'))
                                <article class="message is-danger">
                                    <div class="message-header">
                                        <p>GitLab User Missing</p>
                                    </div>
                                    <div class="message-body">
                                        It looks like your GitLab user doesn't exist on our SDU server. Logging in once,
                                        should create a user for you. You can refresh this page once done. Also make
                                        sure that you are signed into the correct SDU account.
                                        <br><a class="button is-link is-small mt-4" href="https://gitlab.sdu.dk"
                                               target="_blank">Login to GitLab</a>
                                    </div>
                                </article>
                            @endif
                            @if(session()->has('error'))
                                <article class="message is-danger">
                                    <div class="message-header">
                                        <p>Error</p>
                                    </div>
                                    <div class="message-body">
                                        {{ session('error') }}
                                    </div>
                                </article>
                            @endif

                            @if(session()->has('success'))
                                <article class="message is-success">
                                    <div class="message-header">
                                        <p>Assignment Created</p>
                                    </div>
                                    <div class="message-body">
                                        <p>Your assignment has been created successfully, click the lik below to access it.<br><b>If you get a 404 error, you are most likely not signed in to GitLab</b></p>
                                        <a href="https://gitlab.sdu.dk/projects/{{ session('success') }}" class="button is-small is-success mt-4 is-fullwidth">Go to Repo</a>
                                    </div>
                                </article>
                            @else
                                <p>We are now ready to present the first assignment. Press the button below to get
                                    started.</p>

                                <a href="{{ route('start') }}" class="button is-dark is-fullwidth mt-4">Create
                                    Assignment
                                    Repo</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
